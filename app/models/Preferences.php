<?php

class Preferences
{
	protected $table = "preferences";
	protected $db;

	public function __construct() {
		$this->db = new Database();
	}

    public function getAllPreference()
	{
		$this->db->query("SELECT * FROM {$this->table}");
		return $this->db->fetchAll();
	}

    public function getAllCategories()
	{
		$this->db->query("SELECT `category` FROM {$this->table} GROUP BY `category`");
		return $this->db->fetchAll(PDO::FETCH_COLUMN);
	}

	public function getPreference($name)
	{
		$this->db->query("SELECT `value` FROM {$this->table} WHERE `setting` = :setting");
		$this->db->bind('setting', $name);
		return $this->db->fetch(PDO::FETCH_COLUMN);
	}

	public function updatePreference($key, $val)
	{
		$this->db->query("UPDATE {$this->table} SET `value` = :val WHERE `setting` = :setting");
		$this->db->bind('val', $val);
		$this->db->bind('setting', $key);
		$this->db->execute();
		return $this->db->rowCount();
	}
}