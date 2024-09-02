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
                                    <i class="ki-solid ki-setting-3 text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Manage User</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Admin</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Manage User</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">Tambah
                            User</a>
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
                                    class="form-control form-control-solid w-250px ps-12"
                                    placeholder="Cari Reward/Punishment" />
                            </div>
                            <!--end::Search-->
                            <!--begin::Export buttons-->
                            <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                            id="kt_ecommerce_report_views_table">
                            <thead>
                                <tr class="text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px pe-2">No</th>
                                    <th class="text-start min-w-225px">User</th>
                                    <th class="text-center min-w-100px">Role</th>
                                    <th class="text-center min-w-150px">Outlet</th>
                                    <th class="text-center min-w-125px">Terakhir Login</th>
                                    <th class="text-center min-w-125px">Status</th>
                                    <th class="text-center min-w-125px">Approve</th>
                                    <th class="text-end min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php $i = 1; ?>
                                <?php foreach ($data["users"] as $user): ?>
                                    <tr>
                                        <td>
                                            <span><?= $i++ ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <!--begin::Title-->
                                            <div class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                <?= $user['username']; ?>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7 fw-bold"><?= $user['email']; ?>
                                            </div>
                                            <!--end::Description-->
                                        </td>
                                        <td class="text-center">
                                            <?php if ($user['role'] == 'Owner'): ?>
                                                <span class="badge badge-light-warning"><?= $user['role']; ?></span>
                                            <?php elseif ($user['role'] == 'Manager'): ?>
                                                <span class="badge badge-dark"><?= $user['role']; ?></span>
                                            <?php elseif (is_null($user['role'])): ?>
                                                <span class="badge badge-secondary">Tidak Ada</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary"><?= $user['role'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span>
                                                <?php if ($user['nama_outlet']): ?>
                                                    <?= $user['nama_outlet']; ?>
                                                <?php else: ?>
                                                    <span class="text-secondary fw-normal">
                                                        Tidak Ada
                                                    </span>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td class="text-center pe-0">
                                            <span class="fw-bold"><?= $user['last_login_at'] ?></span>
                                        </td>
                                        <td class="text-center pe-0">
                                            <?php if ($user['status']): ?>
                                                <span class="badge badge-light-success m-0">Online</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary m-0">Offline</span>
                                            <?php endif ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($user['active']): ?>
                                                <button type="button" class="btn btn-light-primary m-0 rounded-pill">
                                                    Active
                                                </button>
                                            <?php else: ?>
                                                <button type="button"
                                                    class="btn btn-light-warning m-0 rounded-pill tombolActivation"
                                                    data-bs-toggle="modal" data-bs-target="#switchModal"
                                                    data-id="<?= $user['id']; ?>">
                                                    Unactive
                                                </button>
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
                                                    <a class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                        data-bs-target="#formModal" data-id="<?= $user['id']; ?>">Edit</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="<?= BASEURL; ?>/users/destroy/<?= $user['id'] ?>"
                                                        class="menu-link px-3" data-id="<?= $user['id']; ?>"
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
        </div>
        <!--end::Content-->

        <!-- modal form -->
        <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content rounded">
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
                                <h1 class="mb-3" id="modalLabel">Tambah User</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <form action="<?= BASEURL; ?>/user/insert" method="post">
                                <?= csrf() ?>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="username" class="fd-flex align-items-center fs-6 fw-semibold mb-2"><span
                                            class="required">Name</span></label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Username">
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="email" class="fd-flex align-items-center fs-6 fw-semibold mb-2"><span
                                            class="required">Email</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="email@example.com">
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="role" class="fd-flex align-items-center fs-6 fw-semibold mb-2"><span
                                            class="required">Role</span></label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="Owner">Owner</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Sales">Sales</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Analyzer">Data Analyse</option>
                                        <option value="HR">Human Resource Manager</option>
                                        <option value="karyawan">karyawan</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-15 fv-row password-container">
                                    <label for="password" class="fd-flex align-items-center fs-6 fw-semibold mb-2"><span
                                            class="required">Password</span></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password">
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- modal switch -->
                <div class="modal fade" id="switchModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content rounded">
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
                                        <h1 class="mb-3" id="modalLabel">Aktivasi User</h1>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <form action="<?= BASEURL ?>/users/activateUser" method="post"
                                        enctype="multipart/form-data">
                                        <?= csrf() ?>
                                        <div class="d-flex flex-column mb-8 fv-row" id="select-outlet">
                                            <label for="outlet_uuid"
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                    class="required">Pilih outlet</span></label>
                                            <select class="form-control" name="outlet_uuid">
                                                <?php foreach ($data['outlet'] as $outlet): ?>
                                                    <option value="<?= $outlet['uuid'] ?>"><?= $outlet['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label for="role"
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                    class="required">Pilih Role</span></label>
                                            <select class="form-control" name="role">
                                                <option value="Manager">Manager</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Warehouse">Warehouse</option>
                                                <option value="Analyzer">Data Analyse</option>
                                                <option value="HR">Human Resource Manager</option>
                                                <option value="Karyawan">Karyawan</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-15 fv-row">
                                            <label for="password"
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2 text-danger fw-normal fs-6">
                                                <span class="required">Masukkan password untuk user
                                                    <b><?= $data['user']['username'] ?></b>:</span>
                                            </label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="********" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary mb-1"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn bg-gradient-primary mb-1">Simpan</button>
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
                    <script src="<?= BASEURL ?>/js/datatables.js"></script>

                    <script>
                        $(function () {
                            const BASEURL = window.location.href;

                            $('.tombolActivation').on('click', function () {
                                let id = $(this).data('id');

                                // console.log(id);
                                $('#switchModal form')[0].reset();
                                $('#switchModal form').attr('action', `${BASEURL}/activateUser/${id}`);
                            });

                            $('.tombolTambahData').on('click', function () {
                                $('#modalLabel').html('Tambah Data')
                                $('#formModal .modal-footer button[type=submit]').html('Tambah Data');
                                $("#formModal .modal-body form").attr("action", `${BASEURL}/insert`);
                                $('#formModal .modal-body .password-container').show();
                                $("#formModal .modal-body form")[0].reset();
                            });

                            $(".tampilModalUbah").click(function () {
                                const id = $(this).data("id");

                                $("#modalLabel").html("Ubah Data");
                                $("#formModal .modal-footer button[type=submit]").html("Ubah Data");
                                $("#formModal .modal-body form").attr("action", `${BASEURL}/update/${id}`);
                                $('#formModal .modal-body .password-container').hide();

                                $.ajax({
                                    url: `${BASEURL}/getubah`,
                                    data: {
                                        id: id
                                    },
                                    method: "post",
                                    dataType: "json",
                                    success: function (data) {
                                        $('#username').val(data.username);
                                        $('#email').val(data.email);
                                        $('#role').val(data.role || 'null');
                                    },
                                })
                            })
                        });
                    </script>

                    <?php Get::view('templates/footer', $data) ?>