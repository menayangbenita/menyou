<?php

class Pesanan extends Controller
{
	protected $model_name = 'Pembayaran_model';

	public function index()
	{
		$this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

		$data['title'] = 'Pesanan';
		$data['user'] = $this->user;

        $data['menu'] = $this->model('Menu_model')->getAllData();
        $data['pembayaran'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
        $data['pajak'] = $this->user['pajak_outlet'];

		$this->view('pesanan/index', $data);
	}

    public function add()
    {
		$this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

		$data['title'] = 'Tambah Pesanan';
		$data['user'] = $this->user;
        
        $this->model('Menu_model')->countAvailableAll($this->user['outlet_uuid']);
        $data['menu'] = $this->model('Menu_model')->getAllData($this->user['outlet_uuid']);
        $data['kategori'] = $this->model('Kategori_model')->getAllData();
        $data['pajak'] = $this->user['pajak_outlet'];
		
        $this->view('pesanan/add', $data);
	}

    public function edit($id) 
    {
        $this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

		$data['title'] = 'Kasir';
		$data['user'] = $this->user;
        
        $this->model('Menu_model')->countAvailableAll($this->user['outlet_uuid']);
        $data['menu'] = $this->model('Menu_model')->getAllData($this->user['outlet_uuid']);
        $data['kategori'] = $this->model('Kategori_model')->getAllData();
        $data['pajak'] = $this->user['pajak_outlet'];
		
        $data['pesanan'] = $this->model($this->model_name)->getDataById($id);
        $this->view('pesanan/edit', $data);
    }

    public function invoice($uuid = null)
	{
		$this->auth('user');

		$data['title'] = 'Invoice';
		$data['user'] = $this->user;
        
        $data['pembayaran'] = ($uuid) ?
            $this->model($this->model_name)->getDataByUuid($uuid) :
            $this->model($this->model_name)->getLatestData();

		$this->view('pesanan/invoice', $data);
	}

    public function insert()
    {
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/pesanan/add');

            // Prepare data
            $data = posts();
            $data->outlet_uuid = $this->user['outlet_uuid'];
            $data->tanggal = date('Y-m-d');

            // Proses detail pembayaran untuk invoice
            $detail_pembayaran = [];
            foreach ($_POST['id'] as $i => $item_id) {
                array_push($detail_pembayaran, [
                    'id' => $item_id,
                    'item' => $data->item[$i],
                    'amount' => $data->amount[$i],
                    'subtotal' => $data->item_subtotal[$i],
                    'take_away' => json_decode($data->take_away[$i]),
                ]);
            }
            $data->detail_pembayaran = json_encode($detail_pembayaran);
            unset($data->item); unset($data->amount); unset($data->item_subtotal); unset($data->take_away); unset($data->id);

            // Insert data pembayaran
            $res = $this->model($this->model_name)->insert((array)$data);
            if (!$res) new Exception('Haha eror');
            
            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>','success');
        } catch(Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan/add');
    }

    public function update($id)
    {
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate("/pesanan/edit");

            // Prepare data
            $data = posts();

            // Proses detail pembayaran untuk invoice
            $detail_pembayaran = [];
            foreach ($data->id as $i => $item_id) {
                array_push($detail_pembayaran, [
                    'id' => $item_id,
                    'item' => $data->item[$i],
                    'amount' => $data->amount[$i],
                    'subtotal' => $data->item_subtotal[$i],
                    'take_away' => json_decode($data->take_away[$i]),
                ]);
            }
            $data->detail_pembayaran = json_encode($detail_pembayaran);
            unset($data->item); unset($data->amount); unset($data->item_subtotal); unset($data->take_away); unset($data->id);

            // Update data pembayaran
            $res = $this->model($this->model_name)->update($id, (array)$data);
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>','success');
        } catch(Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan');
    }

	public function updateStatusPesanan()
	{
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/pesanan');

            // Get common information
            $outlet_uuid = $this->user['outlet_uuid'];
            $kemasan = $this->model('Stok_model')->getAllKemasan();
            $pesanan = $this->model($this->model_name)->getDataById(posts()->id);
            $detail = json_decode($pesanan['detail_pembayaran'], true);

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

                // Cek apakah item take away atau tidak, jika tidak hilangkan bahan kemasan dalam list. (jika order)
                if (!$item['take_away']) array_diff($bahan, $kemasan);

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

                // Cek ketersediaan semua menu setelah stok berkurang
                $this->model('Menu_model')->countAvailableAll($outlet_uuid);
                
                // Update status pesanan/prepare
                $res = $this->model($this->model_name)->updateField(posts()->id, 'status_order', 1);
                if (!$res) throw new Exception('Haha error');

                Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
            } else {
                Flasher::setFlash("Menu&nbsp<b>{$tersedia}</b>&nbsptelah habis!", 'danger');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan');
	}

    public function submitPembayaran() 
    {
        try {
            httpPOST();
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/pesanan');

            // Get common information
            $outlet_uuid = $this->user['outlet_uuid'];
            $pesanan = $this->model($this->model_name)->getDataById(posts()->id);

            // Set data finance
            $finance = $this->model('Finance_model')->getDataByRelation('pesanan|' . $pesanan['tanggal']);
            if ($finance) {
                // Update if data on that date is available
                $res = $this->model('Finance_model')->updateFrom(
                    $finance['relation'],
                    $finance['jumlah'] + $pesanan['total'],
                    $finance['tanggal'],
                );
            } else {
                // If not, then add new record
                $res = $this->model('Finance_model')->insertFrom(
                    'pesanan|' . $pesanan['tanggal'],
                    $pesanan['total'],
                    'Pendapatan pesanan Harian',
                    $pesanan['tanggal'],
                    $outlet_uuid
                );
            }
            if (!$res) new Exception('Haha eror');

            // Update data pembayaran
            $res = $this->model($this->model_name)->updatePembayaran(posts()->id, (array)posts());
            if (!$res) throw new Exception('Haha error');

            // Update status pesanan/prepare
            $res = $this->model($this->model_name)->updateField(posts()->id, 'status_order', 2);
            if (!$res) throw new Exception('Haha error');

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch(Exception $e) {
            dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');

            $old = $this->model($this->model_name)->getDataById($id);

            // Update finance by difference and total
            $finance = $this->model('Finance_model')->getDataByRelation('pesanan|' . $old['tanggal']);
            $diff = $_POST['total'] - $old['total'];
            $total = $finance['jumlah'] + $diff;
            if ($total > 0) {
                $res = $this->model('Finance_model')->updateFrom(
                    $finance['relation'],
                    $total,
                    $finance['tanggal'],
                );
            } else {
                $res = $this->model('Finance_model')->delete($finance['id']);
            }
            if (!$res) new Exception('Haha eror');

            // Update pengeluaran
            $res = $this->model($this->model_name)->delete($id);
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch(Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan');
    }

    public function getUbah()
    {
        httpPOST();
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model($this->model_name)->getDataById(posts()->id));
    }

	public function destroy()
	{
	}
}
