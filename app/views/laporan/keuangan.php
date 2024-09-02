<?php Get::view('templates/header', $data) ?>

<style>
    table tr:not(.no-dash),
    table tr:not(.no-dash) td {
        border-style: dashed !important;
    }
</style>

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="symbol symbol-55px me-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-solid ki-document text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Laporan Keuangan</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Laporan</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Laporan Keuangan</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Products-->

                <?php Get::view('laporan/filter', $data) ?>

                <div class="row mb-8">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-7 text-start">
                                        <span class="fs-5 fw-bold pb-2">Pemasukan</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-end">
                                            <span
                                                class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    $pemasukan_sekarang = array_sum($data['dataset_pemasukan']);
                                    $pemasukan_sebelumnya = array_sum($data['dataset_pemasukan_sebelumnya']);
                                    ?>
                                    <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2 me-3 mb-2">
                                        Rp <?= number_format($pemasukan_sekarang, 0, '.', '.') ?>
                                    </span>
                                    <?php
                                    if ($pemasukan_sebelumnya > 0)
                                        $percentage = (float) number_format((($pemasukan_sekarang - $pemasukan_sebelumnya) / $pemasukan_sebelumnya) * 100, 2);
                                    elseif ($pemasukan_sekarang > 0)
                                        $percentage = 100;
                                    else
                                        $percentage = 0;
                                    ?>
                                    <span
                                        class="text-sm text-start text-<?= ($percentage < 0) ? 'warning' : 'success' ?> font-weight-bolder mt-auto mb-0">
                                        <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                                        <span class="font-weight-normal text-gray-500">sejak
                                            <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
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
                                        <span class="fs-5 fw-bold pb-2">Pengeluaran</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-end">
                                            <span
                                                class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    $pengeluaran_sekarang = array_sum($data['dataset_pengeluaran']);
                                    $pengeluaran_sebelumnya = array_sum($data['dataset_pengeluaran_sebelumnya']);
                                    ?>
                                    <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2 me-3 mb-2">
                                        Rp <?= number_format($pengeluaran_sekarang, 0, '.', '.') ?>
                                    </span>
                                    <?php
                                    if ($pengeluaran_sebelumnya > 0)
                                        $percentage = (float) number_format((($pengeluaran_sekarang - $pengeluaran_sebelumnya) / $pengeluaran_sebelumnya) * 100, 2);
                                    elseif ($pengeluaran_sekarang > 0)
                                        $percentage = 100;
                                    else
                                        $percentage = 0;
                                    ?>
                                    <span
                                        class="text-sm text-start text-<?= ($percentage < 0) ? 'success' : 'warning' ?> font-weight-bolder mt-auto mb-0">
                                        <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                                        <span class="font-weight-normal text-gray-500">sejak
                                            <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
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
                                        <span class="fs-5 fw-bold pb-2">Laba Perusahaan</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-end">
                                            <span
                                                class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    $laba_sekarang = $pemasukan_sekarang - $pengeluaran_sekarang;
                                    $laba_sebelumnya = $pemasukan_sebelumnya - $pengeluaran_sebelumnya;
                                    ?>
                                    <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2 me-3 mb-2">
                                        Rp <?= number_format($laba_sekarang, 0, '.', '.') ?>
                                    </span>
                                    <?php
                                    if ($laba_sebelumnya > 0)
                                        $percentage = (float) number_format((($laba_sekarang - $laba_sebelumnya) / $laba_sebelumnya) * 100, 2);
                                    elseif ($laba_sekarang > 0)
                                        $percentage = 100;
                                    else
                                        $percentage = 0;
                                    ?>
                                    <span
                                        class="text-sm text-start text-<?= ($percentage < 0) ? 'danger' : 'success' ?> font-weight-bolder mt-auto mb-0 pb-0">
                                        <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                                        <span class="font-weight-normal text-gray-500">sejak
                                            <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between">
                                    <span class="fs-5 fw-bold pb-2">Analitik Keuangan</span>
                                    <div class="text-end">
                                        <span class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-start my-2">
                                    <div class="col-lg-8">
                                        <span class="badge bg-success text-xxs text-white fw-bold">
                                            Rata-Rata Pemasukan: <b id="avg-pemasukan">Rp
                                                <?= number_format($pemasukan_sekarang / count($data['labels']), 0, '.', '.') ?></b>
                                        </span>
                                        <span class="badge bg-danger text-xxs text-white fw-bold">
                                            Rata-Rata Pengeluaran : <b id="avg-pengeluaran">Rp
                                                <?= number_format($pengeluaran_sekarang / count($data['labels']), 0, '.', '.') ?></b>
                                        </span>
                                    </div>
                                    <div class="col-lg-4 d-flex justify-content-end align-items-end gap-2">
                                        <input type="radio" class="btn-check" name="chart-mode" value="bar"
                                            id="chart-bar">
                                        <label class="btn btn-outline btn-outline-primary rounded-2 p-2 m-0 ki-solid ki-chart-simple-2"
                                            for="chart-bar"></label>

                                        <input type="radio" class="btn-check" name="chart-mode" value="line"
                                            id="chart-line" checked>
                                        <label class="btn btn-outline btn-outline-primary rounded-2 p-2 m-0 ki-solid ki-chart-line-up"
                                            for="chart-line"></label>
                                    </div>
                                </div>
                                <div class="chart h-100">
                                    <canvas id="chart" class="chart-canvas" height="300"
                                        style="display: block; box-sizing: border-box; max-height: 300px; width: 617.3px;"
                                        width="617"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-body pb-0 p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fs-5 fw-bold pb-2">Rekapitulasi</h6>
                                    <div class="text-end">
                                        <span class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">Tampilkan data berdasarkan:</label>
                                    </div>
                                    <div class="ps-0">
                                        <select id="rekap-option" class="form-select form-select-solid">
                                            <option value="all">Total Keseluruhan</option>
                                            <option value="period">Rata-rata/Periode</option>
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-borderless table-md w-100 text-sm"
                                    style="border-collapse: collapse; table-layout: fixed;">
                                    <tbody class="text-sm text-secondary align-middle">
                                        <tr class="border-2 text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <td class="fw-bolder ps-2">Pemasukan</td>
                                            <td data-value="<?= $pemasukan_sekarang ?>" class="text-end rekap-val pe-2">Rp
                                                <?= number_format($pemasukan_sekarang, 2, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr class="border-2 text-gray-600 fw-bold fs-7 text-uppercase gs-0">
                                            <td class="fw-bolder ps-2">Pengeluaran</td>
                                            <td data-value="<?= $pengeluaran_sekarang ?>" class="text-end rekap-val pe-2">Rp
                                                <?= number_format($pengeluaran_sekarang, 2, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr class="border-2 text-gray-600 fw-bold fs-7 text-uppercase gs-0 fw-bolder">
                                            <td class="ps-2">Laba Perusahaan</td>
                                            <td data-value="<?= $laba_sekarang ?>"
                                                class="text-end text-warning rekap-val pe-2">Rp
                                                <?= number_format($laba_sekarang, 2, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr class="border-2 text-gray-600 fw-bold fs-7 text-uppercase gs-0 bg-light no-dash">
                                            <td class="fw-bold ps-2">Potongan Pajak <b>(<?= $data['pajak'] ?>%)</b></td>
                                            <?php $pajak = $laba_sekarang * ($data['pajak'] / 100) ?>
                                            <td data-value="<?= $pajak ?>"
                                                class="text-end fw-bold text-danger rekap-val pe-2">Rp
                                                <?= number_format($pajak, 2, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr class="border-2 text-gray-600 fw-bold fs-7 text-uppercase gs-0 fw-bolder">
                                            <td class="ps-2">Laba Bersih</td>
                                            <td data-value="<?= $laba_sekarang - $pajak ?>"
                                                class="text-end text-success rekap-val pe-2">Rp
                                                <?= number_format($laba_sekarang - $pajak, 2, ',', '.') ?>
                                            </td>
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
                                    <p class="text-sm m-0 me-1">
                                        Sekitar <b class="text-success"><?= $percentage_penjualan ?>%</b> pemasukan
                                        berasal dari <b>penjualan</b>.
                                        Sedangkan <b class="text-warning"><?= $percentage_shipment ?>%</b> pengeluaran
                                        berasal dari biaya <b>shipment</b>.
                                    </p>
                                </div>
                                <div class="w-10 d-flex justify-content-end align-items-center">
                                    <a href="<?= BASEURL ?>/finance"
                                        class="btn btn-icon rounded-pill btn-outline btn-outline-primary mb-0 btn-sm d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat Rekap Finance">
                                        <i class="ki-outline ki-information-2" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            chart.data.datasets[0].backgroundColor = gradientStroke1;
                                            chart.data.datasets[1].backgroundColor = gradientStroke2;
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

                <?php Get::view('templates/footer', $data) ?>