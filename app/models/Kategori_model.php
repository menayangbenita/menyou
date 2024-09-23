<?php

use Ramsey\Uuid\Uuid;

class Kategori_model extends Model
{
	protected $table = "kategori";
	protected $fields = [
		'nama',
		'deskripsi'
	];

	public function getAllData()
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE `status` = 1");
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

	public function insert($data)
	{
		if (
			!$this->validateFiles([
				'foto' => [
					'mime:image/jpeg,image/png,image/gif',
					'type:png,jpg,jpeg,gif',
					'size:2*MB',
				],
			])
		)
			return 0;

		$fields_query = ":foto, :nama, :deskripsi";

		$this->db->query(
			"INSERT INTO {$this->table} 
				VALUES
      		(null, :uuid, {$fields_query}, '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		foreach ($this->fields as $field)
			$this->db->bind($field, $data[$field]);
		$this->db->bind('foto', $this->storeFile('foto', 'upload/kategori'));
		$this->db->bind('uuid', Uuid::uuid4()->toString());
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function update($id, $data)
	{
		if (
			!$this->validateFiles([
				'foto' => [
					'mime:image/jpeg,image/png,image/gif',
					'type:png,jpg,jpeg,gif',
					'size:2*MB',
				],
			])
		)
			return 0;

		$old = $this->getDataById($id);

		$fields_query = "
			foto= :foto,
			nama= :nama, 
			deskripsi= :deskripsi,
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
		$this->db->bind('foto', $this->storeFile('foto', 'upload/kategori', false, $old['foto']));
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

	public function destroy($id)
	{
		$this->db->query("DELETE FROM {$this->table} WHERE id = :id");

		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}
}
