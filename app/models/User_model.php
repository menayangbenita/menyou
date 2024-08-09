<?php

use Ramsey\Uuid\Uuid;

class User_model
{
	protected $table = 'users';
	protected $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function getAllUser($activated = false, $order_by_status = true)
	{
		$this->db->query(
			"SELECT 
				outlet.uuid AS `outlet_uuid`,
				outlet.nama AS `nama_outlet`, 
				outlet.alamat AS `alamat_outlet`, 
				outlet.nomor_telp AS `telp_outlet`, 
				outlet.pajak AS `pajak_outlet`, 
				outlet.manager_id AS `manager_id`, 
				{$this->table}.* FROM {$this->table}
			LEFT JOIN `outlet` ON outlet.uuid = {$this->table}.outlet_uuid" 
			.($activated ? " WHERE {$this->table}.active = 1" : '').
			" ORDER BY {$this->table}.active DESC, ".($order_by_status ? "{$this->table}.status DESC, " : '')."
			CASE 
				WHEN {$this->table}.`role` = 'Owner' THEN 1 
				WHEN {$this->table}.`role` = 'Manager' THEN 2 
				ELSE 3
			END"
		);
		return $this->db->fetchAll();
	}
	

	public function getUser($username, $password)
	{
		$this->db->query(
			"SELECT 
				outlet.uuid AS `outlet_uuid`, 
				outlet.nama AS `nama_outlet`, 
				outlet.alamat AS `alamat_outlet`, 
				outlet.nomor_telp AS `telp_outlet`, 
				outlet.pajak AS `pajak_outlet`, 
				outlet.manager_id AS `manager_id`, 
				{$this->table}.* FROM {$this->table}
			LEFT JOIN `outlet` ON outlet.uuid = {$this->table}.outlet_uuid
				WHERE 
			{$this->table}.`active` = 1 AND
			BINARY {$this->table}.`username` = :username AND 
			BINARY {$this->table}.`password` = :password"
		);

		$this->db->bind('username', $username);
		$this->db->bind('password', $password);

		return $this->db->fetch();
	}

	public function getUserById($id)
	{
		$this->db->query(
			"SELECT 
				outlet.uuid AS `outlet_uuid`,
				outlet.nama AS `nama_outlet`, 
				outlet.alamat AS `alamat_outlet`, 
				outlet.nomor_telp AS `telp_outlet`, 
				outlet.pajak AS `pajak_outlet`, 
				outlet.manager_id AS `manager_id`, 
				{$this->table}.* FROM {$this->table}
			LEFT JOIN `outlet` ON outlet.uuid = {$this->table}.outlet_uuid
				WHERE 
			{$this->table}.`id` = :id"
		);
		$this->db->bind('id', $id);
		return $this->db->fetch();
	}

	public function getUserBy($field, $val)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE `{$field}` = :val");
		$this->db->bind('val', $val);
		return $this->db->fetch();
	}

	public function getMultipleBy($field = 'id', $data = [])
	{
		$sanitized_data = array_map(function ($item) {
			return (gettype($item) == 'string') ? "'{$item}'" : $item;
		}, $data);

		$query = implode(', ', $sanitized_data);
		$this->db->query("SELECT * FROM {$this->table} WHERE `{$field}` IN ({$query})");

		return $this->db->fetchAll();
	}

	public function login($id)
	{
		$this->db->query("UPDATE {$this->table} SET `last_login_at` = CURRENT_TIMESTAMP, `status` = 1 WHERE id = :id");

		$this->db->bind("id", $id);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function logout($id)
	{
		$this->db->query("UPDATE {$this->table} SET `status` = 0 WHERE id = :id");

		$this->db->bind("id", $id);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function register($username, $password, $email)
	{
		$this->db->query(
			"INSERT INTO {$this->table}
				VALUES
			(:id, :username, :password, :email, NULL, NULL, '[]', CURRENT_TIMESTAMP, 0, 0)"
		);

		$this->db->bind('username', $username);
		$this->db->bind('password', hash('sha256', $password));
		$this->db->bind('email', $email);
		$this->db->bind('id', Uuid::uuid4()->toString());

		$this->db->execute();
	}

	public function insert($data)
	{
		$this->db->query(
			"INSERT INTO {$this->table}
				VALUES
			(:id, :username, :password, :email, :role, NULL, '[]', CURRENT_TIMESTAMP, 0, 0)"
		);

		$this->db->bind('username', $data['username']);
		$this->db->bind('password', hash('sha256', $data['password']));
		$this->db->bind('email', $data['email']);
		$this->db->bind('role', $data['role']);
		$this->db->bind('id', Uuid::uuid4()->toString());

		$this->db->execute();
		return $this->db->rowCount(); 
	}

	public function update($id, $data, $isAdmin = false)
	{
		$old = $this->getUserById($id);

		$this->db->query(
			"UPDATE {$this->table}
				SET
				username = :username,
				email = :email,
				role = :role
			WHERE id = :id"
		);

		$this->db->bind('username', $data['username']);
		$this->db->bind('email', $data['email']);
		$this->db->bind('role', ($isAdmin ? $data['role'] : $old['role']));
		$this->db->bind('id', $id);
		
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function changePassword($id, $data)
	{
		if (hash('sha256', $data['old_password']) != $this->getUserById($id)['password'])
			return 0;

		$this->db->query(
      		"UPDATE {$this->table}
				SET `password` = :password
			WHERE id = :id"
		);

		$this->db->bind('password', hash('sha256', $data['new_password']));
		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function setOutletUuid($user_id, $outlet_uuid)
	{
		$this->db->query(
			"UPDATE {$this->table} 
				SET outlet_uuid = :outlet_uuid 
			WHERE id = :user_id"
		);

		$this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('user_id', $user_id);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function activateUser($user_id, $outlet_uuid, $role)
	{
		$this->db->query(
			"UPDATE {$this->table} 
				SET 
				`role` = :role, 
				`outlet_uuid` = :outlet_uuid, 
				`active` = 1 
			WHERE id = :user_id"
		);

		$this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('user_id', $user_id);
		$this->db->bind('role', $role);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function setNotification($data, $id)
	{
		# code...
	}

	public function destroy($id)
	{
		$this->db->query("DELETE FROM {$this->table} WHERE id = :id");

		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}

}
