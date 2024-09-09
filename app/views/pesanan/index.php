<?php Get::view('templates/header', $data) ?>

<script src="<?= BASEURL ?>/js/jquery-1.10.2.js"></script>

<style>
    textarea::placeholder {
        font-weight: normal !important;
    }
</style>

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
                                    <i class="ki-solid ki-basket text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Pesanan</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Penjualan</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Pesanan</li>
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Pesanan" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <a href="<?= BASEURL ?>/pesanan/add" class="btn btn-primary">Tambah Pesanan</a>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
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
                                    <th class="min-w-50px align-middle">Nama Pelanggan</th>
                                    <th class="min-w-75px align-middle">Nomor Telepon</th>
                                    <th class="min-w-150px align-middle">Datetime</th>
                                    <th class="text-center min-w-100px align-middle">Status</th>
                                    <th class="text-end min-w-70px align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data["pembayaran"] as $pembayaran): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $pembayaran['id']; ?>" />
                                            </div>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $pembayaran['pelanggan'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span><?= $pembayaran['nomor_telp'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span
                                                class="fw-bold"><?= date('d/m/Y ', strtotime($pembayaran['tanggal'])) . date('H:i:s', strtotime($pembayaran['created_at'])) ?></span>
                                        </td>
                                        <td class="text-center pe-0">
                                            <?php if ($pembayaran['status_order'] == 0): ?>
                                                <button type="button"
                                                    class="btn btn-light-dark rounded-pill m-0 tampilModalForm"
                                                    data-bs-toggle="modal" data-bs-target="#modal"
                                                    data-id="<?= $pembayaran['id'] ?>" data-status="0">
                                                    Pending
                                                </button>
                                            <?php elseif ($pembayaran['status_order'] == 1): ?>
                                                <button type="button"
                                                    class="btn btn-light-danger rounded-pill m-0 tampilModalForm"
                                                    data-bs-toggle="modal" data-bs-target="#modal"
                                                    data-id="<?= $pembayaran['id'] ?>" data-status="1">
                                                    Belum Bayar
                                                </button>
                                            <?php else: ?>
                                                <button type="button"
                                                    class="btn btn-light-success rounded-pill m-0 tampilModalForm"
                                                    data-bs-toggle="modal" data-bs-target="#modal"
                                                    data-id="<?= $pembayaran['id'] ?>" data-status="2">
                                                    Lunas
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
                                                <?php if ($pembayaran['status_order'] == 0): ?>
                                                    <div class="menu-item px-3">
                                                        <a href="<?= BASEURL; ?>/pesanan/invoice/<?= $pembayaran['uuid'] ?>"
                                                            class="menu-link px-3">
                                                            Cetak</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="<?= BASEURL; ?>/pesanan/edit/<?= $pembayaran['id'] ?>"
                                                            class="menu-link px-3 tampilModalUbah">
                                                            Edit Pesanan</a>
                                                    </div>
                                                <?php elseif ($pembayaran['status_order'] != 1): ?>
                                                    <div class="menu-item px-3">
                                                        <a href="<?= BASEURL; ?>/pesanan/invoice/<?= $pembayaran['uuid'] ?>"
                                                            class="menu-link px-3">
                                                            Cetak Invoice</a>
                                                    </div>
                                                <?php endif ?>
                                                <div class="menu-item px-3">
                                                    <a href="<?= BASEURL; ?>/pesanan/delete/<?= $pembayaran['id'] ?>"
                                                        class="menu-link px-3"
                                                        data-kt-ecommerce-product-filter="delete_row">Hapus</a>
                                                </div>
                                                <!--end::Menu item-->
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

            <!-- Modal -->
            <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650">
                    <div class="modal-content rounded">
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="ki-outline ki-cross fs-1"></i>
                            </div>
                        </div>
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <div class="mb-13 text-center">
                                <!--begin::Title-->
                                <h1 class="modal-title" id="modalLabel">Detail Pesanan</h1>
                                <!--end::Title-->
                            </div>
                            <table class="table table-row-dashed table-row-gray-300 gy-5">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="fw-bold ps-2" style="width: 30%;">Nama</th>
                                        <th class="fw-bold" style="width: 10%;">Keterangan</th>
                                        <th class="text-center fw-bold" style="width: 10%;">Jumlah</th>
                                        <th class="text-end fw-bold subtotal  pe-2" style="display: none;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <div class="form-group">
                                <label for="note" class="col-lg-12 col-form-label">Note</label>
                                <div class="input-group mb-3">
                                    <textarea class="form-control form-control-solid fw-bold" id="note"
                                        placeholder="Tidak ada keterangan tambahan" disabled></textarea>
                                </div>
                            </div>

                            <!-- Form Pembayaran -->
                            <div id="form-pembayaran" style="display: none;">
                                <form action="<?= BASEURL ?>/pesanan/ubahStatusPesanan" method="post">

                                    <?= csrf() ?>
                                    <input type="hidden" name="id" id="id">

                                    <div class="row mb-5">
                                        <div class="col-lg-6 fv-row">
                                            <div class="form-group">
                                                <label for="pembayaran"
                                                    class="required mb-2 col-lg-12 col-form-label">Pembayaran</label>
                                                <select name="metode_pembayaran" id="pembayaran" class="form-select form-select-solid">
                                                    <option value="cash">Cash</option>
                                                    <option value="debit">Debit</option>
                                                    <option value="kredit">Kredit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 fv-row kode-transaksi" style="display: none;">
                                            <label for="kode_transaksi" class="required mb-2 col-lg-12 col-form-label">Kode
                                                Transaksi</label>
                                            <div class="input-group mb-3">
                                                <span class="input input-group-text border-0" id="button-addon1">
                                                    <i class="fa fa-lock ps-2"></i>
                                                </span>
                                                <input type="text" class="form-control form-control-solid ps-2" id="kode_transaksi"
                                                    name="kode_transaksi" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-lg-6 fv-row">
                                            <label for="bayar" class="required mb-2 col-lg-12 col-form-label">Bayar</label>
                                            <div class="input-group mb-3">
                                                <span class="input input-group-text border-0" id="button-addon1">Rp. </span>
                                                <input type="number" class="form-control form-control-solid ps-2" id="bayar" name="bayar"
                                                    value="0" min="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 fv-row">
                                            <label for="kembali" class="mb-2 col-lg-12 col-form-label">Kembalian</label>
                                            <div class="input-group mb-3">
                                                <span class="input input-group-text border-0" id="button-addon1">Rp. </span>
                                                <input type="number" class="form-control form-control-solid ps-2" id="kembali"
                                                    name="kembali" value="0" min="0" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-2" style="flex-wrap: wrap;">
                                        <div class="col-12 col-sm-3 px-1 mb-3">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-success rounded-pill"
                                                style="white-space: nowrap" data-value="pas">Uang Pas</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-default rounded-pill"
                                                style="white-space: nowrap" data-value="10000">Rp. 10.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-default rounded-pill"
                                                style="white-space: nowrap" data-value="20000">Rp. 20.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-default rounded-pill"
                                                style="white-space: nowrap" data-value="50000">Rp. 50.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-default rounded-pill"
                                                style="white-space: nowrap" data-value="100000">Rp. 100.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-default rounded-pill"
                                                style="white-space: nowrap" data-value="200000">Rp. 200.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-default rounded-pill"
                                                style="white-space: nowrap" data-value="500000">Rp. 500.000</button>
                                        </div>
                                    </div>
                            </div>
                            <div class="text-center mt-15">
                                <button type="button" class="btn btn-secondary mb-1"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary mb-1 submit">Submit</button>
                            </div>
                            </form>
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
                    const hargaMenu = JSON.parse(`<?= json_encode(array_combine(array_column($data['menu'], 'nama'), array_column($data['menu'], 'harga'))) ?>`);
                    const formater = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });


                    $(document).ready(function () {
                        const tablePesanan = initDataTables('#table-pesanan', false);
                        const BASEURL = `<?= BASEURL ?>`;

                        const container = $("#form-pembayaran");
                        const form = $('#modal form');
                        const submitButton = $('#modal button.submit');
                        const subtotal = $('th.subtotal');
                        const bayar = document.getElementById('bayar');
                        const kembali = document.getElementById('kembali');
                        const paymentMethodSelect = document.getElementById('pembayaran');
                        const kode_transaksi = document.querySelector('.kode-transaksi');
                        const noteContainer = document.getElementById('note').closest('.form-group');
                        const besarPajak = parseInt(<?= $data['pajak'] ?>);
                        const instantPayButtons = document.querySelectorAll('.instant-pay');
                        let total = 0;

                        $(".tampilModalForm").click(function () {
                            const id = $(this).data("id");
                            const status_order = $(this).data("status");

                            total = 0;
                            bayar.value = 0;
                            kembali.value = 0;
                            $('.modal-body table tbody').html('');

                            $.ajax({
                                url: `${BASEURL}/pesanan/getubah`,
                                data: { id: id },
                                method: "post",
                                dataType: "json",
                                success: function (data) {
                                    console.log(data);
                                    $('#note').html(data.note);
                                    $('#id').val(data.id);
                                    $('#modal').removeClass('modal-lg');

                                    for (let row of JSON.parse(data.detail_pembayaran).sort((a, b) => a.item.localeCompare(b.item))) {
                                        let subtotal = parseInt(row.amount) * hargaMenu[row.item];

                                        $('#modal table tbody').append(`
                            <tr class="fw-bold">
                                <td class="ps-2">${row.item}</td>
                                <td class="text-start">${row.take_away ? 'Take Away' : 'Dine-in'}</td>
                                <td class="text-center">${row.amount}</td>
                                ${data.status_order != 0 ? `<td class="text-end pe-2">${formater.format(subtotal).replace(',00', '')}</td>` : ""}
                            </tr>`
                                        );

                                        total += subtotal;
                                    }

                                    if (data.status_order != 0) {
                                        $('#modal').addClass('modal-lg');

                                        let pajak = total * (besarPajak / 100);
                                        total += pajak;

                                        $('#modal table tbody').append(`
                            <tr class="bg-gray-100 align-middle">
                                <td colspan="3" class="text-end fw-bolder pe-3">Total</td>
                                <td class="text-end fw-bold align-items-start flex-column pe-2">
                                    ${formater.format(total).replace(',00', '')} <br>
                                    <span class="fs-7 text-warning fw-bold ms-2">+ pajak ${besarPajak}% (${formater.format(pajak).replace(',00', '')})</span>
                                </td>
                            </tr>`
                                        );
                                    }

                                    subtotal.show();
                                    container.hide();
                                    noteContainer.classList.remove('d-none');

                                    if (data.status_order == 0) {
                                        form.attr('action', `${BASEURL}/pesanan/updateStatusPesanan`);
                                        subtotal.hide();
                                        submitButton.show().text('Ubah Status Pesanan')
                                            .off().on('click', (e) => {
                                                if (confirm('Apakah anda yakin ingin mengubah status pesanan? (*pesanan tidak akan bisa diedit dan stok bahan akan dikurangi)'))
                                                    form.submit();
                                            });
                                    } else if (data.status_order == 1) {
                                        form.attr('action', `${BASEURL}/pesanan/submitPembayaran`);
                                        container.show()
                                        submitButton.show().text('Submit')
                                            .off().on('click', (e) => {
                                                if (parseInt(bayar.value) >= total) {
                                                    if (confirm('Apakah anda yakin ingin mengubah status pesanan?')) form.submit();
                                                } else {
                                                    alert('Silahkan cek kembali!');
                                                    bayar.value = 0;
                                                    kembali.value = 0;
                                                }
                                            });
                                    } else {
                                        noteContainer.classList.add('d-none');
                                        submitButton.hide().off();
                                    }
                                },
                            });
                        });

                        // Pembayaran
                        function countReturnPrice(pay) {
                            bayar.value = pay;
                            let returnPrice = parseInt(bayar.value) - parseInt(total);
                            kembali.value = returnPrice;
                        }

                        paymentMethodSelect.addEventListener('change', () => {
                            switch (paymentMethodSelect.value) {
                                case 'debit':
                                case 'kredit':
                                    kode_transaksi.style.display = 'block';
                                    break;
                                default:
                                    kode_transaksi.style.display = 'none';
                                    break;
                            }
                        });

                        bayar.addEventListener('input', () => {
                            if (bayar.value == 0) {
                                kembali.value = 0;
                            } else {
                                countReturnPrice(bayar.value);
                            }
                        });

                        instantPayButtons.forEach(btn => {
                            btn.addEventListener('click', () => {
                                let val = btn.dataset.value;
                                if (val == 'pas') {
                                    countReturnPrice(total);
                                } else {
                                    countReturnPrice(val);
                                }
                            });
                        });

                    });
                </script>

                <?php Get::view('templates/footer', $data) ?>