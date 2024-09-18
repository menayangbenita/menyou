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
                                    Shipment</h1>
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
                                    <li class="breadcrumb-item text-muted">Shipment</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="#" class="btn btn-flex btn-primary fw-bold" data-bs-toggle="modal"
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Stok" />
                            </div>
                            <!--end::Search-->
                            <!--begin::Export buttons-->
                            <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
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
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-0">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                id="kt_ecommerce_report_views_table">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-75px align-middle">
                                            No</th>
                                        <th class="min-w-100px align-middle">
                                            No Faktur</th>
                                        <th class="min-w-125px align-middle">
                                            Tanggal</th>
                                        <th class="min-w-175px align-middle">
                                            Deskripsi</th>
                                        <th class="min-w-150px align-middle">
                                            Total Berat</th>
                                        <th class="min-w-350px align-middle">
                                            Biaya EXW</th>
                                        <th class="min-w-250px align-middle">
                                            Biaya Lainnya</th>
                                        <th class="min-w-150px align-middle">
                                            Diskon</th>
                                        <th class="min-w-150px align-middle">
                                            Total</th>
                                        <th class="min-w-150px align-middle">
                                            Harga All In / Kg</th>
                                        <th class="min-w-150px align-middle">
                                            Supplier</th>
                                        <th class="text-end min-w-150px align-middle">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <?php $i = 1; ?>
                                    <?php foreach ($data["shipment"] as $shipment): ?>
                                        <tr>
                                            <td class="text-start pe-0">
                                                <?= $i++; ?>
                                            </td>
                                            <td class="text-start pe-0">
                                                <?= $shipment['no_faktur'] ?>
                                            </td>
                                            <td class="text-start pe-0">
                                                <?= date('d/m/Y', strtotime($shipment['tanggal'])) ?>
                                            </td>
                                            <td class="text-start pe-0">
                                                <?= $shipment['deskripsi'] ?>
                                            </td>
                                            <td class="text-start pe-0">
                                                <?= $shipment['total_berat'] ?> gram
                                            </td>
                                            <td class="font-weight-bold mb-0">
                                                <?php foreach (json_decode($shipment['detail_barang'], true) as $barang): ?>
                                                    - <?= $barang['nama'] ?>
                                                    <?= $barang['jumlah'] . " " . $data['satuan'][$barang['nama']] ?> : Rp
                                                    <?= number_format($barang['subtotal'], 0, ',', '.') ?> <br>
                                                <?php endforeach; ?>
                                                <span class="text-end text-primary">
                                                    Total: Rp <?= number_format($shipment['total_exw'], 0, ',', '.') ?>
                                                </span>
                                            </td>
                                            <td class="text-start pe-0">
                                                <?php $biaya_lainnya = json_decode($shipment['biaya_lainnya'], true); ?>
                                                <?php if (empty($biaya_lainnya)): ?>
                                                    -
                                                <?php else: ?>
                                                    <?php foreach ($biaya_lainnya as $key => $val): ?>
                                                        - <?= $key ?> : Rp <?= number_format($val, 0, ',', '.') ?> <br>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <span class="text-end text-primary">
                                                    Total: <?= number_format($shipment['total_biaya_lainnya'], 0, ',', '.') ?>
                                                </span>
                                            </td>
                                            <td class="text-start pe-0">
                                                Rp <?= number_format($shipment['diskon'], 0, ',', '.') ?>
                                            </td>
                                            <td class="text-start pe-0">
                                                Rp <?= number_format($shipment['total'], 0, ',', '.') ?>
                                            </td>
                                            <td class="text-start pe-0">
                                                Rp <?= number_format($shipment['harga_all_in'], 0, ',', '.') ?>
                                            </td>
                                            <td class="text-start pe-0">
                                                <?php foreach ($data['supplier'] as $supplier): ?>
                                                    <?= ($supplier['id'] == $shipment['supplier_id']) ? $supplier['nama'] : '' ?>
                                                <?php endforeach; ?>
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
                                                        <a class="menu-link px-3 tampilModalDetail" data-bs-toggle="modal"
                                                            data-bs-target="#detailModal"
                                                            data-id="<?= $shipment['id'] ?>">Lihat Detail</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                            data-bs-target="#formModal"
                                                            data-id="<?= $shipment['id'] ?>">Edit</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="<?= BASEURL ?>/shipment/delete/<?= $shipment['id'] ?>"
                                                            class="menu-link px-3" data-id="<?= $shipment['id']; ?>"
                                                            data-kt-ecommerce-product-filter="delete_row">Hapus</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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

            <!-- Form Modal -->
            <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
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
                                <h1 class="mb-3" id="modalLabel">Tambah Data Shipment</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <form action="<?= BASEURL ?>/shipment/insert" method="post">
                                <?= csrf() ?>
                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">No Faktur</span>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Cth: F0001" name="no_faktur" id="no_faktur" />
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Tanggal</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid ps-12" type="date"
                                                name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" required />
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Supplier</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <select class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true" name="supplier_id" id="supplier_id" required>
                                                <?php foreach ($data['supplier'] as $supplier): ?>
                                                    <option value="<?= $supplier['id'] ?>"><?= $supplier['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8">
                                    <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                                    <textarea class="form-control form-control-solid" name="deskripsi" id="deskripsi"
                                        rows="3" placeholder="Deskripsi shipment" required></textarea>
                                </div>
                                <!--end::Input group-->

                                <div class="row mb-3 border-top pt-3 overflow-x-auto">
                                    <div class="col-md-12">
                                        <table class="w-full table table-responsive mb-4">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="min-w-50px">
                                                        No</th>
                                                    <th class="min-w-150px">
                                                        Nama Barang</th>
                                                    <th class="min-w-150px">
                                                        Jenis</th>
                                                    <th class="min-w-100px">
                                                        Jumlah</th>
                                                    <th class="min-w-100px">
                                                        Satuan</th>
                                                    <th class="min-w-150px">
                                                        Harga Satuan</th>
                                                    <th class="min-w-1500px">
                                                        Subtotal</th>
                                                    <th class="text-center align-middle">
                                                        <button class="btn btn-icon btn-success btn-sm m-0 px-3"
                                                            id="add-detail-barang" type="button">
                                                            <i class="ki-solid ki-abstract-10 pe-0 me-0"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="detail_barang">
                                                <!-- <tr> element on <script> tag bellow -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <datalist id="barang">
                                        <?php foreach ($data['barang'] as $barang): ?>
                                            <?php if ($barang['jenis'] == 'prepare')
                                                continue; ?>
                                            <option value="<?= $barang['nama'] ?>" data-satuan="<?= $barang['satuan'] ?>"
                                                data-jenis="<?= $barang['jenis'] ?>">
                                            <?php endforeach; ?>
                                    </datalist>
                                </div>
                                <div class="row g-9 mb-8 border-top pt-2 mt-4">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Total Berat Shipment</span>
                                        </label>
                                        <!--end::Label-->
                                        <div class="row pe-3">
                                            <div class="col-10">
                                                <input type="number" class="form-control form-control-solid count"
                                                    id="total_berat" placeholder="Cth: 200" name="total_berat" min="0"
                                                    required>
                                            </div>
                                            <div class="col-2 px-0">
                                                <input type="text" class="form-control form-control-solid" value="gram"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Total EXW</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <span class="fs-6 position-absolute mx-4">Rp</span>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input class="form-control form-control-solid ps-12" name="total_exw"
                                                id="total_exw" value="0" required readonly />
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row g-9 mb-3">
                                    <div class="col-md-6 fv-row">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="required fs-6 fw-semibold mb-2">Biaya Lainnya</label>
                                            <button class="btn btn-success p-0 px-2 fs-6" id="add-biaya-lainnya"
                                                type="button">+</button>
                                        </div>
                                        <div id="biaya-lainnya" class="d-flex flex-column gap-2">
                                            <!-- .row element on <script> tag bellow -->
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row d-flex flex-column justify-content-end">
                                        <label class="required fs-6 fw-semibold mb-2" for="total_biaya_lainnya">Total
                                            Biaya
                                            Lainnya</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <span class="fs-6 position-absolute mx-4">Rp</span>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input type="number" class="form-control form-control-solid ps-12"
                                                name="total_biaya_lainnya" id="total_biaya_lainnya" value="0" required
                                                readonly />
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mb-0 d-block text-end" for="diskon">Diskon</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text border-0">Rp</span>
                                            <input type="number" class="form-control form-control-solid ps-2 count"
                                                name="diskon" id="diskon" value="0" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mb-0 d-block text-end" for="total">Total</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text border-0">Rp</span>
                                            <input type="number" class="form-control form-control-solid ps-2"
                                                name="total" id="total" value="0" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-15 fv-row align-items-center">
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mb-0 d-block text-end" for="harga_all_in">Harga
                                            All In
                                            /
                                            kg</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group bg-light">
                                            <span class="input-group-text border-0">Rp</span>
                                            <input type="number" class="form-control form-control-solid ps-2"
                                                name="harga_all_in" id="harga_all_in" value="0" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="button" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                        <span class="indicator-label">Simpan</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Modal -->
            <div class="modal modal-lg fade" id="detailModal" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
                        <div class="modal-body">
                            <!--begin::Heading-->
                            <div class="mb-13 text-center">
                                <!--begin::Title-->
                                <h1 class="mb-3" id="modalLabel">Detail Barang</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <div class="table-responsive mb-13">
                                <table class="table table-bordered" style="border-collapse: collapse !important;"
                                    id="tabel-detail-barang">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-50px">
                                                No</th>
                                            <th class="min-w-150px">
                                                Nama Barang</th>
                                            <th class="min-w-125px">
                                                Jenis</th>
                                            <th class="min-w-100px">
                                                Jumlah</th>
                                            <th class="min-w-150px">
                                                Harga Satuan</th>
                                            <th class="min-w-175px">
                                                Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <td colspan="5" class="text-end text-sm fw-bolder pe-3">Total Biaya EXW :
                                            </td>
                                            <td class="total text-sm text-end fw-bolder"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!--begin::Heading-->
                            <div class="mb-13 text-center">
                                <!--begin::Title-->
                                <h1 class="mb-3" id="modalLabel">Biaya Lainnya</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <div class="table-responsive px-4 mb-15">
                                <table class="table table-striped border-top"
                                    style="border-collapse: collapse !important;" id="tabel-biaya-lainnya">
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end text-sm fw-bolder border-end pe-3">Total
                                                Biaya
                                                Lainnya :</td>
                                            <td class="total text-sm text-end fw-bolder"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!--begin::Actions-->
                            <div class="text-center">
                                <button type="button" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                            <!--end::Actions-->
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

                <script src="<?= BASEURL ?>/js/custom/shipment.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    let message = 'Apakah anda yakin ingin menambah data?';

                    $(function () {
                        const BASEURL = window.location.href;
                        const formater = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        });

                        $('.tombolTambahData').click(function () {
                            message = 'Apakah anda yakin ingin menambah data?';

                            $("#formModal").removeClass("edit");
                            $('#modalLabel').html('Tambah Data')
                            $('.modal-footer button[type=submit]').html('Tambah Data');
                            $(".modal-body form").attr("action", `${BASEURL}/insert`);
                            $(".modal-body form")[0].reset();
                            $("#tanggal").prop('disabled', false);

                            detailBarang.innerHTML = `
                <tr>
                    <td class="text-center align-middle">1</td>
                    <td class="px-1">
                        <input type="text" class="form-control form-control-solid nama" name="nama[]" list="barang" autocomplete="off" placeholder="Nama Barang" required>
                    </td>
                    <td class="px-1">
                        <select class="form-select form-select-solid jenis" name="jenis[]" required disabled>
                            <option value="bahan">Bahan</option>
                            <option value="kemasan">Kemasan</option>
                        </select>
                    </td>
                    <td class="px-1">
                        <input type="number" class="form-control form-control-solid count-sub" name="jumlah[]" placeholder="0" min="0" required>
                    </td>
                    <td class="px-1">
                        <select class="form-select form-select-solid satuan" name="satuan[]" required disabled>
                            <option value="Kg" selected>Kg</option>
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
                    </td>
                    <td class="px-1">
                        <div class="input-group">
                            <span class="input-group-text border-0">Rp</span>
                            <input type="number" class="form-control form-control-solid count-sub" name="harga_satuan[]" placeholder="0" min="0" required>
                        </div>
                    </td>
                    <td class="px-1">
                        <div class="input-group bg-light">
                            <span class="input-group-text border-0">Rp</span>
                            <input type="number" class="form-control form-control-solid" name="subtotal[]" value="0" readonly required>
                        </div>
                    </td>
                    <td class="px-1 align-middle text-center">
                        <button class="btn btn-icon btn-danger btn-sm m-0 px-3 remove-detail-barang" type="button">
                            <i class="fa fa-xmark text-sm"></i>
                        </button>
                    </td>
                </tr>
            `;

                            biayaLainnya.innerHTML = `
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <button class="btn btn-icon btn-danger m-0 px-3 remove-biaya-lainnya" type="button">
                                <i class="fa fa-xmark"></i>
                            </button>
                            <input type="text" class="form-control ps-2" name="nama_biaya_lainnya[]" placeholder="Nama biaya">
                        </div>
                    </div>
                    <div class="col-sm-6 ps-0">
                        <div class="input-group">
                            <span class="input-group-text border-0">Rp</span>
                            <input type="number" class="form-control form-control-solid ps-2 biaya-lainnya" name="biaya_lainnya[]" placeholder="0" min="0">
                        </div>
                    </div>
                </div>
            `;

                            refreshEvent();
                        });

                        $(".tampilModalUbah").click(function () {
                            message = 'Apakah anda yakin ingin mengubah data?';
                            const id = $(this).data("id");

                            $("#formModal").addClass("edit");
                            $("#modalLabel").html("Ubah Data");
                            $(".modal-footer button[type=submit]").html("Ubah Data");
                            $(".modal-body form").attr("action", `${BASEURL}/update/${id}`);
                            $("#tanggal").prop('disabled', true);

                            $.ajax({
                                url: `${BASEURL}/getubah/${id}`,
                                method: "get",
                                dataType: "json",
                                success: function (data) {
                                    // console.log(data);
                                    $("#nama").val(data.nama);
                                    $("#tanggal").val(data.tanggal);
                                    $("#no_faktur").val(data.no_faktur);
                                    $("#supplier_id").val(data.supplier_id);
                                    $("#deskripsi").val(data.deskripsi);
                                    $("#total_berat").val(data.total_berat);

                                    // Detail barang
                                    detailBarang.innerHTML = '';
                                    let detail_barang = JSON.parse(data.detail_barang);
                                    detail_barang.forEach((barang, i) => {
                                        let find = barang_all.find(item => item.nama === barang.nama);
                                        let jenis = find.jenis;
                                        let satuan = find.satuan;

                                        let row = document.createElement('tr');
                                        row.innerHTML = `
                            <td class="text-center align-middle">${i + 1}</td>
                            <td class="px-1">
                                <input type="text" class="form-control form-control-solid nama" name="nama[]" value="${barang.nama}" list="barang" autocomplete="off" placeholder="Nama Barang" required>
                            </td>
                            <td class="px-1">
                                <select class="form-select form-select-solid jenis" name="jenis[]" required disabled>
                                    <option value="bahan"${jenis == 'bahan' ? ' selected' : ''}>Bahan</option>
                                    <option value="kemasan"${jenis == 'kemasan' ? ' selected' : ''}>Kemasan</option>
                                </select>
                            </td>
                            <td class="px-1">
                                <input type="number" class="form-control form-control-solid count-sub" name="jumlah[]" value="${barang.jumlah}" placeholder="0" min="0" required>
                            </td>
                            <td class="px-1">
                                <select class="form-select form-select-solid satuan" name="satuan[]" required disabled>
                                    <option value="Kg"${satuan == 'Kg' ? ' selected' : ''}>Kg</option>
                                    <option value="Ons"${satuan == 'Ons' ? ' selected' : ''}>Ons</option>
                                    <option value="Box"${satuan == 'Box' ? ' selected' : ''}>Box</option>
                                    <option value="Pack"${satuan == 'Pack' ? ' selected' : ''}>Pack</option>
                                    <option value="Liter"${satuan == 'Liter' ? ' selected' : ''}>Liter</option>
                                    <option value="Lusin"${satuan == 'Lusin' ? ' selected' : ''}>Lusin</option>
                                    <option value="Gros"${satuan == 'Gros' ? ' selected' : ''}>Gros</option>
                                    <option value="Rim"${satuan == 'Rim' ? ' selected' : ''}>Rim</option>
                                    <option value="Kodi"${satuan == 'Kodi' ? ' selected' : ''}>Kodi</option>
                                    <option value="pcs"${satuan == 'pcs' ? ' selected' : ''}>pcs</option>
                                    <option value="meter"${satuan == 'meter' ? ' selected' : ''}>meter</option>
                                </select>
                            </td>
                            <td class="px-1">
                                <div class="input-group">
                                    <span class="input-group-text border-0">Rp</span>
                                    <input type="number" class="form-control form-control-solid count-sub" name="harga_satuan[]" value="${barang.harga_satuan}" placeholder="0" min="0" required>
                                </div>
                            </td>
                            <td class="px-1">
                                <div class="input-group bg-light">
                                    <span class="input-group-text border-0">Rp</span>
                                    <input type="number" class="form-control form-control-solid" name="subtotal[]" value="${barang.subtotal}" readonly required>
                                </div>
                            </td>
                            <td class="px-1 align-middle text-center">
                                <button class="btn btn-icon btn-danger btn-sm m-0 px-3 remove-detail-barang" type="button">
                                    <i class="fa fa-xmark text-sm"></i>
                                </button>
                            </td>
                        `;
                                        detailBarang.appendChild(row);
                                    });
                                    $("#total_exw").val(data.total_exw);

                                    // Detail biaya lainnya
                                    let biaya_lainnya = JSON.parse(data.biaya_lainnya);
                                    biayaLainnya.innerHTML = '';

                                    for (let key in biaya_lainnya) {
                                        let biaya = document.createElement('div');
                                        biaya.setAttribute('class', 'row');
                                        biaya.innerHTML = `
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <button class="btn btn-icon btn-danger m-0 px-3 remove-biaya-lainnya" type="button">
                                        <i class="fa fa-xmark"></i>
                                    </button>
                                    <input type="text" class="form-control form-control-solid ps-2" name="nama_biaya_lainnya[]" value=${key} placeholder="Nama biaya">
                                </div>
                            </div>
                            <div class="col-sm-6 ps-0">
                                <div class="input-group">
                                    <span class="input-group-text border-0">Rp</span>
                                    <input type="number" class="form-control form-control-solid ps-2 biaya-lainnya" name="biaya_lainnya[]" value=${biaya_lainnya[key]} placeholder="0" min="0">
                                </div>
                            </div>
                        `;
                                        biayaLainnya.appendChild(biaya);
                                    }

                                    $("#total_biaya_lainnya").val(data.total_biaya_lainnya);
                                    $("#diskon").val(data.diskon);
                                    $("#total").val(data.total);
                                    $("#harga_all_in").val(data.harga_all_in);

                                    refreshEvent();
                                },
                            });
                        });



                        $(".tampilModalDetail").click(function () {
                            const id = $(this).data("id");

                            $("#tabel-detail-barang tbody").html('');
                            $("#tabel-biaya-lainnya tbody").html('');
                            $("#tabel-biaya-lainnya").hide();

                            $.ajax({
                                url: `${BASEURL}/getubah/${id}`,
                                method: "get",
                                dataType: "json",
                                success: function (data) {
                                    // console.log(data);
                                    let detail_barang = JSON.parse(data.detail_barang);
                                    detail_barang.forEach((barang, i) => {
                                        let detail = barang_all.find(item => item.nama === barang.nama);

                                        $("#tabel-detail-barang tbody").append(`
                            <tr>
                                <td class="text-sm text-center">${i + 1}</td>
                                <td class="text-sm text-start">${barang.nama}</td>
                                <td class="text-sm text-center">${detail.jenis}</td>
                                <td class="text-sm text-center">${barang.jumlah} ${detail.satuan}</td>
                                <td class="text-sm text-center">${formater.format(barang.harga_satuan).replace(',00', '')}</td>
                                <td class="text-sm text-end fw-bold">${formater.format(barang.subtotal).replace(',00', '')}</td>
                            </tr>
                        `);
                                    });
                                    $('#tabel-detail-barang .total').html(formater.format(data.total_exw).replace(',00', ''))

                                    if (data.biaya_lainnya !== '{}') {
                                        let biaya_lainnya = JSON.parse(data.biaya_lainnya);

                                        $("#tabel-biaya-lainnya").show();
                                        let i = 1;
                                        for (let nama in biaya_lainnya) {
                                            $("#tabel-biaya-lainnya tbody").append(`
                                <tr>
                                    <td class="text-sm text-center">${i++}</td>
                                    <td class="text-sm text-start">${nama}</td>
                                    <td class="text-sm text-end fw-bold">${formater.format(biaya_lainnya[nama]).replace(',00', '')}</td>
                                </tr>
                            `);
                                        }
                                        $('#tabel-biaya-lainnya .total').html(formater.format(data.total_biaya_lainnya).replace(',00', ''))
                                    }
                                },
                            });
                        });
                    });
                </script>

                <?php Get::view('templates/footer', $data) ?>