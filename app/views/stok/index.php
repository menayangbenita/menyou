<?php Get::view('templates/header', $data) ?>

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

<!-- Tabel -->
<div id="dataDetailAbsen">
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
                                        <i class="ki-solid ki-parcel text-primary fs-1"></i>
                                    </span>
                                </div>
                                <div class="card-title align-items-start flex-column">
                                    <!--begin::Title-->
                                    <h1
                                        class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                        Kelola Barang</h1>
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
                                        <li class="breadcrumb-item text-muted">Kelola Barang</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                            </div>
                        </div>
                        <!--end::Page title-->
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <a href="#" class="btn btn-flex btn-primary fw-bold tombolTambahData" data-bs-toggle="modal"
                                data-bs-target="#formModal">Tambah Data</a>
                        </div>
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
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-2 position-absolute ms-4"></i>
                                    <input type="text" data-kt-ecommerce-order-filter="search"
                                        class="form-control form-control-solid w-250px ps-12"
                                        placeholder="Cari Barang" />
                                </div>
                                <!--end::Search-->
                                <!--begin::Export buttons-->
                                <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                                <!--end::Export buttons-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <!--begin::Filter-->
                                <div class="w-150px">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true" data-placeholder="Jenis"
                                        data-kt-ecommerce-order-filter="stokJenis">
                                        <option></option>
                                        <option value="all">Semua</option>
                                        <option value="Bahan">Bahan</option>
                                        <option value="Kemasan">Kemasan</option>
                                        <option value="Prepare">Prepare</option>
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
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5"
                                    id="kt_ecommerce_report_views_table">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-100px">
                                                Nama</th>
                                            <th class="min-w-100px">
                                                Jenis</th>
                                            <th class="text-center min-w-100px">
                                                Satuan</th>
                                            <th class="text-center min-w-100px">
                                                Stok Saat Ini</th>
                                            <th class="text-end min-w-100px">
                                                Aksi</th>
                                        </tr>

                                    </thead>

                                    <tbody class="fw-semibold text-gray-600">
                                        <?php foreach ($data['barang'] as $barang): ?>
                                            <?php $lastVal = 0; ?>
                                            <tr align="center">
                                                <td class="text-start fixed-column">
                                                    <?= $barang['nama'] ?>
                                                </td>
                                                <td class="text-start" data-order="<?= ucfirst($barang['jenis']) ?>"
                                                    data-filter="<?= ucfirst($barang['jenis']) ?>">
                                                    <?= ucfirst($barang['jenis']) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $barang['satuan'] ?>
                                                </td>
                                                <td class="text-center"><?= $barang['stok'] ?>
                                                </td>
                                                <td class="text-end">
                                                    <a href="#"
                                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">Aksi
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a data-bs-toggle="modal" data-bs-target="#formModal"
                                                                data-id="<?= $barang['id'] ?>"
                                                                class="menu-link px-3 tampilModalUbah">
                                                                Edit</a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="<?= BASEURL ?>/stok/delete/<?= $barang['id'] ?>"
                                                                class="menu-link px-3"
                                                                onclick="return confirm('Hapus data?')">Hapus</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
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
        </div>
        <!-- End Tabel -->

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
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3" id="modalLabel">Tambah Data Reward & Punishment</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <form action="<?= BASEURL; ?>/stok/update" method="post">
                            <?= csrf() ?>
                            <input type="hidden" name="id" id="id">
                            <div class="mb-8 fv-row">
                                <label for="nama" class="required fs-6 fw-semibold mb-2">Nama</label>
                                <input type="text" class="form-control form-control-solid" name="nama" id="nama"
                                    placeholder="Nama Barang" autocomplete="off" required>
                                <datalist id="barang">
                                    <?php foreach ($data['barang'] as $barang): ?>
                                        <?php if ($barang['jenis'] == 'prepare')
                                            continue; ?>
                                        <option value="<?= $barang['nama'] ?>">
                                        <?php endforeach; ?>
                                </datalist>
                            </div>
                            <div class="mb-8 fv-row">
                                <label for="nama" class="required fs-6 fw-semibold mb-2">Jenis</label>
                                <select class="form-select form-select-solid" name="jenis" id="jenis" required>
                                    <option value="bahan">Bahan</option>
                                    <option value="kemasan">Kemasan</option>
                                    <option value="prepare">Prepare</option>
                                </select>
                            </div>
                            <div class="mb-15 row g-9">
                                <div class="col-md-6 fv-row" id="stok-awal">
                                    <label for="stok" class="required fs-6 fw-semibold mb-2">Stok Awal</label>
                                    <input type="number" class="form-control form-control-solid" name="stok" id="stok"
                                        value="0" required>
                                </div>
                                <div class="col-md-6 fv-row flex-grow-1">
                                    <label for="satuan" class="required fs-6 fw-semibold mb-2">Satuan</label>
                                    <select class="form-select form-select-solid" name="satuan" required>
                                        <option value="Kg" selected>Kg</option>
                                        <option value="gram" selected>gram</option>
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
                                <button type="button" class="btn btn-light mb-1"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary mb-1">Simpan</button>
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

            <script src="<?= BASEURL ?>/js/datatables.js"></script>

            <script>
                $(function () {
                    const BASEURL = `<?= BASEURL ?>`;
                    const barang_all = JSON.parse(`<?= json_encode(array_column($data['barang'], 'nama')) ?>`);
                    const nama = document.querySelector('input#nama');

                    $(".tombolTambahData").click(function () {
                        $('#modalLabel').html('Tambah Data Barang');
                        $("#formModal form").attr("action", `${BASEURL}/stok/insert`);
                        $("#formModal form")[0].reset();
                        $('#stok-awal').removeClass('d-none');

                        nama.onchange = () => {
                            let value = nama.value;
                            let find = barang_all.find(item => item.toLowerCase() === value.toLowerCase());

                            if (value) {
                                if (find) {
                                    alert(`${find} sudah ada di dalam daftar stok!`)
                                    nama.value = ''
                                }
                            }
                        };
                    });

                    $(".tampilModalUbah").click(function () {
                        const id = $(this).data("id");

                        $('#modalLabel').html('Ubah Data');
                        $("#formModal form").attr("action", `${BASEURL}/stok/update/${id}`);
                        $('#stok-awal').addClass('d-none');

                        $.ajax({
                            url: `${BASEURL}/stok/getubah`,
                            data: { id: id },
                            method: "post",
                            dataType: "json",
                            success: function (data) {
                                $('#id').val(data.id);
                                $('#nama').val(data.nama);
                                $('#satuan').val(data.satuan);
                                $('#jenis').val(data.jenis);
                                $('#riwayat').val(data.riwayat);

                                nama.onchange = () => {
                                    let value = nama.value;
                                    let find = barang_all.filter(barang => barang != data.nama)
                                        .find(item => item.toLowerCase() === value.toLowerCase());

                                    if (value) {
                                        if (find) {
                                            alert(`${find} sudah ada di dalam daftar stok!`);
                                            nama.value = data.nama;
                                        }
                                    }
                                };
                            },
                        })
                    });
                });
            </script>

            <?php Get::view('templates/footer', $data) ?>