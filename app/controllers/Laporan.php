<?php

class Laporan extends Controller
{
	function index()
	{
		redirectTo('/laporan/penjualan', 200);
	}

	public function penjualan()
	{
		$this->auth('user', 'Owner|Manager|Analyzer');

		$data['title'] = 'Laporan Penjualan';
		$data['user'] = $this->user;

		$data['filter'] = $this->filter();
		$data['labels'] = $this->getLabels($data['filter']['option'], $data['filter']['current-start']);
		$data['produk'] = $this->model('Menu_model')->getAllData($this->user['outlet_uuid']);
		$data['penjualan_sekarang'] = $this->model('Pembayaran_model')
			->getDataBetween($data['filter']['current-start'], $data['filter']['current-end'], $this->user['outlet_uuid']);
		$data['penjualan_sebelumnya'] = $this->model('Pembayaran_model')
			->getDataBetween($data['filter']['last-start'], $data['filter']['last-end'], $this->user['outlet_uuid']);
		$data['pendapatan_sekarang'] = (int) $this->model('Pembayaran_model')
			->getIncomeBetween($data['filter']['current-start'], $data['filter']['current-end'], $this->user['outlet_uuid']) ?? 0;
		$data['pendapatan_sebelumnya'] = (int) $this->model('Pembayaran_model')
			->getIncomeBetween($data['filter']['last-start'], $data['filter']['last-end'], $this->user['outlet_uuid']) ?? 0;

		// Create tmp array for dataset lenght based on lenght of labels
		$tmp = [];
		foreach ($data['labels'] as $i)
			array_push($tmp, 0);

		// Create datasets template
		$data['dataset_penjualan'] = $tmp;
		$data['dataset_produk'] = [];
		$data['dataset_produk_sebelumnya'] = [];
		foreach ($data['produk'] as $produk) {
			$data['dataset_produk'][strval($produk['id'])] = $tmp;
			$data['dataset_produk_sebelumnya'][strval($produk['id'])] = 0;
		}

		// Process all datasets
		foreach ($data['penjualan_sekarang'] as $item) {
			// Count all data penjualan based on period
			$match = match ($data['filter']['option']) {
				'tahunan' => fn($date) => (int) date('n', strtotime($date)) - 1,
				'bulanan' => fn($date) => (int) date('j', strtotime($date)) - 1,
				'mingguan' => fn($date, $start_date) => floor((strtotime($date) - strtotime($start_date)) / (60 * 60 * 24)),
			};
			$index = $match($item['tanggal'], $data['filter']['current-start']);
			$data['dataset_penjualan'][$index] += 1;

			$detail_pembayaran = json_decode($item['detail_pembayaran'], true);
			foreach ($detail_pembayaran as $item) {
				$id = $item['id'];
				if (isset($data['dataset_produk'][$id])) $data['dataset_produk'][$id][$index] += $item['amount'];
			}
		}
		foreach ($data['penjualan_sebelumnya'] as $item) {
			$detail_pembayaran = json_decode($item['detail_pembayaran'], true);
			foreach ($detail_pembayaran as $item) {
				$id = $item['id'];
				$data['dataset_produk_sebelumnya'][$id] += $item['amount'];
			}
		}

		// Short dataset_produk
		uasort($data['dataset_produk'], fn($a, $b) => array_sum($b) - array_sum($a));

		$this->view('laporan/penjualan', $data);
	}

	public function keuangan()
	{
		$this->auth('user', 'Owner|Manager|Analyzer');

		$data['title'] = 'Laporan Keuangan';
		$data['user'] = $this->user;

		$data['filter'] = $this->filter();
		$data['labels'] = $this->getLabels($data['filter']['option'], $data['filter']['current-start']);
		$data['pajak'] = $this->user['pajak_outlet'];
		$data['keuangan_sekarang'] = $this->model('Finance_model')
			->getDataBetween($data['filter']['current-start'], $data['filter']['current-end'], $this->user['outlet_uuid']);
		$data['keuangan_sebelumnya'] = $this->model('Finance_model')
			->getDataBetween($data['filter']['last-start'], $data['filter']['last-end'], $this->user['outlet_uuid']);

		// Create tmp array for dataset lenght based on lenght of labels
		$tmp = [];
		foreach ($data['labels'] as $i)
			array_push($tmp, 0);

		// Create datasets template
		$data['dataset_pemasukan'] = $tmp;
		$data['dataset_pengeluaran'] = $tmp;
		$data['dataset_pemasukan_sebelumnya'] = $tmp;
		$data['dataset_pengeluaran_sebelumnya'] = $tmp;

		// Process all datasets
		$match = match ($data['filter']['option']) {
			'tahunan' => fn($date) => (int) date('n', strtotime($date)) - 1,
			'bulanan' => fn($date) => (int) date('j', strtotime($date)) - 1,
			'mingguan' => fn($date, $start_date) => floor((strtotime($date) - strtotime($start_date)) / (60 * 60 * 24)),
		};

		foreach ($data['keuangan_sekarang'] as $item) {
			$index = $match($item['tanggal'], $data['filter']['current-start']);
			if ($item['kategori'] == 'masuk')
				$data['dataset_pemasukan'][$index] += $item['jumlah'];
			else
				$data['dataset_pengeluaran'][$index] += $item['jumlah'];
		}

		foreach ($data['keuangan_sebelumnya'] as $item) {
			$index = $match($item['tanggal'], $data['filter']['last-start']);
			if ($item['kategori'] == 'masuk')
				$data['dataset_pemasukan_sebelumnya'][$index] += $item['jumlah'];
			else
				$data['dataset_pengeluaran_sebelumnya'][$index] += $item['jumlah'];
		}

		// Count total from penjualan and shiptment
		$data['pemasukan_penjualan'] = 0;
		$data['pengeluaran_shipment'] = 0;
		foreach ($data['keuangan_sekarang'] as $item) {
			$relation = $item['relation'];
			if (!empty($relation)) {
				switch (explode('|', $relation)[0]) {
					case 'penjualan':
						$data['pemasukan_penjualan'] += $item['jumlah'];
						break;
					case 'shipment':
						$data['pengeluaran_shipment'] += $item['jumlah'];
						break;
				}
			}
		}

		$this->view('laporan/keuangan', $data);
	}


	public function karyawan()
	{
		$this->auth('user', 'Owner|Manager|Analyzer');
		$this->auth('user', 'Owner|Manager|Analyzer');

		$data['title'] = 'Laporan Karyawan';
		$data['user'] = $this->user;

		$data['filter'] = $this->filter();

		$data['absen'] = $this->model('Absensi_model')->getAllDataFiltered($data['filter']['current-start'], $data['filter']['current-end']);
		$data['reward_punishment'] = $this->model('Rewardpunishment_model')->getAllDataFiltered($data['filter']['current-start'], 'reward'); // Menyesuaikan pemanggilan fungsi untuk mendapatkan data reward saja
		$data['karyawan'] = $this->model('Karyawan_model')->getAllData($this->user['outlet_uuid']);
		$data['reward_punishment'] = $this->model('Rewardpunishment_model')->getAllData();
	//         $data['pendapatan_sekarang'] = $this->model('Karyawan_model')->getDataJmlKaryawan($data['filter']['current-start'], $data['filter']['current-end']);
	// var_dump($data['pendapatan_sekarang']);die;
		foreach ($data['absen'] as &$absen) {
			// Pastikan $absen memiliki karyawan_id sebelum mengaksesnya
			if (isset($absen['karyawan_id'])) {
				$karyawan = $this->model('Absen_model')->getKaryawanById($absen['karyawan_id']);
				$absen['karyawan_nama'] = $karyawan ? $karyawan['nama'] : 'Unknown';
			}
		}

		$this->view('laporan/karyawan', $data);
	}

	// Filter Laporan
	private function filter()
	{
		$dataset = [
			"option" => isset($_POST['option']) ? $_POST['option'] : "tahunan",
			"tahun" => intval(isset($_POST['tahun']) ? $_POST['tahun'] : date('Y')),
			"bulan" => intval(isset($_POST['bulan']) ? $_POST['bulan'] : date('n')),
			"minggu-mulai" => isset($_POST['minggu-mulai']) ? $_POST['minggu-mulai'] : date('Y-m-d', strtotime('-6 days')),
			"minggu-selesai" => isset($_POST['minggu-mulai']) ? date('Y-m-d', strtotime($_POST['minggu-mulai'] . ' +6 day')) : date('Y-m-d'),
			"current-start" => null,
			"current-end" => null,
			"last-start" => null,
			"last-end" => null,
		];

		if ($dataset['option'] == "tahunan") {
			$dataset['current-start'] = $dataset['tahun'] . "-01-01";
			$dataset['current-end'] = $dataset['tahun'] . "-12-31";
			$dataset['last-start'] = ($dataset['tahun'] - 1) . "-01-01";
			$dataset['last-end'] = ($dataset['tahun'] - 1) . "-12-31";
		} elseif ($dataset['option'] == "bulanan") {
			$dataset['current-start'] = date('Y-m-01', mktime(0, 0, 0, $dataset['bulan'], 1, $dataset['tahun']));
			$dataset['current-end'] = date('Y-m-t', mktime(0, 0, 0, $dataset['bulan'], 1, $dataset['tahun']));
			$dataset['last-start'] = date('Y-m-01', strtotime($dataset['current-start'] . ' -15 day'));
			$dataset['last-end'] = date('Y-m-t', strtotime($dataset['current-end'] . ' -45 day'));
		} elseif ($dataset['option'] == "mingguan") {
			$dataset['current-start'] = $dataset['minggu-mulai'];
			$dataset['current-end'] = $dataset['minggu-selesai'];
			$dataset['last-start'] = date('Y-m-d', strtotime($dataset['minggu-mulai'] . ' -7 day'));
			$dataset['last-end'] = date('Y-m-d', strtotime($dataset['minggu-selesai'] . ' -7 day'));
		}

		$dataset['date-range'] = date('j M', strtotime($dataset['current-start'])) . " - " . date('j M', strtotime($dataset['current-end']));

		return $dataset;
	}

	private function getLabels($filter_option, $start_date)
	{
		$match = match ($filter_option) {
			'tahunan' => fn() => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			'bulanan' => function ($start_date) {
					$tmp = [];
					for ($i = 1; $i <= (int) date('t', strtotime($start_date)); $i++)
						array_push($tmp, $i);
					return $tmp;
				},
			'mingguan' => function ($start_date) {
					$tmp = [];
					for ($i = 0; $i < 7; $i++) {
						$day = date('j', strtotime($start_date . '+' . $i . ' days'));
						array_push($tmp, $day);
					}
					return $tmp;
				},
		};
		return $match($start_date);

	}
}