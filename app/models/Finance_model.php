<?php

use Ramsey\Uuid\Uuid;

class Finance_model extends Model
{
	protected $table = "finance";
	protected $fields = [
		'no_akun',
		'kategori',
		'deskripsi',
		'jumlah',
		'tanggal',
	];

	private function generateCode($kategori, $tanggal)
	{
		switch ($kategori) {
			case 'masuk':
				$kategori = 'MSK';
				break;
			case 'keluar':
				$kategori = 'KLR';
				break;
		}

		$year = date('Y', strtotime($tanggal));
		$month = date('m', strtotime($tanggal));
		$day = date('d', strtotime($tanggal));
		$randomNumber = str_pad(strval(rand(100, 999)), 3, '0', STR_PAD_LEFT);

		return $kategori . $year . $month . $day . $randomNumber;
	}

	public function getAllData($outlet_uuid = false)
{
    $query = "SELECT * FROM {$this->table} WHERE `status` = 1";
    
    if ($outlet_uuid) {
        $query .= " AND `outlet_uuid` = :outlet_uuid";
    }

    $this->db->query($query);

    if ($outlet_uuid) {
        $this->db->bind('outlet_uuid', $outlet_uuid);
    }

    return $this->db->fetchAll();
}


	public function getDataByKuartal($kuartal, $tahun, $outlet_uuid = false)
	{
		$this->db->query(
			"SELECT * FROM {$this->table} 
				WHERE 
				QUARTER(`tanggal`) = :kuartal AND
				YEAR(`tanggal`) = :tahun AND
				`status` = 1
			" . ($outlet_uuid ? " AND {$this->table}.`outlet_uuid` = :outlet_uuid" : '')
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('kuartal', $kuartal);
		$this->db->bind('tahun', $tahun);

		return $this->db->fetchAll();
	}

	public function getFilteredData($startDate, $endDate, $outlet_uuid = false)
	{
		$query = "SELECT * FROM {$this->table} 
                  WHERE `tanggal` >= :startDate 
                  AND `tanggal` <= :endDate 
                  AND `status` = 1";

		if ($outlet_uuid) {
			$query .= " AND `outlet_uuid` = :outlet_uuid";
		}

		$this->db->query($query);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('startDate', $startDate);
		$this->db->bind('endDate', $endDate);

		return $this->db->fetchAll();
	}

	public function getKreditAndDebitOutlet($outlet_uuid)
	{
		$this->db->query(
			"SELECT `kategori`, SUM(`jumlah`) AS 'total' FROM {$this->table} 
				WHERE 
				`outlet_uuid` = :outlet_uuid AND
				`status` = 1
			GROUP BY `kategori`"
		);

		$this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetchAll();
	}

	public function getDataBetween($start_date, $end_date, $outlet_uuid = false)
	{
		$this->db->query(
			"SELECT * FROM {$this->table} 
				WHERE `status` = 1 AND `tanggal` BETWEEN :start_date AND :end_date" . 
			($outlet_uuid ? " AND {$this->table}.`outlet_uuid` = :outlet_uuid" : '')
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('start_date', $start_date);
		$this->db->bind('end_date', $end_date);
		return $this->db->fetchAll();
	}

	public function getLatestData()
	{
		$this->db->query("SELECT * FROM {$this->table} ORDER BY `created_at` DESC LIMIT 1");
		return $this->db->fetch();
	}

	public function getDataById($id)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE `status` = 1 AND `id` = :id");
		$this->db->bind('id', $id);
		return $this->db->fetch();
	}

	public function getDataByUuid($uuid)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE `status` = 1 AND `id` = :uuid");
		$this->db->bind('uuid', $uuid);
		return $this->db->fetch();
	}

	public function getDataByRelation($relation)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE `status` = 1 AND `relation` = :relation");
		$this->db->bind('relation', $relation);
		return $this->db->fetch();
	}

	public function insert($data)
	{
		$fields_query = ":no_akun, :kode, :kategori, :deskripsi, :jumlah, :tanggal, null, :outlet_uuid,";

		$this->db->query(
			"INSERT INTO {$this->table} 
				VALUES
      		(null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		foreach ($this->fields as $field)
			$this->db->bind($field, $data[$field]);
		$this->db->bind('kode', $this->generateCode($data['kategori'], $data['tanggal']));
		$this->db->bind('uuid', Uuid::uuid4()->toString());
		$this->db->bind('created_by', $this->user);
		$this->db->bind('outlet_uuid', $data['outlet_uuid']);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function insertFrom($relation, $jumlah, $deskripsi, $tanggal, $outlet_uuid = '')
	{
		$from = explode('|', $relation, 2)[0];

		$this->db->query("SELECT `akun` from no_akun WHERE `note` = '$from' AND `status` = 1");
		$akun = $this->db->fetch(PDO::FETCH_COLUMN);
		$kategori = ($from == 'penjualan') ? 'masuk' : 'keluar';

		$fields_query = ":no_akun, :kode, :kategori, :deskripsi, :jumlah, :tanggal, :relation, :outlet_uuid,";
		$this->db->query(
			"INSERT INTO {$this->table} 
				VALUES
      		(null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		$this->db->bind('no_akun', $akun);
		$this->db->bind('kode', $this->generateCode($kategori, $tanggal));
		$this->db->bind('kategori', $kategori);
		$this->db->bind('deskripsi', $deskripsi);
		$this->db->bind('jumlah', $jumlah);
		$this->db->bind('tanggal', $tanggal);
		$this->db->bind('relation', $relation);
		$this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('uuid', Uuid::uuid4()->toString());
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function update($id, $data)
	{
		$fields_query = "
			no_akun = :no_akun,
			kategori = :kategori,
			deskripsi = :deskripsi,
			jumlah = :jumlah,
			tanggal = :tanggal,
		";

		$this->db->query(
			"UPDATE {$this->table}
				SET
				{$fields_query}
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE id = :id"
		);

		foreach ($this->fields as $field)
			$this->db->bind($field, $data[$field]);
		$this->db->bind('modified_by', $this->user);
		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();

	}
	public function updateFrom($relation, $jumlah, $tanggal)
	{
		$fields_query = "
			jumlah = :jumlah,
			tanggal = :tanggal,
		";

		$this->db->query(
			"UPDATE {$this->table}
				SET
				{$fields_query}
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE `status` = 1 AND `relation` = :relation"
		);

		$this->db->bind('jumlah', $jumlah);
		$this->db->bind('tanggal', $tanggal);
		$this->db->bind('relation', $relation);
		$this->db->bind('modified_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function updateField($id, $field, $value)
	{
		$this->db->query(
			"UPDATE {$this->table}
				SET 
				{$field} = :val,
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE id = :id"
		);

		$this->db->bind('val', $value);
		$this->db->bind('id', $id);
		$this->db->bind('modified_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function delete($id)
	{
		$this->db->query(
			"UPDATE {$this->table}  
				SET 
				`deleted_at` = CURRENT_TIMESTAMP,
				`deleted_by` = :deleted_by,
				`is_deleted` = 1
			WHERE id = :id"
		);

		$this->db->bind('deleted_by', $this->user);
		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function deleteFrom($relation)
	{
		$this->db->query(
			"UPDATE {$this->table}
				SET
				`deleted_at` = CURRENT_TIMESTAMP,
				`deleted_by` = :deleted_by,
				`is_deleted` = 1
			WHERE `relation` = :relation"
		);

		$this->db->bind('relation', $relation);
		$this->db->bind('deleted_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function destroy($id)
	{
		$this->db->query("DELETE FROM {$this->table} WHERE id = :id");

		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}
}
