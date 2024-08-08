<?php Get::view('templates/header', $data) ?>


<div class="row">
    <div class="col-lg-12">

        <div class="card mb-4">
            <div class="card-body p-3 rounded-bottom">
                <div class="row mb-2">
                    <div class="col-12">
                        <h5 class="card-title border-bottom pt-0 pb-3 my-0">
                            Laporan Karyawan
                        </h5>
                    </div>
                </div>

                <?php Get::view('laporan/filter', $data) ?>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-7 text-start">
                                <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Karyawan</p>
                            </div>
                            <div class="col-5">
                                <div class="text-end">
                                    <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="font-weight-bolder mb-1">
                                1
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-7 text-start">
                                <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Jabatan</p>
                            </div>
                            <div class="col-5">
                                <div class="text-end">
                                    <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="font-weight-bolder mb-1">
                                5
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-sm-0 mt-4">
                <div class="card">
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-7 text-start">
                                <p class="text-sm mb-1 text-capitalize font-weight-bold">Jam Kerja Normal</p>
                            </div>
                            <div class="col-5">
                                <div class="text-end">
                                    <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="font-weight-bolder mb-1">
                                08.00 - 17.00
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mt-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Karyawan</h6>
                            <div class="text-end">
                                <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pt-0">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered my-3"
                                style="width:100%; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Karyawan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Kerja</th>
                                        <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alpha</th> -->
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hadir</th>
                                        <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Izin</th> -->
                                        <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lembur</th> -->
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terlambat</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    function hitungLembur($jam_keluar)
                                    {
                                        $jam_normal = strtotime("15:00:00");
                                        $jam_keluar = strtotime($jam_keluar);

                                        $selisih_detik = $jam_keluar - $jam_normal;

                                        $lembur_jam = floor($selisih_detik / (60 * 60));
                                        $lembur_menit = floor(($selisih_detik % (60 * 60)) / 60);

                                        $lembur = sprintf("%02d:%02d", $lembur_jam, $lembur_menit);

                                        return $lembur;
                                    }

                                    function tambahkanDurasi($durasi1, $durasi2)
                                    {
                                        list($jam1, $menit1) = explode(':', $durasi1);
                                        list($jam2, $menit2) = explode(':', $durasi2);

                                        $menit = $menit1 + $menit2;
                                        $jam = $jam1 + $jam2;

                                        $tambah_jam = floor($menit / 60);
                                        $jam += $tambah_jam;
                                        $menit = $menit % 60;

                                        return sprintf("%02d:%02d", $jam, $menit);
                                    }

                                    $gabungkan_data = [];

                                    foreach ($data['absen'] as $row) {
                                        $karyawan_id = $row['karyawan_id'];

                                        if (!isset($gabungkan_data[$karyawan_id])) {
                                            $gabungkan_data[$karyawan_id] = [
                                                'id' => $row['karyawan_id'],
                                                'karyawan_nama' => $row['karyawan_nama'],
                                                'jam_masuk' => $row['jam_masuk'],
                                                'jam_keluar' => $row['jam_keluar'],
                                                'absen' => $row['absen'],
                                                'lembur' => "00:00",
                                                'terlambat' => $row['terlambat'],
                                                'total_jam_kerja' => 0,
                                                'alpha' => 0,
                                                'hadir' => 0,
                                                'izin' => 0
                                            ];
                                        } else {
                                            if (!empty($row['jam_masuk'])) {
                                                $gabungkan_data[$karyawan_id]['jam_masuk'] = $row['jam_masuk'];
                                            }
                                            if (!empty($row['jam_keluar'])) {
                                                $gabungkan_data[$karyawan_id]['jam_keluar'] = $row['jam_keluar'];
                                            }
                                            $gabungkan_data[$karyawan_id]['terlambat'] += $row['terlambat'];
                                        }

                                        if (!empty($row['jam_keluar']) && $row['jam_keluar'] > '15:00:00') {
                                            $waktu_lembur = hitungLembur($row['jam_keluar']);
                                            $gabungkan_data[$karyawan_id]['lembur'] = tambahkanDurasi($gabungkan_data[$karyawan_id]['lembur'], $waktu_lembur);
                                        }

                                        if (!empty($row['jam_masuk']) && !empty($row['jam_keluar'])) {
                                            $jam_masuk = new DateTime($row['jam_masuk']);
                                            $jam_keluar = new DateTime($row['jam_keluar']);
                                            $selisih = $jam_keluar->diff($jam_masuk);
                                            $total_jam_kerja = $selisih->h + ($selisih->i / 60);
                                            $gabungkan_data[$karyawan_id]['total_jam_kerja'] += round($total_jam_kerja);
                                        }

                                        switch ($row['absen']) {
                                            case 0:
                                                $gabungkan_data[$karyawan_id]['alpha']++;
                                                break;
                                            case 1:
                                                $gabungkan_data[$karyawan_id]['hadir']++;
                                                break;
                                            case 2:
                                                $gabungkan_data[$karyawan_id]['izin']++;
                                                break;
                                        }
                                    }

                                    foreach ($gabungkan_data as $data_karyawan) {
                                        ?>
                                        <tr>
                                            <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                                <?= $data_karyawan['karyawan_nama'] ?>
                                            </td>
                                            <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                                <?= $data_karyawan['total_jam_kerja'] ?> jam
                                            </td>
                                            <!-- <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3"><?= $data_karyawan['alpha'] ?> -->
                                            </td>
                                            <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3"><?= $data_karyawan['hadir'] ?> hari
                                            </td>
                                            <!-- <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3"><?= $data_karyawan['izin'] ?> -->
                                            </td>
                                            <!-- <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                                <?php
                                                list($lembur_jam, $lembur_menit) = explode(':', $data_karyawan['lembur']);
                                                echo "{$lembur_jam} jam {$lembur_menit} menit";
                                                ?>
                                            </td> -->
                                            <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                                <?= $data_karyawan['terlambat'] ?> menit
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <button type="button"
                                                    class="btn btn-icon-only btn-rounded bg-gradient-warning mb-0"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Lihat Detail Karyawan" data-id=''>
                                                    <i class="fa fa-info"></i>
                                                </button>
                                                <a href="<?= BASEURL ?>/karyawan/detail/<?= $data_karyawan['id'] ?>"
                                                    class="btn btn-icon-only btn-rounded bg-gradient-primary mb-0"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Lihat Info Karyawan">
                                                    <i class="fas fa-user" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="modalDetailKaryawan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Detail Karyawan</h3>
                    <button type="button" class="btn bg-gradient-dark mb-1" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-12 text-center align-middle">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <img src="<?= BASEURL ?>/img/bruce-mars.jpg" alt="profile_image"
                                        class="border-radius-lg shadow-sm img-fluid col-6" draggable="false">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h7 for="namakaryawan" class="col-12 ms-0 mt-2 mb-0 fw-bold">Masando Fami Ramadhan
                                    </h7>
                                    <p for="namakaryawan" class="col-12 ms-0 mt-0 text-sm">Manager</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12 col-md-12 text-lg-end text-start">
                            <div class="card border-1 shadow-none">
                                <div class="card-body pb-3">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="card border-1 shadow-none p-3 mb-2">
                                                <label class="form-label text-start" for="nama_bank">Total Jam
                                                    Kerja</label>
                                                <input type="text" class="form-control" id="jamKerja"
                                                    value="9 Jam (08.00 - 17.00)" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card border-1 shadow-none p-3 mb-2">
                                                <label class="form-label text-start" for="nama_bank">Total
                                                    Terlambat</label>
                                                <input type="text" class="form-control" id="jamKerja" value="10 kali"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="card border-1 shadow-none p-3 mb-2">
                                                <label class="form-label text-start" for="nama_bank">Total Reward yang
                                                    Didapatkan</label>
                                                <input type="text" class="form-control" id="jamKerja" value="20 reward"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card border-1 shadow-none p-3 mb-2">
                                                <label class="form-label text-start" for="nama_bank">Total Punishment
                                                    yang Didapatkan</label>
                                                <input type="text" class="form-control" id="jamKerja" value="3 kali"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-lg-12">
                                            <div class="card border-1 shadow-none p-3 mb-2">
                                                <label class="form-label text-start" for="nama_bank">Gaji Pokok</label>
                                                <input type="text" class="form-control" id="jamKerja"
                                                    value="Rp 20.000.000" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--modal end-->

    <script src="<?= BASEURL ?>/js/custom/laporan.js"></script>

    <script>
        $(document).ready(function () {
            // Get dataset
            let dataset_labels = JSON.parse(`<?= json_encode($data['labels']) ?>`);
            let dataset_pemasukan = JSON.parse(`<?= json_encode($data['dataset_pemasukan']) ?>`);
            let dataset_pengeluaran = JSON.parse(`<?= json_encode($data['dataset_pengeluaran']) ?>`);

            // Get chart element (canvas)
            var ctx = document.getElementById("chart").getContext("2d");

            // Create background gradient colors
            var gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(112,237,143,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(162,244,182,0)');
            gradientStroke1.addColorStop(0, 'rgba(178,234,192,0)');

            var gradientStroke2 = ctx.createLinearGradient(0, 230, 0, 50);
            gradientStroke2.addColorStop(1, 'rgba(246,44,44,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(249,68,68,0)');
            gradientStroke2.addColorStop(0, 'rgba(242,98,98,0)');

            // Object init
            let chart = createLineChart(ctx, {
                labels: dataset_labels,
                line: [{
                    label: "Pemasukan",
                    pointBackgroundColor: "#3ec960",
                    borderColor: "#3ec960",
                    backgroundColor: gradientStroke1,
                    data: dataset_pemasukan
                }, {
                    label: "Pengeluaran",
                    pointBackgroundColor: "#ef3f3f",
                    borderColor: "#ef3f3f",
                    backgroundColor: gradientStroke2,
                    data: dataset_pengeluaran
                }],
            }, true);

            // Chart mode swap
            $('input[name="chart-mode"]').each((i, e) => {
                e.addEventListener('change', () => {
                    if (e.checked) {
                        let val = e.value;
                        switch (val) {
                            case "bar":
                                chart.config.type = 'bar';
                                chart.data.datasets[0].backgroundColor = "#3ec960";
                                chart.data.datasets[1].backgroundColor = "#ef3f3f";
                                chart.update();
                                break;
                            case "line":
                                chart.config.type = 'line';
                                chart.data.datasets[0].backgroundColor = "transparent";
                                chart.data.datasets[1].backgroundColor = "transparent";
                                chart.update();
                                break;
                        }
                    }
                });
            });

            // Rekap table mode

            $('#rekap-option').on('change', function () {
                let opt = this.value;
                switch (opt) {
                    case "period":
                        $('.rekap-val').each((i, e) => {
                            e.innerText = "Rp " + parseFloat((parseInt(e.dataset.value) / dataset_labels.length).toFixed(2)).toLocaleString('id', { minimumFractionDigits: 2 });
                        });
                        break;
                    default:
                        $('.rekap-val').each((i, e) => {
                            e.innerText = "Rp " + (parseInt(e.dataset.value)).toLocaleString('id', { minimumFractionDigits: 2 });
                        });
                        break;
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>


    <?php Get::view('templates/footer', $data) ?>
    <!-- End of JS -->