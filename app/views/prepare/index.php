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
                                    Menu Prepare</h1>
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
                                    <li class="breadcrumb-item text-muted">Menu Prepare</li>
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
                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <button class="btn btn-primary mb-0 tombolTambahData" type="button"
                                        data-bs-toggle="modal" data-bs-target="#formModal">
                                        Tambah Data Prepare
                                    </button>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0 search"
                                        iid="kt_ecommerce_report_views_table" style="width: 100%">
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
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($data["menu"] as $menu): ?>
                                                <tr class="fw-bold align-middle">
                                                    <td class="text-center font-weight-bold mb-0 bg-transparent">
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td class="text-start font-weight-bold mb-0 text-wrap">
                                                        <?= $menu['nama']; ?>
                                                        <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']): ?>
                                                            <span class="badge badge-light-warning copy-badge ms-1">EXC</span>
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
                                                        <a class="btn btn-icon btn-light-info btn-sm py-1 px-2 mb-0 align-middle tampilModalDetail"
                                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                                            data-id="<?= $menu['id']; ?>">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                        <a href="<?= BASEURL; ?>/menu/update/<?= $menu['id'] ?>"
                                                            class="btn btn-icon btn-light-primary btn-sm py-1 px-2 mb-0 align-middle tampilModalUbah"
                                                            data-bs-toggle="modal" data-bs-target="#formModal"
                                                            data-id="<?= $menu['id']; ?>">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <a href="<?= BASEURL; ?>/menu/delete/<?= $menu['id'] ?>"
                                                            class="btn btn-icon btn-light-dark btn-sm py-1 px-2 mb-0 align-middle"
                                                            onclick="return confirm ('Hapus data?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <button
                                                            class="btn btn-icon btn-light-warning btn-md py-1 px-2 mb-0 ms-2 align-middle addRequest"
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
                            <form action="<?= BASEURL ?>/prepare/addRequest" method="post" id="formPrepare">
                                <?= csrf() ?>
                                <div class="card-body p-3">
                                    <div class="row mb-1">
                                        <div class="input-group mb-3">
                                            <textarea
                                                class="form-control form-control-solid form-control form-control-solid-solid"
                                                id="deskripsi" name="deskripsi" placeholder="Deskripsi prepare..."
                                                required></textarea>
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

                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end p-3">
                                    <button type="submit" class="btn btn-primary mb-0" id="submit-request">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Modal -->
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
                                <h1 class="mb-3" id="modalLabel">Tambah Data Prepare</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <form action="<?= BASEURL ?>" method="post" enctype="multipart/form-data">
                                <?= csrf() ?>
                                <input type="hidden" name="prepare" value="1">
                                <div class="mb-8 fv-row">
                                    <label for="nama" class="required fs-6 fw-semibold mb-2">Nama Item</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-solid fle" name="nama"
                                            id="nama" placeholder="Cth: Kentang Dadu" oninput="toTitleCase(this)"
                                            required>
                                        <select class="input-group-text position-static text-muted border-0"
                                            name="satuan" id="satuan" required>
                                            <option value="Kg" selected>Kg</option>
                                            <option value="gram">gram</option>
                                            <option value="Ons">Ons</option>
                                            <option value="Box">Box</option>
                                            <option value="Pack">Pack</option>
                                            <option value="Liter">Liter</option>
                                            <option value="Lusin">Lusin</option>
                                            <option value="Gros">Gros</option>
                                            <option value="Rim">Rim</option>
                                            <option value="Kodi">Kodi</option>
                                            <option value="pcs" selected>pcs</option>
                                            <option value="meter">meter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-8 fv-row" id="stok-container">
                                    <label class="required fs-6 fw-semibold mb-2">Stok</label>
                                    <input type="number" class="form-control form-control-solid" name="stok" id="stok"
                                        value="0" required>
                                </div>
                                <div class="mb-8 fv-row">
                                    <div class="d-flex justify-content-between">
                                        <label class="required fs-6 fw-semibold mb-2">Bahan</label>
                                        <button class="btn btn-success p-0 px-2 fs-6" id="addItem"
                                            type="button">+</button>
                                    </div>
                                    <div id="bahan">
                                        <div class="row mb-2">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <button class="btn btn-danger m-0 px-3 removeItem" type="button">
                                                        <i class="fa fa-xmark"></i>
                                                    </button>
                                                    <input type="text"
                                                        class="form-control form-control-solid ps-2 nama-bahan"
                                                        name="nama_bahan[]" placeholder="Nama Bahan" list="barang"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group d-flex">
                                                    <input type="text"
                                                        class="form-control form-control-solid position-static jumlah"
                                                        name="jumlah_bahan[]" placeholder="0">
                                                    <span class="input-group-text position-static satuan">..</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <datalist id="barang">
                                        <?php foreach ($data['barang'] as $barang): ?>
                                            <?php if ($barang['jenis'] != 'bahan')
                                                continue; ?>
                                            <option value="<?= $barang['nama'] ?>" data-id="<?= $barang['id'] ?>"
                                                data-satuan="<?= $barang['satuan'] ?>" data-jenis="<?= $barang['jenis'] ?>">
                                            <?php endforeach; ?>
                                    </datalist>
                                </div>
                                <div class="mb-15 form-check">
                                    <input class="form-check-input" name="exclusive" type="checkbox" id="exclusive"
                                        value="<?= $data['user']['outlet_uuid'] ?>">
                                    <label class="custom-control-label" for="exclusive">Exclusive only for your
                                        outlet</label>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-light mb-1"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary mb-1">Simpan</button>
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
                <script src="<?= BASEURL ?>/js/custom/apps/ecommerce/reports/views/views.js"></script>
                <!--end::Custom Javascript-->
                <!--end::Javascript-->

                <script src="<?= BASEURL ?>/js/datatables.js"></script>

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

                    function toTitleCase(input) {
                        let result = input.value.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1));
                        input.value = result.join(' ');
                    }

                    $(document).ready(function () {
                        let tableNoExport = initDataTables('#table-no-export', false);
                        const BASEURL = `<?= BASEURL ?>`;

                        $('.tombolTambahData').on('click', function () {
                            $('#modalLabel').html('Tambah Data')
                            $('#formModal .modal-footer button[type=submit]').html('Simpan');
                            $("#formModal form").attr("action", `${BASEURL}/prepare/insert`);
                            $("#formModal form")[0].reset();
                            $('#preview').html('');
                            $("#bahan").html(`
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <button class="btn btn-danger m-0 px-3 removeItem" type="button">
                                <i class="fa fa-xmark"></i>
                            </button>
                            <input type="text" class="form-control form-control-solid ps-2 nama-bahan" name="nama_bahan[]" placeholder="Nama Bahan" list="barang" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group d-flex">
                            <input type="text" class="form-control form-control-solid position-static rounded-end-0 jumlah-bahan" name="jumlah_bahan[]" placeholder="0" required>
                            <span class="input-group-text position-static satuan">..</span>
                        </div>
                    </div>
                </div>
            `);
                            $('#stok-container').show();
                            $('#exclusive').prop('checked', false);

                            const nama = document.querySelector('input#nama');
                            nama.onchange = () => {
                                let value = nama.value;
                                let find = barang_all.find(item => item.toLowerCase() === value.toLowerCase());

                                if (value) {
                                    if (find) {
                                        alert(`${find} sudah ada di dalam daftar stok!`)
                                        nama.value = ''
                                    }
                                }
                            };

                            refreshEvent();
                        });

                        $(".tampilModalUbah").click(function () {
                            const id = $(this).data("id");

                            $("#modalLabel").html("Ubah Data");
                            $("#formModal .modal-footer button[type=submit]").html("Ubah Data");
                            $("#formModal form").attr("action", `${BASEURL}/prepare/update/${id}`);
                            $('#stok-container').hide();

                            $.ajax({
                                url: `${BASEURL}/prepare/getubah`,
                                data: { id: id },
                                method: "post",
                                dataType: "json",
                                success: function (data) {
                                    $('#nama').val(data.nama);
                                    $('#exclusive').prop('checked', Boolean(data.outlet_uuid))
                                    if (data.foto !== '')
                                        $('#preview').html(`<img src="${BASEURL.replace('/menu', '')}/upload/menu/${data.foto}" class="w-100">`);
                                    $("#bahan").html('');
                                    let bahan = JSON.parse(data.bahan);
                                    for (let key in bahan)
                                        addList(key, bahan[key], daftar_barang.find(item => item.nama == key).satuan);

                                    refreshEvent();
                                },
                            });
                        });

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
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        setTimeout(() => {
                            document.getElementById("kt_app_sidebar_toggle").click() // auto minimize navbar
                        }, 1000)
                    });
                </script>
                <script src="<?= BASEURL ?>/js/custom/menu.js"></script>
                <script src="<?= BASEURL ?>/js/custom/prepare.js"></script>

                <?php Get::view('templates/footer', $data) ?>