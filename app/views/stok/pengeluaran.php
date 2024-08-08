<?php Get::view('templates/header', $data) ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <?php $formater = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE) ?>
                    <h5 class="card-title text-center mt-2">Pengeluaran Stok Hari Ini, tanggal <?= $formater->format(new DateTime()) ?></h5>
                </div>
                <form class="card-body pt-0" action="<?= BASEURL ?>/stok/updatePengeluaran" method="post">
                    <?= csrf() ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-25">
                                    Nama Barang</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Sisa Stok Sebelumnya</th>
                                <th></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Pengeluaran</th>
                                <th></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Sisa Stok Saat Ini</th>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($data['barang'] as $barang) : ?>
                                    <tr>
                                        <input type="hidden" name="id[]" value="<?= $barang['id'] ?>">
                                        <td class="text-sm text-center font-weight-bold align-middle">
                                            <?= ++$i; ?>
                                        </td>
                                        <td class="text-sm text-center font-weight-bold align-middle">
                                            <?= $barang['nama'] ?>
                                        </td>
                                        <td class="text-sm text-center font-weight-bold align-middle">
                                            <input type="text" class="form-control text-center stok" value="<?= $barang['stok'] + $data['pengeluaran'][$i - 1] ?>" disabled>
                                        </td>
                                        <td class="text-sm text-center font-weight-bold align-middle">
                                            -
                                        </td>
                                        <td class="text-sm text-center font-weight-bold align-middle">
                                            <input type="text" class="form-control text-center pengeluaran" name="pengeluaran[]" value="<?= $data['pengeluaran'][$i - 1] ?>" min="0" max="<?= $barang['stok'] + $data['pengeluaran'][$i - 1] ?>" />
                                        </td>
                                        <td class="text-sm text-center font-weight-bold align-middle">
                                            =
                                        </td>
                                        <td class="text-sm text-center font-weight-bold align-middle">
                                            <input type="text" class="form-control text-center sisa" value="<?= $barang['stok'] ?>" min="0" max="<?= $barang['stok'] + $data['pengeluaran'][$i - 1] ?>" />
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn bg-gradient-primary float-end m-2" onclick="return confirm('Apakah anda yakin ingin mengubah data?')">
                            <i class="fa fa-save me-2" aria-hidden="true"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Tabel -->

<script src="<?= BASEURL ?>/js/custom/pengeluaran.js"></script>

<?php Get::view('templates/footer', $data) ?>