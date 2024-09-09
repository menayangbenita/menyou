<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-space-between py-2">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-pesanan-tab" data-bs-toggle="pill"
                                    href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan"
                                    aria-selected="true">Pesanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-prepare-tab" data-bs-toggle="pill"
                                    href="#v-pills-prepare" role="tab" aria-controls="v-pills-prepare"
                                    aria-selected="false">Pesanan Prepare</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row justify-space-between py-2">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-pesanan" role="tabpanel"
                            aria-labelledby="v-pills-pesanan-tab">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0 search" id="table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Pelanggan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nomor Telp</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Detail Pesanan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data["pembayaran"] as $pembayaran): ?>
                                            <tr>
                                                <td class="text-sm text-center font-weight-bold mb-0">
                                                    <?= $i++; ?>
                                                </td>
                                                <td class="text-sm text-center font-weight-bold mb-0">
                                                    <?= $pembayaran['pelanggan']; ?>
                                                </td>
                                                <td class="text-sm text-center font-weight-bold mb-0">
                                                    <?= $pembayaran['nomor_telp']; ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a class="btn bg-gradient-info rounded-pill tampilModalUbah m-0"
                                                        data-bs-toggle="modal" data-bs-target="#modal"
                                                        data-id="<?= $pembayaran['id']; ?>">
                                                        <i class="bi bi-search"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php if (!$pembayaran['status_order']): ?>
                                                        <a class="btn btn-success rounded-pill m-0"
                                                            href="<?= BASEURL ?>/pesanan/updateStatusPesanan/<?= $pembayaran['id'] ?>"
                                                            onclick="return confirm(`Apakah anda yakin ingin mengubah status pesanan?`)">
                                                            Pending
                                                        </a>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-secondary rounded-pill m-0">
                                                            Selesai
                                                        </button>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-sm text-center font-weight-bold mb-0">
                                                    <?= date('d/m/Y ', strtotime($pembayaran['tanggal'])) . date('H:i:s', strtotime($pembayaran['created_at'])) ?>
                                                </td>
                                                <td class="align-middle text-end">
                                                    <?php if (!$pembayaran['status_order']): ?>
                                                        <a class="btn bg-gradient-warning rounded-pill m-0"
                                                            href="<?= BASEURL; ?>/pesanan/invoice/<?= $pembayaran['uuid'] ?>"
                                                            data-bs-toggle="tooltip" data-bs-title="Cetak Pesanan">
                                                            <i class="bi bi-printer-fill"></i>
                                                        </a>
                                                        <a class="btn bg-gradient-info rounded-pill m-0"
                                                            href="<?= BASEURL; ?>/pesanan/kasir/<?= $pembayaran['id'] ?>"
                                                            data-bs-toggle="tooltip" data-bs-title="Edit Pesanan">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn bg-gradient-secondary rounded-pill m-0"
                                                            href="<?= BASEURL; ?>/pesanan/invoice/<?= $pembayaran['uuid'] ?>"
                                                            data-bs-toggle="tooltip" data-bs-title="Cetak Invoice">
                                                            <i class="bi bi-card-list"></i>
                                                        </a>
                                                    <?php endif ?>
                                                    <a class="btn bg-gradient-dark rounded-pill m-0"
                                                        href="<?= BASEURL; ?>/pesanan/delete/<?= $pembayaran['id'] ?>"
                                                        data-bs-toggle="tooltip" data-bs-title="Hapus Pesanan"
                                                        onclick="return confirm ('Hapus data?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-prepare" role="tabpanel"
                            aria-labelledby="v-pills-prepare-tab">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0 search" id="table-prepare"
                                    style="width: 100% !important">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Detail Pesanan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data["pembayaran"] as $pembayaran): ?>
                                            <tr>
                                                <td class="text-sm text-center font-weight-bold mb-0">
                                                    <?= $i++; ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a class="btn bg-gradient-info rounded-pill tampilModalUbah m-0"
                                                        data-bs-toggle="modal" data-bs-target="#modal"
                                                        data-id="<?= $pembayaran['id']; ?>">
                                                        <i class="bi bi-search"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php if (!$pembayaran['status_order']): ?>
                                                        <a class="btn btn-success rounded-pill m-0"
                                                            href="<?= BASEURL ?>/pesanan/updateStatusPesanan/<?= $pembayaran['id'] ?>"
                                                            onclick="return confirm(`Apakah anda yakin ingin mengubah status pesanan?`)">
                                                            Pending
                                                        </a>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-secondary rounded-pill m-0">
                                                            Selesai
                                                        </button>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-sm text-center font-weight-bold mb-0">
                                                    <?= date('d/m/Y ', strtotime($pembayaran['tanggal'])) . date('H:i:s', strtotime($pembayaran['created_at'])) ?>
                                                </td>
                                                <td class="align-middle text-end">
                                                    <?php if (!$pembayaran['status_order']): ?>
                                                        <a class="btn bg-gradient-warning rounded-pill m-0"
                                                            href="<?= BASEURL; ?>/pesanan/invoice/<?= $pembayaran['uuid'] ?>"
                                                            data-bs-toggle="tooltip" data-bs-title="Cetak Pesanan">
                                                            <i class="bi bi-printer-fill"></i>
                                                        </a>
                                                        <a class="btn bg-gradient-info rounded-pill m-0"
                                                            href="<?= BASEURL; ?>/pesanan/kasir/<?= $pembayaran['id'] ?>"
                                                            data-bs-toggle="tooltip" data-bs-title="Edit Pesanan">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn bg-gradient-secondary rounded-pill m-0"
                                                            href="<?= BASEURL; ?>/pesanan/invoice/<?= $pembayaran['uuid'] ?>"
                                                            data-bs-toggle="tooltip" data-bs-title="Cetak Invoice">
                                                            <i class="bi bi-card-list"></i>
                                                        </a>
                                                    <?php endif ?>
                                                    <a class="btn bg-gradient-dark rounded-pill m-0"
                                                        href="<?= BASEURL; ?>/pesanan/delete/<?= $pembayaran['id'] ?>"
                                                        data-bs-toggle="tooltip" data-bs-title="Hapus Pesanan"
                                                        onclick="return confirm ('Hapus data?')">
                                                        <i class="bi bi-trash"></i>
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
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Detail Pesanan</h1>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center fw-bold">Nama</th>
                            <th class="text-center fw-bold">Jumlah</th>
                            <th class="text-center fw-bold">Take Away</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="form-group">
                    <label for="note" class="col-lg-12 col-form-label">Note</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="note" placeholder="Tidak ada keterangan tambahan"
                            disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-1" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL; ?>/js/datatables.js"></script>

<script>
    $(function () {
        const BASEURL = window.location.href;
        // console.log(BASEURL);

        $(".tampilModalUbah").click(function () {
            const id = $(this).data("id");

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: { id: id },
                method: "post",
                dataType: "json",
                success: function (data) {
                    $('.modal-body table tbody').html('');
                    for (let row of JSON.parse(data.detail_pembayaran).sort((a, b) => a.item.localeCompare(b.item))) {
                        $('.modal-body table tbody').append(`
                            <tr>
                                <td>${row.item}</td>
                                <td>${row.amount}</td>
                                <td>${row.take_away ? 'Yes' : 'No'}</td>
                            </tr>`
                        );
                    }
                    $('#note').html(data.note);
                },
            })
        })
    });
</script>

<?php Get::view('templates/footer', $data) ?>