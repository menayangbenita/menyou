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
                                    Supplier</h1>
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
                                    <li class="breadcrumb-item text-muted">Supplier</li>
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Supplier" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <a href="#" class="btn btn-primary tombolTambahData" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Tambah Supplier</a>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive p-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                id="kt_ecommerce_report_views_table">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50">
                                            No</th>
                                        <th class="min-w-150">
                                            Nama</th>
                                        <th class="min-w-175">
                                            Alamat</th>
                                        <th class="min-w-75">
                                            Kontak</th>
                                        <th class="min-w-75">
                                            Email</th>
                                        <th class="text-end min-w-150">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <?php $i = 1; ?>
                                    <?php foreach ($data["supplier"] as $supplier): ?>
                                        <tr>
                                            <td>
                                                <p class="pe-0">
                                                    <?= $i++; ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="pe-0">
                                                    <?= $supplier['nama']; ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="pe-0 text-wrap">
                                                    <?= $supplier['alamat']; ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <?= $supplier['kontak']; ?>
                                                </p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <?= $supplier['email']; ?>
                                                </p>
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
                                                        <a class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"
                                                            data-id="<?= $supplier['id']; ?>">Edit</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="<?= BASEURL; ?>/supplier/delete/<?= $supplier['id'] ?>"
                                                            class="menu-link px-3" data-id="<?= $supplier['id']; ?>"
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
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Products-->
                </div>
                <!--end::Content container-->
        <!--end::Content wrapper-->
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3" id="modalLabel">Tambah Supplier</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <form action="<?= BASEURL; ?>/supplier/insert" method="post">
                            <?= csrf() ?>
                            <input type="hidden" name="id" id="id">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Nama Supplier</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="nama" id="nama"
                                    placeholder="Cth: Menune" required />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Alamat Supplier</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="alamat" id="alamat"
                                    placeholder="Cth: Jl. Merbabu No. 14" required />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Kontak Supplier</span>
                                </label>
                                <!--end::Label-->
                                <input type="number" class="form-control form-control-solid" name="kontak" id="kontak"
                                    placeholder="Cth: 08123456789" required />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-15 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Email Supplier</span>
                                </label>
                                <!--end::Label-->
                                <input type="email" class="form-control form-control-solid" name="email" id="email"
                                    placeholder="Cth: admin@menune.com" required />
                            </div>
                            <!--end::Input group-->
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
        <script src="<? BASEURL ?>/js/custom/utilities/modals/new-target.js"></script>
        <script src="<?= BASEURL ?>/js/custom/apps/ecommerce/reports/views/views.js"></script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(function () {
                const BASEURL = window.location.href;
                console.log(BASEURL)
                $('.tombolTambahData').on('click', function () {
                    $('modalLabel').html('Tambah Data')
                    $('.modal-footer button[type=submit]').html('Tambah Data');
                    $(".modal-body form").attr("action", `${BASEURL}/insert`);
                    $(".modal-body form")[0].reset();
                });

                $(".tampilModalUbah").click(function () {
                    $("#modal").addClass("edit");
                    $("#modalLabel").html("Ubah Data");
                    $(".modal-footer button[type=submit]").html("Ubah Data");
                    $(".modal-body form").attr("action", `${BASEURL}/update`);

                    const id = $(this).data("id");
                    console.log(id);

                    $.ajax({
                        url: `${BASEURL}/getubah`,
                        data: { id: id },
                        method: "post",
                        dataType: "json",
                        success: function (data) {
                            $('#nama').val(data.nama);
                            $("#alamat").val(data.alamat);
                            $('#kontak').val(data.kontak);
                            $('#email').val(data.email);
                            $('#id').val(data.id);
                            console.log(data);
                        },
                    })
                })
            });
        </script>

        <?php Get::view('templates/footer', $data) ?>