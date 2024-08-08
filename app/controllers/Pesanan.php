<?php

class Pesanan extends Controller
{
	protected $model_name = 'Pembayaran_model';

	public function index()
	{
		$this->auth('user', 'Owner|Manager|Sales');

		$data['title'] = 'Pesanan';
		$data['user'] = $this->user;
        $data['pembayaran'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);

		$this->view('penjualan/pesanan', $data);
	}

    public function kasir($id = null)
    {
		$this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

		$data['title'] = 'Kasir';
		$data['user'] = $this->user;
        
        $this->model('Menu_model')->countAvailableAll($this->user['outlet_uuid']);
        $data['menu'] = $this->model('Menu_model')->getAllData($this->user['outlet_uuid']);
        $data['kategori'] = $this->model('Kategori_model')->getAllData();
        $data['pajak'] = $this->user['pajak_outlet'];
		
        if (!$id) {
            $this->view('penjualan/kasir', $data);
        } else {
            $data['pesanan'] = $this->model($this->model_name)->getDataById($id);
            $this->view('penjualan/edit', $data);
        }
	}

    public function invoice($uuid = null)
	{
		$this->auth('user');

		$data['title'] = 'Invoice';
		$data['user'] = $this->user;
        
        $data['pembayaran'] = ($uuid) ?
            $this->model($this->model_name)->getDataByUuid($uuid) :
            $this->model($this->model_name)->getLatestData();

		$this->view('penjualan/invoice', $data);
	}

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/kasir');

            $_POST['outlet_uuid'] = $this->user['outlet_uuid'];
            $_POST['tanggal'] = date('Y-m-d');

            // Proses detail pembayaran untuk invoice
            $detail_pembayaran = [];
            foreach ($_POST['id'] as $i => $item_id) {
                array_push($detail_pembayaran, [
                    'id' => $item_id,
                    'item' => $_POST['item'][$i],
                    'amount' => $_POST['amount'][$i],
                    'subtotal' => $_POST['item_subtotal'][$i],
                    'take_away' => json_decode($_POST['take_away'][$i]),
                ]);
            }
            $_POST['detail_pembayaran'] = json_encode($detail_pembayaran);
            unset($_POST['item']); unset($_POST['amount']); unset($_POST['item_subtotal']); unset($_POST['take_away']); unset($_POST['id']);
            
            // Set data finance
            $finance = $this->model('Finance_model')->getDataByRelation('penjualan|' . $_POST['tanggal']);
            if ($finance) {
                // Update if data on that date is available
                $res = $this->model('Finance_model')->updateFrom(
                    $finance['relation'],
                    $finance['jumlah'] + $_POST['total'],
                    $finance['tanggal'],
                );
            } else {
                // If not, then add new record
                $res = $this->model('Finance_model')->insertFrom(
                    'penjualan|' . $_POST['tanggal'],
                    $_POST['total'],
                    'Pendapatan Penjualan Harian',
                    $_POST['tanggal'],
                    $_POST['outlet_uuid']
                );
            }
            if (!$res) new Exception('Haha eror');

            // Insert data pembayaran
            $res = $this->model($this->model_name)->insert($_POST);
            if (!$res) new Exception('Haha eror');
            
            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>','success');
        } catch(Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan/kasir');
    }

    public function update($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate("/pesanan");

            $old = $this->model($this->model_name)->getDataById($id);

            // Proses detail pembayaran untuk invoice
            $detail_pembayaran = [];
            foreach ($_POST['id'] as $i => $item_id) {
                array_push($detail_pembayaran, [
                    'id' => $item_id,
                    'item' => $_POST['item'][$i],
                    'amount' => $_POST['amount'][$i],
                    'subtotal' => $_POST['item_subtotal'][$i],
                    'take_away' => json_decode($_POST['take_away'][$i]),
                ]);
            }
            $_POST['detail_pembayaran'] = json_encode($detail_pembayaran);
            unset($_POST['item']); unset($_POST['amount']); unset($_POST['item_subtotal']); unset($_POST['take_away']); unset($_POST['id']);

            // Update finance by difference
            $finance = $this->model('Finance_model')->getDataByRelation('penjualan|' . $old['tanggal']);
            $diff = $_POST['total'] - $old['total'];
            $res = $this->model('Finance_model')->updateFrom(
                $finance['relation'],
                $finance['jumlah'] + $diff,
                $finance['tanggal'],
            );
            if (!$res) new Exception('Haha eror');

            // Update data pembayaran
            $res = $this->model($this->model_name)->update($id, $_POST);
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>','success');
        } catch(Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan');
    }

	public function updateStatusPesanan($id)
	{
        try {
            $this->auth('user', 'Owner|Manager|Sales');

            // Get common information
            $outlet_uuid = $this->user['outlet_uuid'];
            $pesanan = $this->model($this->model_name)->getDataById($id);
            $kemasan = $this->model('Stok_model')->getAllKemasan();
            $detail_pembayaran = json_decode($pesanan['detail_pembayaran'], true);

            // Dapatkan data tiap menu
            $selected_menu = $this->model("Menu_model")->getMultipleBy('id', array_unique(array_column($detail_pembayaran, 'id')));
            $tersedia = true;
            $all_bahan = [];
            
            // Cek apakah item tersedia atau tidak
            foreach ($detail_pembayaran as $item) {
                $menu = $selected_menu[array_search($item['id'], array_column($selected_menu, 'id'))];
                $data_tersedia = json_decode($menu['tersedia'], true)[$outlet_uuid];
                if ($data_tersedia != "infinite" && ($data_tersedia < $item['amount'])) {
                    $tersedia = $menu['nama'];
                    break;
                }

                // Tambahkan dan kalikan data bahan berdasarkan amount
                $bahan = json_decode($menu['bahan'], true);

                // Cek apakah item take away atau tidak, jika tidak hilangkan bahan kemasan dalam list.
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
                            ['keluar' => ($current_pengeluaran + $all_bahan[$item['nama']])]
                        );
                    }
                }

                // Cek ketersediaan semua menu setelah stok berkurang
                $this->model('Menu_model')->countAvailableAll($outlet_uuid);
                
                // Update status pesanan
                if ($this->model($this->model_name)->updateField($id, 'status_order', 1) > 0) {
                    Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
                    redirectTo('/pesanan/invoice/' . $pesanan['uuid']);
                } else {
                    throw new Exception('Haha error');
                }
            } else {
                Flasher::setFlash("Menu&nbsp<b>{$tersedia}</b>&nbsptelah habis!", 'danger');
            }
        } catch (Exception $e) {
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

            // Update pengeluaran
            $res = $this->model($this->model_name)->delete($id);
            if (!$res) new Exception('Haha eror');

            // Update finance by difference and total
            $finance = $this->model('Finance_model')->getDataByRelation('penjualan|' . $old['tanggal']);
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

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch(Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/pesanan');
    }

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }

	public function destroy()
	{
	}
}
