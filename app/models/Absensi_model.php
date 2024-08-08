<?php

use Ramsey\Uuid\Uuid;

class Absensi_model extends Model
{
    protected $table = "absensi";
    protected $fields = [
        'karyawan_id',
        'tanggal',
        'keterangan',
        'fotobukti',
        // 'terlambat',
        // 'jam_keluar',
        
        
    ];

    public function getAllData()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        $this->db->execute();
        return $this->db->fetchAll();
    }

    public function getAllDataFiltered($start_date, $end_date)
    {
        $sql = "SELECT * FROM {$this->table} WHERE tanggal BETWEEN :start_date AND :end_date";
        $this->db->query($sql);
        $this->db->bind('start_date', $start_date);
        $this->db->bind('end_date', $end_date);
        $this->db->execute();
        return $this->db->fetchAll();
    }
    

    public function getKaryawanById($karyawan_id) {
        $query = "SELECT nama FROM karyawan WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $karyawan_id);
        $this->db->execute();
        return $this->db->fetch(PDO::FETCH_ASSOC);
    }

    
    public function insert($data)
    {
        $fields_query = ":karyawan_id, :tanggal, :absen, :terlambat, :jam_masuk, :jam_keluar,";

        $this->db->query(
            "INSERT INTO {$this->table} 
                VALUES 
            (null, :uuid, {$fields_query} '', CURRENT_TIMESTAMP, :created_by, null, '', null, '', null, '', 0, 0, DEFAULT)"
        );

        $this->db->bind('karyawan_id', $data['karyawan_id']);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('absen', $data['absen']);
        $this->db->bind('terlambat', $data['terlambat']);
        $this->db->bind('jam_masuk', $data['jam_masuk']);
        $this->db->bind('jam_keluar', $data['jam_keluar']);
        $this->db->bind('uuid', Uuid::uuid4()->toString());

    $this->db->execute();
    return $this->db->rowCount();
}

public function dataabsen($start_date, $end_date, $bulan, $tahun)
    {
        $start_date = str_pad($start_date, 2, '0', STR_PAD_LEFT);
        $end_date = str_pad($end_date, 2, '0', STR_PAD_LEFT);
        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        $start_date = "{$tahun}-{$bulan}-{$start_date}";
        $end_date = "{$tahun}-{$bulan}-{$end_date}";

        $sql = "SELECT *, TIMEDIFF(IFNULL(jam_keluar, '00:00:00'), jam_masuk) AS total_jam_kerja FROM {$this->table} WHERE DATE(tanggal) BETWEEN :start_date AND :end_date";

        $this->db->query($sql);
        $this->db->bind('start_date', $start_date);
        $this->db->bind('end_date', $end_date);
        $this->db->execute();

        return $this->db->fetchAll();
    }

    
    
    // public function dataabsenWithStatus($i, $bulan, $tahun) {
    //     $tgl = ($i < 10) ? '0'.$i : $i;
    //     $d = $tahun.'-'.$bulan.'-'.$tgl;
    //     $this->db->query("SELECT {$this->table}.* FROM {$this->table} WHERE DATE(tanggal)='".$d."'");
    //     $this->db->execute();
    //     return $this->db->fetch();
    // }

    // public function getTotalByStatus($status, $bulan, $tahun) {
    //     $this->db->query("SELECT COUNT(*) as total FROM {$this->table} WHERE MONTH(tanggal) = ? AND YEAR(tanggal) = ? AND absen = ?");
    //     $this->db->bind(1, $bulan);
    //     $this->db->bind(2, $tahun);
    //     $this->db->bind(3, $status);
    //     $this->db->execute();
    //     $result = $this->db->fetch();
    //     return $result['total'];
    // }

    public function karyawanabsen($bulan, $tahun)
    {
        $this->db->query("SELECT karyawan.nama FROM {$this->table} LEFT JOIN karyawan ON {$this->table}.karyawan_id=karyawan.id WHERE YEAR(tanggal) = " . $tahun . " AND MONTH(tanggal) = " . $bulan . " AND GROUP BY karyawan_id");
        $this->db->execute();
        return $this->db->fetch();
    }

    public function getJamKeluarTerlambat($kondisi)
    {
        $this->db->query("SELECT jam_keluar, terlambat FROM {$this->table} WHERE $kondisi");
        $this->db->execute();
        return $this->db->fetchAll();
    }

}



?>