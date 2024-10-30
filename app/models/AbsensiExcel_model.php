<?php

use Ramsey\Uuid\Uuid;

class AbsensiExcel_model extends Model
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

    public function getAllData($start_date = null, $end_date = null)
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($start_date && $end_date) {
            $sql .= " WHERE tanggal BETWEEN :start_date AND :end_date";
        }
        $this->db->query($sql);
        if ($start_date && $end_date) {
            $this->db->bind('start_date', $start_date);
            $this->db->bind('end_date', $end_date);
        }
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


    public function getKaryawanById($karyawan_id)
    {
        $query = "SELECT nama FROM karyawan WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $karyawan_id);
        $this->db->execute();
        return $this->db->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $fields_query = ":user_id, :tanggal, :absen, :terlambat, :jam_masuk, :jam_keluar, :keterangan, :fotobukti";

        $this->db->query(
            "INSERT INTO {$this->table} 
                (uuid, user_id, tanggal, absen, terlambat, jam_masuk, jam_keluar, keterangan, fotobukti) 
                VALUES 
            (:uuid, {$fields_query})"
        );

        $this->db->bind('uuid', Uuid::uuid4()->toString());
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('absen', $data['absen']);
        $this->db->bind('terlambat', $data['terlambat']);
        $this->db->bind('jam_masuk', $data['jam_masuk']);
        $this->db->bind('jam_keluar', $data['jam_keluar']);
        $this->db->bind('keterangan', $data['keterangan'] ?? '');
        $this->db->bind('fotobukti', $data['fotobukti'] ?? '');

        $this->db->execute();
        return $this->db->rowCount();
    }




    public function dataabsen($user_id, $start_day, $end_day, $bulan, $tahun)
{
    // Format tanggal sesuai dengan kebutuhan query
    $start_date = "$tahun-$bulan-$start_day 00:00:00";
    $end_date = "$tahun-$bulan-$end_day 23:59:59";

    // Tampilkan query untuk debugging
    $sql = "SELECT * FROM {$this->table} 
            WHERE user_id = :user_id 
            AND DATE(tanggal) BETWEEN :start_date AND :end_date";

    $this->db->query($sql);
    $this->db->bind('user_id', $user_id);
    $this->db->bind('start_date', $start_date);
    $this->db->bind('end_date', $end_date);

    $result = $this->db->fetchAll();
    // error_log('Data Absensi: ' . json_encode($result)); // Log data
    return $result;
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