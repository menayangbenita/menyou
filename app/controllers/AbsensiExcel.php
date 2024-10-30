<?php

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class AbsensiExcel extends Controller
{
    protected $model_name = 'AbsensiExcel_model';

    public function index()
    {
        $this->auth('user', 'Owner|Manager|HR|Sales|karyawan');
        csrf_generate();

        $data['title'] = 'Absensi';
        $data['user'] = $this->user;

        // Filter bulan dan tahun
        $data['filter'] = [
            'bulan' => intval($_POST['bulan'] ?? date('m')),
            'tahun' => intval($_POST['tahun'] ?? date('Y')),
        ];

        $result = $this->model('User_model')->getAllKaryawan();
        $hari = cal_days_in_month(CAL_GREGORIAN, $data['filter']['bulan'], $data['filter']['tahun']);

        $arr = [];
        $no = 0;
        if ($result) {
            foreach ($result as $row) {
                $num = $no++;
                $arr[$num] = [
                    'karyawan' => $row['username'],
                    'total_hadir' => 0,
                    'total_terlambat' => 0,
                    'total_menit_terlambat' => 0,
                    'total_jam_kerja' => '00:00:00'
                ];

                for ($i = 1; $i <= $hari; $i++) {
                    $absensi = $this->model($this->model_name)->dataabsen($row['id'], $i, $i, $data['filter']['bulan'], $data['filter']['tahun']);
                    // var_dump($row);

                    $status = 0;
                    $terlambat = 0;
                    $jam_kerja = '00:00:00';

                    if (!empty($absensi)) {
                        foreach ($absensi as $tgl) {
                            $status = $tgl['absen'];
                            $terlambat = $tgl['terlambat'];

                            if ($status == 1) { // Hadir
                                $arr[$num]['total_hadir']++;
                            } elseif ($status == 2) { // Terlambat
                                $arr[$num]['total_terlambat']++;
                                $arr[$num]['total_menit_terlambat'] += $terlambat;
                            }

                            if ($jam_kerja !== null) {
                                $arr[$num]['total_jam_kerja'] = gmdate("H:i:s", strtotime($jam_kerja) - strtotime('today'));
                            }
                        }
                    } 

                    $arr[$num]['tgl_' . $i] = $status;
                    $arr[$num]['terlambat_' . $i] = $terlambat;
                    $arr[$num]['jam_kerja_' . $i] = $jam_kerja;
                }
            }
        }

        $data['result'] = $arr;
        $data['hari'] = $hari;
        // $data['absensi'] = $this->histori();

        // Menentukan view berdasarkan role dan parameter query
        if (in_array($data['user']['role'], ['Owner', 'Manager', 'HR'])) {
            if (isset($_GET['view']) && $_GET['view'] == 'excel') {
                $this->view('karyawan/absensiExcel', $data);
            } else {
                $this->view('karyawan/absensiExcel', $data);
            }
        } elseif (in_array($data['user']['role'], ['Sales', 'karyawan'])) {
            $this->view('karyawan/absensiUser', $data);
        }
    }



    private function calculateTotalJamKerja($existingTime, $newTime)
    {
        $existingSeconds = strtotime($existingTime) - strtotime('today');
        $newSeconds = strtotime($newTime) - strtotime('today');
        $totalSeconds = $existingSeconds + $newSeconds;

        return gmdate("H:i:s", $totalSeconds);
    }

    public function import()
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');
            $this->validateCSRFToken($_POST['csrf_token'] ?? '');

            if (empty($_FILES['file']['tmp_name'])) {
                throw new Exception('File tidak ditemukan.');
            }

            $target = '../excel/' . $_FILES['file']['name'];
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                throw new Exception('Gagal mengupload file.');
            }

            $reader = new Xlsx();
            $spreadsheet = $reader->load($target);
            $excel = $spreadsheet->getActiveSheet();
            $arr = $excel->toArray();
            $jumlah = count($arr);

            $waktu_datang = $this->model('Preferences')->getSetting('ERP', 'Waktu_Datang');
            $waktu_datang = isset($waktu_datang['value']) ? $waktu_datang['value'] : '09:00:00';

            for ($i = 3; $i < $jumlah; $i++) {
                $nama = isset($arr[$i][1]) ? $arr[$i][1] : '';
                $tanggal = isset($arr[$i][3]) ? $arr[$i][3] : '';
                $jam_masuk = isset($arr[$i][4]) ? $arr[$i][4] : '';
                $jam_keluar = isset($arr[$i][5]) ? $arr[$i][5] : '';
                $terlambat = isset($arr[$i][8]) ? $arr[$i][8] : 0;

                $checknama = $this->model('User_model')->searchKaryawan($nama);
                if ($checknama) {
                    $data = [
                        'user_id' => $checknama['id'],
                        'tanggal' => date('Y-m-d', strtotime($tanggal)),
                        'jam_masuk' => $jam_masuk ? date('H:i:s', strtotime($jam_masuk)) : null,
                        'jam_keluar' => $jam_keluar ? date('H:i:s', strtotime($jam_keluar)) : null,
                        'terlambat' => $terlambat,
                        'absen' => ($jam_masuk && $jam_masuk <= $waktu_datang) ? 1 : 2,
                        'created_by' => $_SESSION['user_id'],
                        'keterangan' => 'Ini hasil import dari Excel'
                    ];

                    $insert = $this->model($this->model_name)->insert($data);
                } else {
                    echo $nama . " Tidak Terdaftar sebagai karyawan<br>";
                }
            }

            Flasher::setFlash('Import&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            Flasher::setFlash('Import&nbsp<b>ERROR</b>: ' . $e->getMessage(), 'danger');
        }

        redirectTo('/absensiExcel');
    }

    private function validateCSRFToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $token) {
            throw new Exception('CSRF token tidak valid.');
        }
    }
}