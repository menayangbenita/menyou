<?php

use Ramsey\Uuid\Uuid;

class Outlet_model extends Model
{
	protected $table = "outlet";
	protected $fields = [
		'nama',
		'manager_id',
		'alamat',
		'kota',
		'lokasi',
		'nomor_telp',
		'pajak',
	];

	public function getAllData()
	{
		$this->db->query(
			"SELECT users.username AS manager, {$this->table}.* FROM {$this->table}
			LEFT JOIN `users` ON users.id = {$this->table}.manager_id
				WHERE {$this->table}.`status` = 1"
		);
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
		$this->db->query(
			"SELECT users.username AS manager, {$this->table}.* FROM {$this->table}
			LEFT JOIN `users` ON users.id = {$this->table}.manager_id
				WHERE {$this->table}.`status` = 1 AND {$this->table}.`uuid` = :uuid"
		);
		$this->db->bind('uuid', $uuid);
		return $this->db->fetch();
	}

	public function getAllUuid()
	{
		$this->db->query("SELECT `uuid` FROM {$this->table} WHERE `status` = 1");
		return $this->db->fetchAll(PDO::FETCH_COLUMN);
	}

	public function getAllUuidkExcept($uuid)
	{
		$this->db->query("SELECT `uuid` FROM {$this->table} WHERE `status` = 1 AND `uuid` <> :uuid");

		$this->db->bind('uuid', $uuid);
		return $this->db->fetchAll(PDO::FETCH_COLUMN);
	}

	public function insert($data)
	{
		if (!$this->validateFiles([
			'foto' => [
				'mime:image/jpeg,image/png,image/gif',
				'type:png,jpg,jpeg,gif',
				'size:2*MB',
			],
		])) return 0;

		$fields_query = ":foto, :nama, :manager_id, :alamat, :kota, :lokasi, :nomor_telp, :pajak,";

		$this->db->query(
			"INSERT INTO {$this->table} 
				VALUES
      		(null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		$uuid = Uuid::uuid4()->toString();

		foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
		$this->db->bind('foto', $this->storeFile('foto', 'upload/outlet'));
		$this->db->bind('uuid', $uuid);
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		if ($this->db->rowCount() > 0)
			return [$data['manager_id'], $uuid];
		return false;
	}

	public function update($id, $data)
	{
		if (!$this->validateFiles([
			'foto' => [
				'mime:image/jpeg,image/png,image/gif',
				'type:png,jpg,jpeg,gif',
				'size:2*MB',
			],
		])) return 0;

		$old = $this->getDataById($id);

		$fields_query = "
			foto = :foto,
			nama = :nama,
			manager_id = :manager_id,
			alamat = :alamat,
			kota = :kota,
			lokasi = :lokasi,
			nomor_telp = :nomor_telp,
			pajak = :pajak,
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
		$this->db->bind('foto', $this->storeFile('foto', 'upload/outlet', false, $old['foto']));
		$this->db->bind('id', $id);
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
			WHERE id = :id AND (SELECT COUNT(*) FROM {$this->table}) > 1"
		);
		
		$this->db->bind('deleted_by', $this->user);
		$this->db->bind('id', $id);

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
