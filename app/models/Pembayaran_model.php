<?php

use Ramsey\Uuid\Uuid;

class Pembayaran_model extends Model
{
	protected $table = "pembayaran";
	protected $fields = [
		'kasir',
		'pelanggan',
		'nomor_telp',
		'detail_pembayaran',
		'subtotal',
		'pajak',
		'total',
	];

	public function getAllData($outlet_uuid = false)
	{
		$this->db->query(
			"SELECT * FROM {$this->table} 
				WHERE `status` = 1 ". 
				($outlet_uuid ? "AND `outlet_uuid` = :outlet_uuid" : '') 
			." ORDER BY `status_order` ASC, `created_at` ASC"
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		return $this->db->fetchAll();
	}

	public function getLatestData()
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
			WHERE {$this->table}.`status` = 1
			ORDER BY `created_at` DESC LIMIT 1"
		);
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
			"SELECT 
				outlet.uuid AS `outlet_uuid`,
				outlet.nama AS `nama_outlet`, 
				outlet.alamat AS `alamat_outlet`, 
				outlet.nomor_telp AS `telp_outlet`, 
				outlet.pajak AS `pajak_outlet`, 
				outlet.manager_id AS `manager_id`, 
				{$this->table}.* FROM {$this->table}
			LEFT JOIN `outlet` ON outlet.uuid = {$this->table}.outlet_uuid
			WHERE {$this->table}.uuid = :uuid"
		);
		$this->db->bind('uuid', $uuid);
		return $this->db->fetch();
	}

	public function getDataBetween($start_date, $end_date, $outlet_uuid = false)
	{
		$this->db->query(
			"SELECT * FROM {$this->table} 
				WHERE `status` = 1 AND `tanggal` BETWEEN :start_date AND :end_date" .
			($outlet_uuid ? " AND {$this->table}.`outlet_uuid` = :outlet_uuid" : '')
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('start_date', $start_date);
		$this->db->bind('end_date', $end_date);
		return $this->db->fetchAll();
	}

	public function getIncomeAt($date, $outlet_uuid = false)
	{
		$this->db->query(
			"SELECT SUM(`total`) FROM {$this->table} WHERE `status` = 1 AND `tanggal` = :date" .
			($outlet_uuid ? " AND {$this->table}.`outlet_uuid` = :outlet_uuid" : '')
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('date', $date);
		return $this->db->fetch(PDO::FETCH_COLUMN);
	}

	public function getIncomeBetween($start_date, $end_date, $outlet_uuid = false)
	{
		$this->db->query(
			"SELECT SUM(`total`) AS 'total' FROM {$this->table} 
				WHERE `status` = 1 AND `tanggal` BETWEEN :start_date AND :end_date" .
			($outlet_uuid ? " AND {$this->table}.`outlet_uuid` = :outlet_uuid" : '')
		);

		if ($outlet_uuid) $this->db->bind('outlet_uuid', $outlet_uuid);
		$this->db->bind('start_date', $start_date);
		$this->db->bind('end_date', $end_date);
		return $this->db->fetch(PDO::FETCH_COLUMN);
	}

	public function insert($data)
	{
		$fields_query = "
			:kasir, 
			:pelanggan, 
			:nomor_telp, 
			:detail_pembayaran, 
			:subtotal, 
			:pajak, 
			:total, 
			NULL, 
			NULL, 
			NULL, 
			NULL, 
			:tanggal,
			0,
			:outlet_uuid,
		";

		$this->db->query(
			"INSERT INTO {$this->table} 
				VALUES
      		(null, :uuid, {$fields_query} :note, CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
		);

		$uuid = Uuid::uuid4()->toString();
		foreach ($this->fields as $field) $this->db->bind($field, $data[$field]);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('outlet_uuid', $data['outlet_uuid']);
		$this->db->bind('note', $data['note']);
		$this->db->bind('uuid', $uuid);
		$this->db->bind('created_by', $this->user);

		$this->db->execute();
		if ($this->db->rowCount() > 0) return $this->getDataByUuid($uuid);
		return false;
	}

	public function update($id, $data)
	{
		$fields_query = "
			kasir = :kasir,
			pelanggan = :pelanggan,
			nomor_telp = :nomor_telp,
			detail_pembayaran = :detail_pembayaran,
			subtotal = :subtotal,
			pajak = :pajak,
			total = :total,
			note = :note,
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
		$this->db->bind('note', $data['note']);
		$this->db->bind('id', $id);
		$this->db->bind('modified_by', $this->user);

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function updatePembayaran($id, $data) 
	{
		$fields_query = "
			metode_pembayaran = :metode_pembayaran,
			kode_transaksi = :kode_transaksi,
			bayar = :bayar,
			kembali = :kembali,
		";

		$this->db->query(
			"UPDATE {$this->table}
				SET
				{$fields_query}
				modified_at = CURRENT_TIMESTAMP,
				modified_by = :modified_by
			WHERE id = :id"
		);

		
		$this->db->bind('metode_pembayaran', $data['metode_pembayaran']);
		$this->db->bind('kode_transaksi', $data['kode_transaksi']);
		$this->db->bind('bayar', $data['bayar']);
		$this->db->bind('kembali', $data['kembali']);
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
