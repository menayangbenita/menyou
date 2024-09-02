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
                                    <i class="ki-solid ki-lots-shopping text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Daftar Kategori</h1>
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
                                    <li class="breadcrumb-item text-muted">Daftar Kategori</li>
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Kategori" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <a href="#" class="btn btn-primary er fs-6 px-8 py-4 tombolTambahData"
                                data-bs-toggle="modal" data-bs-target="#formModal">Tambah Kategori</a>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="text-start min-w-250px">Kategori</th>
                                    <th class="text-start min-w-75px">Total Produk</th>
                                    <th class="text-end min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['kategori'] as $kategori): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $kategori['id']; ?>" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <!--begin::Thumbnail-->
                                                <a href="#" class="symbol symbol-50px">
                                                    <span class="symbol-label"
                                                        style="background-image:url(<?= BASEURL ?>/upload/kategori/<?= $kategori['foto'] ?>);"></span>
                                                </a>
                                                <!--end::Thumbnail-->
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1"
                                                        data-kt-ecommerce-category-filter="category_name"
                                                        data-order="<?= $kategori['nama']; ?>"><?= $kategori['nama']; ?>
                                                    </div>
                                                    <!--end::Title-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7 fw-bold"><?= $kategori['deskripsi']; ?>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-start pe-0">
                                            5 produk
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
                                                    <a href="<?= BASEURL; ?>/menu/update/<?= $kategori['id'] ?>"
                                                        class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                        data-bs-target="#formModal"
                                                        data-id="<?= $kategori['id']; ?>">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-id="<?= $kategori['id']; ?>"
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
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

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
                        <form action="<?= BASEURL; ?>/kategori/insert" method="post" enctype="multipart/form-data">
                            <?= csrf() ?>
                            <!--begin::Heading-->
                            <div class="mb-13 text-center">
                                <!--begin::Title-->
                                <h1 class="mb-3" id="modalLabel">Tambah Kategori</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <input type="hidden" name="id" id="id">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Foto Kategori</span>
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
                                    <span class="required">Nama Kategori</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="nama" id="nama" />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Deskripsi Kategori</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" name="deskripsi"
                                    id="deskripsi" />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <button data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>
                                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                    <span class="indicator-label">Simpan</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                            <!--end::Actions-->
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

        <script>
            $('#foto').on('change', function () {
                let file = $(this)[0].files[0];
                let url = URL.createObjectURL(file);

                $('#preview').html(`<img src="${url}" class="w-100">`);
            });
            $(function () {
                const BASEURL = window.location.href;
                console.log(BASEURL)
                $('.tombolTambahData').on('click', function () {
                    $('modalLabel').html('Tambah Kategori')
                    $('.modal-footer button[type=submit]').html('Simpan');
                    $('#preview').html('');
                });

                $(".tampilModalUbah").click(function () {
                    $("#modal").addClass("edit");
                    $("#modalLabel").html("Ubah Kategori");
                    $(".modal-footer button[type=submit]").html("Simpan");
                    $(".modal-body form").attr("action", `${BASEURL}/update`);

                    const id = $(this).data("id");
                    console.log(id);

                    $.ajax({
                        url: `${BASEURL}/getubah`,
                        data: {
                            id: id
                        },
                        method: "post",
                        dataType: "json",
                        success: function (data) {
                            $('#nama').val(data.nama);
                            $('#deskripsi').val(data.deskripsi);
                            $('#id').val(data.id);
                            console.log(data);
                        },
                    })
                })
            });
        </script>

        <script>
            "use strict";
            var KTAppEcommerceCategories = function () {
                var t, e, n = () => {
                    t.querySelectorAll('[data-kt-ecommerce-category-filter="delete_row"]').forEach((t => {
                        t.addEventListener("click", (function (t) {
                            t.preventDefault();
                            const n = t.target.closest("tr")
                                , o = n.querySelector('[data-kt-ecommerce-category-filter="category_name"]').innerText;
                            Swal.fire({
                                text: "Are you sure you want to delete " + o + "?",
                                icon: "warning",
                                showCancelButton: !0,
                                buttonsStyling: !1,
                                confirmButtonText: "Yes, delete!",
                                cancelButtonText: "No, cancel",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-danger",
                                    cancelButton: "btn fw-bold btn-active-light-primary"
                                }
                            }).then((function (t) {
                                t.value ? Swal.fire({
                                    text: "You have deleted " + o + "!.",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then((function () {
                                    e.row($(n)).remove().draw()
                                }
                                )) : "cancel" === t.dismiss && Swal.fire({
                                    text: o + " was not deleted.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                })
                            }
                            ))
                        }
                        ))
                    }
                    ))
                }
                    ;
                return {
                    init: function () {
                        (t = document.querySelector("#kt_ecommerce_category_table")) && ((e = $(t).DataTable({
                            info: !1,
                            order: [],
                            pageLength: 10,
                            columnDefs: [{
                                orderable: !1,
                                targets: 0
                            }, {
                                orderable: !1,
                                targets: 3
                            }]
                        })).on("draw", (function () {
                            n()
                        }
                        )),
                            document.querySelector('[data-kt-ecommerce-category-filter="search"]').addEventListener("keyup", (function (t) {
                                e.search(t.target.value).draw()
                            }
                            )),
                            n())
                    }
                }
            }();
            KTUtil.onDOMContentLoaded((function () {
                KTAppEcommerceCategories.init()
            }
            ));
        </script>

        <?php Get::view('templates/footer', $data) ?>