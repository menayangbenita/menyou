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
                                    Reward & Punishment</h1>
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
                                    <li class="breadcrumb-item text-muted">Reward & Punishsment</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#formModal">Tambah Data</a>
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
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-50px align-middle">Nama Karyawan</th>
                                    <th class="min-w-75px align-middle">Jenis</th>
                                    <th class="min-w-100px align-middle">Total Besaran</th>
                                    <th class="min-w-100px align-middle">Keterangan</th>
                                    <th class="min-w-100px align-middle">Tanggal</th>
                                    <th class="text-end min-w-70px align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['reward_punishment'] as $reward_punishment): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $reward_punishment['id']; ?>" />
                                            </div>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $reward_punishment['nama'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <h6
                                                class='mb-0 badge badge-light-<?= ($reward_punishment['jenis'] == 'reward' ? 'success' : 'danger') ?> copy-badge'>
                                                <?= ucfirst($reward_punishment['jenis']) ?>
                                            </h6>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><b><?= $reward_punishment['jumlah'] ?></b> x Rp
                                                <?= number_format($reward_punishment['besaran'], 0, '.', '.') ?>
                                                <br>= <b>Rp
                                                    <?= number_format($reward_punishment['total'], 0, '.', '.') ?></b></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $reward_punishment['keterangan'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span
                                                class="fw-bold"><?= date('d-m-Y', strtotime($reward_punishment['tanggal'])) ?></span>
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
                                                        data-bs-target="#formModal"
                                                        data-id="<?= $reward_punishment['id']; ?>">Edit</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="<?= BASEURL; ?>/rewardpunishment/delete/<?= $reward_punishment['id'] ?>"
                                                        class="menu-link px-3" data-id="<?= $reward_punishment['id']; ?>"
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

        <!-- Modal -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form action="<?= BASEURL ?>/rewardpunishment/insert" method="post">
                            <?= csrf() ?>
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Karyawan</label>
                                    <select class="form-select form-select-solid" id="karyawan_id" name="karyawan_id"
                                        required>
                                        <option>--Pilih Karyawan--</option>
                                        <?php foreach ($data['karyawan'] as $karyawan): ?>
                                            <option value="<?= $karyawan['id'] ?>" data-email="<?= $karyawan['email'] ?>"
                                                data-posisi="<?= $karyawan['posisi'] ?>"
                                                data-alamat="<?= $karyawan['alamat'] ?>">
                                                <?= $karyawan['nama'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Email</label>
                                    <input type="email" class="form-control form-control-solid" id="email"
                                        placeholder="Cth: sales@menune.com" disabled readonly>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Posisi</label>
                                    <input type="text" class="form-control form-control-solid" id="posisi"
                                        placeholder="Cth: Kasir" disabled readonly>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Alamat Rumah</label>
                                    <input type="text" class="form-control form-control-solid" id="alamat"
                                        placeholder="Cth: Jl. Merbabu No.12" disabled readonly>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Keterangan</span>
                                </label>
                                <!--end::Label-->
                                <textarea name="keterangan" class="form-control form-control-solid" id="keterangan"
                                    rows="2" placeholder="Cth: Terlambat" required></textarea>
                            </div>
                            <!--end::Input group-->
                            <div class="row g-9 mb-15">
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Besaran</label>
                                    <input type="number" class="form-control form-control-solid" id="besaran"
                                        name="besaran" placeholder="Cth: 100000" required>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Jumlah</label>
                                    <input type="number" class="form-control form-control-solid" id="jumlah"
                                        name="jumlah" placeholder="Cth: 3" value="1" required>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Total</label>
                                    <input type="number" class="form-control form-control-solid" id="total" value="0"
                                        disabled>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary mb-1"
                                    data-bs-dismiss="modal">Tutup</button>
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

        <script>
            $(function () {
                const BASEURL = window.location.href;

                $('.tombolTambahData').on('click', function () {
                    $('#exampleModalLabel').html('Tambah Data');
                    $('.modal-footer button[type=submit]').html('Tambah Data');
                    $('.modal-body form').attr('action', `${BASEURL}/insert`);
                    $('.modal-body form')[0].reset();
                });

                $('.tampilModalUbah').on('click', function () {
                    $('#exampleModalLabel').html('Ubah Data Reward & Punishment');
                    $('.modal-footer button[type=submit]').html('Ubah Data');
                    $('.modal-body form').attr('action', `${BASEURL}/update`);

                    const id = $(this).data('id');

                    $.ajax({
                        url: `${BASEURL}/getubah`,
                        data: { id: id },
                        method: 'post',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            $('#id').val(data.id);
                            $('#karyawan_id').val(data.karyawan_id);
                            $('#jenis').val(data.jenis);
                            $('#jumlah').val(data.jumlah);
                            $('#besaran').val(data.besaran);
                            $('#total').val(data.total);
                            $('#keterangan').val(data.keterangan);
                            $('#tanggal').val(data.tanggal);
                            updateDataKaryawan();
                        }
                    });
                });

                $('#karyawan_id').change(updateDataKaryawan);

                function updateDataKaryawan() {
                    // Get the selected employee's information
                    let selectedEmployee = $('#karyawan_id').find(':selected');

                    // Set the values for Email, Jabatan, and Alamat
                    $('#email').val(selectedEmployee.data('email'));
                    $('#posisi').val(selectedEmployee.data('posisi'));
                    $('#alamat').val(selectedEmployee.data('alamat'));
                }

                $('#besaran').on('input', countTotal);
                $('#jumlah').on('input', countTotal);

                function countTotal() {
                    $('#total').val(($('#besaran').val() || 0) * ($('#jumlah').val() || 0));
                }
            });
        </script>

        <?php Get::view('templates/footer', $data) ?>