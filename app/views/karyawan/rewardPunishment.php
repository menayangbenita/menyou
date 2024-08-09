<?php Get::view('templates/header', $data) ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 ">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-8">
                        <h5 class="card-title">Reward & Punishment</h5>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-end">
                        <button type="button" class="mb-0 btn bg-gradient-primary tombolTambahData" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" style="width: 100%" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Karyawan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Besaran</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['reward_punishment'] as $reward_punishment) : ?>
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-sm font-weight-bold mb-0 text-wrap">
                                                <?= $reward_punishment['nama']; ?>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class='mb-0 badge bg-gradient-<?= ($reward_punishment['jenis'] == 'reward' ? 'success' : 'danger') ?> copy-badge'>
                                                <?= ucfirst($reward_punishment['jenis']) ?>
                                            </h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0 text-wrap">
                                                <b><?= $reward_punishment['jumlah'] ?></b> x Rp <?= number_format($reward_punishment['besaran'], 0, '.', '.') ?> 
                                                <br>= <b>Rp <?= number_format($reward_punishment['total'], 0, '.', '.') ?></b>
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-sm font-weight-bold mb-0 text-wrap">
                                                <?= $reward_punishment['keterangan'] ?>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0 text-wrap">
                                                <?= date('d-m-Y', strtotime($reward_punishment['tanggal'])) ?>
                                            </p>
                                        </td>
                                        <td class="align-middle text-end text-sm">
                                            <a href="<?= BASEURL; ?>/rewardpunishment/print/<?= $reward_punishment['uuid'] ?>" class="btn bg-gradient-success rounded-pill mb-0">
                                                <i class="bi bi-printer-fill me-1"></i>
                                            </a>
                                            <button type="button" class="btn bg-gradient-warning tampilModalUbah rounded-pill mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id='<?= $reward_punishment['id'] ?>'>
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <a href="<?= BASEURL; ?>/rewardpunishment/delete/<?= $reward_punishment['id'] ?>" class="btn bg-gradient-danger rounded-pill mb-0" onclick="return confirm('Yakin Mau Hapus?');"><i class="fa fa-trash"></i>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn bg-gradient-dark mb-1" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL ?>/rewardpunishment/insert" method="post">
                    <?= csrf() ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3">
                                <label for="tanggal">Tanggal</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="karyawan_id">Nama Karyawan:</label>
                                <div class="input-group">
                                    <select class="form-select" id="karyawan_id" name="karyawan_id" required>
                                        <option>--Pilih Karyawan--</option>
                                        <?php foreach ($data['karyawan'] as $karyawan) : ?>
                                            <option value="<?= $karyawan['id'] ?>" data-email="<?= $karyawan['email'] ?>" data-posisi="<?= $karyawan['posisi'] ?>" data-alamat="<?= $karyawan['alamat'] ?>">
                                                <?= $karyawan['nama'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" placeholder="example@email.com" disabled readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="posisi" placeholder="Cth: Kasir" disabled readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat Rumah</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="alamat" placeholder="Jl. xxx" disabled readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="jenis">Jenis</label>
                                <div class="input-group">
                                    <select class="form-select" id="jenis" name="jenis" required>
                                        <option value="reward">Reward</option>
                                        <option value="punishment">Punishment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Keterangan</label>
                                <div class="input-group">
                                    <textarea name="keterangan" class="form-control" id="keterangan" rows="1" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="besaran">Besaran</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="besaran" name="besaran" placeholder="Rp. xxx" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah">Jumlah</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="1" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah">Total</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="total" value="0" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary mb-1" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-gradient-primary mb-1">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const BASEURL = window.location.href;

        $('.tombolTambahData').on('click', function() {
            $('#exampleModalLabel').html('Tambah Data');
            $('.modal-footer button[type=submit]').html('Tambah Data');
            $('.modal-body form').attr('action', `${BASEURL}/insert`);
            $('.modal-body form')[0].reset();
        });

        $('.tampilModalUbah').on('click', function() {
            $('#exampleModalLabel').html('Ubah Data');
            $('.modal-footer button[type=submit]').html('Ubah Data');
            $('.modal-body form').attr('action', `${BASEURL}/update`);

            const id = $(this).data('id');

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: {id: id},
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#karyawan_id').val(data.karyawan_id);
                    $('#jenis').val(data.jenis);
                    $('#jumlah').val(data.jumlah);
                    $('#besaran').val(data.besaran);
                    $('#total').val(data.total);
                    $('#keterangan').val(data.keterangan);
                    $('#tanggal').val(data.tanggal);
                    updateDataKaryawan();
                }
            });
        });

        $('#karyawan_id').change(updateDataKaryawan);

        function updateDataKaryawan() {
            // Get the selected employee's information
            let selectedEmployee = $('#karyawan_id').find(':selected');

            // Set the values for Email, Jabatan, and Alamat
            $('#email').val(selectedEmployee.data('email'));
            $('#posisi').val(selectedEmployee.data('posisi'));
            $('#alamat').val(selectedEmployee.data('alamat'));
        }

        $('#besaran').on('input', countTotal);
        $('#jumlah').on('input', countTotal);

        function countTotal() {
            $('#total').val(($('#besaran').val() || 0) * ($('#jumlah').val() || 0));            
        }
    });
</script>

<?php Get::view('templates/footer', $data) ?>