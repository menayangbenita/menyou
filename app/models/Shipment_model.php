<?php

use Ramsey\Uuid\Uuid;

class Shipment_model extends Model
{
	protected $table = "shipment";
	protected $fields = [
		'supplier_id',
		'no_faktur',
        'deskripsi',
		'total_berat',
		'detail_barang',
		'total_exw',
        'biaya_lainnya',
        'total_biaya_lainnya',
        'diskon',
        'total',
        'harga_all_in',
    ];

	public function getAllData($outlet_uuid = false)
	{
		$this->db->query(
			"SELECT * FROM {$this->table} 
			WHERE `status` = 1". ($outlet_uuid ? " AND `outlet_uuid` = :outlet_uuid" : '')
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
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
		$fields_query = "
			:supplier_id,
			:no_faktur,
			:deskripsi,
			:total_berat,
			:detail_barang,
			:total_exw,
			:biaya_lainnya,
			:total_biaya_lainnya,
			:diskon,
			:total,
			:harga_all_in,
			:tanggal,
			:outlet_uuid,
		";

		$this->db->query(
			"INSERT INTO {$this->table} 
				VALUES
			(null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		$uuid = Uuid::uuid4()->toString();
		foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
		$this->db->bind('uuid', $uuid);
		$this->db->bind('outlet_uuid', $data['outlet_uuid']);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		if ($this->db->rowCount() > 0) return $uuid;
		return false;
	}

	public function update($id, $data)
	{
		$fields_query = "
			supplier_id = :supplier_id,
			no_faktur = :no_faktur,
			deskripsi = :deskripsi,
			total_berat = :total_berat,
			detail_barang = :detail_barang,
			total_exw = :total_exw,
			biaya_lainnya = :biaya_lainnya,
			total_biaya_lainnya = :total_biaya_lainnya,
			diskon = :diskon,
			total = :total,
			harga_all_in = :harga_all_in,
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