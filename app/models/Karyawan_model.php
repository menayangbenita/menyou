<?php

use Ramsey\Uuid\Uuid;

class Karyawan_model extends Model
{
	protected $table = "karyawan";
	protected $fields = [
		'nik',
		'nama',
		'status_karyawan',
		'status_nikah',
		'posisi',
		'level',
		'departement',
		'atasan_langsung',
		'lokasi',
		'mulai_kerja',
		'tempat_lahir',
		'tanggal_lahir',
		'jenis_kelamin',
		'gol_darah',
		'kt_pendidikan_terakhir',
		'pendidikan_terakhir',
		'agama',
		'alamat',
		'suku',
		'no_telp',
		'email',
		'nama_kontak_darurat',
		'telp_kontak_darurat',
		'no_ktp',
		'masa_ktp',
		'no_kk',
		'nama_ibu_kandung',
		'npwp',
		'gaji_overtime',
		'gaji_kehadiran',
		'gaji_insentif',
		'gaji_tunjangan',
		'bpjs_ketenagakerjaan',
		'bpjs_kesehatan',
		'bpjs_kesehatan_keluarga',
		'bebas_pajak',
		'ukuran_baju',
		'ukuran_sepatu',
		'nama_bank',
		'keterangan_bank',
		'akun_bank',
		'nama_pemilik_rek',
		'gaji_pokok',
		'outlet_uuid',
    ];

	public function getAllData($outlet_uuid = false)
	{
		$this->db->query(
			"SELECT {$this->table}.* FROM {$this->table}
			LEFT JOIN `outlet` ON outlet.uuid = {$this->table}.outlet_uuid
				WHERE {$this->table}.`status` = 1 ". ($outlet_uuid ? 
				"AND {$this->table}.`outlet_uuid` = :outlet_uuid
			" : '')
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetchAll();
	}
	public function searchuser($nama)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE nama LIKE '%".$nama."%'");
	 	return$this->db->fetch();
	}

	public function getDataById($id)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE `status` = 1 AND id = :id");
		$this->db->bind('id', $id);
		return $this->db->fetch();
	}
	public function getDataJmlKaryawan($id)
	{
		$this->db->query("SELECT COUNT(nama) AS jumlah 
		FROM {$this->table} 
		WHERE `status` = 1 
		  AND `tanggal` BETWEEN :start_date AND :end_date");
		$this->db->bind('id', $id);
		return $this->db->fetch();
	}

	public function getDataByUuid($uuid)
	{
		$this->db->query(
			"SELECT 
				outlet.nama AS `nama_outlet`, 
				outlet.alamat AS `alamat_outlet`, 
				outlet.kota AS `kota_outlet`, 
				outlet.nomor_telp AS `telp_outlet`,
				users.username AS `manager`, 
				{$this->table}.* FROM {$this->table}
			LEFT JOIN `outlet` ON outlet.uuid = {$this->table}.outlet_uuid
			LEFT JOIN `users` ON users.id = outlet.manager_id
				WHERE {$this->table}.`status` = 1 AND {$this->table}.`uuid` = :uuid"
		);
		$this->db->bind('uuid', $uuid);
		return $this->db->fetch();
	}

	public function getDataByModel($uuid)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE `status` = 1 AND uuid = :uuid");
		$this->db->bind('uuid', $uuid);
		return $this->db->fetch();
	}

	public function getAllSalaryByMonthYear($month, $year, $outlet_uuid = false)
	{
		$this->db->query(
			"SELECT
			e.id,
			e.uuid,
			e.nik,
			e.nama,
			e.posisi,
			e.gaji_pokok,
			COALESCE(SUM(CASE WHEN rp.jenis = 'reward' THEN rp.total ELSE 0 END), 0) AS total_reward,
			COALESCE(SUM(CASE WHEN rp.jenis = 'punishment' THEN rp.total ELSE 0 END), 0) AS total_punishment,
			e.gaji_pokok + COALESCE(SUM(CASE WHEN rp.jenis = 'reward' THEN rp.total ELSE 0 END), 0)
					 - COALESCE(SUM(CASE WHEN rp.jenis = 'punishment' THEN rp.total ELSE 0 END), 0) AS gaji_total
			FROM {$this->table} e
			LEFT JOIN reward_punishment rp 
				ON 
				e.id = rp.`karyawan_id` AND
				EXTRACT(MONTH FROM rp.tanggal) = :month AND
				EXTRACT(YEAR FROM rp.tanggal) = :year".
			($outlet_uuid ? " WHERE e.outlet_uuid = :outlet_uuid" : '')
			." GROUP BY e.id"
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('month', $month);
		$this->db->bind('year', $year);
		
		return $this->db->fetchAll();
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

		$fields = array_merge(['foto'], $this->fields);
        $fields_query = ':' . implode(', :', $fields) . ',';

		$this->db->query(
			"INSERT INTO {$this->table} 
			    VALUES
			(null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
		$this->db->bind('foto', $this->storeFile('foto', 'upload/karyawan'));
		$this->db->bind('uuid', Uuid::uuid4()->toString());
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
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

		$fields = array_merge(['foto'], $this->fields);
		$fields_query = "";
		foreach ($fields as $field)
			$fields_query .= $field . '=:' . $field . ', ';

		$old = $this->getDataById($id);

		$this->db->query(
			"UPDATE {$this->table}
				SET
				{$fields_query}
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE id = :id"
		);

		foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
		$this->db->bind('foto', $this->storeFile('foto', 'upload/karyawan', false, $old['foto']));
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