<?php 

class Prepare extends Controller
{
	protected $model_name = 'Prepare_model';

	public function index()
	{
        $this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

        $data['title'] = 'Menu Prepare';
        $data['user'] = $this->user;

        $this->model('Menu_model')->countAvailableAll($this->user['outlet_uuid'], true, true);
        $data['menu'] = $this->model('Menu_model')->getAllPrepare($this->user['outlet_uuid']);
        $data['barang'] = $this->model('Stok_model')->getAllData($this->user['outlet_uuid']);

        $this->view('/prepare/index', $data);
	}

    public function request() 
    {
        $this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

		$data['title'] = 'Request Prepare';
		$data['user'] = $this->user;
        $data['request_prepare'] = $this->model('Prepare_model')->getAllData($this->user['outlet_uuid']);
        $menu_prepare = $this->model('Menu_model')->getAllPrepare($this->user['outlet_uuid']);
        foreach($menu_prepare as $item) $data['satuan'][$item['nama']] = $item['satuan'];

        $this->view('/prepare/request', $data);
    }
    
    function edit($id) {
        $this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

        $data['title'] = 'Edit Request Prepare';
		$data['user'] = $this->user;

        $this->model('Menu_model')->countAvailableAll($this->user['outlet_uuid'], true, true);
        $data['prepare'] = $this->model('Prepare_model')->getDataById($id);
        $data['menu'] = $this->model('Menu_model')->getAllPrepare($this->user['outlet_uuid']);
        $data['barang'] = $this->model('Stok_model')->getAllData($this->user['outlet_uuid']);

        $this->view('/prepare/edit', $data);
    }

    public function invoice($uuid = null)
	{
		$this->auth('user');

		$data['title'] = 'Invoice';
		$data['user'] = $this->user;
        
        $data['prepare'] = ($uuid) ?
            $this->model('Prepare_model')->getDataByUuid($uuid) :
            $this->model('Prepare_model')->getLatestData();

		$this->view('prepare/invoice', $data);
	}

    public function addRequest()  {
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/prepare');

            // Prepare data
            $data = posts();
            $data->outlet_uuid = $this->user['outlet_uuid'];
            $data->tanggal = date('Y-m-d');

            // Proses detail items untuk request prepare
            $detail_items = [];
            foreach ($data->id as $i => $item_id) {
                array_push($detail_items, [
                    'id' => $item_id,
                    'stok_id' => $data->stok_id[$i],
                    'item' => $data->item[$i],
                    'amount' => $data->amount[$i],
                ]);
            }
            $data->detail_items = json_encode($detail_items);
            unset($data->id); unset($data->item); unset($data->stok_id); unset($data->amount);

            // Insert data prepare
            $res = $this->model('Prepare_model')->insert((array)$data);
            if (!$res) new Exception('Haha eror');
            
            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/prepare');
    }

    public function editRequest($id)  {
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/prepare');

            // Prepare data
            $data = posts();

            // Proses detail items untuk request prepare
            $detail_items = [];
            foreach ($data->id as $i => $item_id) {
                array_push($detail_items, [
                    'id' => $item_id,
                    'stok_id' => $data->stok_id[$i],
                    'item' => $data->item[$i],
                    'amount' => $data->amount[$i],
                ]);
            }
            $data->detail_items = json_encode($detail_items);
            unset($data->id); unset($data->item); unset($data->stok_id); unset($data->amount);

            // Update data pembayaran
            $res = $this->model($this->model_name)->update($id, (array)$data);
            if (!$res) new Exception('Haha eror');
            
            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/prepare/request');
    }

    public function updateStatusRequest()
	{
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/prepare/request');

            // Prepare data
            $id = posts()->id;
            $outlet_uuid = $this->user['outlet_uuid'];

            // Tentukan apakah ini data order atau prepare
            $pesanan = $this->model('Prepare_model')->getDataById($id);
            $detail = json_decode($pesanan['detail_items'], true);

            // Dapatkan data tiap menu
            $selected_menu = $this->model("Menu_model")->getMultipleBy('id', array_unique(array_column($detail, 'id')));
            $tersedia = true;
            $all_bahan = [];
            
            // Cek apakah item tersedia atau tidak
            foreach ($detail as $item) {
                $menu = $selected_menu[array_search($item['id'], array_column($selected_menu, 'id'))];
                $data_tersedia = json_decode($menu['tersedia'], true)[$outlet_uuid];
                if ($data_tersedia != "infinite" && ($data_tersedia < $item['amount'])) {
                    $tersedia = $menu['nama'];
                    break;
                }

                // Tambahkan dan kalikan data bahan berdasarkan amount
                $bahan = json_decode($menu['bahan'], true);

                foreach ($bahan as $key => $val) {
                    // Cek apakah array sudah ada di dalam list bahan
                    if (isset($all_bahan['key'])) {
                        $all_bahan[$key] += ($val * $item['amount']);
                    } else {
                        $all_bahan[$key] = $val * $item['amount'];
                    }
                }
            }

            // Proses data bahan jika tersedia
            if ($tersedia === true) {
                // Tambah data pengeluaran stok hari ini jika ada
                if (!empty($all_bahan)) {
                    $stok = $this->model('Stok_model')->getMultipleBy('nama', array_keys($all_bahan), $outlet_uuid);
                    foreach ($stok as $item) {
                        $riwayat = json_decode($item['riwayat'], true);
                        $current_pengeluaran = isset($riwayat[date('Y-m-d')]) ?
                            $riwayat[date('Y-m-d')]['keluar'] : 0;
    
                        $this->model('Stok_model')->updateRiwayat(
                            $item['id'],
                            $outlet_uuid,
                            date('Y-m-d'), 
                            ['keluar' => $current_pengeluaran + $all_bahan[$item['nama']]]
                        );
                    }
                }

                // Tambah stok prepare berdasarkan amount
                $stok = $this->model('Stok_model')->getMultipleBy('id', array_column($detail, 'stok_id'), $outlet_uuid);
                $amount = array_combine(array_column($detail, 'stok_id'), array_column($detail, 'amount'));
                foreach ($stok as $item) {
                    $riwayat = json_decode($item['riwayat'], true);
                    $current = (isset($riwayat[date('Y-m-d')])) ? $riwayat[date('Y-m-d')]['masuk'] : 0;

                    $this->model('Stok_model')->updateRiwayat(
                        $item['id'],
                        $outlet_uuid,
                        date('Y-m-d'), 
                        ['masuk' => $current + $amount[$item['id']]]
                    );
                }

                // Cek ketersediaan semua menu setelah stok berkurang
                $this->model('Menu_model')->countAvailableAll($outlet_uuid);
                
                // Update status pesanan/prepare
                $res = $this->model("Prepare_model")->updateField($id, 'status_order', 1);
                if (!$res) throw new Exception('Haha error');

                Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
            } else {
                Flasher::setFlash("Menu&nbsp<b>{$tersedia}</b>&nbsptelah habis!", 'danger');
            }
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/prepare/request');
	}

    public function insert()
    {
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/prepare');

            // Set data
            $data = posts();
            $data->harga = NULL;
            $data->kategori_id = NULL;
            $data->outlet_uuid = $this->user['outlet_uuid'];
            $data->nama = stripAndSanitize($data->nama);

            // Insert stok data
            $res = $this->model('Stok_model')->insert([
                'nama' => $data->nama,
                'jenis' => 'prepare',
                'satuan' => $data->satuan,
            ]);
            if (!$res) throw new Exception('Haha eror');

            // Add riwayat stok
            $data->stok_id = $this->model('Stok_model')->getDataByName($data->nama)['id'];
            $tmp[date('Y-m-d')] = [
                'stok' => $data->stok,
                'masuk' => $data->stok, 
                'keluar' => 0, 
            ];
            $data->riwayat = json_encode($tmp);

            $res = $this->model('Stok_model')->insertRiwayat((array)$data);
            if (!$res) throw new Exception('Haha eror');

            // Set all bahan value to float
            $bahan = [];
            foreach ($data->nama_bahan as $i => $nama_bahan) {
                if (!$nama_bahan) continue;
                $bahan[$nama_bahan] = floatval($data->jumlah_bahan[$i]);
            }
            $data->bahan = json_encode($bahan);
            unset($data->nama_bahan); unset($data->jumlah_bahan);

            // Insert data menu
            $res = $this->model('Menu_model')->insert((array)$data, $data->stok_id);
            if (!$res) throw new Exception('Haha eror');
            
            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/prepare');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            
            $this->model($this->model_name)->delete($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/prepare', 200);
    }

	public function update($id)
	{
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/prepare');

            // Prepare data
            $data = posts();

            // Set data
            $data->harga = NULL;
            $data->kategori_id = NULL;
            $outlet_uuid = $this->user['outlet_uuid'];
            $data->nama = stripAndSanitize($data->nama);

            foreach ($data->nama_bahan as $i => $nama_bahan)
                $bahan[$nama_bahan] = floatval($data->jumlah_bahan[$i]);
            $data->bahan = json_encode($bahan);
            unset($data->nama_bahan); unset($data->jumlah_bahan);
            
            // Update the stok name
            $old_name = $this->model('Menu_model')->getDataById($id)['nama'];
            $stok = $this->model("Stok_model")->getDataByName($old_name, $outlet_uuid);
            $stok['nama'] = $data->nama;
            
            $res = $this->model("Stok_model")->update($stok['id'], $stok);
            if (!$res) new Exception('Haha eror');

            // Update menu
            $res = $this->model('Menu_model')->update($id, (array)$data);
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/prepare');
	}

    public function getUbah()
    {
        httpPOST();
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model('Menu_model')->getPrepareById(posts()->id, $this->user['outlet_uuid']));
    }
    
    public function getPrepare()
    {
        httpPOST();
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model('Prepare_model')->getDataById(posts()->id));
    }

	public function destroy()
	{
	}
}
