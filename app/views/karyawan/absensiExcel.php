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
                                    Kehadiran Karyawan</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <?= date('F', mktime(0, 0, 0, $data['filter']['bulan'], 10)), '&nbsp', $data['filter']['tahun']; ?>
                                    </li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <form class="d-flex align-items-center gap-2 gap-lg-3" method="post">
                        <div class="w-150px">
                            <select class="form-select form-select-solid" name="bulan" id="bulan">
                                <?php $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] ?>
                                <?php foreach ($months as $i => $month): ?>
                                    <option value="<?= $i + 1 ?>" <?= ($i == $data['filter']['bulan'] - 1) ? ' selected' : '' ?>>
                                        <?= $month ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="w-150px">
                            <select class="form-select form-select-solid" name="tahun" id="tahun">
                                <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++): ?>
                                    <option value="<?= $i ?>" <?= ($i == $data['filter']['tahun']) ? ' selected' : '' ?>>
                                        <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="w-125px">
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </form>
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
                        <div class="d-flex justify-content-center align-items-center">
                            <form action="<?= BASEURL; ?>/AbsensiExcel/import" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                <input type="file" name="file" id="btn_excel" style="display:none">
                                <button type="button" class="btn btn-light-primary mb-0"
                                    onclick="importexcel('#btn_excel')">
                                    Import Data Dari Excel
                                </button>
                                <button type="submit" class="btn btn-primary mb-0">
                                    Kirim
                                </button>
                            </form>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
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
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                            id="kt_ecommerce_report_views_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0 align-middle">
                                    <th rowspan="2" class="min-w-200px text-wrap">Nama</th>
                                    <th colspan="<?= $data['hari'] ?>" class="min-w-150px">Tanggal</th>
                                    <th rowspan="2" class="text-center min-w-150px">Total Hadir</th>
                                    <th rowspan="2" class="text-center min-w-150px">Total Terlambat</th>
                                    <th rowspan="2" class="text-center min-w-150px">Total Menit Terlambat</th>
                                    <th rowspan="2" class="text-center min-w-150px">Total Jam Kerja</th>
                                </tr>
                                <tr class="text-center text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <?php for ($i = 1; $i <= $data['hari']; $i++) { ?>
                                        <th class="min-w-50px"><?= $i; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['result'] as $row): ?>
                                    <tr class="fw-bold align-middle">
                                        <td class=""><?= $row['karyawan']; ?></td>
                                        <?php for ($i = 1; $i <= $data['hari']; $i++) { ?>
                                            <?php
                                            $status_id = $row['tgl_' . $i];
                                            $terlambat = $row['terlambat_' . $i];
                                            $status_text = ($status_id == 2) ? 'Terlambat' : status($status_id);
                                            $status_class = ($status_id == 2) ? 'text-warning' : getClass($status_id);
                                            ?>
                                            <td class="<?= $status_class; ?>" <?php if ($status_id == 2) echo 'data-bs-toggle="tooltip" data-bs-placement="top" title="Terlambat ' . $terlambat . ' menit"'?>>
                                                <?= $status_text; ?>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center"><?= $row['total_hadir']; ?></td>
                                        <td class="text-center"><?= $row['total_terlambat']; ?></td>
                                        <td class="text-center"><?= $row['total_menit_terlambat']; ?> menit</td>
                                        <td class="text-center"><?= $row['total_jam_kerja']; ?></td>
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

            <?php
            function status($id)
            {
                $arr = [
                    0 => 'alpha',
                    1 => 'hadir',
                    2 => 'terlambat',
                    3 => 'izin',
                ];

                return $arr[$id];
            }

            function getClass($id)
            {
                $bg = [
                    0 => ' text-danger', // Alpha
                    1 => ' text-success', // Hadir
                    2 => ' text-success', // terlambat
                    3 => ' text-secondary' // Hadir
                ];

                return $bg[$id];
            }
            ?>

            <!-- Initialize Bootstrap Tooltip -->

            <!-- Initialize Bootstrap Tooltip -->
            <script>
                function showTooltip(element) {
                    var terlambat = element.getAttribute('data-terlambat');
                    if (terlambat && terlambat != 0) {
                        var tooltip = document.createElement('div');
                        tooltip.className = 'tooltip-custom';
                        tooltip.innerHTML = 'Terlambat ' + terlambat + ' menit';
                        tooltip.style.position = 'absolute';
                        tooltip.style.backgroundColor = '#333';
                        tooltip.style.color = '#fff';
                        tooltip.style.padding = '5px';
                        tooltip.style.borderRadius = '5px';
                        tooltip.style.zIndex = '9999';
                        document.body.appendChild(tooltip);

                        var rect = element.getBoundingClientRect();
                        tooltip.style.left = rect.left + window.scrollX + 'px';
                        tooltip.style.top = rect.top + window.scrollY - tooltip.offsetHeight + 'px';

                        element.tooltipElement = tooltip;
                    }
                }

                function hideTooltip(element) {
                    if (element.tooltipElement) {
                        document.body.removeChild(element.tooltipElement);
                        element.tooltipElement = null;
                    }
                }
            </script>

            <script>
                function importexcel(id) {
                    const btn = document.querySelector(id);
                    btn.click();
                }
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