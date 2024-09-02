<?php Get::view('templates/header', $data) ?>

<style>
    .card-img-top {
        object-fit: cover;
        height: 150px;
        width: 100%;
    }

    #show-panel {
        display: none;
        position: fixed;
        left: 0;
        bottom: 8px;
        z-index: 3;
    }

    #show-panel i {
        font-size: 1.8rem;
        transition: transform 0.3s ease;
    }

    @media (max-width: 992px) {
        #panel-detail {
            position: fixed;
            top: 80px;
            right: 100vw;
            z-index: 2;
            transition: right 0.3s ease;
        }

        #panel-detail.active {
            right: 0;
        }

        #show-panel {
            display: block;
        }

        #panel-detail.active #show-panel i {
            transform: rotate(180deg);
        }
    }

    .menu .amount {
        top: 8px;
        right: 8px;
        border-radius: 16px;
        padding: 4px 12px;
        font-size: 14px;
    }

    .menu .take-away {
        bottom: 0;
        right: 0;
        border-top-left-radius: 16px;
        padding: 8px 12px 8px 16px;
        font-size: 14px;
        pointer-events: fill;
    }

    .menu .take-away i {
        transition: transform 0.3s ease;
    }

    .menu .take-away:hover i {
        transform: scale(1.2);
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

                <div class="row">
                    <div id="pilihan-menu" class="col-lg-6" style="max-height: calc(100vh - 100px); overflow-y: auto;">
                        <div class="container-fluid pt-1 mb-4 border-bottom sticky-top bg-white"
                            style="white-space: nowrap; overflow-x: auto; z-index: 1;">
                            <input type="radio" class="btn-check filter-kategori" data-kategori="all" name="kategori"
                                id="kategori-all" checked>
                            <label class="btn btn-outline btn-outline-primary btn-active-light-primary rounded-pill" for="kategori-all">
                                All
                            </label>
                            <?php foreach ($data['kategori'] as $kategori): ?>
                                <input type="radio" class="btn-check filter-kategori"
                                    data-kategori="<?= strtolower($kategori['nama']) ?>" name="kategori"
                                    id="kategori-<?= $kategori['nama'] ?>">
                                <label class="btn btn-outline btn-outline-primary btn-active-light-primary  rounded-pill" for="kategori-<?= $kategori['nama'] ?>">
                                    <?= $kategori['nama'] ?>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <?php foreach ($data['kategori'] as $kategori): ?>
                            <div class="container-fluid mb-3 kategori-menu <?= strtolower($kategori['nama']) ?>">
                                <h4 class="mb-4 align-middle">
                                    <i class="ki-solid ki-lots-shopping text-primary fs-2x me-1"></i>
                                    <?= $kategori['nama'] ?>
                                </h4>
                                <div class="row">
                                    <?php foreach ($data["menu"] as $menu): ?>
                                        <?php if ($menu['kategori_id'] !== $kategori['id'])
                                            continue; ?>
                                        <?php $tersedia = json_decode($menu['tersedia'], true)[$data['user']['outlet_uuid']]; ?>
                                        <div class="col-sm-12 mb-4 menu"
                                            data-tersedia="<?= ($tersedia > 0) ? 'true' : 'false' ?>"
                                            data-id="<?= $menu['id'] ?>" data-nama="<?= $menu['nama'] ?>"
                                            data-harga="<?= $menu['harga'] ?>">
                                            <button
                                                class="card w-100 h-100 animation-card addProductSale overflow-hidden position-relative p-0">
                                                <div class="row w-100 g-0">
                                                    <div class="col-sm-4 mw-100">
                                                        <div class="col-md-12">
                                                            <img src="<?= BASEURL ?>/upload/menu/<?= $menu['foto'] != '' ? $menu['foto'] : 'tmp.png' ?>"
                                                                style="min-height: 120px; max-height: 150px; object-fit: cover;"
                                                                class="img-fluid rounded-start p-0 w-100"
                                                                alt="<?= $menu['nama']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="card-body text-start py-3 text-nowrap h-100">
                                                            <h5 class="card-title">
                                                                <?= $menu['nama']; ?>
                                                                <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']): ?>
                                                                    <span class="badge badge-light-warning copy-badge ms-1 text-xs"
                                                                        style="transform: translateY(-1px);">EXC</span>
                                                                <?php endif; ?>
                                                            </h5>
                                                            <p class="card-text mb-4">Rp
                                                                <?= number_format($menu['harga'], 0, '.', '.') ?></p>
                                                            <h6
                                                                class="card-text mb-0 text-md text-<?= ($tersedia > 0) ? 'success' : 'danger' ?>">
                                                                <?php if ($tersedia == "infinite"): ?>
                                                                    Tersedia
                                                                <?php elseif ($tersedia > 0): ?>
                                                                    Tersedia <?= $tersedia ?> Porsi
                                                                <?php else: ?>
                                                                    Habis
                                                                <?php endif ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="amount position-absolute badge-light-warning d-none">
                                                    <b>1</b>
                                                </span>
                                                <span class="take-away position-absolute bg-primary text-light">
                                                    <b></b> <i class="fa fa-right-from-bracket text-white"></i>
                                                </span>
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div id="panel-detail" class="col-lg-6" style="height: calc(100vh - 100px);">
                        <button id="show-panel" class="btn bg-gradient-success rounded-start-0">
                            <i class="fa fa-angle-right"></i>
                        </button>

                        <div class="card" style="height: 100%; overflow-y: auto;">
                            <div class="card-body">
                                <form action="<?= BASEURL ?>/pesanan/insert" method="post">
                                    <?= csrf() ?>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-0" id="basic-addon1">
                                            <i class="fas fa-id-card-alt ps-2"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-solid ps-2" name="kasir"
                                            value="<?= $data['user']['username'] ?>" required readonly>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-0" id="basic-addon1">
                                            <i class="fa fa-user ps-2"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-solid ps-2" name="pelanggan" value="Customer"
                                            required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-0" id="basic-addon1">
                                            <i class="fa fa-phone ps-2"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-solid ps-2" name="nomor_telp" value=""
                                            placeholder="08xxx" required>
                                    </div>

                                    <div class="d-flex justify-content-between border-top pt-3 my-4">
                                        <label class="col-form-label">Daftar Belanja</label>
                                        <button type="button" class="btn btn-danger rounded-pill" id="clear">Clear All
                                            Items</button>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <div style="width: 99%; min-width: 400px;">
                                            <div class="row mb-1 g-2">
                                                <div class="col-5 py-1 text-sm">
                                                    Item
                                                </div>
                                                <div class="col-2 py-1 text-sm text-nowrap">
                                                    Amount
                                                </div>
                                                <div class="col-3 py-1 text-sm text-nowrap">
                                                    Subtotal
                                                </div>
                                                <div class="col-1 py-1 text-sm text-nowrap">
                                                    Status
                                                </div>
                                            </div>
                                            <div id="daftar-belanja" class="border-bottom pb-3 mb-2"></div>
                                        </div>
                                    </div>

                                    <div class="row border-bottom pb-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="note" class="col-lg-12 col-form-label">Note</label>
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control form-control-solid" id="note" name="note"
                                                        placeholder="Keterangan tambahan..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="subtotal" class="col-lg-12 col-form-label">Subtotal</label>
                                                <div class="input-group mb-3">
                                                    <span class="input input-group-text border-0" id="button-addon1">Rp. </span>
                                                    <input type="number" class="form-control form-control-solid ps-2" id="subtotal"
                                                        name="subtotal" value="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pajak" class="col-lg-12 col-form-label">
                                                    Pajak <span class="badge badge-warning">(
                                                        <?= $data['pajak'] ?>%)
                                                    </span>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <span class="input input-group-text border-0" id="button-addon1">Rp. </span>
                                                    <input type="number" class="form-control form-control-solid ps-2" id="pajak"
                                                        name="pajak" value="0" data-pajak="<?= $data['pajak'] ?>"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="total" class="col-lg-12 col-form-label">Total</label>
                                                <div class="input-group mb-3">
                                                    <span class="input input-group-text border-0" id="button-addon1">Rp. </span>
                                                    <input type="number" class="form-control form-control-solid ps-2" id="total"
                                                        name="total" value="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="pembayaran"
                                                    class="col-lg-12 col-form-label required fs-6 fw-semibold">Pembayaran</label>
                                                <select name="metode_pembayaran" id="pembayaran" class="form-select form-select-solid">
                                                    <option value="cash">Cash</option>
                                                    <option value="debit">Debit</option>
                                                    <option value="kredit">Kredit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 kode-transaksi" style="display: none;">
                                            <label for="kode_transaksi" class="col-lg-12 col-form-label required fs-6 fw-semibold">Kode
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

                                    <div class="row mb-4">
                                        <div class="col-lg-6">
                                            <label for="bayar" class="col-lg-12 col-form-label required fs-6 fw-semibold">Bayar</label>
                                            <div class="input-group mb-3">
                                                <span class="input input-group-text border-0" id="button-addon1">Rp. </span>
                                                <input type="number" class="form-control form-control-solid ps-2" id="bayar" name="bayar"
                                                    value="0" min="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="kembali" class="col-lg-12 col-form-label required fs-6 fw-semibold">Kembalian</label>
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
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-outline-success btn-active-light-success rounded-pill"
                                                style="white-space: nowrap" data-value="pas">Uang Pas</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1 mb-3">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-active-light-secondary rounded-pill"
                                                style="white-space: nowrap" data-value="10000">Rp. 10.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1 mb-3">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-active-light-secondary rounded-pill"
                                                style="white-space: nowrap" data-value="20000">Rp. 20.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1 mb-3">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-active-light-secondary rounded-pill"
                                                style="white-space: nowrap" data-value="50000">Rp. 50.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1 mb-3">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-active-light-secondary rounded-pill"
                                                style="white-space: nowrap" data-value="100000">Rp. 100.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1 mb-3">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-active-light-secondary rounded-pill"
                                                style="white-space: nowrap" data-value="200000">Rp. 200.000</button>
                                        </div>
                                        <div class="col-6 col-sm-3 px-1 mb-3">
                                            <button type="button"
                                                class="instant-pay w-100 px-0 text-center btn btn-outline btn-active-light-secondary rounded-pill"
                                                style="white-space: nowrap" data-value="500000">Rp. 500.000</button>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary mb-0 submit-form">
                                                <i class="fa fa-save me-2"></i>
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- <div class="modal fade" id="myCalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Customer baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></button>
            </div>
            <div class="container">
                <input type="text" class="display" />
                <div class="buttons">
                    <button class="operator" data-value="AC">AC</button>
                    <button class="operator" data-value="DEL">DEL</button>
                    <button class="operator" data-value="%">%</button>
                    <button class="operator" data-value="/">/</button>
                    <button data-value="7">7</button>
                    <button data-value="8">8</button>
                    <button data-value="9">9</button>
                    <button class="operator" data-value="*">*</button>
                    <button data-value="4">4</button>
                    <button data-value="5">5</button>
                    <button data-value="6">6</button>
                    <button class="operator" data-value="-">-</button>
                    <button data-value="1">1</button>
                    <button data-value="2">2</button>
                    <button data-value="3">3</button>
                    <button class="operator" data-value="+">+</button>
                    <button data-value="0">0</button>
                    <button data-value="00">00</button>
                    <button data-value=".">.</button>
                    <button class="operator" data-value="=">=</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        setTimeout(() => {
                            document.getElementById("kt_app_sidebar_toggle").click() // auto minimize navbar
                        }, 1000)
                    });
                </script>
                <script src="<?= BASEURL ?>/js/custom/kasir.js"></script>

                <?php Get::view('templates/footer', $data) ?>