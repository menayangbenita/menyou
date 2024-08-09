<?php Get::view('templates/header', $data) ?>

<?php 
$kuartal_option = [
    '1' => 'Kuartal 1 | Januari - Maret',
    '2' => 'Kuartal 2 | April - Juni',
    '3' => 'Kuartal 3 | Juli - September',
    '4' => 'Kuartal 4 | Oktober - Desember',
];

$bulan = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
];

$saldo = 0;
$pemasukan = 0;
$pengeluaran = 0;

foreach ($data['finance'] as $finance) {
    if ($finance['kategori'] == 'masuk') {
        $pemasukan += $finance['jumlah'];
    } else {
        $pengeluaran += $finance['jumlah'];
    }
}
?>

<style>
    .badge.copy-badge {
        background-color: #5bc0de;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .badge.copy-badge:hover {
        background-color: #2a6496;
        color: #000;
    }
</style>

<div class="mb-2">
    <form method="post">
        <div class="row align-items-center">
            <div class="col-md-6 mt-3">
                <h1>Finance</h1>
            </div>
            <div class="col-md-6 row">
                <div class="col-4">
                    <label for="tahun" class="form-label">Pilih Tahun</label>
                    <select class="form-select" name="tahun" id="tahun">
                        <?php $currentYear = date('Y');
                        for ($i = $currentYear - 5; $i <= $currentYear; $i++) : ?>
                            <option value='<?= $i ?>' <?= ($i == $data['tahun']) ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="kuartal" class="form-label">Pilih Kuartal</label>
                    <select class="form-select" name="kuartal" id="kuartal">
                        <?php foreach ($kuartal_option as $key => $opt) : ?>
                            <option value="<?= $key ?>" <?= ($key == $data['kuartal']) ? 'selected' : '' ?>>
                                <?= $opt ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-2 d-flex flex align-items-end justify-content-center">
                    <button type="submit" class="btn bg-gradient-primary m-0 px-4 filter">
                        <i class="fa fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="col-2 d-flex flex align-items-end justify-content-center">
                    <button type="reset" class="btn bg-gradient-primary m-0 px-4 filter" onclick="window.location.href = '<?= BASEURL ?>/finance'">
                        <i class="fa fa-regular fa-circle-xmark"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="row mb-4">
    <div class="col-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pemasukan</p>
                    <h5 class="font-weight-bolder text-success mb-0">
                        Rp <?= number_format($pemasukan, 0, ',', '.') ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengeluaran</p>
                    <h5 class="font-weight-bolder text-danger mb-0">
                        Rp <?= number_format($pengeluaran, 0, ',', '.') ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-7">
                        <h2 class="mb-0"><?= $data['tahun'] ?></h2>
                        <h5 class="fw-medium"><?= $kuartal_option[$data['kuartal']] ?></h5>
                    </div>

                    <div class="col-lg-6 col-5 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary ms-auto tombolTambahData" data-bs-toggle="modal" data-bs-target="#formModal">
                        Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body pb-3">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered table-sm" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanggal</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kode</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No Akun</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Deskripsi</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Debit</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kredit</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Saldo</th>
                                <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($data['finance'] as $finance) : ?>
                                <tr>
                                    <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                        <?= $i++ ?>
                                    </td>

                                    <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                        <?= date('d', strtotime($finance['tanggal'])) ?> 
                                        <?= $bulan[date('n', strtotime($finance['tanggal'])) - 1]?> 
                                        <?= date('Y', strtotime($finance['tanggal'])) ?>
                                    </td>

                                    <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                        <a class="badge bg-gradient-<?= ($finance['kategori'] == 'masuk') ? 'success' : 'danger' ?> copy-badge">
                                            <span><?= $finance['kode'] ?></span>
                                            <i class="bi bi-bookmark-x-fill"></i>
                                        </a>
                                    </td>

                                    <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                        <?= $finance['no_akun'] ?>
                                    </td>

                                    <td class="align-middle text-sm text-start font-weight-bold mb-0">
                                        <?= $finance['deskripsi'] ?>
                                    </td>

                                    <td class="align-middle text-sm text-end font-weight-bold mb-0 px-2">
                                       <?= ($finance['kategori'] == 'masuk') ? 'Rp ' . number_format($finance['jumlah'], 0, ',', '.') : '' ?>
                                    </td>

                                    <td class="align-middle text-sm text-end font-weight-bold mb-0 px-2">
                                        <?= ($finance['kategori'] == 'keluar') ? 'Rp ' . number_format($finance['jumlah'], 0, ',', '.') : '' ?>
                                    </td>

                                    <?php 
                                        if ($finance['kategori'] == 'masuk') {
                                            $saldo += $finance['jumlah'];
                                        } else {
                                            $saldo -= $finance['jumlah'];
                                        }
                                    ?>
                                    <td class="align-middle text-sm text-end font-weight-bold mb-0 px-2">
                                        Rp <?= number_format($saldo, 0, ',', '.') ?>    
                                    </td>

                                    <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                        <button type="button" class="btn bg-gradient-primary btn-md p-1 px-2 mb-0 align-middle acc-button tampilModalUbah" 
                                            data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $finance['id'] ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="<?= BASEURL ?>/finance/delete/<?= $finance['id'] ?>" 
                                            class="btn bg-gradient-dark btn-md p-1 px-2 mb-0 align-middle acc-button" 
                                            onclick="return confirm('Hapus data?')">
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


<!-- modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></i></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL ?>/finance/insert" method="post" enctype="multipart/form-data">
                    <?= csrf() ?>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="tanggal" class="col-form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" placeholder="Tanggal">
                    </div>
                    <div class="form-group">
                        <label for="no_akun" class="col-form-label">No Akun</label>
                        <input type="text" class="form-control" name="no_akun" id="no_akun" list="akuntansi" autocomplete="off" placeholder="No Akun">
                        <datalist id="akuntansi">
                            <?php foreach ($data['akuntansi'] as $nomor) : ?>
                                <option value="<?= $nomor['akun'] ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-form-label">Kategori</label>
                        <div class="px-3 row">
                            <div class="form-check col-auto">
                                <input type="radio" class="form-check-input" name="kategori" id="masuk" value="masuk">
                                <label class="form-check-label" for="masuk">Pemasukan</label>
                            </div>
                            <div class="form-check col-auto">
                                <input type="radio" class="form-check-input" name="kategori" id="keluar" value="keluar">
                                <label class="form-check-label" for="keluar">Pengeluaran</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nominal" class="col-form-label">Nominal / Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Rp. xxx">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(function() {
        const BASEURL = window.location.href;
        const no_akun = Array.from(document.getElementById('akuntansi').options).map(opt => opt.value);

        $('#no_akun').on('change', function() {
            let val = $(this).val();
            let find = no_akun.find(no => no == val);
            if (!find) {
                alert('No akun tidak ada dalam daftar!');
                $(this).val('');
            }
        });
        
        $('.tombolTambahData').on('click', function () {
            $('#modalLabel').html('Tambah Data')
            $('.modal-footer button[type=submit]').html('Tambah Data');
            $(".modal-body form")[0].reset();
            $(".modal-body form").attr("action", `${BASEURL}/insert`);
        });

        $(".tampilModalUbah").click(function () {
            $("#modalLabel").html("Ubah Data");
            $(".modal-footer button[type=submit]").html("Ubah Data");
            $(".modal-body form").attr("action", `${BASEURL}/update`);

            const id = $(this).data("id");

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: {id: id},
                method: "post",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $('#tanggal').val(data.tanggal);
                    $('#no_akun').val(data.no_akun);
                    $(`#${data.kategori}`).prop('checked', true);
                    $('#deskripsi').val(data.deskripsi);
                    $('#jumlah').val(data.jumlah);
                },
            })
        })
    });
</script>

<?php Get::view('templates/footer', $data) ?>
