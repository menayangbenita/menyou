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
                                    <i class="ki-solid ki-shop text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Manage Outlet</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Outlet</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Manage Outlet</li>
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
                            Outlet</a>
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
                <div class="card card-flush mb-10">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-2 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-order-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Outlet" />
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
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px pe-2">No</th>
                                    <th class="min-w-150px align-middle">Nama Outlet</th>
                                    <th class="min-w-200px align-middle">Lokasi</th>
                                    <th class="min-w-125px align-middle">Manager</th>
                                    <th class="min-w-125px align-middle">No. Telp</th>
                                    <th class="text-end min-w-70px align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <? $i = 1 ?>
                                <?php foreach ($data['outlet'] as $outlet): ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $outlet['nama'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span><?= $outlet['kota']; ?>, <?= $outlet['lokasi']; ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span>
                                                <?php if ($outlet['manager']): ?>
                                                    <?= $outlet['manager'] ?>
                                                <?php else: ?>
                                                    <span class="text-secondary fw-normal">Tidak ada</span>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $outlet['nomor_telp'] ?></span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <?php if ($data['user']['role'] == "Owner" || ($data['user']['role'] == "Manager" && $outlet['uuid'] == $data['user']['outlet_uuid'])): ?>
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                            data-bs-target="#formModal" data-id="<?= $outlet['id']; ?>">Edit</a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link px-3"
                                                            onclick="alert('Tidak dapat mengubah data outlet lain')">Edit</a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($data['user']['role'] == "Owner"): ?>
                                                    <div class="menu-item px-3">
                                                        <a href="<?= BASEURL; ?>/outlet/delete/<?= $outlet['id'] ?>"
                                                            class="menu-link px-3" data-id="<?= $outlet['id']; ?>"
                                                            onclick="return confirm ('Hapus data?')">Hapus</a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="menu-item px-3">
                                                    <a href="<?= BASEURL; ?>/outlet/detail/<?= $outlet['id'] ?>"
                                                        class="menu-link px-3" data-id="<?= $outlet['uuid']; ?>">Detail</a>
                                                </div>
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

                <?php if ($data['user']['role'] == "Owner"): ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-flush mb-15">
                                <div class="card-header pt-5 mb-3">
                                    <div class="d-flex justify-content-center align-items-center mt-4">
                                        <div class="symbol symbol-55px me-5">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-solid ki-setting-3 text-primary fs-1"></i>
                                            </span>
                                        </div>
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800 pb-1">User Access</span>
                                            <!--begin::Breadcrumb-->
                                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">Outlet</li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item">
                                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                                </li>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">User Access</li>
                                                <!--end::Item-->
                                            </ul>
                                            <!--end::Breadcrumb-->
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0"
                                            style="width: 100%; border-collapse: collapse;">
                                            <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="min-w-150px align-middle">
                                                        Username</th>
                                                    <th class="min-w-150px align-middle">
                                                        Role</th>
                                                    <th class="min-w-150px align-middle">
                                                        Outlet</th>
                                                    <th class="text-start min-w-50px align-middle">
                                                        Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($data["users"] as $user): ?>
                                                    <tr class="align-middle" <?= $user['id'] == $user['manager_id'] ? 'class="bg-warning-subtle"' : '' ?>>
                                                        <td class="text-start font-weight-bold mb-0">
                                                            <h6 class="mb-0 text-sm"><?= $user['username'] ?></h6>
                                                            <p class="text-xs text-gray-500 pb-0 mb-0"><?= $user['email'] ?>
                                                            </p>
                                                        </td>
                                                        <td class="text-start font-weight-bold mb-0">
                                                            <?php if ($user['role'] == 'Owner'): ?>
                                                                <span class="badge badge-light-primary"><?= $user['role']; ?></span>
                                                            <?php elseif ($user['role'] == 'Manager'): ?>
                                                                <span class="badge badge-light-info"><?= $user['role']; ?></span>
                                                            <?php else: ?>
                                                                <span
                                                                    class="badge badge-light-secondary"><?= $user['role']; ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="fw-bold text-start mb-0">
                                                            <?= $user['nama_outlet']; ?>
                                                        </td>
                                                        <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                                            <?php if ($user['id'] == $user['manager_id']): ?>
                                                                <button
                                                                    class="btn btn-light rounded-pill btn-icon mb-0 tombolUserAccess"
                                                                    onclick="alert('Anda tidak dapat mengubah outlet dari user ini! Jika anda ingin merubah, hapus manager dari <?= $user['nama_outlet'] ?> terlebih dahulu.')">
                                                                    <i class="fa fa-pen"></i>
                                                                </button>
                                                            <?php else: ?>
                                                                <button
                                                                    class="btn btn-primary rounded-pill btn-icon mb-0 tombolUserAccess"
                                                                    data-bs-toggle="modal" data-bs-target="#switchModal"
                                                                    data-outlet_uuid="<?= $user['outlet_uuid'] ?>"
                                                                    data-id="<?= $user['id']; ?>">
                                                                    <i class="fa fa-pen"></i>
                                                                </button>
                                                            <?php endif; ?>
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

                    <!-- modal switch -->
                    <div class="modal fade" id="switchModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <h1 class="mb-3" id="modalLabel">Ubah Data Outlet User</h1>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <form action="<?= BASEURL ?>/outlet/changeUserAccess" method="post"
                                        enctype="multipart/form-data">
                                        <?= csrf() ?>
                                        <div class="d-flex flex-column mb-8 fv-row" id="select-outlet">
                                            <label for="outlet_uuid"
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                    class="required">Pilih outlet</span></label>
                                            <select class="form-select form-select-solid" name="outlet_uuid"
                                                id="outlet_uuid">
                                                <?php foreach ($data['outlet'] as $outlet): ?>
                                                    <option value="<?= $outlet['uuid'] ?>"><?= $outlet['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-15 fv-row">
                                            <label for="password"
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2 text-danger">
                                                <span class="required">Masukkan password untuk user
                                                    <b><?= $data['user']['username'] ?></b>:</span>
                                            </label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="********" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary mb-1"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary mb-1">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--end::Products-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->

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
                                <h1 class="mb-3" id="modalLabel">Tambah Outlet</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <form action="<?= BASEURL ?>/outlet/insert" method="post" enctype="multipart/form-data">
                                <?= csrf() ?>
                                <input type="hidden" name="id" id="id">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="foto" class="d-flex align-items-center fs-6 fw-semibold mb-2">Foto
                                        Cabang</label>
                                    <div id="preview"
                                        class="w-100 mb-2 rounded-2 overflow-hidden d-flex align-items-center justify-content-center"
                                        style="max-height: 12rem;"></div>
                                    <input type="file" class="form-control form-control-solid" name="foto" id="foto"
                                        accept="image/*">
                                </div>
                                <div class="row g-9 mb-8">
                                    <div class="col-md-7 fv-row">
                                        <label for="nama" class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                class="required">Nama</span></label>
                                        <input type="text" class="form-control form-control-solid" name="nama" id="nama"
                                            placeholder="Nama Cabang" required>
                                    </div>
                                    <div class="col-md-5 fv-row">
                                        <label for="manager_id"
                                            class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                class="required">Manager</span></label>
                                        <select class="form-select form-select-solid" name="manager_id" id="manager_id"
                                            required>
                                            <?php foreach ($data['users'] as $user): ?>
                                                <?php if (!in_array($user['role'], ['Owner', 'Manager']))
                                                    continue; ?>
                                                <option value="<?= $user['id'] ?>"
                                                    data-outlet_uuid="<?= $user['outlet_uuid'] ?>">
                                                    <?= $user['username'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <?php if ($data['user']['role'] == "Owner"): ?>
                                                <option value="null">Tidak Ada</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-9 mb-8">
                                    <div class="col-md-7 fv-row">
                                        <label for="alamat"
                                            class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                class="required">Alamat</span></label>
                                        <textarea type="text" class="form-control form-control-solid" name="alamat"
                                            id="alamat" placeholder="Cth: Jl. Merbabu No 12" required></textarea>
                                    </div>
                                    <div class="col-md-5 fv-row">
                                        <div class="mb-2">
                                            <label for="kota"
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                    class="required">Kota</span></label>
                                            <input type="text" class="form-control form-control-solid" name="kota"
                                                id="kota" placeholder="Cth: Malang" required>
                                        </div>
                                        <div>
                                            <label for="lokasi"
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                    class="required">Lokasi</span></label>
                                            <input type="text" class="form-control form-control-solid" name="lokasi"
                                                id="lokasi" placeholder="Cth: Jawa Timur" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label for="nomor_telp"
                                        class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                            class="required">No. Telp</span></label>
                                    <input type="tel" class="form-control form-control-solid" name="nomor_telp"
                                        id="nomor_telp" placeholder="Cth: 089501020304" required>
                                </div>
                                <div class="d-flex flex-column mb-15 fv-row">
                                    <label for="pajak" class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                            class="required">Pajak (%)</span></label>
                                    <input type="number" class="form-control form-control-solid" name="pajak" id="pajak"
                                        min="0" max="100" placeholder="Cth: 2" required>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary mb-1"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary mb-1">Simpan</button>
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

                    $('#foto').on('change', function () {
                        let file = $(this)[0].files[0];
                        let url = URL.createObjectURL(file);

                        $('#preview').html(`<img src="${url}" class="w-100">`);
                    });

                    <?php if ($data['user']['role'] == "Owner"): ?>
                        $('.tombolUserAccess').on('click', function () {
                            let id = $(this).data('id');
                            let outlet_uuid = $(this).data('outlet_uuid');
                            if (!!outlet_uuid) $('#switchModal #outlet_uuid').val(outlet_uuid);
                            $('#switchModal form').attr('action', `${BASEURL}/changeUserAccess/${id}`)
                        });

                        $('.tombolTambahData').on('click', function () {
                            $('#modalLabel').html('Tambah Data')
                            $('.modal-footer button[type=submit]').html('Tambah Data');
                            $("#manager_id option").show();
                            $('form')[0].reset();
                            $("#manager_id").val('null');
                            $('#preview').html('');

                            $("#manager_id option").each((i, e) => {
                                if (e.dataset.outlet_uuid != '') {
                                    e.style.display = 'none';
                                }
                            });
                        });
                    <?php endif; ?>

                    $(".tampilModalUbah").click(function () {
                        $("#modal").addClass("edit");
                        $("#modalLabel").html("Ubah Data");
                        $(".modal-footer button[type=submit]").html("Ubah Data");
                        $(".modal-body form").attr("action", `${BASEURL}/update`);
                        $("#manager_id option").show();

                        const id = $(this).data("id");

                        $.ajax({
                            url: `${BASEURL}/getubah`,
                            data: { id: id },
                            method: "post",
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                                $('#id').val(data.id);
                                if (data.foto !== '')
                                    $('#preview').html(`<img src="${BASEURL.replace('/outlet', '')}/upload/outlet/${data.foto}" class="w-100">`);
                                $('#nama').val(data.nama);
                                $('#manager_id').val(data.manager_id || 'null');
                                $('#alamat').val(data.alamat);
                                $('#kota').val(data.kota);
                                $('#lokasi').val(data.lokasi);
                                $('#nomor_telp').val(data.nomor_telp);
                                $('#pajak').val(data.pajak);

                                $("#manager_id option").each((i, e) => {
                                    if (e.value == 'null') return 0;
                                    if (e.dataset.outlet_uuid != data.uuid) {
                                        e.style.display = 'none';
                                    }
                                });
                            },
                        })
                    })
                });
            </script>

            <?php Get::view('templates/footer', $data) ?>