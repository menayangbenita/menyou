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
                                    <i class="ki-solid ki-bank text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Nomor Akuntansi</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Finance</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Nomor Akuntansi</li>
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
                                    class="form-control form-control-solid w-250px ps-12"
                                    placeholder="Cari Nomor Akuntansi" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal"
                                data-bs-target="#formModal">Tambah No Akun</a>
                            <!--end::Add product-->
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
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="text-center min-w-50px align-middle">Nomor Akuntansi</th>
                                    <th class="min-w-75px align-middle">Sub Kategori</th>
                                    <th class="min-w-100px align-middle">Deskripsi</th>
                                    <th class="text-end min-w-70px align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['akuntansi'] as $nomor): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $nomor['id']; ?>" />
                                            </div>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span class="fw-bold"><?= $nomor['akun'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $nomor['subkategori'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $nomor['deskripsi'] ?></span>
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
                                                        data-bs-target="#formModal" data-id="<?= $nomor['id']; ?>">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <?php if ($nomor['note']): ?>
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3"
                                                        onclick="alert('Tidak bisa menghapus no akun default!')">
                                                        <a href="#" class="menu-link px-3" data-id="<?= $nomor['id']; ?>"
                                                            data-kt-ecommerce-product-filter="delete_row">Hapus</a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="menu-item px-3">
                                                        <a href="<?= BASEURL; ?>/akuntansi/delete/<?= $nomor['id'] ?>"
                                                            class="menu-link px-3" data-id="<?= $nomor['id']; ?>"
                                                            data-kt-ecommerce-product-filter="delete_row">Hapus</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                <?php endif; ?>
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

                <!-- modal -->
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
                                    <h1 class="mb-3" id="modalLabel">Tambah Nomor Akuntansi</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <form action="<?= BASEURL; ?>/akuntansi/insert" method="post">
                                    <?= csrf() ?>
                                    <input type="hidden" name="id" id="id">
                                    <div class="row g-9 mb-8">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="required fs-6 fw-semibold mb-2">Nomor Akuntansi</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Cth: 101" name="akun" id="akun">

                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="required fs-6 fw-semibold mb-2">Sub Kategori</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Cth: Pemasukan" name="subkategori" id="subkategori">
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="mb-15 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                                        <textarea class="form-control form-control-solid"
                                            placeholder="Cth: Pendapatan penjualan" name="deskripsi"
                                            id="deskripsi"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary mb-0"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                            <span class="indicator-label">Simpan</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </button>
                                    </div>
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
                <script src="<?= BASEURL ?>/js/custom/apps/ecommerce/reports/views/views.js"></script>
                <!--end::Custom Javascript-->
                <!--end::Javascript-->

                <script src="<?= BASEURL ?>/js/datatables.js"></script>
                <script>
                    $(function () {
                        const BASEURL = window.location.href;

                        $('.tombolTambahData').on('click', function () {
                            $('#modalLabel').html('Tambah Nomor Akuntansi')
                            $('.modal-footer button[type=submit]').html('Tambah Data');
                            $(".modal-body form")[0].reset();
                            $(".modal-body form").attr("action", `${BASEURL}/insert`);
                        });

                        $(".tampilModalUbah").click(function () {
                            $("#modal").addClass("edit");
                            $("#modalLabel").html("Ubah Data Nomor Akuntansi");
                            $(".modal-footer button[type=submit]").html("Ubah Data");
                            $(".modal-body form").attr("action", `${BASEURL}/update`);

                            const id = $(this).data("id");

                            $.ajax({
                                url: `${BASEURL}/getubah`,
                                data: { id: id },
                                method: "post",
                                dataType: "json",
                                success: function (data) {
                                    $('#akun').val(data.akun);
                                    $('#subkategori').val(data.subkategori);
                                    $('#deskripsi').val(data.deskripsi);
                                    $('#id').val(data.id);
                                },
                            })
                        })
                    });
                </script>

                <?php Get::view('templates/footer', $data) ?>