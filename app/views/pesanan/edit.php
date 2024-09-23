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
                        <div class="container-fluid pt-1 mb-4 pb-4 border-bottom sticky-top bg-white"
                            style="white-space: nowrap; overflow-x: auto; z-index: 1;">
                            <input type="radio" class="btn-check filter-kategori" data-kategori="all" name="kategori"
                                id="kategori-all" checked>
                            <label class="btn btn-outline btn-outline-primary btn-active-light-primary rounded-pill"
                                for="kategori-all">
                                All
                            </label>
                            <?php foreach ($data['kategori'] as $kategori): ?>
                                <input type="radio" class="btn-check filter-kategori"
                                    data-kategori="<?= strtolower($kategori['nama']) ?>" name="kategori"
                                    id="kategori-<?= $kategori['nama'] ?>">
                                <label class="btn btn-outline btn-outline-primary btn-active-light-primary  rounded-pill"
                                    for="kategori-<?= $kategori['nama'] ?>">
                                    <?= $kategori['nama'] ?>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <?php foreach ($data['kategori'] as $kategori): ?>
                            <div class="container-fluid mb-3 kategori-menu <?= strtolower($kategori['nama']) ?>">
                                <div class="d-flex align-middle mb-4">
                                    <i class="ki-solid ki-lots-shopping text-primary fs-2x me-2"></i>
                                    <h4 class="mt-1">
                                        <?= $kategori['nama'] ?>
                                    </h4>
                                </div>
                                <div class="row">
                                    <?php foreach ($data["menu"] as $menu): ?>
                                        <?php if ($menu['kategori_id'] !== $kategori['id'])
                                            continue; ?>
                                        <?php $tersedia = json_decode($menu['tersedia'], true)[$data['user']['outlet_uuid']]; ?>
                                        <div class="col-sm-12 mb-4 menu"
                                            data-tersedia="<?= ($tersedia > 0) ? 'true' : 'false' ?>"
                                            data-id="<?= $menu['id'] ?>" data-nama="<?= $menu['nama'] ?>"
                                            data-harga="<?= $menu['harga'] ?>">
                                            <button class="card w-100 h-100 animation-card addProductSale p-0">
                                                <div class="row w-100 g-0">
                                                    <div class="col-md-4" style="min-width: 100px;">
                                                        <div class="col-md-12">
                                                            <img src="<?= BASEURL ?>/upload/menu/<?= $menu['foto'] != '' ? $menu['foto'] : 'tmp.png' ?>"
                                                                style="min-height: 120px; max-height: 150px; object-fit: cover;"
                                                                class="img-fluid rounded-start p-0 w-100"
                                                                alt="<?= $menu['nama']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body text-start py-3 text-nowrap h-100">
                                                            <h5 class="card-title">
                                                                <?= $menu['nama']; ?>
                                                                <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']): ?>
                                                                    <span class="badge btn-light-warning copy-badge ms-1 text-xs"
                                                                        style="transform: translateY(-1px);">EXC</span>
                                                                <?php endif; ?>
                                                            </h5>
                                                            <p class="card-text mb-0">Rp
                                                                <?= number_format($menu['harga'], 0, '.', '.') ?>
                                                            </p>
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
                                                <span class="take-away position-absolute bg-primary">
                                                    <b></b> <i class="fa fa-right-from-bracket text-white"></i>
                                                </span>
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div id="panel-detail" class="col-lg-6">
                        <button id="show-panel" class="btn bg-gradient-success rounded-start-0">
                            <i class="fa fa-angle-right"></i>
                        </button>

                        <div class="card" style="height: calc(100vh - 120px); overflow-y: auto;">
                            <div class="card-body">
                                <form action="<?= BASEURL ?>/pesanan/update/<?= $data['pesanan']['id'] ?>"
                                    method="post">
                                    <?= csrf() ?>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-0" id="basic-addon1">
                                            <i class="fas fa-id-card-alt ps-2"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-solid ps-2" name="kasir"
                                            value="<?= $data['pesanan']['kasir'] ?>" required readonly>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-0" id="basic-addon1">
                                            <i class="fa fa-user ps-2"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-solid ps-2" name="pelanggan"
                                            value="<?= $data['pesanan']['pelanggan'] ?>" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-0" id="basic-addon1">
                                            <i class="fa fa-phone ps-2"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-solid ps-2" name="nomor_telp"
                                            value="<?= $data['pesanan']['nomor_telp'] ?>" placeholder="08xxx" required>
                                    </div>

                                    <div class="d-flex justify-content-between border-top pt-3 my-4">
                                        <label class="col-form-label">Daftar Belanja</label>
                                        <button type="button" class="btn btn-light-danger rounded-pill" id="clear">Clear All
                                            Items</button>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <div style="width: 99%; min-width: 400px;">
                                            <div class="row mb-1 g-2">
                                                <div class="col-5 py-1 d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    Item
                                                </div>
                                                <div class="col-2 py-1 d-flex align-items-center fs-6 fw-semibold mb-2 text-nowrap">
                                                    Amount
                                                </div>
                                                <div class="col-3 py-1 d-flex align-items-center fs-6 fw-semibold mb-2 text-nowrap">
                                                    Subtotal
                                                </div>
                                                <div class="col-1 py-1 d-flex align-items-center fs-6 fw-semibold mb-2 text-nowrap">
                                                    Status
                                                </div>
                                            </div>
                                            <div id="daftar-belanja" class="border-bottom pb-3 mb-2">
                                                <?php foreach (json_decode($data['pesanan']['detail_pembayaran'], true) as $item): ?>
                                                    <div class="row g-2" data-id="<?= $item['id'] ?>"
                                                        data-nama="<?= $item['item'] ?>"
                                                        data-harga="<?= $data['menu'][array_search($item['id'], array_column($data['menu'], 'id'))]['harga'] ?>"
                                                        data-take_away="<?= json_encode($item['take_away']) ?>">
                                                        <div class="col-5">
                                                            <input class="id" type="hidden" name="id[]"
                                                                value="<?= $item['id'] ?>">
                                                            <div class="input-group mb-3">
                                                                <button class="btn btn-icon btn-danger m-0 removeList" type="button">
                                                                    <i class="fa fa-xmark"></i>
                                                                </button>
                                                                <input type="text" class="item form-control form-control-solid ps-3"
                                                                    name="item[]" value="<?= $item['item'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 ps-0">
                                                            <input type="number" class="amount form-control form-control-solid ps-2"
                                                                name="amount[]" value="<?= $item['amount'] ?>" min="1">
                                                        </div>
                                                        <div class="col-3 ps-0">
                                                            <div class="input-group mb-3">
                                                                <span class="input input-group-text border-0">Rp. </span>
                                                                <input type="number" class="subtotal form-control form-control-solid ps-2"
                                                                    name="item_subtotal[]" value="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-1 ps-2">
                                                            <input type="hidden" name="take_away[]"
                                                                value="<?= ($item['take_away']) ?>">
                                                            <button type="button"
                                                                class="tooltips btn btn-icon py-2 px-3 <?= $item['take_away'] ? "btn-light-warning" : "btn-light-primary" ?>"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="<?= $item['take_away'] ? 'Take Away' : 'Dine-In' ?>">
                                                                <i
                                                                    class="fa <?= $item['take_away'] ? "fa-right-from-bracket" : "fa-utensils" ?>"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row border-bottom pb-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="note" class="col-lg-12 col-form-label">Note</label>
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control form-control-solid" id="note" name="note"
                                                        placeholder="Keterangan tambahan..."><?= $data['pesanan']['note'] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
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

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="pajak" class="col-lg-12 col-form-label">
                                                    Pajak <span
                                                        class="badge badge-light-warning">(<?= $data['pajak'] ?>%)</span>
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


                                    <input type="hidden" name="outlet_uuid"
                                        value="<?= $data['pesanan']['outlet_uuid'] ?>">

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


                <script src="<?= BASEURL ?>/js/custom/pesanan.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        document.querySelector('a.nav-link.text-body.p-0').click(); // auto minimize navbar
                    });

                    document.querySelectorAll('#daftar-belanja > *').forEach(row => {
                        let id = row.dataset.id;
                        let nama = row.dataset.nama;
                        let amount = row.querySelector('input.amount').value;
                        let take_away = JSON.parse(row.dataset.take_away);

                        let menu = document.querySelector(`.menu[data-id="${id}"]`);

                        if (take_away) {
                            menu.querySelector('span.take-away b').innerHTML = amount;
                        } else {
                            menu.querySelector('span.amount').classList.remove('d-none');
                            menu.querySelector('span.amount b').innerHTML = amount;
                        }

                        selected_menu.push({
                            nama: nama,
                            take_away: take_away,
                            element: row,
                        });
                    });

                    refreshAmountEvent();
                </script>

                <?php Get::view('templates/footer', $data) ?>