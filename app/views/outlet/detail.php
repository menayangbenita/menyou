<?php Get::view('templates/header', $data) ?>

<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?= BASEURL ?>/upload/outlet/<?= $data['outlet']['foto'] !== '' ? $data['outlet']['foto'] : 'tmp.jpeg' ?>'); background-position-y: 50%;">
    <span class="mask bg-black opacity-3"></span>
</div>
<div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
        <div class="col-auto my-auto">
            <div class="h-100 p-1">
                <h2 class="mb-1 fs-3 fw-bolder d-inline">
                    </i> <?= $data['outlet']['nama'] ?>
                </h2>
                <p class="mb-0 font-weight-bold text-lg">
                    <i class="fa fa-location-dot fs-5 me-1 text-danger"></i> <?= $data['outlet']['alamat'] ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid my-3 py-3">
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky" style="top: 5rem;">
                <div class="card-body d-flex flex-column gap-3">
                    <div class="d-flex justify-content-start align-items-center column-gap-3 border-bottom pb-3">
                        <div>
                            <div class="icon icon-shape bg-gradient-primary shadow border-radius-md d-flex align-items-center justify-content-center">
                                <i class="fa fa-user text-icon text-lg opacity-10 top-0" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div>
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Karyawan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= count($data['karyawan']) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center column-gap-3 border-bottom pb-3">
                        <div>
                            <div class="icon icon-shape bg-gradient-primary shadow border-radius-md d-flex align-items-center justify-content-center">
                                <i class="fa fa-utensils text-icon text-lg opacity-10 top-0" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div>
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Menu</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= count($data['menu']) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center column-gap-3 border-bottom pb-3">
                        <div>
                            <div class="icon icon-shape bg-gradient-primary shadow border-radius-md d-flex align-items-center justify-content-center">
                                <i class="fa fa-inbox text-icon text-lg opacity-10 top-0" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div>
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Stok</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= count($data['barang']) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center column-gap-3 border-bottom pb-3">
                        <div>
                            <div class="icon icon-shape bg-gradient-primary shadow border-radius-md d-flex align-items-center justify-content-center">
                                <i class="fa fa-dollar-sign text-icon text-lg opacity-10 top-0" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div>
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Debit</p>
                                <h5 class="fs-6 font-weight-bolder text-success mb-0">
                                    Rp <?= number_format($data['finance']['masuk'], 0, ',', '.') ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center column-gap-3">
                        <div>
                            <div class="icon icon-shape bg-gradient-primary shadow border-radius-md d-flex align-items-center justify-content-center">
                                <i class="fa fa-credit-card text-icon text-lg opacity-10 top-0" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div>
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kredit</p>
                                <h5 class="fs-6 font-weight-bolder text-danger mb-0">
                                    Rp <?= number_format($data['finance']['keluar'], 0, ',', '.') ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 mt-lg-0 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <h3>Basic Info</h3>
                </div>
                <div class="card-body overflow-auto pt-0">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Nama Cabang</label>
                            <div class="input-group">
                                <input class="form-control" type="text" value="<?= $data['outlet']['nama'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Manager</label>
                            <div class="input-group">
                                <input class="form-control" type="text" value="<?= $data['outlet']['manager'] ?>" placeholder="Tidak Ada" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label class="form-label">Alamat</label>
                            <div class="input-group">
                                <textarea class="form-control" readonly><?= $data['outlet']['alamat'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Kota</label>
                            <div class="input-group">
                                <input class="form-control" type="text" value="<?= $data['outlet']['kota'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Lokasi</label>
                            <div class="input-group">
                                <input class="form-control" type="text" value="<?= $data['outlet']['lokasi'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label class="form-label">No. Telp</label>
                            <div class="input-group">
                                <input class="form-control" type="text" value="<?= $data['outlet']['nomor_telp'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Pajak</label>
                            <div class="input-group">
                                <input class="form-control" type="text" value="<?= $data['outlet']['pajak'] ?>%" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <p class="text-md mb-0">Terdapat <b><?= count($data['karyawan']) ?></b> karyawan saat ini.</p>
                        <a href="<?= BASEURL ?>/karyawan" class="d-block btn bg-gradient-primary mb-0">Manage Karyawan</a>
                    </div>
                    <div class="overflow-x-auto row flex-row flex-nowrap mt-3 py-3 mx-0 border-top">
                        <?php foreach ($data['karyawan'] as $karyawan) : ?>
                            <div class="col-sm-6 col-md-3 ps-0">
                                <a href="<?= BASEURL ?>/karyawan/detail/<?= $karyawan['id'] ?>" class="card card-block bg-light shadow-none card-1 h-100">
                                    <div class="card-body">
                                        <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                            <div class="align-middle mb-3">
                                                <img src="<?= BASEURL ?>/upload/karyawan/<?= !empty($karyawan['foto']) ? $karyawan['foto'] : 'tmp.jpg' ?>" 
                                                    class="avatar avatar-lg shadow-md" style="object-fit: cover;" alt="foto_karyawan">
                                            </div>
                                            <div class="text-center">
                                                <h6 class="text-sm fw-bolder mb-1" style="line-height: 1.2rem;"><?= $karyawan['nama'] ?></h6>
                                                <p class="text-sm text-muted fw-bold mb-2"><?= $karyawan['posisi'] ?></p>
                                            </div>
                                            <div class="text-center font-weight-bold text-sm mb-0">
                                                <?php if ($karyawan['status_karyawan'] == 'Aktif') : ?>
                                                    <span class="badge bg-gradient-success">Aktif</span>
                                                <?php else : ?>
                                                    <span class="badge bg-gradient-secondary">Tidak Aktif</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <p class="text-md mb-0">Terdapat <b><?= count($data['menu']) ?></b> menu tersedia saat ini.</p>
                        <a href="<?= BASEURL ?>/menu" class="d-block btn bg-gradient-primary mb-0">Manage Menu</a>
                    </div>
                    <div class="overflow-x-auto row flex-row flex-nowrap mt-3 py-3 mx-0 border-top">
                        <?php foreach ($data['menu'] as $menu) : ?>
                            <div class="col-sm-6 col-md-3 ps-0">
                                <div class="card card-block bg-light shadow-none card-1">
                                    <div class="d-flex flex-column w-100">
                                        <div class="overflow-hidden rounded-top-4 rounded-bottom-2" style="max-height: 120px !important;">
                                            <img src="<?= BASEURL ?>/upload/menu/<?= $menu['foto'] != '' ? $menu['foto'] : 'tmp.png' ?>" 
                                                style="min-height: 120px; max-height: 150px; object-fit: cover;" 
                                                class="img-fluid rounded-start p-0 w-100" alt="<?= $menu['nama']; ?>">
                                        </div>
                                        <div class="card-body text-start py-3 text-nowrap h-100">
                                            <h6 class="fs-6 fw-bolder mb-0" style="text-overflow: ellipsis; overflow: hidden;">
                                                <?= $menu['nama']; ?>
                                                <?php if ($menu['outlet_uuid'] == $data['user']['outlet_uuid']) : ?>
                                                    <span class="badge bg-gradient-warning ms-1 text-xxs" style="transform: translateY(-2px);">EXC</span>
                                                <?php endif; ?>
                                            </h6>
                                            <p class="text-sm text-muted mb-1"><?= $menu['kategori'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <p class="text-md mb-0">Terdapat <b><?= count($data['barang']) ?></b> jenis barang di dalam stok saat ini.</p>
                        <a href="<?= BASEURL ?>/stok" class="d-block btn bg-gradient-primary mb-0">Manage Stok</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php Get::view('templates/footer', $data) ?>