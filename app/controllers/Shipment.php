<?php

use Symfony\Bridge\Twig\Node\DumpNode;

class Shipment extends Controller
{
	protected $model_name = 'Shipment_model';

	public function index()
	{
		$this->auth('user', 'Owner|Manager|Warehouse');
        csrf_generate();

		$data['title'] = 'Shipment';
		$data['user'] = $this->user;
        $data['shipment'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
        $data['barang'] = $this->model('Stok_model')->getAllData();
        $data['supplier'] = $this->model('Supplier_model')->getAllData($this->user['outlet_uuid']);

        $data['satuan'] = [];
        foreach ($data['barang'] as $item) {
            $data['satuan'][$item['nama']] = $item['satuan'];
        }

		$this->view('stok/shipment', $data);
	}

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/shipment');

            $_POST['outlet_uuid'] = $this->user['outlet_uuid'];

            // Process data stok
            $_POST['detail_barang'] = [];
            foreach ($_POST['nama'] as $i => $nama) {
                array_push($_POST['detail_barang'], [
                    'nama' => $nama,
                    'jumlah' => $_POST['jumlah'][$i],
                    'harga_satuan' => $_POST['harga_satuan'][$i],
                    'subtotal' => $_POST['subtotal'][$i],
                ]);
            }
            unset($_POST['nama']); unset($_POST['jumlah']); unset($_POST['harga_satuan']); unset($_POST['subtotal']);

            $_POST['tanggal'] = date('Y-m-d', strtotime($_POST['tanggal']));
            
            // Check if data stok is available or not. If so, then add the stok data. If not, update stok data.
            foreach ($_POST['detail_barang'] as $item) {
                $stok = $this->model('Stok_model')->getDataByName($item['nama']);

                if ($stok) {
                    $riwayat = $this->model('Stok_model')->getRiwayatBy($stok['id'], $_POST['outlet_uuid'])['riwayat'];

                    if ($riwayat) {
                        // If riwayat is available, get current and update riwayat
                        $riwayat = json_decode($riwayat, true);
                        $current = (isset($riwayat[$_POST['tanggal']])) ? $riwayat[$_POST['tanggal']]['masuk'] : 0;

                        $this->model('Stok_model')->updateRiwayat(
                            $stok['id'], 
                            $_POST['outlet_uuid'],
                            $_POST['tanggal'],
                            ['masuk' => $current + $item['jumlah']],
                        );
                    } else {
                        // If not, insert new riwayat data
                        $riwayat[$_POST['tanggal']] = [
                            'stok' => $item['jumlah'],
                            'masuk' => $item['jumlah'], 
                            'keluar' => 0
                        ];
                        
                        $this->model('Stok_model')->insertRiwayat([
                            'stok_id' => $stok['id'],
                            'stok' => $item['jumlah'],
                            'riwayat' => json_encode($riwayat),
                            'outlet_uuid' => $_POST['outlet_uuid'],
                        ]);
                    }
                } else {
                    // Create new data stok and riwayat at that time
                    $riwayat[$_POST['tanggal']] = [
                        'stok' => $item['jumlah'],
                        'masuk' => $item['jumlah'], 
                        'keluar' => 0
                    ];

                    // Insert data stok
                    $this->model('Stok_model')->insert([
                        'nama' => $item['nama'],
                        'jenis' => $_POST['jenis'][0],
                        'satuan' => $_POST['satuan'][0],
                    ]);

                    // Insert data riwayat
                    $stok_id = $this->model('Stok_model')->getDataByName($item['nama'])['id'];
                    $this->model('Stok_model')->insertRiwayat([
                        'stok_id' => $stok_id,
                        'stok' => $item['jumlah'],
                        'riwayat' => json_encode($riwayat),
                        'outlet_uuid' => $_POST['outlet_uuid'],
                    ]);

                    // Shift data jenis and satuan
                    unset($_POST['jenis'][0]); unset($_POST['satuan'][0]);
                    $_POST['jenis'] = array_values($_POST['jenis']);
                    $_POST['satuan'] = array_values($_POST['satuan']);
                }
            }
            unset($_POST['jenis']); unset($_POST['satuan']);
            $_POST['detail_barang'] = json_encode($_POST['detail_barang']);

            // Rearange array biaya_lainnya
            if ($_POST['nama_biaya_lainnya'][0]) {
                $tmp = []; $i = 0;
                foreach ($_POST['nama_biaya_lainnya'] as $nama) {
                    $tmp[$nama] = !empty($_POST['biaya_lainnya'][$i]) ? $_POST['biaya_lainnya'][$i] : 0;
                    $i++;
                }
                $_POST['biaya_lainnya'] = json_encode($tmp);
            } else {
                $_POST['biaya_lainnya'] = "{}";
            }
            unset($_POST['nama_biaya_lainnya']);

            // Insert data shipment
            $uuid = $this->model($this->model_name)->insert($_POST);
            if (!$uuid) new Exception('Haha eror');

            // Insert data finance
            $res = $this->model('Finance_model')->insertFrom(
                'shipment|' . $uuid,
                $_POST['total'],
                'Biaya shipment',
                $_POST['tanggal'],
                $_POST['outlet_uuid'],
            );
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/shipment');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');

            $old = $this->model($this->model_name)->getDataById($id);
            $detail_barang = json_decode($old['detail_barang'], true);

            // Update old data
            foreach ($detail_barang as $item) {
                // Get current
                $stok = $this->model('Stok_model')->getDataByName($item['nama'], $old['outlet_uuid']);
                $riwayat = json_decode($stok['riwayat'], true);
                $current = $riwayat[$old['tanggal']]['masuk'];
        
                // Update stok
                $this->model('Stok_model')->updateRiwayat(
                    $stok['id'], 
                    $old['outlet_uuid'],
                    $old['tanggal'],
                    ['masuk' => $current - $item['jumlah']]
                );
            }

            // Delete finance data
            $this->model('Finance_model')->deleteFrom('shipment|' . $old['uuid']);

            // Delete shipment data
            $res = $this->model($this->model_name)->delete($id);
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/shipment');
    }

	public function update($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/shipment');

            // Rearange array detail_barang
            $_POST['detail_barang'] = [];
            foreach ($_POST['nama'] as $i => $nama) {
                array_push($_POST['detail_barang'], [
                    'nama' => $nama,
                    'jumlah' => $_POST['jumlah'][$i],
                    'harga_satuan' => $_POST['harga_satuan'][$i],
                    'subtotal' => $_POST['subtotal'][$i],
                ]);
            }
            unset($_POST['nama']); unset($_POST['jumlah']); unset($_POST['harga_satuan']); unset($_POST['subtotal']);

            // Get detail_barang old and new
            $old = $this->model($this->model_name)->getDataById($id);
            $detail_barang_old = json_decode($old['detail_barang'], true);
            $detail_barang_new = $_POST['detail_barang'];

            // Update old data
            foreach ($detail_barang_old as $item) {
                // Find data masuk
                $find = array_search($item['nama'], array_column($detail_barang_new, 'nama'));
                $diff = $item['jumlah'] * -1; // (diff default value is ~jumlah_old)
                if ($find !== false) {
                    // If found, get the difference.
                    $diff = $detail_barang_new[$find]['jumlah'] - $item['jumlah'];
                    // Delete the old data
                    unset($detail_barang_new[$find]);
                    $detail_barang_new = array_values($detail_barang_new);
                    // If the difference was 0, skip the process to next data
                    if ($diff == 0) continue;
                }

                // Get current
                $stok = $this->model('Stok_model')->getDataByName($item['nama'], $old['outlet_uuid']);
                $riwayat = json_decode($stok['riwayat'], true);
                $current = $riwayat[$old['tanggal']]['masuk'];
        
                // Update stok
                $this->model('Stok_model')->updateRiwayat(
                    $stok['id'], 
                    $old['outlet_uuid'],
                    $old['tanggal'],
                    ['masuk' => $current + $diff]
                );
            }

            // The rest data is new, so add them in stok and riwayat
            if (!empty($detail_barang_new)) {
                foreach ($detail_barang_new as $item) {
                    $stok = $this->model('Stok_model')->getDataByName($item['nama']);
                    
                    if ($stok) {
                        // Get data riwayat
                        $riwayat = $this->model('Stok_model')->getRiwayatBy($stok['id'], $_POST['outlet_uuid'])['riwayat'];

                        if ($riwayat) {
                            // If riwayat is available, get current and update riwayat
                            $riwayat = json_decode($riwayat, true);
                            $current = (isset($riwayat[$old['tanggal']])) ? $riwayat[$old['tanggal']]['masuk'] : 0;
                
                            $this->model('Stok_model')->updateRiwayat(
                                $stok['id'], 
                                $old['outlet_uuid'],
                                $old['tanggal'],
                                ['masuk' => $current + $item['jumlah']]
                            );
                        } else {
                            // If not, insert new riwayat data
                            $riwayat[$old['tanggal']] = [
                                'stok' => $item['jumlah'],
                                'masuk' => $item['jumlah'], 
                                'keluar' => 0
                            ];
                            
                            $this->model('Stok_model')->insertRiwayat([
                                'stok_id' => $stok['id'],
                                'stok' => $item['jumlah'],
                                'riwayat' => json_encode($riwayat),
                                'outlet_uuid' => $old['outlet_uuid'],
                            ]);
                        }
                    } else {
                        // Create new data stok and riwayat at that time
                        $riwayat[$old['tanggal']] = [
                            'stok' => $item['jumlah'],
                            'masuk' => $item['jumlah'], 
                            'keluar' => 0
                        ];
                        
                        // Insert data stok
                        $this->model('Stok_model')->insert([
                            'nama' => $item['nama'],
                            'jenis' => $_POST['jenis'][0],
                            'satuan' => $_POST['satuan'][0],
                        ]);

                        // Insert data riwayat
                        $stok_id = $this->model('Stok_model')->getDataByName($item['nama'])['id'];
                        $this->model('Stok_model')->insertRiwayat([
                            'stok_id' => $stok_id,
                            'stok' => $item['jumlah'],
                            'riwayat' => json_encode($riwayat),
                            'outlet_uuid' => $old['outlet_uuid'],
                        ]);

                        // Shift data jenis and satuan
                        unset($_POST['jenis'][0]); unset($_POST['satuan'][0]);
                        $_POST['jenis'] = array_values($_POST['jenis']);
                        $_POST['satuan'] = array_values($_POST['satuan']);
                    }
                }

                unset($_POST['jenis']); unset($_POST['satuan']);
            }
            $_POST['detail_barang'] = json_encode($_POST['detail_barang']);

            // Rearange array biaya_lainnya
            if ($_POST['nama_biaya_lainnya'][0]) {
                $tmp = []; $i = 0;
                foreach ($_POST['nama_biaya_lainnya'] as $nama) {
                    $tmp[$nama] = $_POST['biaya_lainnya'][$i];
                    $i++;
                }
                $_POST['biaya_lainnya'] = json_encode($tmp);
            } else {
                $_POST['biaya_lainnya'] = "{}";
            }
            unset($_POST['nama_biaya_lainnya']);

            // Update data finance
            $res = $this->model('Finance_model')->updateFrom(
                'shipment|' . $old['uuid'],
                $_POST['total'],
                $old['tanggal'],
            );
            if (!$res) new Exception('Haha eror');

        
            // Update data shipment
            $res = $this->model($this->model_name)->update($id, $_POST);
            if (!$res) new Exception('Haha eror');

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/shipment');
    }

    public function getUbah($id)
    {
        $this->auth('user', 'Owner|Manager|Warehouse');
        returnJson($this->model($this->model_name)->getDataById($id)); 
    }

	public function destroy()
	{
	}
}