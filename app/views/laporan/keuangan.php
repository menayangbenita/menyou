<?php Get::view('templates/header', $data) ?>

<style>
    table tr:not(.no-dash),
    table tr:not(.no-dash) td {
        border-style: dashed !important;
    }
</style>

<div class="card mb-4">
    <div class="card-body p-3 rounded-bottom">
        <div class="row mb-2">
            <div class="col-12">
                <h5 class="card-title border-bottom pt-0 pb-3 my-0">
                    Laporan Keuangan
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
                        <p class="text-sm mb-1 text-capitalize font-weight-bold">Pemasukan</p>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $pemasukan_sekarang =  array_sum($data['dataset_pemasukan']);
                    $pemasukan_sebelumnya =  array_sum($data['dataset_pemasukan_sebelumnya']);
                    ?>
                    <h5 class="font-weight-bolder mb-1">
                        Rp <?= number_format($pemasukan_sekarang, 0, '.', '.') ?>
                    </h5>
                    <?php
                    if ($pemasukan_sebelumnya > 0)
                        $percentage = (float)number_format((($pemasukan_sekarang - $pemasukan_sebelumnya) / $pemasukan_sebelumnya) * 100, 2);
                    elseif ($pemasukan_sekarang > 0)
                        $percentage = 100;
                    else
                        $percentage = 0;
                    ?>
                    <span class="text-sm text-start text-<?= ($percentage < 0) ? 'warning' : 'success' ?> font-weight-bolder mt-auto mb-0">
                        <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                        <span class="font-weight-normal text-secondary">sejak <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-sm-0 mt-4">
        <div class="card">
            <div class="card-body p-3 position-relative">
                <div class="row">
                    <div class="col-7 text-start">
                        <p class="text-sm mb-1 text-capitalize font-weight-bold">Pengeluaran</p>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $pengeluaran_sekarang =  array_sum($data['dataset_pengeluaran']);
                    $pengeluaran_sebelumnya =  array_sum($data['dataset_pengeluaran_sebelumnya']);
                    ?>
                    <h5 class="font-weight-bolder mb-1">
                        Rp <?= number_format($pengeluaran_sekarang, 0, '.', '.') ?>
                    </h5>
                    <?php
                    if ($pengeluaran_sebelumnya > 0)
                        $percentage = (float)number_format((($pengeluaran_sekarang - $pengeluaran_sebelumnya) / $pengeluaran_sebelumnya) * 100, 2);
                    elseif ($pengeluaran_sekarang > 0)
                        $percentage = 100;
                    else
                        $percentage = 0;
                    ?>
                    <span class="text-sm text-start text-<?= ($percentage < 0) ? 'success' : 'warning' ?> font-weight-bolder mt-auto mb-0">
                        <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                        <span class="font-weight-normal text-secondary">sejak <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 mt-sm-0 mt-4">
        <div class="card">
            <div class="card-body p-3 position-relative">
                <div class="row">
                    <div class="col-7 text-start">
                        <p class="text-sm mb-1 text-capitalize font-weight-bold">Laba Perusahaan</p>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $laba_sekarang = $pemasukan_sekarang - $pengeluaran_sekarang;
                    $laba_sebelumnya = $pemasukan_sebelumnya - $pengeluaran_sebelumnya;
                    ?>
                    <h5 class="font-weight-bolder mb-1">
                        Rp <?= number_format($laba_sekarang, 0, '.', '.') ?>
                    </h5>
                    <?php
                    if ($laba_sebelumnya > 0)
                        $percentage = (float)number_format((($laba_sekarang - $laba_sebelumnya) / $laba_sebelumnya) * 100, 2);
                    elseif ($laba_sekarang > 0)
                        $percentage = 100;
                    else
                        $percentage = 0;
                    ?>
                    <span class="text-sm text-start text-<?= ($percentage < 0) ? 'danger' : 'success' ?> font-weight-bolder mt-auto mb-0 pb-0">
                        <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                        <span class="font-weight-normal text-secondary">sejak <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-6 mt-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">Analitik Keuangan</h6>
                    <div class="text-end">
                        <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                    </div>
                </div>
                <div class="row justify-content-between align-items-start my-2">
                    <div class="col-lg-8">
                        <span class="badge bg-success text-xxs text-white fw-bold">
                            Rata-Rata Pemasukan: <b id="avg-pemasukan">Rp <?= number_format($pemasukan_sekarang / count($data['labels']), 0, '.', '.') ?></b>
                        </span>
                        <span class="badge bg-danger text-xxs text-white fw-bold">
                            Rata-Rata Pengeluaran : <b id="avg-pengeluaran">Rp <?= number_format($pengeluaran_sekarang / count($data['labels']), 0, '.', '.') ?></b>
                        </span>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-end align-items-end gap-2">
                        <input type="radio" class="btn-check" name="chart-mode" value="bar" id="chart-bar">
                        <label class="btn btn-outline-primary rounded-2 p-2 m-0 fa fa-chart-bar" for="chart-bar"></label>

                        <input type="radio" class="btn-check" name="chart-mode" value="line" id="chart-line" checked>
                        <label class="btn btn-outline-primary rounded-2 p-2 m-0 fa fa-chart-line" for="chart-line"></label>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="chart h-100">
                    <canvas id="chart" class="chart-canvas" height="300" style="display: block; box-sizing: border-box; height: 300px; width: 617.3px;" width="617"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mt-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">Rekapitulasi</h6>
                    <div class="text-end">
                        <span class="text-xs text-secondary"><?= $data['filter']['date-range'] ?></span>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0 p-3">
                <div class="row mb-4">
                    <div class="col-7 d-flex align-items-center">
                        <label class="form-label m-0">Tampilkan data berdasarkan :</label>
                    </div>
                    <div class="col-5 ps-0">
                        <select id="rekap-option" class="form-control">
                            <option value="all">Total Keseluruhan</option>
                            <option value="period">Rata-rata/Periode</option>
                        </select>
                    </div>
                </div>
                <table class="table table-borderless table-md w-100 text-sm" style="border-collapse: collapse; table-layout: fixed;">
                    <tbody class="text-sm text-secondary">
                        <tr class="border-2">
                            <td class="fw-bolder">Pemasukan</td>
                            <td data-value="<?= $pemasukan_sekarang ?>" class="text-end rekap-val">Rp <?= number_format($pemasukan_sekarang, 2, ',', '.') ?></td>
                        </tr>
                        <tr class="border-2">
                            <td class="fw-bolder">Pengeluaran</td>
                            <td data-value="<?= $pengeluaran_sekarang ?>" class="text-end rekap-val">Rp <?= number_format($pengeluaran_sekarang, 2, ',', '.') ?></td>
                        </tr>
                        <tr class="border-2 fw-bolder">
                            <td>Laba Perusahaan</td>
                            <td data-value="<?= $laba_sekarang ?>" class="text-end text-warning rekap-val">Rp <?= number_format($laba_sekarang, 2, ',', '.') ?></td>
                        </tr>
                        <tr class="border-2 bg-light no-dash">
                            <td class="fw-bold">Potongan Pajak <b>(<?= $data['pajak'] ?>%)</b></td>
                            <?php $pajak = $laba_sekarang * ($data['pajak'] / 100) ?>
                            <td data-value="<?= $pajak ?>" class="text-end fw-bold text-danger rekap-val">Rp <?= number_format($pajak, 2, ',', '.') ?></td>
                        </tr>
                        <tr class="border-2 fw-bolder">
                            <td>Laba Bersih</td>
                            <td data-value="<?= $laba_sekarang - $pajak ?>" class="text-end text-success rekap-val">Rp <?= number_format($laba_sekarang - $pajak, 2, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-3 border-top d-flex align-items-center">
                <div class="w-90">
                    <?php 
                        $percentage_penjualan = ($pemasukan_sekarang > 0) ? 
                            number_format(($data['pemasukan_penjualan'] / $pemasukan_sekarang) * 100, 2) : 0;
                        $percentage_shipment = ($pengeluaran_sekarang > 0) ? 
                            number_format(($data['pengeluaran_shipment'] / $pengeluaran_sekarang) * 100, 2) : 0;
                    ?>
                    <p class="text-sm m-0">
                        Sekitar <b class="text-success"><?= $percentage_penjualan ?>%</b> pemasukan berasal dari <b>penjualan</b>.
                        Sedangkan <b class="text-warning"><?= $percentage_shipment ?>%</b> pengeluaran berasal dari biaya <b>shipment</b>.
                    </p>
                </div>
                <div class="w-10 d-flex justify-content-end align-items-center">
                    <a href="<?= BASEURL ?>/finance" class="btn btn-icon-only btn-rounded btn-outline-primary mb-0 btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat Rekap Finance">
                        <i class="fas fa-info" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/custom/laporan.js"></script>

<script>
    $(document).ready(function() {
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
                            chart.data.datasets[0].backgroundColor = gradientStroke1;
                            chart.data.datasets[1].backgroundColor = gradientStroke2;
                            chart.update();
                            break;
                    }
                }
            });
        });

        // Rekap table mode
        $('#rekap-option').on('change', function() {
            let opt = this.value;
            switch (opt) {
                case "period":
                    $('.rekap-val').each((i, e) => {
                        e.innerText = "Rp " + parseFloat((parseInt(e.dataset.value) / dataset_labels.length).toFixed(2)).toLocaleString('id', {minimumFractionDigits: 2});
                    });
                    break;
                default:
                    $('.rekap-val').each((i, e) => {
                        e.innerText = "Rp " + (parseInt(e.dataset.value)).toLocaleString('id', {minimumFractionDigits: 2});
                    });
                    break;
            }
        });
    });
</script>

<?php Get::view('templates/footer', $data) ?>