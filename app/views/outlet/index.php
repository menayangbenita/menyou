<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title mb-0">Manage Outlet</h5>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end">
                        <?php if ($data['user']['role'] == "Owner") : ?>
                            <button type="button" class="btn bg-gradient-primary d-lg-block mb-0 ms-2 tombolTambahData" 
                                data-bs-toggle="modal" data-bs-target="#formModal">
                                Tambah Data
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 search" id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama Outlet</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Lokasi</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Manager</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No. Telp</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data["outlet"] as $outlet) : ?>
                                <tr>
                                    <td class="text-sm text-center font-weight-bold mb-0 bg-transparent">
                                        <?= $i++; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $outlet['nama']; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                    <?= $outlet['kota']; ?>, <?= $outlet['lokasi']; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?php if ($outlet['manager']) : ?>
                                            <?= $outlet['manager'] ?>
                                        <?php else : ?>
                                            <span class="text-secondary fw-normal">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $outlet['nomor_telp']; ?>
                                    </td>
                                    <td class="align-middle text-sm text-center font-weight-bold mb-0 bg-transparent">
                                        <?php if ($data['user']['role'] == "Owner" || ($data['user']['role'] == "Manager" && $outlet['uuid'] == $data['user']['outlet_uuid'])) : ?>
                                            <button class="btn bg-gradient-primary rounded-pill btn-icon mb-0 tampilModalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $outlet['id']; ?>">
                                                <i class="fa fa-pen" data-bs-toggle="tooltip" title="Edit"></i>
                                            </button>
                                        <?php else : ?>
                                            <button class="btn btn-secondary rounded-pill btn-icon mb-0" onclick="alert('Tidak dapat mengubah data outlet lain')">
                                                <i class="fa fa-pen" data-bs-toggle="tooltip" title="Edit"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($data['user']['role'] == "Owner") : ?>
                                            <a href="<?= BASEURL ?>/outlet/delete/<?= $outlet['id'] ?>" class="btn bg-gradient-danger rounded-pill btn-icon mb-0" onclick="return confirm ('Hapus data?')">
                                                <i class="fa fa-trash" data-bs-toggle="tooltip" title="Hapus"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?= BASEURL ?>/outlet/detail/<?= $outlet['uuid'] ?>" class="btn bg-gradient-info rounded-pill btn-icon mb-0" data-id="<?= $outlet['uuid']; ?>">
                                            <i class="fa fa-circle-info text-sm" data-bs-toggle="tooltip" title="Detail"></i>
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

<?php if ($data['user']['role'] == "Owner") : ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="icon icon-shape icon-sm shadow-sm border-radius-md bg-white text-center d-inline-flex align-items-center justify-content-center me-2">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>settings</title>
                                    <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                <g id="settings" transform="translate(304.000000, 151.000000)">
                                                    <polygon class="color-background" id="Path" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                                    <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" id="Path" opacity="0.596981957"></path>
                                                    <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z" id="Path"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h5 class="card-title d-inline mb-0">User Access</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Outlet</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data["users"] as $user) : ?>
                                    <tr <?= $user['id'] == $user['manager_id'] ? 'class="bg-warning-subtle"' : '' ?>>
                                        <td class="text-sm font-weight-bold mb-0">
                                            <h6 class="mb-0 text-sm"><?= $user['username'] ?></h6>
                                            <p class="text-xs text-secondary pb-0 mb-0"><?= $user['email'] ?></p>
                                        </td>
                                        <td class="text-sm text-center font-weight-bold mb-0">
                                            <?php if ($user['role'] == 'Owner') : ?>
                                                <span class="badge bg-gradient-warning"><?= $user['role']; ?></span>
                                            <?php elseif ($user['role'] == 'Manager') : ?>
                                                <span class="badge bg-dark"><?= $user['role']; ?></span>
                                            <?php else : ?>
                                                <span class="badge bg-secondary"><?= $user['role']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-sm fw-bold text-center mb-0">
                                            <?= $user['nama_outlet']; ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                            <?php if ($user['id'] == $user['manager_id']) : ?>
                                                <button class="btn btn-light rounded-pill btn-icon mb-0 tombolUserAccess" 
                                                    onclick="alert('Anda tidak dapat mengubah outlet dari user ini! Jika anda ingin merubah, hapus manager dari <?= $user['nama_outlet'] ?> terlebih dahulu.')">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                            <?php else : ?>
                                                <button class="btn bg-gradient-primary rounded-pill btn-icon mb-0 tombolUserAccess" 
                                                    data-bs-toggle="modal" data-bs-target="#switchModal" data-outlet_uuid="<?= $user['outlet_uuid'] ?>" data-id="<?= $user['id']; ?>">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                            <?php endif; ?>
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

    <!-- modal switch -->
    <div class="modal fade" id="switchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Ubah Data</h1>
                    <button type="button" class="btn btn-dark mb-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-xmark"></i>
                    </button>
                </div>
                <form action="<?= BASEURL ?>/outlet/changeUserAccess" method="post" enctype="multipart/form-data">
                    <?= csrf() ?>
                    <div class="modal-body">
                        <div class="mb-3" id="select-outlet">
                            <label for="outlet_uuid" class="form-label">Pilih outlet</label>
                            <select class="form-control" name="outlet_uuid" id="outlet_uuid">
                                <?php foreach ($data['outlet'] as $outlet) : ?>
                                    <option value="<?= $outlet['uuid'] ?>"><?= $outlet['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-danger fw-normal fs-6">
                                Masukkan password untuk user <b><?= $data['user']['username'] ?></b>:
                            </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="********" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mb-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary mb-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- modal -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Tambah Data</h1>
                <button type="button" class="btn btn-dark mb-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL ?>/outlet/insert" method="post" enctype="multipart/form-data">
                    <?= csrf() ?>
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Cabang</label>
                        <div id="preview" class="w-100 mb-2 rounded-2 overflow-hidden d-flex align-items-center justify-content-center" style="max-height: 12rem;"></div>
                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Cabang" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="manager_id" class="form-label">Manager</label>
                            <select class="form-control" name="manager_id" id="manager_id" required>
                                <?php foreach ($data['users'] as $user) : ?>
                                    <?php if (!in_array($user['role'], ['Owner', 'Manager'])) continue; ?>
                                    <option value="<?= $user['id'] ?>" data-outlet_uuid="<?= $user['outlet_uuid'] ?>">
                                        <?= $user['username'] ?>
                                    </option>
                                <?php endforeach; ?>
                                <?php if ($data['user']['role'] == "Owner") : ?>
                                    <option value="null">Tidak Ada</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea type="text" class="form-control" name="alamat" id="alamat" placeholder="Jl. xxx" required></textarea>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="mb-2">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" class="form-control" name="kota" id="kota" placeholder="Malang" required>
                            </div>
                            <div>
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Jawa Timur" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telp" class="form-label">No. Telp</label>
                        <input type="tel" class="form-control" name="nomor_telp" id="nomor_telp" placeholder="08xxx" required>
                    </div>
                    <div class="mb-3">
                        <label for="pajak" class="form-label">Pajak (%)</label>
                        <input type="number" class="form-control" name="pajak" id="pajak" min="0" max="100" placeholder="0" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-1" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary mb-1">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/datatables.js"></script>

<script>
    $(function() {
        const BASEURL = window.location.href;

        $('#foto').on('change', function() {
            let file = $(this)[0].files[0];
            let url = URL.createObjectURL(file);

            $('#preview').html(`<img src="${url}" class="w-100">`);
        });

        <?php if ($data['user']['role'] == "Owner") : ?>
            $('.tombolUserAccess').on('click', function() {
                let id = $(this).data('id');
                let outlet_uuid = $(this).data('outlet_uuid');
                if (!!outlet_uuid) $('#switchModal #outlet_uuid').val(outlet_uuid);
                $('#switchModal form').attr('action', `${BASEURL}/changeUserAccess/${id}`)
            });

            $('.tombolTambahData').on('click', function() {
                $('#modalLabel').html('Tambah Data')
                $('.modal-footer button[type=submit]').html('Tambah Data');
                $("#manager_id option").show();
                $('form')[0].reset();
                $("#manager_id").val('null');
                $('#preview').html('');

                $("#manager_id option").each((i, e) => {
                    if (e.dataset.outlet_uuid != '') {
                        e.style.display = 'none';
                    }
                });
            });
        <?php endif; ?>

        $(".tampilModalUbah").click(function() {
            $("#modal").addClass("edit");
            $("#modalLabel").html("Ubah Data");
            $(".modal-footer button[type=submit]").html("Ubah Data");
            $(".modal-body form").attr("action", `${BASEURL}/update`);
            $("#manager_id option").show();

            const id = $(this).data("id");

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: {id: id},
                method: "post",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    if (data.foto !== '')
                        $('#preview').html(`<img src="${BASEURL.replace('/outlet', '')}/upload/outlet/${data.foto}" class="w-100">`);
                    $('#nama').val(data.nama);
                    $('#manager_id').val(data.manager_id || 'null');
                    $('#alamat').val(data.alamat);
                    $('#kota').val(data.kota);
                    $('#lokasi').val(data.lokasi);
                    $('#nomor_telp').val(data.nomor_telp);
                    $('#pajak').val(data.pajak);

                    $("#manager_id option").each((i, e) => {
                        if (e.value == 'null') return 0;
                        if (e.dataset.outlet_uuid != data.uuid) {
                            e.style.display = 'none';
                        }
                    });
                },
            })
        })
    });
</script>

<?php Get::view('templates/footer', $data) ?>