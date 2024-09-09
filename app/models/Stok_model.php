<?php

use Ramsey\Uuid\Uuid;

class Stok_model extends Model
{
	protected $table = "stok";
	protected $riwayat = "riwayat_stok";

	protected $fields = [
        'nama',
        'jenis',
        'satuan',
    ];

	public function getAllData($outlet_uuid = false)
	{
		$this->db->query(
			(
				($outlet_uuid) ?
					"SELECT r.`riwayat`, r.`stok`, s.* FROM {$this->table} s
					LEFT JOIN {$this->riwayat} r ON r.`stok_id` = s.`id`
						WHERE s.`status` = 1 AND r.`outlet_uuid` = :outlet_uuid"
				:
					"SELECT * FROM {$this->table} WHERE `status` = 1"
			)
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetchAll();
	}

	public function getRiwayatBy($stok_id, $outlet_uuid) {
		$this->db->query(
			"SELECT * FROM {$this->riwayat}
				WHERE 
			`status` = 1 AND 
			`stok_id` = :stok_id AND 
			`outlet_uuid` = :outlet_uuid"
		);

		$this->db->bind('stok_id', $stok_id);
		$this->db->bind('outlet_uuid', $outlet_uuid);

		return $this->db->fetch();
	}

	public function getLatestData()
	{
		$this->db->query("SELECT * FROM {$this->table} ORDER BY `created_at` DESC LIMIT 1");
		return $this->db->fetch();
	}

	public function getDataById($id, $outlet_uuid = false)
	{
		$this->db->query(
			(
				($outlet_uuid) ?
					"SELECT r.`riwayat`, r.`stok`, s.* FROM {$this->table} s
					LEFT JOIN {$this->riwayat} r ON r.`stok_id` = s.`id`
						WHERE 
					s.`status` = 1 AND 
					s.`id` = :id AND
					r.outlet_uuid = :outlet_uuid"
				:
					"SELECT * FROM {$this->table} WHERE `status` = 1 AND `id` = :id"
			)
		);
		
		$this->db->bind('id', $id);
		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetch();
	}

	public function getDataByName($nama, $outlet_uuid = false)
	{
		$this->db->query(
			($outlet_uuid) ?
				"SELECT r.`riwayat`, r.`stok`, s.* FROM {$this->table} s
				LEFT JOIN {$this->riwayat} r ON r.`stok_id` = s.`id`
					WHERE 
				s.`status` = 1 AND 
				s.`nama` = :nama AND
				r.outlet_uuid = :outlet_uuid"
			:
				"SELECT * FROM {$this->table} WHERE `status` = 1 AND `nama` = :nama"
		);

		$this->db->bind('nama', $nama);
		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetch();
	}

	public function getAllKemasan()
	{
		$this->db->query("SELECT nama FROM {$this->table} WHERE `status` = 1 AND `jenis` = 'kemasan'");
		return $this->db->fetchAll(PDO::FETCH_COLUMN);
	}

	public function getMultipleBy($field = 'id', $data = [], $outlet_uuid = false)
	{
		$sanitized_data = array_map(function ($item) {
			return (gettype($item) == 'string') ? "'{$item}'" : $item;
		}, $data);
		
		$query = implode(', ', $sanitized_data);
		$this->db->query(
			"SELECT r.`riwayat`, r.`stok`, s.* FROM {$this->table} s
			INNER JOIN {$this->riwayat} r ON r.`stok_id` = s.`id`
				WHERE 
			s.`status` = 1 AND 
			s.`{$field}` IN ({$query}) AND
			r.`outlet_uuid` = :outlet_uuid"
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetchAll();
	}

	public function insert($data)
	{
		// insert data stok
		$fields_query = ":nama, :jenis, :satuan,";

		$this->db->query(
            "INSERT INTO {$this->table} 
				VALUES
            (null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT);"
        );

        $this->db->bind('uuid', Uuid::uuid4()->toString());
        foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
        $this->db->bind('created_by', $this->user);

        $this->db->execute();
		return $this->db->rowCount();
	}

	public function insertRiwayat($data) {
		// Insert data riwayat
		$fields_query = ":stok_id, :stok, :riwayat, :outlet_uuid,";

		$this->db->query(
            "INSERT INTO {$this->riwayat} 
				VALUES
            (null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT);"
        );

		$this->db->bind('uuid', Uuid::uuid4()->toString());
		$this->db->bind('stok_id', $data['stok_id']);
		$this->db->bind('stok', $data['stok']);
		$this->db->bind('riwayat', $data['riwayat']);
		$this->db->bind('outlet_uuid', $data['outlet_uuid']);
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function update($id, $data, $rename_all = true)
	{
		$old_name = $this->getDataById($id)['nama'];

		$fields_query = "
            nama = :nama,
            jenis = :jenis,
            satuan = :satuan,
        ";

		$this->db->query(
            "UPDATE {$this->table}
				SET
                {$fields_query}
                modified_at = CURRENT_TIMESTAMP,
                modified_by = :modified_by
            WHERE id = :id"
        );

		foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
        $this->db->bind('id', $id);
        $this->db->bind('modified_by', $this->user);
        $this->db->execute();

		if ($rename_all) {
			// Update bahan in all menu that contain old bahan name
			$this->db->query("SELECT id, bahan FROM menu WHERE bahan LIKE :bahan");
			$this->db->bind('bahan', '%"'.$old_name.'"%', false);
			$all_menu = $this->db->fetchAll();
	
			foreach ($all_menu as $menu) {
				$bahan_update = str_replace($old_name, $data['nama'], $menu['bahan']);
				$this->db->query("UPDATE menu SET bahan = :bahan WHERE id = :id");
				$this->db->bind('bahan', $bahan_update);
				$this->db->bind('id', $menu['id']);
				$this->db->execute();
			}
	
			// Update all shipment detail_barang that contain old bahan name
			$this->db->query("SELECT id, detail_barang FROM shipment WHERE detail_barang LIKE :detail_barang");
			$this->db->bind('detail_barang', '%"'.$old_name.'"%', false);
			$shipments = $this->db->fetchAll();
	
			foreach ($shipments as $shipment) {
				$detail_update = str_replace($old_name, $data['nama'], $shipment['detail_barang']);
				$this->db->query("UPDATE shipment SET detail_barang = :detail_barang WHERE id = :id");
				$this->db->bind('detail_barang', $detail_update);
				$this->db->bind('id', $shipment['id']);
				$this->db->execute();
			}
		}

        return $this->db->rowCount();
	}

	public function updateRiwayat($stok_id, $outlet_uuid, $tanggal, $value = ['masuk' => 0, 'keluar' => 0])
	{
		$data = $this->getRiwayatBy($stok_id, $outlet_uuid);
		$riwayat = json_decode($data['riwayat'], true);

		// Update masuk & keluar
		if (isset($value['masuk'])) $riwayat[$tanggal]['masuk'] = $value['masuk'];
		if (isset($value['keluar'])) $riwayat[$tanggal]['keluar'] = $value['keluar'];

		// If data is new (masuk or keluar isn't set yet), fill that data with 0
		if (!isset($riwayat[$tanggal]['masuk'])) $riwayat[$tanggal]['masuk'] = 0;
		if (!isset($riwayat[$tanggal]['keluar'])) $riwayat[$tanggal]['keluar'] = 0;

		// Calculate stok periodicly
		$stok = 0;
		foreach ($riwayat as $key => $i) {
			$stok += ($i['masuk'] - $i['keluar']);
			$riwayat[$key]['stok'] = $stok;
		}

		$this->db->query(
			"UPDATE {$this->riwayat}
				SET 
				stok = :stok,
				riwayat = :riwayat,
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE stok_id = :stok_id AND outlet_uuid = :outlet_uuid"
		);

		$this->db->bind('stok', $stok);
		$this->db->bind('riwayat', json_encode($riwayat));
		$this->db->bind('stok_id', $stok_id);
		$this->db->bind('outlet_uuid', $outlet_uuid);
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

	public function deleteRiwayat($stok_id, $outlet_uuid)
	{
		$this->db->query(
            "UPDATE {$this->riwayat}  
                SET 
                `deleted_at` = CURRENT_TIMESTAMP,
                `deleted_by` = :deleted_by,
                `is_deleted` = 1
            WHERE stok_id = :stok_id AND outlet_uuid = :outlet_uuid"
        );

		$this->db->bind('stok_id', $stok_id);
		$this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('deleted_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function destroy($id)
	{
		$this->db->query("DELETE FROM {$this->table} WHERE");
		
		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}
}
