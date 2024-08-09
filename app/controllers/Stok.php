<?php

class Stok extends Controller
{
	protected $model_name = 'Stok_model';

	public function index()
	{
		$this->auth('user', 'Owner|Manager|Warehouse');
        csrf_generate();

		$data['title'] = 'Rekap Stok';
		$data['user'] = $this->user;

        $data['barang'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
        $data['filter'] = (isset($_POST['filter'])) ?
            ['from' => $_POST['filter'][0], 'to' => $_POST['filter'][1]] :
            ['from' => date('Y-m-d'), 'to' => date('Y-m-d')];
		
		$this->view('stok/index', $data);
	}

    public function pengeluaran()
    {
        $this->auth('user', 'Owner|Manager|Warehouse');
        csrf_generate();

        $data['title'] = 'Pengeluaran';
		$data['user'] = $this->user;
        
        $data['barang'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
        $data['pengeluaran'] = [];
        foreach ($data['barang'] as $barang) {
            $tmp = json_decode($barang['riwayat'], true);
            array_push($data['pengeluaran'], isset($tmp[date('Y-m-d')]) ? 
                $tmp[date('Y-m-d')]['keluar'] : 0
            );
        }
		
		$this->view('stok/pengeluaran', $data);
    }

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/stok');

            $_POST['outlet_uuid'] = $this->user['outlet_uuid'];
            $this->model($this->model_name)->insert($_POST);

            $_POST['stok_id'] = $this->model($this->model_name)->getDataByName($_POST['nama'])['id'];
            $tmp[date('Y-m-d')] = [
                'stok' => $_POST['stok'],
                'masuk' => $_POST['stok'], 
                'keluar' => 0, 
            ];
            $_POST['riwayat'] = json_encode($tmp);
            $this->model($this->model_name)->insertRiwayat($_POST);

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/stok');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');

            $this->model($this->model_name)->deleteRiwayat($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/stok');
    }

	public function update()
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/stok');

            $this->model($this->model_name)->update($_POST);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/stok');
    }

    public function updatePengeluaran()
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/stok/pengeluaran');

            $data = array_combine($_POST['id'], $_POST['pengeluaran']);

            foreach ($data as $id => $val)
                if (!$this->model($this->model_name)->updateStok($id, date('Y-m-d'), ['keluar' => $val]))
                    throw new Exception("Haha error");

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/stok/pengeluaran');
    }

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|Warehouse');
        returnJson($this->model($this->model_name)->getDataById($_POST['id'])); 
    }

	public function destroy()
	{
	}
}
