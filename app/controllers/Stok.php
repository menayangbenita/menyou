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
		
		$this->view('stok/index', $data);
	}

	public function rekap()
	{
		$this->auth('user', 'Owner|Manager|Warehouse');
        csrf_generate();

		$data['title'] = 'Rekap Stok';
		$data['user'] = $this->user;

        $data['barang'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
        $data['filter'] = (isset($_POST['filter'])) ?
            ['from' => posts()->filter[0], 'to' => posts()->filter[1]] :
            ['from' => date('Y-m-d'), 'to' => date('Y-m-d')];
		
		$this->view('stok/rekap', $data);
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
            httpPOST();
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/stok');

            // Prepare data
            $data = posts();
            $data->outlet_uuid = $this->user['outlet_uuid'];
            $data->nama = stripAndSanitize($data->nama);

            // Insert data stok
            $res = $this->model($this->model_name)->insert((array)$data);
            if (!$res) new Exception('Haha eror');

            // Insert data riwayat
            $data->stok_id = $this->model($this->model_name)->getDataByName($data->nama)['id'];
            $tmp[date('Y-m-d')] = [
                'stok' => $data->stok,
                'masuk' => $data->stok, 
                'keluar' => 0, 
            ];
            $data->riwayat = json_encode($tmp);

            $res = $this->model($this->model_name)->insertRiwayat((array)$data);
            if (!$res) new Exception('Haha eror');

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

            $res = $this->model($this->model_name)->deleteRiwayat($id, $this->user['outlet_uuid']);
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/stok');
    }

	public function update($id)
    {
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/stok');

            // Prepare data
            $data = posts();

            $res = $this->model("Stok_model")->update($id, (array)$data);
            if (!$res) new Exception('Haha eror');

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
            httpPOST();
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/stok/pengeluaran');

            // Prepare data
            $posts = posts();
            $data = array_combine($posts->id, $posts->pengeluaran);
            $outlet_uuid = $this->user['outlet_uuid'];

            foreach ($data as $id => $val)
                if (!$this->model($this->model_name)->updateRiwayat($id, $outlet_uuid, date('Y-m-d'), ['keluar' => $val]))
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
        httpPOST();
        $this->auth('user', 'Owner|Manager|Warehouse');
        returnJson($this->model($this->model_name)->getDataById(posts()->id)); 
    }

	public function destroy()
	{
	}
}
