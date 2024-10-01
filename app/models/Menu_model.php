<?php

use Ramsey\Uuid\Uuid;

class Menu_model extends Model
{
	protected $table = "menu";
	protected $fields = [
		'nama',
		'kategori_id',
		'harga',
		'bahan',
	];

	public function getAllData($outlet_uuid = false)
	{
		$this->db->query(
			"SELECT kategori.nama AS kategori, {$this->table}.* FROM {$this->table}
			LEFT JOIN `kategori` ON kategori.id = {$this->table}.kategori_id
				WHERE 
				{$this->table}.`status` = 1 AND
				{$this->table}.`stok_id` IS NULL" . ($outlet_uuid ?
				" AND (
				{$this->table}.`outlet_uuid` = :outlet_uuid OR 
				{$this->table}.`outlet_uuid` IS NULL
			)" : '')
		);

		if ($outlet_uuid)
			$this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetchAll();
	}

	public function getAllPrepare($outlet_uuid)
	{
		$this->db->query(
			"SELECT riwayat_stok.stok AS stok, stok.satuan AS satuan, {$this->table}.* FROM {$this->table}
			INNER JOIN `stok` ON stok.id = {$this->table}.stok_id
			INNER JOIN `riwayat_stok` ON riwayat_stok.stok_id = {$this->table}.stok_id
				WHERE 
			{$this->table}.`status` = 1 AND
			{$this->table}.`stok_id` IS NOT NULL AND
			riwayat_stok.`outlet_uuid` = :outlet_uuid"
		);

		$this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetchAll();
	}

	public function getLatestData()
	{
		$this->db->query("SELECT * FROM {$this->table} ORDER BY `created_at` DESC LIMIT 1");
		return $this->db->fetch();
	}

	public function getDataById($id)
	{
		$this->db->query(
			"SELECT kategori.nama AS kategori, {$this->table}.* FROM {$this->table}
			LEFT JOIN `kategori` ON kategori.id = {$this->table}.kategori_id
				WHERE 
			{$this->table}.`status` = 1 AND 
			{$this->table}.`id` = :id"
		);
		$this->db->bind('id', $id);
		return $this->db->fetch();
	}

	public function getPrepareById($id, $outlet_uuid = false)
	{
		$this->db->query(
			"SELECT riwayat_stok.stok AS stok, stok.satuan AS satuan, {$this->table}.* FROM {$this->table}
			INNER JOIN `stok` ON stok.id = {$this->table}.stok_id
			INNER JOIN `riwayat_stok` ON riwayat_stok.stok_id = {$this->table}.stok_id
				WHERE 
			{$this->table}.`id` = :id AND
			{$this->table}.`status` = 1 AND
			{$this->table}.`stok_id` IS NOT NULL AND
			riwayat_stok.`outlet_uuid` = :outlet_uuid"
		);
		$this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('id', $id);
		return $this->db->fetch();
	}

	public function cekMenu($name)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE nama = :nama AND status = 1");
		$this->db->bind('nama', $name);
		return $this->db->fetch();
	}


	public function getMultipleBy($field = 'id', $data = [])
	{
		$sanitized_data = array_map(function ($item) {
			return (gettype($item) == 'string') ? "'{$item}'" : $item;
		}, $data);

		$query = implode(', ', $sanitized_data);
		$this->db->query("SELECT * FROM {$this->table} WHERE `status` = 1 AND `{$field}` IN ({$query}) ");
		return $this->db->fetchAll();
	}

	public function countAvailableAll($outlet_uuid, $with_flasher = true, $prepare = false)
	{
		$allMenu = ($prepare) ? $this->getAllPrepare($outlet_uuid) : $this->getAllData($outlet_uuid);

		foreach ($allMenu as $menu) {
			$bahan = json_decode($menu['bahan'], true);

			if (!is_array($bahan))
				continue;

			$availability = [];
			foreach ($bahan as $nama => $value) {
				$this->db->query(
					"SELECT r.`stok` FROM riwayat_stok r
					INNER JOIN stok s ON r.stok_id = s.id
						WHERE 
					r.`status` = 1 AND 
					s.`nama` = :nama AND 
					r.`outlet_uuid` = :outlet_uuid"
				);
				$this->db->bind('nama', $nama);
				$this->db->bind('outlet_uuid', $outlet_uuid);

				$stok = $this->db->fetch(PDO::FETCH_COLUMN);

				if (!$stok || !$value)
					continue;
				array_push($availability, floor($stok / $value));
			}

			$tmp = json_decode($menu['tersedia'], true);

			if (!empty($availability)) {
				$tmp[$outlet_uuid] = min($availability);
			} else {
				$tmp[$outlet_uuid] = "infinite";
				if (!isset($_SESSION['flash']) && $with_flasher)
					Flasher::setFlash("Data bahan dari&nbsp<b>" . $menu['nama'] . "</b>&nbspkosong! Silahkan cek kembali.", "warning", 5000);
			}

			$this->updateField($menu['id'], 'tersedia', json_encode($tmp));
		}

		return $this->db->rowCount();
	}

	public function insert($data, $stok_id = NULL, $with_flasher = true)
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

		$fields_query = ":foto, :nama, :kategori_id, :harga, :bahan, '{}', :stok_id, :outlet_uuid,";

		$this->db->query(
			"INSERT INTO {$this->table} 
				VALUES
			(null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		foreach ($this->fields as $field)
			$this->db->bind($field, $data[$field]);
		$this->db->bind('foto', ($stok_id == NULL ? $this->storeFile('foto', 'upload/menu') : ''));
		$this->db->bind('outlet_uuid', isset($data['exclusive']) ? $data['exclusive'] : NULL);
		$this->db->bind('uuid', Uuid::uuid4()->toString());
		$this->db->bind('stok_id', $stok_id);
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
			foto = :foto,
			nama = :nama,
			kategori_id = :kategori_id,
			harga = :harga,
			bahan = :bahan,
			outlet_uuid = :outlet_uuid,
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
		$this->db->bind('foto', $this->storeFile('foto', 'upload/menu', false, $old['foto']));
		$this->db->bind('outlet_uuid', isset($data['exclusive']) ? $data['exclusive'] : $old['outlet_uuid']);
		$this->db->bind('modified_by', $this->user);
		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function updateField($id, $field, $val)
	{
		$this->db->query(
			"UPDATE {$this->table}
				SET 
				{$field} = :val,
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE id = :id"
		);

		$this->db->bind('val', $val);
		$this->db->bind('id', $id);
		$this->db->bind('modified_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function addSoldValue($id, $amount)
	{
		$this->db->query(
			"UPDATE {$this->table} 
				SET 
				terjual = terjual + :amount,
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE id = :id"
		);

		$this->db->bind('amount', $amount);
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
		$this->db->query("DELETE FROM {$this->table} WHERE");

		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->rowCount();
	}
}
