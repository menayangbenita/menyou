<?php Get::view('templates/header', $data) ?>

<?php
$range = (strtotime($data['filter']['to']) - strtotime($data['filter']['from'])) / (60 * 60 * 24);
?>

<style>
    .fixed-column {
        position: -webkit-sticky;
        position: sticky;
        left: 0;
        background-color: white !important;
        z-index: 1;
    }


    .table-responsive::-webkit-scrollbar-track {
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .table-responsive::-webkit-scrollbar {
        height: 8px;
        background-color: #F5F5F5;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #9e9a9a9a;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        border-radius: 10px;
        background-color: #9e9a9a;
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
                                    <i class="ki-solid ki-parcel text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Rekap Stok</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Stok</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Rekap Stok</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                    <form class="d-flex align-items-center gap-2 gap-lg-3" method="post">
                        <!--begin::Filter-->
                        <div class="w-150px">
                            <input type="date" name="filter[]" value="<?= $data['filter']['from'] ?>"
                                class="datepicker form-control form-control-solid" id="from" placeholder="From" />
                        </div>
                        <div class="w-150px">
                            <input type="date" name="filter[]" value="<?= $data['filter']['to'] ?>"
                                class="datepicker form-control form-control-solid" id="to" placeholder="To" />
                        </div>
                        <div class="w-125px">
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                        </div>
                        <!--end::Filter-->
                    </form>
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
                <div class="card card-flush">
                    <div class="card-header align-items-center pt-5 gap-2 gap-md-5" method="post">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-2 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-order-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Barang" />
                            </div>
                            <!--end::Search-->
                            <!--begin::Export buttons-->
                            <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Export dropdown-->
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-outline ki-exit-up fs-2"></i>Ekspor Laporan</button>
                            <!--begin::Menu-->
                            <div id="kt_ecommerce_report_views_export_menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-ecommerce-export="copy">Copy to
                                        clipboard</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-ecommerce-export="excel">Export as
                                        Excel</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-ecommerce-export="csv">Export as
                                        CSV</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-ecommerce-export="pdf">Export as
                                        PDF</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <!--end::Card header-->
                        <div id="dataDetailAbsen">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-stok">
                                    <thead>
                                        <tr
                                            class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0 align-middle">
                                            <th rowspan="2" class="text-start min-w-200px fixed-column">
                                                Nama</th>
                                            <th rowspan="2" class="min-w-100px">
                                                Jenis</th>
                                            <th rowspan="2" class="text-center min-w-150px">
                                                Stok Saat Ini</th>
                                            <?php for ($i = 0; $i <= $range; $i++): ?>
                                                <th colspan="3" class="text-center min-w-150px">
                                                    <?= date('d/m/Y', strtotime($data['filter']['from']) + ($i * 60 * 60 * 24)) ?>
                                                </th>
                                            <?php endfor; ?>
                                        </tr>
                                        <tr class="text-center text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <?php for ($i = 0; $i <= $range; $i++): ?>
                                                <th class="text-center min-w-100px">
                                                    Masuk</th>
                                                <th class="text-center min-w-100px">
                                                    Stok</th>
                                                <th class="text-center min-w-100px">
                                                    Keluar</th>
                                            <?php endfor; ?>
                                        </tr>

                                    </thead>

                                    <tbody class="fw-semibold text-gray-600">
                                        <?php foreach ($data['barang'] as $barang): ?>
                                            <?php $lastVal = 0; ?>
                                            <tr align="center" class="text-gray-600">
                                                <td class="text-start fixed-column">
                                                    <?= $barang['nama'] ?>
                                                </td>
                                                <td class="text-start">
                                                    <?= ucfirst($barang['jenis']) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $barang['stok'] ?>
                                                </td>
                                                <?php
                                                $riwayat = json_decode($barang['riwayat'], true);

                                                // Add index for each item
                                                $i = 0;
                                                $found = false;
                                                foreach ($riwayat as $key => $val) {
                                                    $riwayat[$key]['index'] = $i;
                                                    $i++;
                                                }

                                                // Get first value of the range
                                                for ($i = 0; $i <= $range; $i++) {
                                                    $key = date('Y-m-d', strtotime($data['filter']['from']) + ($i * 60 * 60 * 24));
                                                    if (array_key_exists($key, $riwayat)) {
                                                        $found = true;
                                                        foreach ($riwayat as $val) {
                                                            if (($riwayat[$key]['index'] - 1) == $val['index']) {
                                                                $lastVal = $val['stok'];
                                                                break;
                                                            }
                                                        }
                                                        break;
                                                    }
                                                }

                                                // If not, set the lastVal to latest stok value if start day was greater than the first date of data.
                                                if (!$found && !empty($riwayat)) {
                                                    $first_date = array_keys($riwayat)[0];
                                                    if (strtotime($data['filter']['from']) >= strtotime($first_date)) {
                                                        $lastVal = $barang['stok'];
                                                    }
                                                }
                                                ?>
                                                <?php for ($i = 0; $i <= $range; $i++): ?>
                                                    <?php $key = date('Y-m-d', strtotime($data['filter']['from']) + ($i * 60 * 60 * 24)) ?>
                                                    <?php if (array_key_exists($key, $riwayat)): ?>
                                                        <td
                                                            class="text-center<?= (floatval($riwayat[$key]['masuk']) > 0) ? ' text-success' : '' ?>">
                                                            <?= $riwayat[$key]['masuk'] ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $riwayat[$key]['stok'] ?>
                                                        </td>
                                                        <td
                                                            class="text-center<?= (floatval($riwayat[$key]['keluar']) > 0) ? ' text-danger' : '' ?>">
                                                            <?= $riwayat[$key]['keluar'] ?>
                                                        </td>
                                                        <?php $lastVal = $riwayat[$key]['stok'] ?>
                                                    <?php else: ?>
                                                        <td class="text-center">0</td>
                                                        <td class="text-center">
                                                            <?= $lastVal ?>
                                                        </td>
                                                        <td class="text-center">0</td>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Filter -->

            <!-- Tabel -->

            <!-- End Tabel -->

            <!--begin::Javascript-->
            <script>var hostUrl = "assets/";</script>
            <!--begin::Global Javascript Bundle(mandatory for all pages)-->
            <script src="<?= BASEURL ?>/plugins/global/plugins.bundle.js"></script>
            <script src="<?= BASEURL ?>/js/scripts.bundle.js"></script>
            <!--end::Global Javascript Bundle-->
            <!--begin::Vendors Javascript(used for this page only)-->
            <script src="<?= BASEURL ?>/plugins/custom/datatables/datatables.bundle.js"></script>
            <!--end::Vendors Javascript-->
            <!--end::Javascript-->

            <script src="<?= BASEURL ?>/js/datatables.js"></script>
            <script src="<?= BASEURL ?>/js/custom/stok.js"></script>

            <?php Get::view('templates/footer', $data) ?>