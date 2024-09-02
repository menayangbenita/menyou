<?php Get::view('templates/header', $data) ?>

<style>
    body {
        background: white;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        margin: 80px;
        align-items: center;
        grid-gap: 30px;
    }

    .card-img-top {
        object-fit: cover;
        height: 230px;
        width: 100%;
    }

    .img-menu {
        object-fit: cover;
        width: 60px;
        height: 60px;
    }

    grid>article {
        box-shadow: 10px 5px 5px 0px black;
        border-radius: 20px;
        text-align: center;
        background: white;
    }

    .animation-card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, 0.125);
        border-radius: 1rem;
        transition: transform 0.3s ease-in-out
    }

    .animation-card:hover {
        transform: scale(1.03);
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
                                    <i class="ki-solid ki-lots-shopping text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Daftar Menu</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Produk</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Daftar Menu</li>
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
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-ecommerce-product-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Produk" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="w-100 mw-150px">
                                <!--begin::Select2-->
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="Kategori"
                                    data-kt-ecommerce-product-filter="filter_kategori">
                                    <option></option>
                                    <option value="all">Semua</option>
                                    <?php foreach ($data['kategori'] as $kategori): ?>
                                        <option value="<?= $kategori['nama'] ?>"><?= $kategori['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <!--end::Select2-->
                            <!--begin::Add product-->
                            <a href="#" class="btn btn-primary tombolTambahData" data-bs-toggle="modal"
                                data-bs-target="#formModal">Tambah Produk</a>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px">Produk</th>
                                    <th class="text-center min-w-100px">Kategori</th>
                                    <th class="text-center min-w-70px">Bahan</th>
                                    <th class="text-center min-w-100px">Harga</th>
                                    <th class="text-center min-w-100px">Porsi Tersedia</th>
                                    <th class="text-end min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['menu'] as $menu): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $menu['id']; ?>" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!--begin::Thumbnail-->
                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                    class="symbol symbol-50px">
                                                    <span class="symbol-label"
                                                        style="background-image:url(<?= BASEURL ?>/upload/menu/<?= $menu['foto'] != '' ? $menu['foto'] : 'tmp.png' ?>);"></span>
                                                </a>
                                                <!--end::Thumbnail-->
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="apps/ecommerce/catalog/edit-product.html"
                                                        class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                        data-kt-ecommerce-product-filter="product_name">
                                                        <?= $menu['nama']; ?>
                                                        <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']): ?>
                                                            <span class="badge badge-primary copy-badge ms-1">EXC</span>
                                                        <?php endif; ?></a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center pe-0" data-order="<?= $menu['kategori'] ?>">
                                            <?= $menu['kategori'] ?>
                                        </td>
                                        <td class="text-center pe-0">
                                            <a class="btn btn-light-primary rounded-pill hover-elevate-up tampilModalDetail m-0"
                                                data-bs-toggle="modal" data-bs-target="#detailModal"
                                                data-id="<?= $menu['id']; ?>">
                                                <i class="ki-solid ki-magnifier p-0 m-0"></i>
                                            </a>
                                        </td>
                                        <td class="text-center pe-0">Rp <?= number_format($menu['harga'], 0, '.', '.') ?>
                                        </td>
                                        <td class="text-center pe-0" data-order="rating-3">
                                            <?php $tersedia = json_decode($menu['tersedia'], true)[$data['user']['outlet_uuid']]; ?>
                                            <?php if ($tersedia == "infinite"): ?>
                                                <span class="badge badge-light-warning fs-base">
                                                    Infinite
                                                </span>
                                            <?php elseif ($tersedia > 0): ?>
                                                <span class="badge badge-light-success fs-base">
                                                    <?= $tersedia ?> Porsi
                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-light-danger fs-base">
                                                    Habis
                                                </span>
                                            <?php endif ?>
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
                                    </tr>
                                <?php endforeach ?>
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
    </div>
    <!--end::Content wrapper-->
    <!-- Form Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->

                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form action="<?= BASEURL ?>/menu/insert" method="post" enctype="multipart/form-data"
                        id="kt_modal_new_target_form">
                        <?= csrf() ?>
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3" id="modalLabel">Tambah Produk</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Foto Menu</span>
                            </label>
                            <!--end::Label-->
                            <div id="preview"
                                class="w-100 mb-2 rounded-2 overflow-hidden d-flex align-items-center justify-content-center"
                                style="max-height: 12rem;"></div>
                            <input type="file" class="form-control form-control-solid" name="foto" id="foto"
                                accept="image/*" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nama Produk</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" name="nama" id="nama"
                                placeholder="Cth: Nasi Goreng" oninput="toTitleCase(this)" required />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Pilih Kategori" name="kategori_id" id="kategori_id">
                                <?php foreach ($data['kategori'] as $kategori): ?>
                                    <option value="<?= $kategori['id'] ?>"> <?= $kategori['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Harga</span>
                            </label>
                            <!--end::Label-->
                            <input type="number" class="form-control form-control-solid" name="harga" id="harga"
                                placeholder="Rp" required />
                        </div>
                        <!--end::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <div class="d-flex justify-content-between mb-2">
                                <label class="form-label">Bahan / Kemasan</label>
                                <button class="btn btn-success p-0 px-2 fs-6" id="addItem" type="button">
                                    <i class="ki-solid ki-abstract-10 pe-0"></i>
                                </button>
                            </div>
                            <div id="bahan">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <button class="btn btn-danger m-0 px-3 removeItem" type="button">
                                                <i class="fa fa-xmark"></i>
                                            </button>
                                            <input type="text" class="form-control ps-2 nama-bahan" name="nama_bahan[]"
                                                placeholder="Nama Bahan" list="barang" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group d-flex">
                                            <input type="text" class="form-control position-static jumlah"
                                                name="jumlah_bahan[]" placeholder="0">
                                            <span class="input-group-text position-static satuan">..</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <datalist id="barang">
                                <?php foreach ($data['barang'] as $barang): ?>
                                    <option value="<?= $barang['nama'] ?>" data-id="<?= $barang['id'] ?>"
                                        data-satuan="<?= $barang['satuan'] ?>" data-jenis="<?= $barang['jenis'] ?>">
                                    <?php endforeach; ?>
                            </datalist>
                        </div>
                        <div class="mt-2 mb-15 fv-row form-check">
                            <input class="form-check-input" name="exclusive" type="checkbox" id="exclusive"
                                value="<?= $data['user']['outlet_uuid'] ?>">
                            <label class="custom-control-label" for="exclusive">Exclusive only for your
                                outlet</label>
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                        <h1 class="mb-3">Bahan</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">Bahan yang digunakan untuk membuat produk ini</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <div class="table-responsive mb-15">
                        <table class="table table-bordered" id="detail_bahan">
                            <thead>
                                <tr>
                                    <th class="text-center fw-bold">Nama Bahan</th>
                                    <th class="text-center fw-bold">Jumlah</th>
                                    <th class="text-center fw-bold">Satuan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Kemasan</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">Kemasan yang digunakan produk ini</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <div class="table-responsive mb-15 fv-row">
                        <table class="table table-bordered" id="detail_kemasan">
                            <thead>
                                <tr>
                                    <th class="text-center fw-bold">Nama Kemasan</th>
                                    <th class="text-center fw-bold">Jumlah</th>
                                    <th class="text-center fw-bold">Satuan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                    </div>
                    <!--end::Actions-->
                </div>
            </div>
        </div>
    </div>

    <script>
        var daftar_barang = Array.from(document.getElementById('barang').options)
            .map(opt => {
                return {
                    nama: opt.value,
                    satuan: opt.dataset.satuan,
                    jenis: opt.dataset.jenis,
                }
            });

        function toTitleCase(input) {
            let text = input.value;
            let words = text.split(' ');

            for (let i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
            }

            let titleCaseText = words.join(' ');

            input.value = titleCaseText;
        }

        $('#foto').on('change', function () {
            let file = $(this)[0].files[0];
            let url = URL.createObjectURL(file);

            $('#preview').html(`<img src="${url}" class="w-100">`);
        });

        $(document).ready(function () {
            const BASEURL = window.location.href;

            $('.tombolTambahData').on('click', function () {
                $('#modalLabel').html('Tambah Data')
                $('#formModal .modal-footer button[type=submit]').html('Simpan');
                $("#formModal form").attr("action", `${BASEURL}/insert`);
                $("#formModal form")[0].reset();
                $('#preview').html('');
                $("#bahan").html(`
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <button class="btn btn-danger m-0 px-3 removeItem" type="button">
                                <i class="fa fa-xmark"></i>
                            </button>
                            <input type="text" class="form-control ps-2 nama-bahan" name="nama_bahan[]" placeholder="Nama Bahan" list="barang" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group d-flex">
                            <input type="text" class="form-control position-static rounded-end-0 jumlah-bahan" name="jumlah_bahan[]" placeholder="0">
                            <span class="input-group-text position-static satuan">..</span>
                        </div>
                    </div>
                </div>
            `);
                $('#exclusive').prop('checked', false)
                refreshEvent();
            });

            $(".tampilModalUbah").click(function () {
                const id = $(this).data("id");

                $("#modalLabel").html("Ubah Data");
                $("#formModal .text-center button[type=submit]").html("Ubah Data");
                $("#formModal form").attr("action", `${BASEURL}/update/${id}`);

                $.ajax({
                    url: `${BASEURL}/getubah/${id}`,
                    method: "get",
                    dataType: "json",
                    success: function (data) {
                        $('#nama').val(data.nama);
                        $('#harga').val(data.harga);
                        $("#kategori_id").val(data.kategori_id);
                        $('#exclusive').prop('checked', Boolean(data.outlet_uuid))
                        if (data.foto !== '')
                            $('#preview').html(`<img src="${BASEURL.replace('/menu', '')}/upload/menu/${data.foto}" class="w-100">`);
                        $("#bahan").html('');
                        let bahan = JSON.parse(data.bahan);
                        for (let key in bahan)
                            addList(key, bahan[key], daftar_barang.find(item => item.nama == key).satuan);

                        refreshEvent();
                    },
                });
            });

            $(".tampilModalDetail").click(function () {
                const id = $(this).data("id");

                $.ajax({
                    url: `${BASEURL}/getubah/${id}`,
                    method: "post",
                    dataType: "json",
                    success: function (result) {
                        let bahan = JSON.parse(result.bahan);
                        $('#detailModal .modal-body table tbody').html('');
                        for (let key in bahan) {
                            let barang = daftar_barang.find(item => item.nama == key);
                            $(`#detailModal .modal-body table#detail_${barang.jenis} tbody`).append(`
                            <tr>
                                <td>${key}</td>
                                <td>${bahan[key]}</td>
                                <td>${barang.satuan}</td>
                            </tr>`);
                        }
                    },
                });
            });
        });
    </script>
    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="<?= BASEURL ?>/plugins/global/plugins.bundle.js"></script>
    <script src="<?= BASEURL ?>/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->   
    <script src="<?= BASEURL ?>/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <script src="<?= BASEURL ?>/js/custom/menu.js"></script>

    <script>
        "use strict";
        var KTAppEcommerceProducts = (function () {
            var t, e, n = () => {
                t.querySelectorAll(
                    '[data-kt-ecommerce-product-filter="delete_row"]'
                ).forEach((t) => {
                    t.addEventListener("click", function (t) {
                        t.preventDefault();
                        const n = t.target.closest("tr"),
                            r = n.querySelector(
                                '[data-kt-ecommerce-product-filter="product_name"]'
                            ).innerText,
                            // Mengambil ID produk dari atribut data-id
                            productId = n.querySelector('[data-kt-ecommerce-product-filter="delete_row"]').getAttribute('data-id');
                        Swal.fire({
                            text: "Are you sure you want to delete " + r + "?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary",
                            },
                        }).then(function (result) {
                            if (result.value) {
                                // Redirect ke URL penghapusan setelah konfirmasi
                                window.location.href = `<?= BASEURL; ?>/menu/delete/${productId}`;
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire({
                                    text: r + " was not deleted.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn fw-bold btn-primary" },
                                });
                            }
                        });
                    });
                });
            };
            return {
                init: function () {
                    if ((t = document.querySelector("#kt_ecommerce_products_table")) &&
                        (e = $(t).DataTable({
                            info: !1,
                            order: [],
                            pageLength: 10,
                            columnDefs: [
                                { render: DataTable.render.number(",", ".", 2), targets: 4 },
                                { orderable: !1, targets: 0 },
                                { orderable: !1, targets: 3 },
                            ],
                        })).on("draw", function () {
                            n();
                        }),
                        document
                            .querySelector('[data-kt-ecommerce-product-filter="search"]')
                            .addEventListener("keyup", function (t) {
                                e.search(t.target.value).draw();
                            }),
                        (() => {
                            const t = document.querySelector(
                                '[data-kt-ecommerce-product-filter="filter_kategori"]'
                            );
                            $(t).on("change", (t) => {
                                let n = t.target.value;
                                "all" === n && (n = ""), e.column(2).search(n).draw();
                            });
                        })(),
                        n());
                },
            };
        })();
        KTUtil.onDOMContentLoaded(function () {
            KTAppEcommerceProducts.init();
        });

    </script>

    <?php Get::view('templates/footer', $data) ?>