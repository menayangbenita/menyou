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
                            <?php $formater = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE) ?>
                            <h5 class="card-title text-center mt-2">Pengeluaran Stok Hari Ini, tanggal
                                <?= $formater->format(new DateTime()) ?></h5>
                            <!--begin::Export buttons-->
                            <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->

                    <form class="card-body pt-0" action="<?= BASEURL ?>/stok/updatePengeluaran" method="post">
                        <?= csrf() ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th
                                        class="text-center min-w-125px">
                                        No</th>
                                    <th
                                        class="text-center min-w-125px w-25">
                                        Nama Barang</th>
                                    <th
                                        class="text-center min-w-125px">
                                        Sisa Stok Sebelumnya</th>
                                    <th></th>
                                    <th
                                        class="text-center min-w-125px">
                                        Pengeluaran</th>
                                    <th></th>
                                    <th
                                        class="text-center min-w-125px">
                                        Sisa Stok Saat Ini</th>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($data['barang'] as $barang): ?>
                                        <tr>
                                            <input type="hidden" name="id[]" value="<?= $barang['id'] ?>">
                                            <td class="text-sm text-center font-weight-bold align-middle">
                                                <?= ++$i; ?>
                                            </td>
                                            <td class="text-sm text-center font-weight-bold align-middle">
                                                <?= $barang['nama'] ?>
                                            </td>
                                            <td class="text-sm text-center font-weight-bold align-middle">
                                                <input type="text" class="form-control text-center stok"
                                                    value="<?= $barang['stok'] + $data['pengeluaran'][$i - 1] ?>" disabled>
                                            </td>
                                            <td class="text-sm text-center font-weight-bold align-middle">
                                                -
                                            </td>
                                            <td class="text-sm text-center font-weight-bold align-middle">
                                                <input type="text" class="form-control text-center pengeluaran"
                                                    name="pengeluaran[]" value="<?= $data['pengeluaran'][$i - 1] ?>" min="0"
                                                    max="<?= $barang['stok'] + $data['pengeluaran'][$i - 1] ?>" />
                                            </td>
                                            <td class="text-sm text-center font-weight-bold align-middle">
                                                =
                                            </td>
                                            <td class="text-sm text-center font-weight-bold align-middle">
                                                <input type="text" class="form-control text-center sisa"
                                                    value="<?= $barang['stok'] ?>" min="0"
                                                    max="<?= $barang['stok'] + $data['pengeluaran'][$i - 1] ?>" />
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn bg-gradient-primary float-end m-2"
                                onclick="return confirm('Apakah anda yakin ingin mengubah data?')">
                                <i class="fa fa-save me-2" aria-hidden="true"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Tabel -->

    <script src="<?= BASEURL ?>/js/custom/pengeluaran.js"></script>

    <?php Get::view('templates/footer', $data) ?>