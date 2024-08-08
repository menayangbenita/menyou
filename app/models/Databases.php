<?php

class Databases
{
	protected $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function getAllTables()
	{
		$this->db->query(
			"SELECT table_name FROM information_schema.tables 
				WHERE 
			table_schema = '". DB_NAME ."' AND
			table_type = 'BASE TABLE'"
		);
		$tables = $this->db->fetchAll(PDO::FETCH_COLUMN);

		$result = [];

		foreach ($tables as $table) {
			$this->db->query("SELECT COUNT(*) FROM {$table}");
			$count = $this->db->fetch(PDO::FETCH_COLUMN);
			array_push($result, [
				'name' => $table,
				'rows' => $count
			]);
		}

		return $result;
	}

	public function drop($table_name)
	{
		$this->db->query("DROP TABLE IF EXISTS {$table_name}");
		$this->db->execute();
		$this->db->rowCount();
	}

	public function truncate($table_name)
	{
		$this->db->query("TRUNCATE TABLE ". DB_NAME .".{$table_name}");
		$this->db->execute();
		$this->db->rowCount();
	}

	public function import($queries)
	{
		foreach ($queries as $query) {
			$query = trim($query);
			if (empty($query)) continue;
			$this->db->query($query);
			$this->db->execute();
		}
	}
}
