<?php Get::view('templates/header', $data) ?>

<?php
function generateRandomLightColor($many)
{
    $colors = [];
    for ($i = 0; $i < $many; $i++) {
        // Generate light color (higher RGB values for a lighter color)
        $red = rand(200, 255);
        $green = rand(200, 255);
        $blue = rand(200, 255);
        // Convert RGB to HEX and apply opacity (e.g., 0.8)
        $color = sprintf('rgba(%d, %d, %d, 1)', $red, $green, $blue);
        array_push($colors, $color);
    }
    return $colors;
}

$pie_colors = generateRandomLightColor(count($data['produk']));
$labels = array_map('trim', array_column($data['produk'], 'nama'));
$produk_id = array_combine(array_column($data['produk'], 'id'), $labels);

?>

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
                                    Laporan Penjualan</h1>
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
                                    <li class="breadcrumb-item text-muted">Laporan Penjualan</li>
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
                            <div class="card-body d-flex p-3 position-relative">
                                <div class="w-100">
                                    <div class="row mb-2">
                                        <div class="col-7 text-start">
                                            <span class="fs-5 fw-bold pb-2">Customer</span>
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
                                        $penjualan_sekarang = count($data['penjualan_sekarang']);
                                        $penjualan_sebelumnya = count($data['penjualan_sebelumnya']);
                                        ?>
                                        <span
                                            class="fs-1 fw-bold text-gray-900 lh-1 ls-n2 me-3 mb-2"><?= $penjualan_sekarang ?></span>
                                        <?php
                                        if ($penjualan_sebelumnya > 0)
                                            $percentage = (float) number_format((($penjualan_sekarang - $penjualan_sebelumnya) / $penjualan_sebelumnya) * 100, 2);
                                        elseif ($penjualan_sekarang > 0)
                                            $percentage = 100;
                                        else
                                            $percentage = 0;
                                        ?>
                                        <span
                                            class="text-sm text-start text-<?= ($percentage < 0) ? 'danger' : 'success' ?> font-weight-bolder mt-auto mb-0">
                                            <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                                            <span class="font-weight-normal text-gray-500">sejak
                                                <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-sm-0 mt-4">
                        <div class="card">
                            <div class="card-body d-flex p-3 position-relative">
                                <div class="w-100">
                                    <div class="row mb-2">
                                        <div class="col-7 text-start">
                                            <span class="fs-5 fw-bold pb-2">Pendapatan</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="text-end">
                                                <span
                                                    class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2 me-3 mb-2">
                                            Rp <?= number_format($data['pendapatan_sekarang'], 0, '.', '.') ?>
                                        </span>
                                        <?php
                                        if ($data['pendapatan_sebelumnya'] > 0)
                                            $percentage = (float) number_format((($data['pendapatan_sekarang'] - $data['pendapatan_sebelumnya']) / $data['pendapatan_sebelumnya']) * 100, 2);
                                        elseif ($data['pendapatan_sekarang'] > 0)
                                            $percentage = 100;
                                        else
                                            $percentage = 0;
                                        ?>
                                        <span
                                            class="text-sm text-start text-<?= ($percentage < 0) ? 'danger' : 'success' ?> font-weight-bolder mt-auto mb-0">
                                            <?= ($percentage < 0) ? $percentage . "%" : "+" . $percentage . "%" ?>
                                            <span class="font-weight-normal text-gray-500">sejak
                                                <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-sm-0 mt-4">
                        <div class="card">
                            <div class="card-body d-flex p-3 position-relative">
                                <div class="w-100">
                                    <div class="row mb-2">
                                        <div class="col-7 text-start">
                                            <span class="fs-5 fw-bold pb-2">Rata-Rata Pendapatan</span>
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
                                        $avg_pendapatan_sekarang = $data['pendapatan_sekarang'] / count($data['labels']);
                                        $avg_pendapatan_sebelumnya = $data['pendapatan_sebelumnya'] / count($data['labels']);
                                        ?>
                                        <div class="d-flex align-items-center">
                                            <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2 me-2 mb-2">
                                                Rp <?= number_format($avg_pendapatan_sekarang, 0, '.', '.') ?></span>
                                            <span class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">
                                                /<?= ($data['filter']['option'] == 'tahunan') ? 'bulan' : 'hari' ?>
                                            </span>
                                        </div>
                                        <?php $diff = $avg_pendapatan_sekarang - $avg_pendapatan_sebelumnya ?>
                                        <span
                                            class="text-sm text-start text-<?= ($diff < 0) ? 'danger' : 'success' ?> font-weight-bolder mt-auto mb-0 pb-0">
                                            <?= ($diff < 0) ? "-Rp " . number_format($diff * -1, 0, '.', '.') : "+Rp " . number_format($diff, 0, '.', '.') ?>
                                            <span class="font-weight-normal text-gray-500">sejak
                                                <?= substr($data['filter']['option'], 0, -2) ?> terakhir</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card h-100">
                            <div class="card-body pb-0 p-3">
                                <div class="d-flex justify-content-between">
                                    <span class="fs-5 fw-bold pb-2">Produk</span>
                                    <div class="text-end">
                                        <span class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <span class="badge badge-light-primary text-xxs fw-medium">
                                        Total Penjualan Produk : <b id="total-penjualan-produk">0</b>
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="chart border-0">
                                        <canvas id="chart-pie-produk" class="chart-canvas border-0"
                                            style="margin: 0 auto; width: 100%; max-height: 250px;"></canvas>
                                    </div>
                                </div>
                                <div class="row my-3 px-2 justify-content-between">
                                    <?php foreach ($data['produk'] as $i => $produk): ?>
                                        <?php if (
                                            !isset($data['dataset_produk'][$produk['id']]) ||
                                            array_sum($data['dataset_produk'][$produk['id']]) == 0
                                        )
                                            continue; ?>
                                        <div class="col-6">
                                            <div class="d-flex fw-semibold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 me-3"
                                                    style="background-color: <?= $pie_colors[$i] ?>;"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4"><?= $produk['nama'] ?></div>
                                                <!--end::Label-->
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fs-5 fw-bold pb-2 mb-0">Penjualan</h6>
                                    <div class="text-end">
                                        <span class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <span class="badge badge-light-primary text-xxs fw-medium">
                                        Total Customer : <b id="total-customer">0</b>
                                    </span>
                                    <span class="badge badge-light-primary text-xxs fw-medium">
                                        Rata-Rata Customer : <b id="avg-customer">0</b>
                                    </span>
                                </div>
                                <div class="chart h-100">
                                    <canvas id="chart-line-periode" class="chart-canvas" height="300"
                                        style="display: block; box-sizing: border-box; max-height: 300px; width: 617.3px;"
                                        width="617"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fs-5 fw-bold pb-2">Penjualan Produk per Periode</h6>
                                    <div class="text-end">
                                        <span class="text-xs text-gray-500"><?= $data['filter']['date-range'] ?></span>
                                    </div>
                                </div>
                                <div class="row mb-3 overflow-hidden">
                                    <div class="row col-sm-12 col-lg-10 col-xxl-8" style="min-width: 540px;">
                                        <div class="col-5 border-end">
                                            <div class="input-group">
                                                <select class="form-control" id="select-produk-1">
                                                    <?php foreach ($data['produk'] as $produk): ?>
                                                        <option value="<?= $produk['id'] ?>"><?= $produk['nama'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="input-group-text position-static">
                                                    <i class="fa fa-chart-line text-primary"></i>
                                                </span>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6 pe-1">
                                                    <span
                                                        class="d-inline-block w-100 badge badge-light-primary text-xxs fw-medium text-start">
                                                        Total : <b id="total-produk-1">0</b>
                                                    </span>
                                                </div>
                                                <div class="col-6 ps-1">
                                                    <span
                                                        class="d-inline-block w-100 badge badge-light-primary text-xxs fw-medium text-start">
                                                        Rata-rata : <b id="avg-produk-1">0</b>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 p-0 d-flex justify-content-center align-items-center">
                                            <svg style="width: 20px !important;" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <path style="fill: #67748e;"
                                                    d="M406.6 374.6l96-96c12.5-12.5 12.5-32.8 0-45.3l-96-96c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224l-293.5 0 41.4-41.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288l293.5 0-41.4 41.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z" />
                                            </svg>
                                        </div>
                                        <div class="col-5 border-start">
                                            <div class="input-group">
                                                <select class="form-control" id="select-produk-2">
                                                    <option value="none" selected>None</option>
                                                    <?php foreach ($data['produk'] as $produk): ?>
                                                        <option value="<?= $produk['id'] ?>"><?= $produk['nama'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="input-group-text position-static">
                                                    <i class="fa fa-chart-line text-info"></i>
                                                </span>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6 pe-1">
                                                    <span
                                                        class="d-inline-block w-100 badge badge-light-primary text-xxs fw-medium text-start">
                                                        Total : <b id="total-produk-2">0</b>
                                                    </span>
                                                </div>
                                                <div class="col-6 ps-1">
                                                    <span
                                                        class="d-inline-block w-100 badge badge-light-primary text-xxs fw-medium text-start">
                                                        Rata-rata : <b id="avg-produk-2">0</b>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart">
                                    <canvas id="chart-line-produk" class="chart-canvas" height="300"
                                        style="display: block; box-sizing: border-box; height: 300px; width: 100%;"
                                        width="617"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-12">
                        <div class="card card-flush">
                            <div class="card-header pb-0">
                                <span class="card-title fs-5 fw-bold pb-2">Top 5 Produk</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-150px">
                                                    Produk</th>
                                                <th class="text-center min-w-100px ps-2">
                                                    Harga</th>
                                                <th class="text-center min-w-100px">
                                                    Pendapatan</th>
                                                <th class="text-center min-w-100px">
                                                    Presentase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($data['dataset_produk'] as $id => $dataset): ?>
                                                <?php
                                                if ($i > 5)
                                                    break;
                                                $i++;

                                                $subtotal = array_sum($dataset);
                                                $found = null;
                                                foreach ($data['produk'] as $produk) {
                                                    if ($produk['id'] == intval($id)) {
                                                        $found = $produk;
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-3 py-1">
                                                            <div>
                                                                <div class="d-flex">
                                                                    <!--begin::Thumbnail-->
                                                                    <a href="#" class="symbol symbol-50px">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(<?= BASEURL; ?>/upload/menu/<?= $found['foto'] != '' ? $found['foto'] : 'tmp.png' ?>);"></span>
                                                                    </a>
                                                                    <!--end::Thumbnail-->
                                                                    <div class="ms-5">
                                                                        <!--begin::Title-->
                                                                        <div class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1"
                                                                            data-kt-ecommerce-category-filter="category_name"
                                                                            data-order="<?= $found['nama']; ?>">
                                                                            <?= $found['nama']; ?>
                                                                        </div>
                                                                        <!--end::Title-->
                                                                        <!--begin::Description-->
                                                                        <div class="text-muted fs-7 fw-bold">
                                                                            <span class="text-primary"><?= $subtotal; ?></span> orders
                                                                        </div>
                                                                        <!--end::Description-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <p class="text-center text-sm fw-bold mb-0">Rp
                                                            <?= number_format($found['harga'], 0, '.', '.') ?>
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-sm fw-bold mb-0">Rp
                                                            <?= number_format($found['harga'] * $subtotal, 0, '.', '.') ?>
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-end">
                                                        <?php
                                                        $subtotal_sebelumnya = $data['dataset_produk_sebelumnya'][$id];
                                                        if ($subtotal_sebelumnya > 0)
                                                            $percentage = (float) number_format((($subtotal - $subtotal_sebelumnya) / $subtotal_sebelumnya) * 100, 2);
                                                        elseif ($subtotal > 0)
                                                            $percentage = 100;
                                                        else
                                                            $percentage = 0;
                                                        ?>
                                                        <div
                                                            class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                            <?php if ($percentage < 0): ?>
                                                                <p class="text-sm fw-bold mb-0">
                                                                    <?= $percentage * -1 ?>%
                                                                </p>
                                                                <i class="ki-solid ki-down text-sm ms-1 mt-1 text-danger"></i>
                                                            <?php else: ?>
                                                                <p class="text-sm fw-bold mb-0"><?= $percentage ?>%
                                                                </p>
                                                                <i class="ki-solid ki-up text-sm ms-1 mt-1 text-success"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
                        let dataset_penjualan = JSON.parse(`<?= json_encode($data['dataset_penjualan']) ?>`);
                        let dataset_produk = JSON.parse(`<?= json_encode($data['dataset_produk']) ?>`);
                        let produk_id = JSON.parse(`<?= json_encode($produk_id) ?>`);

                        // Process dataset for pie chart
                        let pie_labels = JSON.parse(`<?= json_encode($labels) ?>`);
                        let pie_colors = JSON.parse(`<?= json_encode($pie_colors) ?>`);
                        let pie_dataset = Object.values(dataset_produk).map(item => item.reduce((acc, cur) => acc + cur))

                        // Count general info for each chart
                        let totalPenjualanProduk = pie_dataset.reduce((acc, cur) => acc + cur);
                        let totalCustomer = dataset_penjualan.reduce((acc, cur) => acc + cur);
                        document.getElementById('total-penjualan-produk').innerText = totalPenjualanProduk;
                        document.getElementById('total-customer').innerText = totalCustomer;
                        document.getElementById('avg-customer').innerText = (totalCustomer / dataset_penjualan.length).toFixed(2);

                        // Get chart element (canvas)
                        var ctx1 = document.getElementById("chart-pie-produk").getContext("2d");
                        var ctx2 = document.getElementById("chart-line-periode").getContext("2d");
                        var ctx3 = document.getElementById("chart-line-produk").getContext("2d");
                        var gradientStroke_2 = ctx2.createLinearGradient(0, 230, 0, 50);
                        gradientStroke_2.addColorStop(1, 'rgba(20,23,39,0.2)');
                        gradientStroke_2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                        gradientStroke_2.addColorStop(0, 'rgba(20,23,39,0)');

                        // Object init
                        let chart_pie_produk = createPieChart(ctx1, {
                            labels: pie_labels,
                            colors: pie_colors,
                            data: pie_dataset,
                        });

                        let chart_line_periode = createLineChart(ctx2, {
                            labels: dataset_labels,
                            line: [{
                                pointBackgroundColor: "#3A416F",
                                borderColor: "#3A416F",
                                backgroundColor: gradientStroke_2,
                                data: dataset_penjualan,
                            }],
                        });

                        let chart_line_produk = createLineChart(ctx3, {
                            labels: dataset_labels,
                            line: [{
                                label: produk_id[$('#select-produk-1').val()],
                                pointBackgroundColor: "#cb0c9f",
                                borderColor: "#cb0c9f",
                                backgroundColor: "transparent",
                                data: dataset_produk[$('#select-produk-1').val()]
                            }],
                        });

                        // Select input produk event handler
                        let totalProduk1 = document.getElementById('total-produk-1');
                        let avgProduk1 = document.getElementById('avg-produk-1');
                        let totalProduk2 = document.getElementById('total-produk-2');
                        let avgProduk2 = document.getElementById('avg-produk-2');

                        let dataset = dataset_produk[document.getElementById('select-produk-1').value];
                        let total = dataset.reduce((acc, cur) => acc + cur);
                        totalProduk1.innerText = total;
                        avgProduk1.innerText = (total / dataset.length).toFixed(2);

                        $('#select-produk-1').on('change', function () {
                            let dataset = dataset_produk[this.value];
                            let total = dataset.reduce((acc, cur) => acc + cur);

                            totalProduk1.innerText = total;
                            avgProduk1.innerText = (total / dataset.length).toFixed(2);

                            chart_line_produk.data.datasets[0].data = dataset;
                            chart_line_produk.data.datasets[0].label = produk_id[this.value];
                            chart_line_produk.update();
                        });

                        $('#select-produk-2').on('change', function () {
                            let id = this.value;
                            if (id == 'none') {
                                chart_line_produk.data.datasets.splice(1, 1);
                                totalProduk2.innerText = 0;
                                avgProduk2.innerText = 0;
                            } else {
                                let dataset = dataset_produk[id];
                                let total = dataset.reduce((acc, cur) => acc + cur);

                                totalProduk2.innerText = total;
                                avgProduk2.innerText = (total / dataset.length).toFixed(2);

                                chart_line_produk.data.datasets[1] = {
                                    label: produk_id[this.value],
                                    data: dataset_produk[this.value],
                                    fill: true,
                                    tension: 0.4,
                                    pointRadius: 2,
                                    borderWidth: 3,
                                    maxBarThickness: 6,
                                    pointBackgroundColor: "#17c1e8",
                                    borderColor: '#17c1e8',
                                    backgroundColor: "transparent",
                                };
                            }
                            chart_line_produk.update();
                        });

                    });
                </script>


                <?php Get::view('templates/footer', $data) ?>