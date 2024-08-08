<?php

use Ramsey\Uuid\Uuid;

class Rewardpunishment_model extends Model
{
	protected $table = "reward_punishment";
	protected $fields = [
        'karyawan_id',
        'jenis',
        'jumlah',
        'besaran',
        'keterangan',
        'tanggal',
    ];

	public function getAllData()
	{
		$this->db->query(
			"SELECT karyawan.nama AS `nama`, {$this->table}.* FROM {$this->table}
			INNER JOIN `karyawan` ON karyawan.id = {$this->table}.karyawan_id
		 		WHERE {$this->table}.status = 1"
		);

		return $this->db->fetchAll();
	}

	public function getAllDataFiltered($tanggal, $jenis = null) {
		$query = "SELECT * FROM reward_punishment WHERE tanggal = :tanggal";
		
		if ($jenis) {
			$query .= " AND jenis = :jenis";
		}
		
		$this->db->query($query);
		$this->db->bind(':tanggal', $tanggal);
	
		if ($jenis) {
			$this->db->bind(':jenis', $jenis);
		}
	
		return $this->db->fetchAll();
	}
	
	

	public function getLatestData()
	{
		$this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT 1");
		return $this->db->fetch();
	}

	public function getDataById($id)
	{
		$this->db->query(
			"SELECT karyawan.nama AS `nama`, karyawan.posisi AS `posisi`, {$this->table}.* FROM {$this->table}
			INNER JOIN `karyawan` ON karyawan.id = {$this->table}.karyawan_id
		 		WHERE 
			{$this->table}.status = 1 AND
			{$this->table}.id = :id"
		);

		$this->db->bind('id', $id);
		return $this->db->fetch();
	}

	public function getDataByUuid($uuid)
	{
		$this->db->query(
			"SELECT 
				karyawan.nama AS `nama`, 
				karyawan.posisi AS `posisi`,
				outlet.nama AS `nama_outlet`, 
				outlet.alamat AS `alamat_outlet`, 
				outlet.kota AS `kota_outlet`, 
				outlet.nomor_telp AS `telp_outlet`,
				users.username AS `manager`, 
				{$this->table}.* FROM {$this->table}
			INNER JOIN `karyawan` ON karyawan.id = {$this->table}.karyawan_id
			LEFT JOIN `outlet` ON outlet.uuid = karyawan.outlet_uuid
			LEFT JOIN `users` ON users.id = outlet.manager_id
		 		WHERE {$this->table}.`status` = 1 AND {$this->table}.`uuid` = :uuid"
		);

		$this->db->bind('uuid', $uuid);
		return $this->db->fetch();
	}

	public function getDataByMonthYear($month, $year)
	{
		$this->db->query(
			"SELECT karyawan.nama AS `nama`, {$this->table}.* FROM {$this->table}
			INNER JOIN `karyawan` ON karyawan.id = {$this->table}.karyawan_id
				WHERE
			EXTRACT(MONTH FROM {$this->table}.tanggal) = :month AND
			EXTRACT(YEAR FROM {$this->table}.tanggal) = :year AND
			{$this->table}.status = 1"	
		);

		$this->db->bind('month', $month);
		$this->db->bind('year', $year);
		
		return $this->db->fetchAll();
	}

	public function insert($data)
	{
		$fields_query = ":karyawan_id, :jenis, :jumlah, :besaran, DEFAULT, :keterangan, :tanggal,";

		$this->db->query(
				"INSERT INTO {$this->table} 
					VALUES
				(null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		foreach ($this->fields as $field)
			$this->db->bind($field, $data[$field]);
		$this->db->bind('uuid', Uuid::uuid4()->toString());
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function update($id, $data)
	{
		$fields_query = "
			karyawan_id = :karyawan_id,
			jenis = :jenis,
			jumlah = :jumlah,
			besaran = :besaran,
			total = DEFAULT,
			keterangan = :keterangan,
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

		foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
		$this->db->bind('modified_by', $this->user);
		$this->db->bind('id', $id);

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
		$this->db->bind('modified_by', $this->user);
		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function delete($id)
	{
		$this->db->query(
			"UPDATE {$this->table}  
				SET 
				deleted_at = CURRENT_TIMESTAMP,
				deleted_by = :deleted_by,
				is_deleted = 1,
				is_restored = 0
			WHERE id = :id"
		);

		$this->db->bind('deleted_by', $this->user);
		$this->db->bind('id', $id);

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