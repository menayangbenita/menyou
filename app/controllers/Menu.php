<?php

class Menu extends Controller
{
    protected $model_name = 'Menu_model';

    public function index()
    {
        $this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

        $data['title'] = 'Menu';
        $data['user'] = $this->user;

        $this->model($this->model_name)->countAvailableAll($this->user['outlet_uuid']);
        $data['menu'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
        $data['kategori'] = $this->model('Kategori_model')->getAllData();
        $data['barang'] = $this->model('Stok_model')->getAllData($this->user['outlet_uuid']);

        $this->view('menu/index', $data);
    }

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/menu');

            // Prepare data
            $data = posts();

            $cekMenu = $this->model($this->model_name)->cekMenu($data->nama);
            if ($cekMenu) {
                Flasher::setFlash('Menu dengan nama <b> ' . $data->nama . ' </b> sudah ada! Silakan cek kembali.', 'warning');
                redirectTo('/menu');
                return;
            }

            // Set all bahan value to float
            $bahan = [];
            foreach ($data->nama_bahan as $i => $nama_bahan) {
                if (!$nama_bahan)
                    continue;
                $bahan[$nama_bahan] = floatval($data->jumlah_bahan[$i]);
            }
            $data->bahan = json_encode($bahan);
            unset($data->nama_bahan);
            unset($data->jumlah_bahan);

            // Insert data menu. If it prepare, insert stok id that previously added
            $res = $this->model($this->model_name)->insert((array) $data);
            if (!$res)
                throw new Exception('Haha eror');

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/menu');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');

            $this->model($this->model_name)->delete($id);
            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/menu');
    }

    public function update($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/menu');

            foreach ($_POST['nama_bahan'] as $i => $nama_bahan)
                $bahan[$nama_bahan] = floatval($_POST['jumlah_bahan'][$i]);
            $_POST['bahan'] = json_encode($bahan);
            unset($_POST['nama_bahan']);
            unset($_POST['jumlah_bahan']);

            $this->model($this->model_name)->update($id, $_POST);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/menu' . (isset($_POST['prepare']) ? '/prepare' : ''));
    }

    public function getUbah($id)
    {
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model($this->model_name)->getDataById($id));
    }

    public function cekMenu()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $namaMenu = $_POST['nama'] ?? '';

            $menuExists = $this->model($this->model_name)->cekMenu($namaMenu);

            echo json_encode(['exists' => $menuExists]);
        }
    }

    public function destroy()
    {
    }
}
