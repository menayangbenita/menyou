
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


<div class="row">
    <div id="pilihan-menu" class="col-lg-6" style="max-height: calc(100vh - 100px); overflow-y: auto;">
        <div class="container-fluid pt-1 mb-4 border-bottom sticky-top bg-gray-100"
            style="white-space: nowrap; overflow-x: auto; z-index: 1;">
            <input type="radio" class="btn-check filter-kategori" data-kategori="all" name="kategori" id="kategori-all"
                checked>
            <label class="btn btn-outline-primary rounded-pill" for="kategori-all">
                All
            </label>
            <?php foreach ($data['kategori'] as $kategori): ?>
                <input type="radio" class="btn-check filter-kategori" data-kategori="<?= strtolower($kategori['nama']) ?>"
                    name="kategori" id="kategori-<?= $kategori['nama'] ?>">
                <label class="btn btn-outline-primary rounded-pill" for="kategori-<?= $kategori['nama'] ?>">
                    <?= $kategori['nama'] ?>
                </label>
            <?php endforeach; ?>
        </div>

        <?php foreach ($data['kategori'] as $kategori): ?>
            <div class="container-fluid mb-3 kategori-menu <?= strtolower($kategori['nama']) ?>">
                <h5 class="mb-4 align-bottom">
                    <svg class="mb-1 me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="32">
                        <path
                            d="M190.58-513.333q-40.385 0-68.41-28.308t-28.025-68.504V-769.42q0-40.385 28.025-68.598 28.025-28.214 68.41-28.214h159.652q39.819 0 68.127 28.214 28.308 28.213 28.308 68.598v159.275q0 40.196-28.308 68.504-28.308 28.308-68.127 28.308H190.58Zm0 419.188q-40.385 0-68.41-28.025t-28.025-68.41v-159.652q0-39.819 28.025-68.127 28.025-28.308 68.41-28.308h159.652q39.819 0 68.127 28.308 28.308 28.308 28.308 68.127v159.652q0 40.385-28.308 68.41t-68.127 28.025H190.58Zm419.565-419.188q-40.196 0-68.504-28.308-28.308-28.308-28.308-68.504V-769.42q0-40.385 28.308-68.598 28.308-28.214 68.504-28.214H769.42q40.385 0 68.598 28.214 28.214 28.213 28.214 68.598v159.275q0 40.196-28.214 68.504-28.213 28.308-68.598 28.308H610.145Zm0 419.188q-40.196 0-68.504-28.025-28.308-28.025-28.308-68.41v-159.652q0-39.819 28.308-68.127 28.308-28.308 68.504-28.308H769.42q40.385 0 68.598 28.308 28.214 28.308 28.214 68.127v159.652q0 40.385-28.214 68.41-28.213 28.025-68.598 28.025H610.145Z" />
                    </svg>
                    <?= $kategori['nama'] ?>
                </h5>
                <div class="row">
                    <?php foreach ($data["menu"] as $menu) : ?>
                        <?php if ($menu['kategori_id'] !== $kategori['id']) continue;?>
                        <?php $tersedia = json_decode($menu['tersedia'], true)[$data['user']['outlet_uuid']]; ?>
                        <div class="col-sm-12 mb-4 menu" 
                            data-tersedia="<?= ($tersedia > 0) ? 'true' : 'false' ?>"
                            data-id="<?= $menu['id'] ?>"
                            data-nama="<?= $menu['nama'] ?>"
                            data-harga="<?= $menu['harga'] ?>"
                        >
                            <button class="card w-100 h-100 animation-card addProductSale p-0">
                                <div class="row w-100 g-0">
                                    <div class="col-md-4" style="min-width: 100px;">
                                        <div class="col-md-12">
                                            <img src="<?= BASEURL ?>/upload/menu/<?= $menu['foto'] != '' ? $menu['foto'] : 'tmp.png' ?>" 
                                                style="min-height: 120px; max-height: 150px; object-fit: cover;" 
                                                class="img-fluid rounded-start p-0 w-100" alt="<?= $menu['nama']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body text-start py-3 text-nowrap h-100">
                                            <h5 class="card-title">
                                                <?= $menu['nama']; ?>
                                                <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']) : ?>
                                                    <span class="badge bg-gradient-warning copy-badge ms-1 text-xs" style="transform: translateY(-1px);">EXC</span>
                                                <?php endif; ?>
                                            </h5>
                                            <p class="card-text mb-0">Rp <?= number_format($menu['harga'], 0, '.', '.') ?></p>
                                            <h6
                                                class="card-text mb-0 text-md text-<?= ($tersedia > 0) ? 'success' : 'danger' ?>">
                                                <?php if ($tersedia == "infinite") : ?>
                                                    Tersedia
                                                <?php elseif ($tersedia > 0) : ?>
                                                    Tersedia <?= $tersedia ?> Porsi
                                                <?php else : ?>
                                                    Habis
                                                <?php endif ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <span class="amount position-absolute bg-gradient-warning text-light d-none">
                                    <b>1</b>
                                </span>
                                <span class="take-away position-absolute bg-gradient-info text-light">
                                    <b></b> <i class="fa fa-right-from-bracket"></i>
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
                <form action="<?= BASEURL ?>/pesanan/update/<?= $data['pesanan']['id'] ?>" method="post">
                    <?= csrf() ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-id-card-alt ps-2"></i>
                        </span>
                        <input type="text" class="form-control ps-2" name="kasir" value="<?= $data['pesanan']['kasir'] ?>" required readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-user ps-2"></i>
                        </span>
                        <input type="text" class="form-control ps-2" name="pelanggan" value="<?= $data['pesanan']['pelanggan'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-phone ps-2"></i>
                        </span>
                        <input type="text" class="form-control ps-2" name="nomor_telp" value="<?= $data['pesanan']['nomor_telp'] ?>" placeholder="08xxx" required>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-3 mt-4">
                        <label class="col-form-label">Daftar Belanja</label>
                        <button type="button" class="btn btn-danger rounded-pill" id="clear">Clear All Items</button>
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
                            <div id="daftar-belanja" class="border-bottom pb-3 mb-2">
                                <?php foreach (json_decode($data['pesanan']['detail_pembayaran'], true) as $item) : ?>
                                    <div class="row g-2"
                                        data-id="<?= $item['id'] ?>"
                                        data-nama="<?= $item['item'] ?>"
                                        data-harga="<?= $data['menu'][array_search($item['id'], array_column($data['menu'], 'id'))]['harga'] ?>"
                                        data-take_away="<?= json_encode($item['take_away']) ?>"
                                    >
                                        <div class="col-5">
                                            <input class="id" type="hidden" name="id[]" value="<?= $item['id'] ?>">
                                            <div class="input-group mb-3">
                                                <button class="btn btn-danger m-0 removeList" type="button">
                                                    <i class="fa fa-xmark"></i>
                                                </button>
                                                <input type="text" class="item form-control ps-3" name="item[]" value="<?= $item['item'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-2 ps-0">
                                            <input type="number" class="amount form-control ps-2" name="amount[]" value="<?= $item['amount'] ?>" min="1">
                                        </div>
                                        <div class="col-3 ps-0">
                                            <div class="input-group mb-3">
                                                <span class="input input-group-text">Rp. </span>
                                                <input type="number" class="subtotal form-control ps-2" name="item_subtotal[]" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-1 ps-2 pt-1">
                                            <input type="hidden" name="take_away[]" value="<?= ($item['take_away']) ?>">
                                            <button type="button" class="tooltips btn py-2 px-3 <?= $item['take_away'] ? "bg-gradient-warning" : "bg-gradient-info" ?>"
                                                data-bs-toggle="tooltip" data-bs-title="<?= $item['take_away'] ? 'Take Away' : 'Dine-In' ?>">
                                                <i class="fa <?= $item['take_away'] ? "fa-right-from-bracket" : "fa-utensils" ?>"></i>
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
                                    <textarea class="form-control" id="note" name="note" placeholder="Keterangan tambahan..."><?= $data['pesanan']['note'] ?></textarea>
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
                                    <span class="input input-group-text" id="button-addon1">Rp. </span>
                                    <input type="number" class="form-control ps-2" id="subtotal" name="subtotal" value="0" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="pajak" class="col-lg-12 col-form-label">
                                    Pajak <span class="badge badge-warning">(<?= $data['pajak'] ?>%)</span>
                                </label>
                                <div class="input-group mb-3">
                                    <span class="input input-group-text" id="button-addon1">Rp. </span>
                                    <input type="number" class="form-control ps-2" id="pajak" name="pajak" value="0" data-pajak="<?= $data['pajak'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="total" class="col-lg-12 col-form-label">Total</label>
                                <div class="input-group mb-3">
                                    <span class="input input-group-text" id="button-addon1">Rp. </span>
                                    <input type="number" class="form-control ps-2"  id="total" name="total" value="0" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pembayaran" class="col-lg-12 col-form-label">Pembayaran</label>
                                <select name="metode_pembayaran" id="pembayaran" class="form-control">
                                    <option value="cash" <?= $data['pesanan']['metode_pembayaran'] == 'cash' ? 'selected' : '' ?>>Cash</option>
                                    <option value="debit" <?= $data['pesanan']['metode_pembayaran'] == 'debit' ? 'selected' : '' ?>>Debit</option>
                                    <option value="kredit" <?= $data['pesanan']['metode_pembayaran'] == 'kredit' ? 'selected' : '' ?>>Kredit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 kode-transaksi" <?= $data['pesanan']['metode_pembayaran'] == 'cash' ? 'style="display: none"' : '' ?>>
                            <label for="kode_transaksi" class="col-lg-12 col-form-label">Kode Transaksi</label>
                            <div class="input-group mb-3">
                                <span class="input input-group-text" id="button-addon1">
                                    <i class="fa fa-lock ps-2"></i>
                                </span>
                                <input type="text" class="form-control ps-2" id="kode_transaksi" name="kode_transaksi" value="<?= $data['pesanan']['kode_transaksi'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="bayar" class="col-lg-12 col-form-label">Bayar</label>
                            <div class="input-group mb-3">
                                <span class="input input-group-text" id="button-addon1">Rp. </span>
                                <input type="number" class="form-control ps-2" id="bayar" name="bayar" value="<?= $data['pesanan']['bayar'] ?>" min="0">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="kembali" class="col-lg-12 col-form-label">Kembalian</label>
                            <div class="input-group mb-3">
                                <span class="input input-group-text" id="button-addon1">Rp. </span>
                                <input type="number" class="form-control ps-2" id="kembali" name="kembali" value="<?= $data['pesanan']['kembali'] ?>" min="0" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row p-2" style="flex-wrap: wrap;">
                        <div class="col-12 col-sm-3 px-1">
                            <button type="button" 
                                class="instant-pay w-100 px-0 text-center btn btn-outline-success rounded-pill"
                                style="white-space: nowrap"
                                data-value="pas">Uang Pas</button>
                        </div>
                        <div class="col-6 col-sm-3 px-1">
                            <button type="button" 
                                class="instant-pay w-100 px-0 text-center btn btn-outline-secondary rounded-pill"
                                style="white-space: nowrap"
                                data-value="10000">Rp. 10.000</button>
                        </div>
                        <div class="col-6 col-sm-3 px-1">
                            <button type="button" 
                                class="instant-pay w-100 px-0 text-center btn btn-outline-secondary rounded-pill"
                                style="white-space: nowrap"
                                data-value="20000">Rp. 20.000</button>
                        </div>
                        <div class="col-6 col-sm-3 px-1">
                            <button type="button" 
                                class="instant-pay w-100 px-0 text-center btn btn-outline-secondary rounded-pill"
                                style="white-space: nowrap"
                                data-value="50000">Rp. 50.000</button>
                        </div>
                        <div class="col-6 col-sm-3 px-1">
                            <button type="button" 
                                class="instant-pay w-100 px-0 text-center btn btn-outline-secondary rounded-pill"
                                style="white-space: nowrap"
                                data-value="100000">Rp. 100.000</button>
                        </div>
                        <div class="col-6 col-sm-3 px-1">
                            <button type="button" 
                                class="instant-pay w-100 px-0 text-center btn btn-outline-secondary rounded-pill"
                                style="white-space: nowrap"
                                data-value="200000">Rp. 200.000</button>
                        </div>
                        <div class="col-6 col-sm-3 px-1">
                            <button type="button" 
                                class="instant-pay w-100 px-0 text-center btn btn-outline-secondary rounded-pill"
                                style="white-space: nowrap"
                                data-value="500000">Rp. 500.000</button>
                        </div>
                    </div>
                    <input type="hidden" name="outlet_uuid" value="<?= $data['pesanan']['outlet_uuid'] ?>">

                    <div class="row mt-2">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="button" class="btn bg-gradient-primary mb-0 submit-form">
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


<script src="<?= BASEURL ?>/js/custom/kasir.js"></script>
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