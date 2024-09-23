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
                                    Edit Prepare</h1>
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
                                    <li class="breadcrumb-item text-muted">Request Prepare</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Edit Prepare</li>
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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-flush">
                            <!--begin::Card header-->
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-outline ki-magnifier fs-2 position-absolute ms-4"></i>
                                        <input type="text" data-kt-ecommerce-order-filter="search"
                                            class="form-control form-control-solid form-control form-control-solid-solid w-250px ps-12"
                                            placeholder="Cari Menu Prepare" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5"
                                        id="kt_ecommerce_report_views_table">
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="text-center min-w-50px">
                                                    No</th>
                                                <th class="min-w-150px">
                                                    Nama Item</th>
                                                <th class="text-center min-w-100px">
                                                    Stok</th>
                                                <th class="text-center min-w-100px">
                                                    Status</th>
                                                <th class="text-center min-w-100px">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            <?php $i = 1; ?>
                                            <?php foreach ($data["menu"] as $menu): ?>
                                                <tr class="fw-bold align-middle">
                                                    <td class="text-center font-weight-bold mb-0 bg-transparent">
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td class="text-center font-weight-bold mb-0 text-wrap">
                                                        <?= $menu['nama']; ?>
                                                        <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']): ?>
                                                            <span class="badge bg-gradient-warning copy-badge ms-1">EXC</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center font-weight-bold mb-0">
                                                        <?php if ($menu['stok']): ?>
                                                            <button type="button"
                                                                class="btn btn-light-success m-0 rounded-pill">
                                                                <?= $menu['stok'] ?>         <?= $menu['satuan'] ?>
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button"
                                                                class="btn btn-light-warning m-0 rounded-pill">
                                                                Tidak Ada
                                                            </button>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-center font-weight-bold mb-0">
                                                        <?php $tersedia = json_decode($menu['tersedia'], true)[$data['user']['outlet_uuid']]; ?>
                                                        <?php if ($tersedia == 'infinite'): ?>
                                                            <span class="badge badge-light-warning">Infinite</span>
                                                        <?php elseif ($tersedia > 0): ?>
                                                            <span class="badge badge-light-success">Tersedia</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-light-danger">Habis</span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="align-middle text-center bg-transparent">
                                                        <a class="btn btn-icon btn-sm btn-light-info btn-md py-1 px-2 mb-0 align-middle tampilModalDetail"
                                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                                            data-id="<?= $menu['id']; ?>">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                        <a href="<?= BASEURL; ?>/menu/update/<?= $menu['id'] ?>"
                                                            class="btn btn-icon btn-sm btn-light-primary btn-md py-1 px-2 mb-0 align-middle tampilModalUbah"
                                                            data-bs-toggle="modal" data-bs-target="#formModal"
                                                            data-id="<?= $menu['id']; ?>">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <a href="<?= BASEURL; ?>/menu/delete/<?= $menu['id'] ?>"
                                                            class="btn btn-icon btn-sm btn-light-dark btn-md py-1 px-2 mb-0 align-middle"
                                                            onclick="return confirm ('Hapus data?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <button
                                                            class="btn btn-icon btn-sm btn-light-warning btn-lg py-1 px-2 mb-0 ms-2 align-middle addRequest"
                                                            data-tersedia="<?= $tersedia ?>" data-id="<?= $menu['id'] ?>"
                                                            data-nama="<?= $menu['nama'] ?>"
                                                            data-stok_id="<?= $menu['stok_id'] ?>">
                                                            <i class="fa fa-angle-double-right"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4" style="max-height: calc(100vh - 100px); overflow-y: auto;">
                        <div class="card card-flush mb-4">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card title-->
                                <h3 class="card-title">
                                    Request Stok Prepare
                                </h3>
                                <!--end::Card title-->
                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <button type="button" class="btn btn-light-danger rounded-pill" id="clear">
                                        Clear
                                    </button>
                                </div>
                            </div>
                            <form action="<?= BASEURL ?>/prepare/editRequest/<?= $data['prepare']['id'] ?>"
                                method="post" id="formPrepare">
                                <?= csrf() ?>
                                <div class="card-body p-3">
                                    <div class="row mb-1">
                                        <div class="input-group mb-3">
                                            <textarea class="form-control form-control-solid" id="deskripsi"
                                                name="deskripsi" placeholder="Deskripsi prepare..."
                                                required><?= $data['prepare']['deskripsi'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="border-top mb-3"></div>

                                    <div class="row mb-1 g-2">
                                        <div class="col-8 py-1 text-sm">
                                            Item
                                        </div>
                                        <div class="col-4 py-1 text-nowrap">
                                            Amount
                                        </div>
                                    </div>

                                    <div id="request-prepare">
                                        <?php foreach (json_decode($data['prepare']['detail_items'], true) as $prepare): ?>
                                            <div class="row g-2" data-id="<?= $prepare['id'] ?>">
                                                <div class="col-8">
                                                    <input type="hidden" name="id[]" value="<?= $prepare['id'] ?>">
                                                    <input type="hidden" name="stok_id[]"
                                                        value="<?= $prepare['stok_id'] ?>">
                                                    <div class="input-group mb-3">
                                                        <button class="btn btn-icon btn-danger m-0 removeList"
                                                            type="button">
                                                            <i class="fa fa-xmark"></i>
                                                        </button>
                                                        <input type="text" class="name form-control form-control-solid ps-3"
                                                            name="item[]" value="<?= $prepare['item'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="number" class="amount form-control form-control-solid"
                                                        name="amount[]" value="1" min="1" max="<?= $prepare['amount'] ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                                <div class="card-footer border-top d-flex justify-content-end p-3">
                                    <button type="submit" class="btn btn-primary mb-0" id="submit-request">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Bahan-Bahan</h1>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped" id="detail_bahan">
                                    <thead>
                                        <tr>
                                            <th class="text-center fw-bold">Nama Bahan</th>
                                            <th class="text-center fw-bold">Jumlah</th>
                                            <th class="text-center fw-bold">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mb-1"
                                    data-bs-dismiss="modal">Close</button>
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
                <script src="<?= BASEURL ?>/js/custom/prepare.js"></script>
                <script src="<?= BASEURL ?>/js/custom/apps/ecommerce/reports/views/views.js"></script>
                <!--end::Custom Javascript-->
                <script src="<?= BASEURL ?>/js/datatables.js"></script>
                <!--end::Javascript-->
                <script src="<?= BASEURL ?>/js/custom/prepare.js"></script>

                <script>
                    var daftar_barang = Array.from(document.getElementById('barang').options)
                        .map(opt => {
                            return {
                                nama: opt.value,
                                satuan: opt.dataset.satuan,
                                jenis: opt.dataset.jenis,
                            }
                        });
                    var barang_all = JSON.parse(`<?= json_encode(array_column($data['barang'], 'nama')) ?>`);

                    $(document).ready(function () {
                        document.querySelectorAll('#request-prepare > *').forEach(row => {
                            selected_item.push({
                                id: row.dataset.id,
                                element: row,
                            });
                        });

                        refreshPrepare();

                        $(".tampilModalDetail").click(function () {
                            const id = $(this).data("id");

                            $.ajax({
                                url: `${BASEURL}/prepare/getubah`,
                                data: { id: id },
                                method: "post",
                                dataType: "json",
                                success: function (result) {
                                    let bahan = JSON.parse(result.bahan);
                                    $('#detailModal .modal-body table tbody').html('');
                                    for (let key in bahan) {
                                        let satuan = daftar_barang.find(item => item.nama == key).satuan;
                                        $(`#detailModal .modal-body table#detail_bahan tbody`).append(`
                            <tr>
                                <td>${key}</td>
                                <td>${bahan[key]}</td>
                                <td>${satuan}</td>
                            </tr>
                        `);
                                    }
                                },
                            });
                        });
                    });
                </script>
                <script src="<?= BASEURL ?>/js/custom/menu.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        setTimeout(() => {
                            document.getElementById("kt_app_sidebar_toggle").click() // auto minimize navbar
                        }, 1000)
                    });
                </script>

                <?php Get::view('templates/footer', $data) ?>