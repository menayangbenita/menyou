<?php

class Preferences
{
	protected $table = "preferences";
	protected $db;

	public function __construct()
	{
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
	public function updateValueBySetting($setting, $value)
	{
		$this->db->query("UPDATE {$this->table} SET `value` = :value WHERE `setting` = :setting");
		$this->db->bind('value', $value);
		$this->db->bind('setting', $setting);
		$this->db->execute();
		return $this->db->rowCount();
	}
	public function updatePreferenceToken($token)
	{
		$expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

		$this->db->query(
			"UPDATE preferences 
         SET value = :token, 
             datetime = :expiry 
         WHERE category = 'ERP' 
           AND setting = 'Token_Absensi'"
		);

		$this->db->bind('token', $token);
		$this->db->bind('expiry', $expiry);

		$this->db->execute();

		// Log jumlah baris yang terpengaruh
		error_log('Update Token in Preferences RowCount: ' . $this->db->rowCount());

		return $this->db->rowCount(); // Mengembalikan jumlah baris yang terpengaruh
	}


	public function getPreferenceToken()
	{
		$this->db->query("SELECT value FROM preferences WHERE category = 'ERP' AND setting = 'Token_Absensi'");
		$this->db->execute();
		return $this->db->fetch(PDO::FETCH_ASSOC); // Mengembalikan satu baris sebagai array asosiatif
	}

	public function getWaktuDatang()
	{
		$this->db->query(
			"SELECT value FROM preferences WHERE category = 'ERP' AND setting = 'Waktu_Datang'"
		);

		// Menggunakan fetch untuk mendapatkan hasil
		$result = $this->db->fetch(PDO::FETCH_ASSOC); // Menggunakan fetch

		return $result ? $result['value'] : '00:00'; // Mengembalikan default waktu jika tidak ditemukan
	}
	public function getSetting($category, $setting)
    {
        // Membangun query untuk mengambil pengaturan berdasarkan kategori dan pengaturan
        $sql = "SELECT value FROM {$this->table} WHERE category = :category AND setting = :setting";

        $this->db->query($sql);
        $this->db->bind('category', $category);
        $this->db->bind('setting', $setting);
        $this->db->execute();

        // Mengambil hasil query
        $result = $this->db->fetch(PDO::FETCH_ASSOC);

        // Mengembalikan hasil jika ditemukan, atau null jika tidak ditemukan
        return $result ? $result : null;
    }
}
