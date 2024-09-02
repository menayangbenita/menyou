<?php require_once "templates/header.php" ?>

<style>
    .img-menu {
        object-fit: cover;
        width: 50px;
        height: 50px;
    }
</style>
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 gx-xl-10">
                    <!--begin::Col-->
                    <div class="col-xxl-4 mb-md-5 mb-xl-10">
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10">
                            <!--begin::Col-->
                            <div class="col-md-12 col-lg-6 col-xl-12">
                                <div class="card card-bordered">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="symbol symbol-55px me-8">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="ki-solid ki-wallet text-primary fs-1"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fs-5 fw-bold pb-2">Total Pendapatan</span>
                                                <!--begin::Info-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Currency-->
                                                    <span
                                                        class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Rp</span>
                                                    <!--end::Currency-->
                                                    <!--begin::Amount-->
                                                    <span
                                                        class="fs-2x fw-bold text-gray-900 me-2 lh-1 ls-n2"><?= number_format($data['pendapatanBulanIni'], 0, '.', '.') ?></span>
                                                    <!--end::Amount-->
                                                    <!--begin::Badge-->
                                                    <?php
                                                    $banding = $data['pendapatanKemarin'] > 0 ? ($data['pendapatanHariIni'] - $data['pendapatanKemarin']) / $data['pendapatanKemarin'] * 100 : 100;
                                                    $banding = round($banding, 2);
                                                    ?>
                                                    <?php if ($banding > 0): ?>
                                                        <span class="badge badge-light-success fs-base">
                                                            <i
                                                                class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i><?= $banding ?>%</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-light-danger fs-base">
                                                            <i
                                                                class="ki-outline ki-arrow-down fs-5 text-danger ms-n1"></i><?= $banding ?>%</span>
                                                    <?php endif; ?>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-12 col-lg-6 col-xl-12">
                                <div class="card card-bordered">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="symbol symbol-55px me-8">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="ki-solid ki-lots-shopping text-primary fs-1"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fs-5 fw-bold pb-2">Total Produk</span>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="fs-2x fw-bold text-gray-900 me-2 lh-1 ls-n2"><?= $data['jmlMenu'] ?></span>
                                                    <span
                                                        class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">produk</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-12 col-lg-6 col-xl-12">
                                <div class="card card-bordered">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="symbol symbol-55px me-8">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="ki-solid ki-profile-user text-primary fs-1"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fs-5 fw-bold pb-2">Total Karyawan</span>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="fs-2x fw-bold text-gray-900 me-2 lh-1 ls-n2"><?= $data['jmlKaryawan'] ?></span>
                                                    <span
                                                        class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">karyawan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-12 col-lg-6 col-xl-12">
                                <div class="card card-bordered">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="symbol symbol-55px me-8">
                                                <span class="symbol-label bg-light-primary">
                                                    <i class="ki-solid ki-logistic text-primary fs-1"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fs-5 fw-bold pb-2">Total Supplier</span>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="fs-2x fw-bold text-gray-900 me-2 lh-1 ls-n2"><?= $data['jmlSupplier'] ?></span>
                                                    <span
                                                        class="fs-4 fw-semibold text-gray-500 ms-1 align-self-start">supplier</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-8 mb-5 mb-xl-10">
                        <!--begin::Table Widget 5-->
                        <div class="card card-flush h-xl-100">
                            <!--begin::Card header-->
                            <div class="card-header pt-7">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="symbol symbol-55px me-8">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-solid ki-graph-2 text-primary fs-1"></i>
                                        </span>
                                    </div>
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800 pb-1">Penjualan Terbaik</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Produk dengan penjualan
                                            terbaik</span>
                                    </h3>
                                </div>
                                <!--begin::Actions-->
                                <div class="card-toolbar">
                                    <!--begin::Filters-->
                                    <div class="d-flex flex-stack flex-wrap gap-4">
                                        <!--begin::Destination-->
                                        <div class="d-flex align-items-center fw-bold">
                                            <!--begin::Label-->
                                            <div class="text-muted fs-7 me-2">Kategori</div>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            
                                            <select
                                                class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto"
                                                data-control="select2" data-hide-search="true"
                                                data-dropdown-css-class="w-150px" data-placeholder="Select an option"
                                                data-kt-ecommerce-product-filter="filter_kategori">
                                                <option></option>
                                                <option value="lihat" selected="selected">Lihat Semua</option>
                                                <?php foreach ($data['kategori'] as $kategori): ?>
                                                    <option value="<?= $kategori['nama'] ?>"> <?= $kategori['nama'] ?></option>
                                                <?php endforeach ?>
                                            </select>

                                            <!--end::Select-->
                                        </div>
                                        <!--end::Destination-->
                                    </div>
                                    <!--begin::Filters-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-3"
                                    id="kt_ecommerce_products_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center pe-3 min-w-50px">No.</th>
                                            <th class="min-w-70px">Gambar</th>
                                            <th class="text-start pe-3 min-w-150px">Menu</th>
                                            <th class="text-start pe-3 min-w-100px">Kategori</th>
                                            <th class="text-start pe-3 min-w-100px">Terjual</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <?php $i = 1 ?>
                                        <?php foreach ($data["menu"] as $menu): ?>
                                            <tr <?= ($menu['outlet_uuid'] == $data['user']['outlet_uuid']) ? 'class="bg-primary-subtle"' : '' ?>>
                                                <!--begin::Product ID-->
                                                <td class="text-center"><?= $i++ ?></td>
                                                <!--end::Product ID-->
                                                <!--begin::Item-->
                                                <td>
                                                    <img src="<?= BASEURL; ?>/upload/menu/<?= $menu['foto'] != '' ? $menu['foto'] : 'tmp.png' ?>"
                                                        class="w-50px rounded img-fluid img-menu" alt="" />
                                                </td>
                                                <!--end::Item-->
                                                <!--begin::Product ID-->
                                                <td class="text-start"><a href="apps/ecommerce/catalog/edit-product.html"
                                                        class="text-gray-900 text-hover-primary"><?= $menu['nama'] ?>
                                                        <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']): ?>
                                                            <span class="badge badge-primary copy-badge ms-1">EXC</span>
                                                        <?php endif; ?></a></td>
                                                <!--end::Product ID-->
                                                <!--begin::Date added-->
                                                <td class="text-start" data-order="<?= $menu['kategori'] ?>" data-value="<?= $menu['kategori'] ?>">
                                                    <?= $menu['kategori'] ?>
                                                </td>
                                                <!--end::Date added-->
                                                <!--begin::Date added-->
                                                <td class="text-start"><?= $menu['kategori'] ?></td>
                                                <!--end::Date added-->
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Table Widget 5-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5 mb-xl-0">
                        <!--begin::Chart widget 3-->
                        <div class="card card-flush overflow-hidden h-md-100">
                            <div class="card-header pt-5">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="symbol symbol-55px me-5">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-solid ki-parcel text-primary fs-1"></i>
                                        </span>
                                    </div>
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800 pb-1">Stok Tersedia</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Bahan baku dan kemasan
                                            makanan</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table id="example" class="table align-middle table-row-dashed fs-6 gy-3"
                                        style="width:100%">
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="text-start min-w-100px">Nama</th>
                                                <th class="text-center min-w-125px">Jenis Barang</th>
                                                <th class="text-center min-w-100px">Satuan Barang</th>
                                                <th class="text-center min-w-50px">Stok saat ini</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-bold text-gray-600">
                                            <?php foreach ($data['barang'] as $barang): ?>
                                                <?php $lastVal = 0; ?>
                                                <tr>
                                                    <td class="text-start text-gray-900 text-hover-primary">
                                                        <?= ucfirst($barang['nama']) ?>
                                                    </td>
                                                    <td class="text-center"><?= ucfirst($barang['jenis']) ?>
                                                    </td>
                                                    <td class="text-center"><?= $barang['satuan'] ?></td>
                                                    <td class="text-center fw-bolder <?php
                                                    if ($barang['satuan'] == 'Liter') {
                                                        if ($barang['stok'] < 60) {
                                                            echo 'text-danger';
                                                        }
                                                    } else if ($barang['satuan'] == 'Kg') {
                                                        if ($barang['stok'] < 20) {
                                                            echo 'text-danger';
                                                        }
                                                    } else if ($barang['satuan'] == 'pcs') {
                                                        if ($barang['stok'] < 100) {
                                                            echo 'text-danger';
                                                        }
                                                    } else if ($barang['satuan'] == 'Pack') {
                                                        if ($barang['stok'] < 10) {
                                                            echo 'text-danger';
                                                        }
                                                    }
                                                    ?> fs-6">
                                                        <?= $barang['stok'] ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        </tfoot>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Chart widget 3-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
    </div>
</div>
<script src="<?= BASEURL ?>/plugins/global/plugins.bundle.js"></script>
<script src="<?= BASEURL ?>/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="<?= BASEURL ?>/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="<?= BASEURL ?>/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="<?= BASEURL ?>/js/custom/apps/ecommerce/catalog/products.js"></script>
<script src="<?= BASEURL ?>/js/widgets.bundle.js"></script>
<script src="<?= BASEURL ?>/js/custom/widgets.js"></script>
<script src="<?= BASEURL ?>/js/custom/apps/chat/chat.js"></script>
<script src="<?= BASEURL ?>/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="<?= BASEURL ?>/js/custom/utilities/modals/create-campaign.js"></script>
<script src="<?= BASEURL ?>/js/custom/utilities/modals/users-search.js"></script>
<script src="<?= BASEURL ?>/js\widgets.bundle.js"></script>
<!-- js datatable start-->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.colVis.min.js"></script>
<script>
    new DataTable('#example', {
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'print', 'pdf']
            }
        }
    });
</script>
<!-- js datatable end-->

<?php require_once "templates/footer.php" ?>