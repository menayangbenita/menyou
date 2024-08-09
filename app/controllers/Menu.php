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

    public function prepare()
    {
        $this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

        $data['title'] = 'Menu Prepare';
        $data['user'] = $this->user;

        $this->model($this->model_name)->countAvailableAll($this->user['outlet_uuid']);
        $data['menu'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid'], true);
        $data['barang'] = $this->model('Stok_model')->getAllData($this->user['outlet_uuid']);

        $this->view('menu/prepare', $data);
    }

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/menu/prepare');

            // If Prepare, add data to stok
            if (isset($_POST['prepare'])) {
                $_POST['harga'] = NULL;
                $_POST['kategori_id'] = NULL;

                if (isset($_POST["exclusive"])) {
                    $this->model('Stok_model')->insert([
                        'nama' => $_POST['nama'],
                        'jenis' => 'prepare',
                        'stok' => 0,
                        'satuan' => 'pcs',
                        'riwayat' => '{}',
                        'outlet_uuid' => $_POST["exclusive"],
                    ]);
                } else {
                    $other_outlet = $this->model('Outlet_model')->getAllUuid();
                    foreach ($other_outlet as $outlet_uuid) {
                        $find = $this->model('Stok_model')->getDataByName($_POST['nama'], $outlet_uuid);
                        if ($find) continue;
    
                        $this->model('Stok_model')->insert([
                            'nama' => $_POST['nama'],
                            'jenis' => 'prepare',
                            'stok' => 0,
                            'satuan' => 'pcs',
                            'riwayat' => '{}',
                            'outlet_uuid' => $outlet_uuid,
                        ]);
                    }
                }
            }

            // Set all bahan value to float
            $bahan = [];
            foreach ($_POST['nama_bahan'] as $i => $nama_bahan) {
                if (!$nama_bahan) continue;
                $bahan[$nama_bahan] = floatval($_POST['jumlah_bahan'][$i]);
            }
            $_POST['bahan'] = json_encode($bahan);
            unset($_POST['nama_bahan']); unset($_POST['jumlah_bahan']);

            // Insert data menu prepare
            $this->model($this->model_name)->insert($_POST, isset($_POST['prepare']));
            
            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/menu'.(isset($_POST['prepare']) ? '/prepare' : ''));
    }

    public function delete($id)
    {
        try {
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

            if (isset($_POST['prepare'])) {
                $_POST['harga'] = NULL;
                $_POST['kategori_id'] = NULL;
                
                // Update the stok name
                $old_nama = $this->model($this->model_name)->getDataById($id)['nama'];
                $all_barang = $this->model("Stok_model")->getAllDataByName($old_nama);

                $rename = true;
                foreach ($all_barang as $barang) {
                    $this->model("Stok_model")->update($barang['id'], [
                        'nama' => $_POST['nama'],
                        'jenis' => $barang['jenis'],
                        'stok' => $barang['stok'],
                        'satuan' => $barang['satuan'],
                        'riwayat' => $barang['riwayat'],
                        'outlet_uuid' => $barang['outlet_uuid'],
                    ], $rename);
                    if ($rename) $rename = false;
                }
            }

            foreach ($_POST['nama_bahan'] as $i => $nama_bahan)
                $bahan[$nama_bahan] = floatval($_POST['jumlah_bahan'][$i]);
            $_POST['bahan'] = json_encode($bahan);
            unset($_POST['nama_bahan']); unset($_POST['jumlah_bahan']);

            $this->model($this->model_name)->update($id, $_POST);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/menu'.(isset($_POST['prepare']) ? '/prepare' : ''));
    }

    public function getUbah($id)
    {
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model($this->model_name)->getDataById($id));
    }

    public function destroy()
    {
    }
}
