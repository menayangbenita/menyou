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
                                    <i class="ki-solid ki-package text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Request Prepare</h1>
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
                            <table class="table align-items-center mb-0 search" id="table-prepare" style="width: 100%">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center min-w-50px">
                                            No</th>
                                        <th class="min-w-100px">
                                            Deskripsi</th>
                                        <th class="min-w-100px">
                                            Datetime</th>
                                        <th class="text-center min-w-100px">
                                            Status</th>
                                        <th class="text-end min-w-100px">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data["request_prepare"] as $prepare): ?>
                                        <tr class="fw-bold align-middle">
                                            <td class="text-center">
                                                <?= $i++; ?>
                                            </td>
                                            <td>
                                                <?= $prepare['deskripsi'] ?>
                                            </td>
                                            <td class="fw-bold mb-0">
                                                <?= date('d/m/Y ', strtotime($prepare['tanggal'])) . date('H:i:s', strtotime($prepare['created_at'])) ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (!$prepare['status_order']): ?>
                                                    <button type="button"
                                                        class="btn btn-light-success rounded-pill m-0 tampilModalDetail"
                                                        data-bs-toggle="modal" data-bs-target="#modal"
                                                        data-id="<?= $prepare['id'] ?>">
                                                        Pending
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button"
                                                        class="btn btn-secondary rounded-pill m-0 tampilModalDetail"
                                                        data-bs-toggle="modal" data-bs-target="#modal"
                                                        data-id="<?= $prepare['id'] ?>">
                                                        Selesai
                                                    </button>
                                                <?php endif ?>
                                            </td>
                                            <td class="align-middle text-end">
                                                <?php if (!$prepare['status_order']): ?>
                                                    <a class="btn btn-icon btn-light-warning m-0"
                                                        href="<?= BASEURL; ?>/prepare/invoice/<?= $prepare['uuid'] ?>"
                                                        data-bs-toggle="tooltip" data-bs-title="Cetak Request">
                                                        <i class="ki-solid ki-printer"></i>
                                                    </a>
                                                    <a class="btn btn-icon btn-light-info m-0"
                                                        href="<?= BASEURL; ?>/pesanan/kasir/<?= $prepare['id'] ?>"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit Request">
                                                        <i class="ki-solid ki-pencil"></i>
                                                    </a>
                                                <?php endif ?>
                                                <a class="btn btn-icon btn-light btn-lg"
                                                    href="<?= BASEURL; ?>/prepare/delete/<?= $prepare['id'] ?>"
                                                    data-bs-toggle="tooltip" data-bs-title="Hapus Request"
                                                    onclick="return confirm ('Hapus data?')">
                                                    <i class="ki-solid ki-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail Menu -->
            <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                                <h1 class="mb-3" id="modalLabel">Detail Prepare</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <table class="table table-row-dashed mb-15">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="fw-bold">Nama</th>
                                        <th class="text-center fw-bold">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600"></tbody>
                            </table>
                            <div class="text-center d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary mb-1 me-2"
                                    data-bs-dismiss="modal">Close</button>
                                <form action="<?= BASEURL ?>/prepare/updateStatusRequest" method="post"
                                    style="display: none;">
                                    <?= csrf() ?>
                                    <input type="hidden" name="id" id="id">
                                    <button type="submit" class="btn btn-primary mb-1" data-bs-dismiss="modal"
                                        onclick='return confirm(`Apakah anda yakin ingin mengubah status request menjadi "Selesai"?`)'>
                                        Ubah Status Pesanan
                                    </button>
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
                    let satuan = JSON.parse(`<?= json_encode($data['satuan']) ?>`);

                    $(document).ready(function () {
                        var tablePrepare = initDataTables('#table-prepare', false);
                        const BASEURL = `<?= BASEURL ?>`;

                        $(".tampilModalDetail").click(function () {
                            const id = $(this).data("id");

                            $('.modal-body table tbody').html('');
                            $('.text-center form').hide();

                            $.ajax({
                                url: `${BASEURL}/prepare/getPrepare`,
                                data: { id: id },
                                method: "post",
                                dataType: "json",
                                success: function (data) {
                                    for (let row of JSON.parse(data.detail_items).sort((a, b) => a.item.localeCompare(b.item))) {
                                        $('.modal-body table tbody').append(`
                            <tr>
                                <td>${row.item}</td>
                                <td class="text-center">${row.amount} ${satuan[row.item]}</td>
                            </tr>`
                                        );
                                    }

                                    if (data.status_order == 0) {
                                        $('.text-center form').show();
                                        $('input#id').val(id);
                                    } else {
                                        $('.text-center form').hide();
                                    }
                                },
                            });
                        });
                    });
                </script>


                <?php Get::view('templates/footer', $data) ?>