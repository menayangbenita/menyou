<?php

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Absensi extends Controller
{
    protected $model_name = 'Absensi_model';

    public function index()
    {
        $this->auth('user', 'Owner|Manager|HR|Sales|karyawan');
        csrf_generate();

        $data['title'] = 'Absensi';
        $data['user'] = $this->user;

        $data['filter'] = [
            'bulan' => intval((isset($_POST['bulan'])) ? $_POST['bulan'] : date('m')),
            'tahun' => intval((isset($_POST['tahun'])) ? $_POST['tahun'] : date('Y')),
        ];

        $result = $this->model('Karyawan_model')->getAllData();
        $hari = cal_days_in_month(CAL_GREGORIAN, $data['filter']['bulan'], $data['filter']['tahun']);

        $arr = [];
        $no = 0;
        if ($result) {
            foreach ($result as $row) {
                $num = $no++;
                $arr[$num]['karyawan'] = $row['nama'];
                $jumlah_hadir = 0;
                $jumlah_terlambat = 0;
                $total_menit_terlambat = 0;
                $total_jam_kerja = 0;

                for ($i = 1; $i <= $hari; $i++) {
                    $absensi = $this->model($this->model_name)->dataabsen($i, $i, $data['filter']['bulan'], $data['filter']['tahun']);
                    $status = 0;
                    $terlambat = 0;
                    $jam_kerja = '00:00:00';
                    if (!empty($absensi)) {
                        foreach ($absensi as $tgl) {
                            $status = $tgl['absen'];
                            $terlambat = $tgl['terlambat'];
                            $jam_kerja = $tgl['total_jam_kerja'];
                            if ($tgl['absen'] == 1) {
                                if ($terlambat > 0) {
                                    $jumlah_terlambat++;
                                    $total_menit_terlambat += $terlambat;
                                } else {
                                    $jumlah_hadir++;
                                }
                                if ($jam_kerja !== null) {
                                    $total_jam_kerja += strtotime($jam_kerja) - strtotime('TODAY');
                                }
                            }
                        }
                    }
                    $arr[$num]['tgl_' . $i] = $status;
                    $arr[$num]['terlambat_' . $i] = $terlambat;
                    $arr[$num]['jam_kerja_' . $i] = $jam_kerja;
                }
                $arr[$num]['total_hadir'] = $jumlah_hadir;
                $arr[$num]['total_terlambat'] = $jumlah_terlambat;
                $arr[$num]['total_menit_terlambat'] = $total_menit_terlambat;
                $arr[$num]['total_jam_kerja'] = gmdate("H:i:s", $total_jam_kerja);
            }
        }
        $data['result'] = $arr;
        $data['hari'] = $hari;
        if (in_array($data['user']['role'], explode('|', 'Owner|Manager|HR'))) {
            $this->view('karyawan/absensi', $data);
        } elseif (in_array($data['user']['role'], explode('|', 'Sales|karyawan')))
            $this->view('karyawan/absensiUser', $data);
    }

    public function qrcode()
    {
        $this->auth('user', 'Owner|Manager|HR');
        csrf_generate();

        $data['title'] = 'Absensi';
        $data['user'] = $this->user;

        $data['filter'] = [
            'bulan' => intval((isset($_POST['bulan'])) ? $_POST['bulan'] : date('m')),
            'tahun' => intval((isset($_POST['tahun'])) ? $_POST['tahun'] : date('Y')),
        ];

        $this->view('karyawan/qrcode', $data);
    }

    public function karyawan()
    {
        $this->auth('user', 'Owner|Manager|HR');
        csrf_generate();

        $data['title'] = 'Absensi';
        $data['user'] = $this->user;

        $data['filter'] = [
            'bulan' => intval((isset($_POST['bulan'])) ? $_POST['bulan'] : date('m')),
            'tahun' => intval((isset($_POST['tahun'])) ? $_POST['tahun'] : date('Y')),
        ];

        $this->view('karyawan/qrcode', $data);
    }

    public function import()
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');
            csrf_validate('/absen');

            if (!empty($_FILES['file']['tmp_name']))
                throw new Exception('Haha eror');

            $target = '../excel/' . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $target);
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($target);
            $excel = $spreadsheet->getActiveSheet();
            $arr = $excel->toArray();
            $jumlah = count($arr);

            $check = [];
            for ($i = 1; $i < $jumlah; $i++) {  // Mulai dari 1 untuk melewati header
                $tanggal = isset($arr[$i][1]) ? $arr[$i][1] : '';
                $nama = isset($arr[$i][2]) ? $arr[$i][2] : '';
                $absen = isset($arr[$i][3]) && is_numeric($arr[$i][3]) ? intval($arr[$i][3]) : 0;
                $terlambat = isset($arr[$i][4]) && is_numeric($arr[$i][4]) ? intval($arr[$i][4]) : 0;
                $jam_masuk = isset($arr[$i][5]) ? $arr[$i][5] : '';
                $jam_keluar = isset($arr[$i][6]) ? $arr[$i][6] : '';

                $check[$i] = [$tanggal, $nama, $absen, $terlambat, $jam_masuk, $jam_keluar];
                $checknama = $this->model('Karyawan_model')->searchuser($nama);
                if ($checknama) {
                    $data['karyawan_id'] = $checknama['id'];
                    $data['tanggal'] = date('Y-m-d H:i:s', strtotime($tanggal));
                    $data['absen'] = $absen;
                    $data['terlambat'] = $terlambat;
                    $data['jam_masuk'] = date('H:i:s', strtotime($jam_masuk));
                    $data['jam_keluar'] = date('H:i:s', strtotime($jam_keluar));

                    $insert = $this->model($this->model_name)->insert($data);
                } else {
                    echo $nama . " Tidak Terdaftar<br>";
                }
            }

            Flasher::setFlash('Import&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Import&nbsp<b>SUCCESS</b>', 'danger');
        }
        redirectTo('/absensi');
    }


}