<?php

class Dashboard extends Controller
{
	public function index()
	{
		$this->auth('user');

		$data['title'] = 'Dashboard';
		$data['user'] = $this->user;

		$data['menu'] = $this->model('Menu_model')->getAllData($this->user['outlet_uuid']);
        $data['kategori'] = $this->model('Kategori_model')->getAllData();
		$data['jmlMenu'] = count($data['menu']);
		$data['jmlSupplier'] = count($this->model('Supplier_model')->getAllData($this->user['outlet_uuid']));
		$data['jmlKaryawan'] = count($this->model('Karyawan_model')->getAllData($this->user['outlet_uuid']));
		$data['pendapatanBulanIni'] = $this->model('Pembayaran_model')
			->getIncomeBetween(date('Y-m-01'), date('Y-m-t'), $this->user['outlet_uuid']) ?? 0;
		$data['pendapatanHariIni'] = $this->model('Pembayaran_model')
			->getIncomeAt(date('Y-m-d'), $this->user['outlet_uuid']) ?? 0;
		$data['pendapatanKemarin'] = $this->model('Pembayaran_model')
			->getIncomeAt(date('Y-m-d', strtotime('-1 day')), $this->user['outlet_uuid']) ?? 0;
		$data['barang'] = $this->model('Stok_model')->getAllData($this->user['outlet_uuid']);

		$this->view('dashboard', $data);
	}
}
