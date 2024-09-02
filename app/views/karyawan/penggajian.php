<?php Get::view('templates/header', $data) ?>

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
                                    <i class="ki-solid ki-profile-user text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Penggajian</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Human Resource</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Penggajian</li>
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
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-2 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-order-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Karyawan" />
                            </div>
                            <!--end::Search-->
                            <!--begin::Export buttons-->
                            <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Daterangepicker-->
                            <input class="form-control form-control-solid w-100 mw-250px"
                                placeholder="Pilih rentang tanggal" id="kt_ecommerce_report_views_daterangepicker" />
                            <!--end::Daterangepicker-->
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
                            <!--end::Menu-->
                            <!--end::Export dropdown-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                            id="kt_ecommerce_report_views_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th rowspan="2" class="w-10px pe-2 align-middle">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th rowspan="2" class="min-w-125px align-middle">Nomor Pegawai</th>
                                    <th rowspan="2" class="min-w-200px align-middle">Nama</th>
                                    <th rowspan="2" class="min-w-125px align-middle">Jabatan</th>
                                    <th colspan="3" class="text-center min-w-100px">Gaji</th>
                                    <th rowspan="2" class="text-start min-w-175px align-middle">Gaji Total</th>
                                    <th rowspan="2" class="text-end min-w-70px align-middle">Aksi</th>
                                </tr>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center min-w-175px">Gaji Pokok</th>
                                    <th class="text-center min-w-175px">Total Bonus</th>
                                    <th class="text-center min-w-175px">Total Potongan</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['karyawan'] as $karyawan): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $reward_punishment['id']; ?>" />
                                            </div>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span><?= $karyawan['nik']; ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span><?= $karyawan['nama']; ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span><?= $karyawan['posisi']; ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span>Rp <?= number_format($karyawan['gaji_pokok'], 0, '', '.'); ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span>Rp <?= number_format($karyawan['total_reward'], 0, '', '.'); ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span>Rp <?= number_format($karyawan['total_punishment'], 0, '', '.'); ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span>Rp <?= (number_format($karyawan['gaji_total'], 0, '', '.')); ?></span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="<?= BASEURL ?>/penggajian/print/<?= $data['filter']['bulan'] ?>/<?= $data['filter']['tahun'] ?>/<?= $karyawan['uuid'] ?>"
                                                        class="menu-link px-3" data-id="<?= $menu['id']; ?>">Print</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= BASEURL ?>/plugins/global/plugins.bundle.js"></script>
<script src="<?= BASEURL ?>/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="<?= BASEURL ?>/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="<?= BASEURL ?>/js/custom/apps/ecommerce/reports/views/views.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->

<?php Get::view('templates/footer', $data) ?>