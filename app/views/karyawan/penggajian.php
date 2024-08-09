<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body mb-3">
                <form class="row g-3 align-middle" method="post">
                    <div class="col-md-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select class="form-select" name="bulan" id="bulan">
                            <?php $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] ?>
                            <?php foreach ($months as $i => $month) : ?>
                                <option value="<?= $i + 1 ?>" <?= ($i == $data['filter']['bulan'] - 1) ? ' selected' : '' ?>>
                                    <?= $month ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select class="form-select" name="tahun" id="tahun">
                            <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++) : ?>
                                <option value="<?= $i ?>" <?= ($i == $data['filter']['tahun']) ? ' selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-2 pb-0 mt-5 d-flex flex-column">
                        <button type="submit" class="btn bg-gradient-primary mb-0 filter "><i class="fa fa-search-plus" aria-hidden="true"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Filter -->

<!-- Tabel -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-secondary pt-0">
                                    Penggajian Bulan <span class="fw-bold"><?= $months[$data['filter']['bulan'] - 1] ?></span>, Tahun <span class="fw-bold"><?= $data['filter']['tahun'] ?></span>
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <table class="table table-bordered align-items-center mb-0" style="width: 100%; border-collapse: collapse;" id="table">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                        No.</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nomor Pengawai</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jabatan</th>
                                    <th colspan="3" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Gaji</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Gaji Total</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                        Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Gaji Pokok</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Bonus</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Potongan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($data['karyawan'] as $karyawan) : ?>
                                    <tr>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            <?= $i++ ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            <?= $karyawan['nik']; ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            <?= $karyawan['nama']; ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            <?= $karyawan['posisi']; ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            Rp <?= number_format($karyawan['gaji_pokok'], 0, '', '.'); ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            Rp <?= number_format($karyawan['total_reward'], 0, '', '.'); ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            Rp <?= number_format($karyawan['total_punishment'], 0, '', '.'); ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            Rp <?= (number_format($karyawan['gaji_total'], 0, '', '.')); ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">
                                            <a href="<?= BASEURL ?>/penggajian/print/<?= $data['filter']['bulan'] ?>/<?= $data['filter']['tahun'] ?>/<?= $karyawan['uuid'] ?>" class="btn bg-gradient-dark rounded-pill btn-icon mb-0">
                                                <i class="fa fa-print"></i>
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
<!-- End Tabel -->


<?php Get::view('templates/footer', $data) ?>