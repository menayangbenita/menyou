<?php Get::view('templates/header', $data) ?>

<?php
$range = (strtotime($data['filter']['to']) - strtotime($data['filter']['from'])) / (60 * 60 * 24);
?>

<style>
    .fixed-column {
        position: -webkit-sticky;
        position: sticky;
        left: 0;
        background-color: white !important;
        z-index: 1;
        /* Tambahkan z-index agar elemen sticky berada di atas elemen lain */
    }


    .table-responsive::-webkit-scrollbar-track {
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .table-responsive::-webkit-scrollbar {
        height: 8px;
        background-color: #F5F5F5;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #9e9a9a9a;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        border-radius: 10px;
        background-color: #9e9a9a;
    }
</style>


<!-- Filter -->
<div class="py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 ">
                <div class="card-body mb-3">
                    <form class="row g-3 align-middle" method="post">
                        <div class="col-md-4">
                            <label for="from" class="form-label">From</label>
                            <input type="date" name="filter[]" value="<?= $data['filter']['from'] ?>" class="datepicker form-control" id="from" />
                        </div>
                        <div class="col-md-4">
                            <label for="to" class="form-label">To</label>
                            <input type="date" name="filter[]" value="<?= $data['filter']['to'] ?>" class="datepicker form-control" id="to" />
                        </div>
                        <div class="col-md-4 pb-0 mt-5 d-flex flex-column">
                            <button type="submit" class="btn bg-gradient-info mb-0"><i class="fa fa-search-plus" aria-hidden="true"></i> Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Filter -->

<!-- Tabel -->
<div id="dataDetailAbsen">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row mb-3">
                        <div class="col-sm-8">
                            <h5 class="card-title">Kelola Stok</h5>
                        </div>
                        <div class="col-sm-4 d-flex justify-content-end">
                            <button class="btn bg-gradient-info mb-0 d-lg-block tombolTambahData" type="button" data-bs-toggle="modal" data-bs-target="#formModal">
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table" style="min-width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder fixed-column">Nama</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Satuan</th>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok Saat Ini</th>
                                    <?php for ($i = 0; $i <= $range; $i++) : ?>
                                        <th colspan="3" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <?= date('d/m/Y', strtotime($data['filter']['from']) + ($i * 60 * 60 * 24)) ?>
                                        </th>
                                    <?php endfor; ?>
                                    <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder fixed-column">
                                        Aksi</th>
                                </tr>
                                <tr>
                                    <?php for ($i = 0; $i <= $range; $i++) : ?>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Masuk</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keluar</th>
                                    <?php endfor; ?>
                                </tr>

                            </thead>

                            <tbody>
                                <?php foreach ($data['barang'] as $barang) : ?>
                                    <?php $lastVal = 0; ?>
                                    <tr align="center">
                                        <td class="text-sm text-center font-weight-bold mb-0 fixed-column"><?= $barang['nama'] ?></td>
                                        <td class="text-sm text-center font-weight-bold mb-0"><?= ucfirst($barang['jenis']) ?></td>
                                        <td class="text-sm text-center font-weight-bold mb-0"><?= $barang['satuan'] ?></td>
                                        <td class="text-sm text-center font-weight-bold mb-0"><?= $barang['stok'] ?></td>
                                        <?php
                                        $riwayat = json_decode($barang['riwayat'], true);

                                        // Add index for each item
                                        $i = 0;
                                        $found = false;
                                        foreach ($riwayat as $key => $val) {
                                            $riwayat[$key]['index'] = $i;
                                            $i++;
                                        }

                                        // Get first value of the range
                                        for ($i = 0; $i <= $range; $i++) {
                                            $key = date('Y-m-d', strtotime($data['filter']['from']) + ($i * 60 * 60 * 24));
                                            if (array_key_exists($key, $riwayat)) {
                                                $found = true;
                                                foreach ($riwayat as $val) {
                                                    if (($riwayat[$key]['index'] - 1) == $val['index']) {
                                                        $lastVal = $val['stok']; break;
                                                    }
                                                }
                                                break;
                                            }
                                        }

                                        // If not, set the lastVal to latest stok value if start day was greater than the first date of data.
                                        if (!$found && !empty($riwayat)) {
                                            $first_date = array_keys($riwayat)[0];
                                            if (strtotime($data['filter']['from']) >= strtotime($first_date)) {
                                                $lastVal = $barang['stok'];
                                            }
                                        }
                                        ?>
                                        <?php for ($i = 0; $i <= $range; $i++) : ?>
                                            <?php $key = date('Y-m-d', strtotime($data['filter']['from']) + ($i * 60 * 60 * 24)) ?>
                                            <?php if (array_key_exists($key, $riwayat)) : ?>
                                                <td class="text-sm text-center font-weight-bold mb-0<?= (floatval($riwayat[$key]['masuk']) > 0) ? ' text-success' : '' ?>">
                                                    <?= $riwayat[$key]['masuk'] ?>
                                                </td>
                                                <td class="text-sm text-center font-weight-bold mb-0"><?= $riwayat[$key]['stok'] ?></td>
                                                <td class="text-sm text-center font-weight-bold mb-0<?= (floatval($riwayat[$key]['keluar']) > 0) ? ' text-danger' : '' ?>">
                                                    <?= $riwayat[$key]['keluar'] ?>
                                                </td>
                                                <?php $lastVal = $riwayat[$key]['stok'] ?>
                                            <?php else : ?>
                                                <td class="text-sm text-center font-weight-bold mb-0">0</td>
                                                <td class="text-sm text-center font-weight-bold mb-0"><?= $lastVal ?></td>
                                                <td class="text-sm text-center font-weight-bold mb-0">0</td>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 fixed-column">
                                            <button type="button" class="btn bg-gradient-primary btn-md  p-1 px-2 mb-0 align-middle acc-button tampilModalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $barang['id'] ?>">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <a href="<?= BASEURL ?>/shipment/delete/<?= $shipment['id'] ?>" class="btn bg-gradient-dark btn-md  p-1 px-2 mb-0 align-middle acc-button" onclick="return confirm('Hapus data?')">
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
<!-- End Tabel -->

<!-- Modal -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Ubah Data</h1>
                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/stok/update" method="post">
                    <?= csrf() ?>
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Barang" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Jenis</label>
                        <select class="form-select" name="jenis" id="jenis" required>
                            <option value="bahan">Bahan</option>
                            <option value="kemasan">Kemasan</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6" id="stok-awal">
                            <label for="stok" class="form-label">Stok Awal</label>
                            <input type="number" class="form-control" name="stok" id="stok" value="0" required>
                        </div>
                        <div class="col-md-6 flex-grow-1">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-select" name="satuan" required>
                                <option value="Kg" selected>Kg</option>
                                <option value="Ons">Ons</option>
                                <option value="Box">Box</option>
                                <option value="Pack">Pack</option>
                                <option value="Liter">Liter</option>
                                <option value="Lusin">Lusin</option>
                                <option value="Gros">Gros</option>
                                <option value="Rim">Rim</option>
                                <option value="Kodi">Kodi</option>
                                <option value="pcs">pcs</option>
                                <option value="meter">meter</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary mb-1" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-gradient-primary mb-1">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const BASEURL = window.location.href;

        $(".tombolTambahData").click(function() {
            $('#modalLabel').html('Tambah Data');
            $("#formModal form").attr("action", `${BASEURL}/insert`);
            $("#formModal form")[0].reset();
            $('#stok-awal').removeClass('d-none');
        });

        $(".tampilModalUbah").click(function() {
            $('#modalLabel').html('Ubah Data');
            $("#formModal form").attr("action", `${BASEURL}/update`);
            $('#stok-awal').addClass('d-none');

            const id = $(this).data("id");

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#satuan').val(data.satuan);
                    $('#jenis').val(data.jenis);
                    $('#riwayat').val(data.riwayat);
                },
            })
        });
    });
</script>

<script src="<?= BASEURL ?>/js/custom/stok.js"></script>

<?php Get::view('templates/footer', $data) ?>