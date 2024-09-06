<?php

class Rewardpunishment extends Controller
{
    protected $model_name = 'Rewardpunishment_model';

    public function index()
    {
		$this->auth('user', 'Owner|Manager|HR');
        csrf_generate();

        $data['title'] = 'Reward & Punishment';
		$data['user'] = $this->user;

        $data['karyawan'] = $this->model('Karyawan_model')->getAllData($this->user['outlet_uuid']);
        $data['reward_punishment'] = $this->model($this->model_name)->getAllData();

        $data['filter'] = $this->filter();

        $this->view('karyawan/rewardPunishment', $data);
    }

    private function filter() {
		$dataset = [
			"option" => isset($_POST['option']) ? $_POST['option'] : "tahunan",
			"tahun" => intval(isset($_POST['tahun']) ? $_POST['tahun'] : date('Y')),
			"bulan" => intval(isset($_POST['bulan']) ? $_POST['bulan'] : date('n')),
			"minggu-mulai" => isset($_POST['minggu-mulai']) ? $_POST['minggu-mulai'] : date('Y-m-d', strtotime('-7 days')),
			"minggu-selesai" => isset($_POST['minggu-selesai']) ? $_POST['minggu-selesai'] : date('Y-m-d'),
			"filter-start" => null,
			"filter-end" => null,
		];

		if ($dataset['option'] == "tahunan") {
			$dataset['filter-start'] = $dataset['tahun']. "-01-01";
			$dataset['filter-end'] = $dataset['tahun']. "-12-31";
		} elseif ($dataset['option'] == "bulanan") {
			$dataset['filter-start'] = date('Y-m-01', mktime(0, 0, 0, $dataset['bulan'], 1, $dataset['tahun']));
			$dataset['filter-end'] = date('Y-m-t', mktime(0, 0, 0, $dataset['bulan'], 1, $dataset['tahun']));
		} elseif ($dataset['option'] == "mingguan") {
			$dataset['filter-start'] = $dataset['minggu-mulai'];
			$dataset['filter-end'] = $dataset['minggu-selesai'];
		}

		return $dataset;
	}

    public function print($uuid)
    {
        $this->auth('user', 'Owner|Manager|HR');

        $data['title'] = 'Surat Peringatan';
		$data['user'] = $this->user;

        $data['reward_punishment'] = $this->model($this->model_name)->getDataByUuid($uuid);

        $this->view('karyawan/cetakSurat', $data);
    }

    public function insert()
    {
        try {
            // Autentikasi pengguna
            $this->auth('user', 'Owner|Manager|HR');
            
            // Validasi CSRF
            csrf_validate('/rewardpunishment');
    
            // Set tanggal jika tidak dikirim dari form
            if (!isset($_POST['tanggal']) || empty($_POST['tanggal'])) {
                $_POST['tanggal'] = date('Y-m-d'); // Set tanggal hari ini
            }
    
            // Hitung total
            $_POST['total'] = $_POST['besaran'] * $_POST['jumlah'];
    
            // Insert data ke model
            $this->model($this->model_name)->insert($_POST);
    
            // Flash message sukses
            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // Tampilkan pesan error dari exception
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>: ' . $e->getMessage(), 'danger');
        }
    
        // Redirect kembali ke halaman
        redirectTo('/rewardpunishment');
    }
    
    

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');

            $this->model($this->model_name)->delete($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/rewardpunishment');
    }

    public function update()
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');
            csrf_validate('/rewardpunishment');
    
            // Validasi bahwa 'id' ada dalam data POST
            if (isset($_POST['id'])) {
                // Pastikan data yang diperlukan ada dalam POST
                $data = [
                    'karyawan_id' => $_POST['karyawan_id'] ?? null,
                    'jenis' => $_POST['jenis'] ?? null,
                    'jumlah' => $_POST['jumlah'] ?? null,
                    'besaran' => $_POST['besaran'] ?? null,
                    'keterangan' => $_POST['keterangan'] ?? null,
                    'tanggal' => $_POST['tanggal'] ?? null,
                    'total' => $_POST['total'] ?? 0 // Pastikan 'total' ada dengan nilai default
                ];
    
                $this->model($this->model_name)->update($_POST['id'], $data);
    
                Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
            } else {
                throw new Exception('ID is missing.');
            }
        } catch (Exception $e) {
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/rewardpunishment');
    }
    
    
    
    
    public function getubah()
    {
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model($this->model_name)->getDataById($_POST['id'])); 
    }

    public function destroy($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');

            $this->model($this->model_name)->destroy($id);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/rewardpunishment');
    }
}