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
        /* Tambahkan z-index agar elemen sticky berada di atas elemen lain */
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
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal"
                            data-bs-target="#formModal">Tambah Stok</a>
                    </div>
                    <!--end::Actions-->
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Stok" />
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
                            <!--begin::Filter-->
                            <div class="w-150px">
                                <!--begin::Select2-->
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="Jenis"
                                    data-kt-ecommerce-order-filter="rating">
                                    <option></option>
                                    <option value="all">Semua</option>
                                    <option value="Bahan">Bahan</option>
                                    <option value="Kemasan">Kemasan</option>
                                </select>
                                <!--end::Select2-->
                            </div>
                            <!--end::Filter-->
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
                                    <th rowspan="2" class="min-w-150px align-middle">Barang</th>
                                    <th rowspan="2" class="text-center min-w-75px align-middle">Jenis</th>
                                    <th rowspan="2" class="text-center min-w-75px align-middle">Satuan</th>
                                    <th rowspan="2" class="text-center min-w-100px align-middle">Stok Saat Ini</th>
                                    <?php for ($i = 0; $i <= $range; $i++): ?>
                                        <th colspan="3" class="text-center min-w-100px">
                                            <?= date('d/m/Y', strtotime($data['filter']['from']) + ($i * 60 * 60 * 24)) ?>
                                        </th>
                                    <?php endfor; ?>
                                    <th rowspan="2" class="text-end min-w-70px align-middle">Aksi</th>
                                </tr>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <?php for ($i = 0; $i <= $range; $i++): ?>
                                        <th class="text-center min-w-100px">Masuk</th>
                                        <th class="text-center min-w-100px">Stok</th>
                                        <th class="text-center min-w-100px">Keluar</th>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['barang'] as $barang): ?>
                                    <?php $lastVal = 0; ?>
                                    <tr>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $barang['nama'] ?></span>
                                        </td>
                                        <td class="text-center pe-0" data-order="<?= ucfirst($barang['jenis']) ?>"
                                            data-filter="<?= ucfirst($barang['jenis']) ?>">
                                            <span><?= ucfirst($barang['jenis']) ?></span>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span><?= $barang['satuan'] ?></span>
                                        </td>
                                        <td class="text-center pe-0"><?= $barang['stok'] ?></td>
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
                                                    class="text-center pe-0<?= (floatval($riwayat[$key]['masuk']) > 0) ? ' text-success' : '' ?>">
                                                    <?= $riwayat[$key]['masuk'] ?>
                                                </td>
                                                <td class="text-center pe-0"><?= $riwayat[$key]['stok'] ?></td>
                                                <td
                                                    class="text-center pe-0<?= (floatval($riwayat[$key]['keluar']) > 0) ? ' text-danger' : '' ?>">
                                                    <?= $riwayat[$key]['keluar'] ?>
                                                </td>
                                                <?php $lastVal = $riwayat[$key]['stok'] ?>
                                            <?php else: ?>
                                                <td class="text-center pe-0">0</td>
                                                <td class="text-center pe-0"><?= $lastVal ?></td>
                                                <td class="text-center pe-0">0</td>
                                            <?php endif; ?>
                                        <?php endfor; ?>
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
                                                    <a href="<?= BASEURL; ?>/menu/update/<?= $menu['id'] ?>"
                                                        class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                        data-bs-target="#formModal" data-id="<?= $menu['id']; ?>">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-id="<?= $menu['id']; ?>"
                                                        data-kt-ecommerce-product-filter="delete_row">Hapus</a>
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

    <!-- Modal -->
    <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="mb-13 mt-0 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3" id="modalLabel">Tambah Stok</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <form action="<?= BASEURL; ?>/stok/update" method="post">
                        <?= csrf() ?>
                        <input type="hidden" name="id" id="id">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label for="nama" class="required fs-6 fw-semibold mb-2">Nama</label>
                            <input type="text" class="form-control form-control-solid" name="nama" id="nama"
                                placeholder="Nama Barang" autocomplete="off" required>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label for="nama" class="required fs-6 fw-semibold mb-2">Jenis</label>
                            <select class="form-select form-select-solid" name="jenis" id="jenis" required>
                                <option value="bahan">Bahan</option>
                                <option value="kemasan">Kemasan</option>
                            </select>
                        </div>
                        <div class="row g-9 mb-15">
                            <div class="col-md-6 fv-row" id="stok-awal">
                                <label for="stok" class="required fs-6 fw-semibold mb-2">Stok Awal</label>
                                <input type="number" class="form-control form-control-solid" name="stok" id="stok"
                                    value="0" required>
                            </div>
                            <div class="col-md-6 fv-row flex-grow-1">
                                <label for="satuan" class="required fs-6 fw-semibold mb-2">Satuan</label>
                                <select class="form-select form-select-solid" name="satuan" required>
                                    <option value="Kg" selected>Kg</option>
                                    <option value="Ons">Ons</option>
                                    <option value="Box">Box</option>
                                    <option value="Pack">Pack</option>
                                    <option value="Liter">Liter</option>
                                    <option value="Lusin">Lusin</option>
                                    <option value="Gros">Gros</option>
                                    <option value="Rim">Rim</option>
                                    <option value="Kodi">Kodi</option>
                                    <option value="pcs">pcs</option>
                                    <option value="meter">meter</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        <script>
            $(function () {
                const BASEURL = window.location.href;

                $(".tombolTambahData").click(function () {
                    $('#modalLabel').html('Tambah Stok');
                    $("#formModal form").attr("action", `${BASEURL}/insert`);
                    $("#formModal form")[0].reset();
                    $('#stok-awal').removeClass('d-none');
                });

                $(".tampilModalUbah").click(function () {
                    $('#modalLabel').html('Ubah Data Stok');
                    $("#formModal form").attr("action", `${BASEURL}/update`);
                    $('#stok-awal').addClass('d-none');

                    const id = $(this).data("id");

                    $.ajax({
                        url: `${BASEURL}/getubah`,
                        data: {
                            id: id
                        },
                        method: "post",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            $('#id').val(data.id);
                            $('#nama').val(data.nama);
                            $('#satuan').val(data.satuan);
                            $('#jenis').val(data.jenis);
                            $('#riwayat').val(data.riwayat);
                        },
                    })
                });
            });
        </script>

        <script src="<?= BASEURL ?>/js/custom/stok.js"></script>

        <?php Get::view('templates/footer', $data) ?>