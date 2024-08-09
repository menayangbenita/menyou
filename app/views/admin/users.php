<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="card-title">Manage Users</h5>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex justify-content-end">
                            <button class="btn bg-gradient-primary d-lg-block mb-0 tombolTambahData" type="button" data-bs-toggle="modal" data-bs-target="#formModal">
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    User</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Role</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Outlet</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Terakhir Login</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Approve</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data["users"] as $user) : ?>
                                <tr>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $i++; ?>
                                    </td>
                                    <td class="text-sm font-weight-bold mb-0">
                                        <h6 class="mb-0 text-sm"><?= $user['username'] ?></h6>
                                        <p class="text-xs text-secondary pb-0 mb-0"><?= $user['email'] ?></p>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?php if ($user['role'] == 'Owner') : ?>
                                            <span class="badge bg-gradient-warning"><?= $user['role']; ?></span>
                                        <?php elseif ($user['role'] == 'Manager') : ?>
                                            <span class="badge bg-dark"><?= $user['role']; ?></span>
                                        <?php elseif (is_null($user['role'])) : ?>
                                            <span class="badge badge-secondary">Tidak Ada</span>
                                        <?php else : ?>
                                            <span class="badge bg-secondary"><?= $user['role'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?php if ($user['nama_outlet']) : ?>
                                            <?= $user['nama_outlet']; ?>
                                        <?php else : ?>
                                            <span class="text-secondary fw-normal">
                                                Tidak Ada
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $user['last_login_at']; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?php if ($user['status']) : ?>
                                            <span class="badge badge-success m-0">Online</span>
                                        <?php else : ?>
                                            <span class="badge badge-secondary m-0">Offline</span>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?php if ($user['active']) : ?>
                                            <button type="button" class="btn btn-info m-0 rounded-pill">
                                                Active
                                            </button>
                                        <?php else : ?>
                                            <button type="button" class="btn btn-warning m-0 rounded-pill tombolActivation" data-bs-toggle="modal" data-bs-target="#switchModal" data-id="<?= $user['id']; ?>">
                                                Unactive
                                            </button>
                                        <?php endif ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn bg-gradient-primary mb-0 rounded-pill tampilModalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $user['id']; ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="<?= BASEURL; ?>/users/destroy/<?= $user['id'] ?>" class="btn bg-gradient-danger mb-0 rounded-pill" onclick="return confirm ('Apakah anda yakin ingin menghapus data secara permanen?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal form -->
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
                <form action="<?= BASEURL; ?>/user/insert" method="post">
                    <?= csrf() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Name</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="Owner">Owner</option>
                            <option value="Manager">Manager</option>
                            <option value="Sales">Sales</option>
                            <option value="Warehouse">Warehouse</option>
                            <option value="Analyzer">Data Analyse</option>
                            <option value="HR">Human Resource Manager</option>
                            <option value="karyawan">karyawan</option>
                        </select>
                    </div>
                    <div class="mb-3 password-container">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal switch -->
<div class="modal fade" id="switchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Activate User</h1>
                <button type="button" class="btn btn-dark mb-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL ?>/users/activateUser" method="post" enctype="multipart/form-data">
                    <?= csrf() ?>
                    <div class="mb-3" id="select-outlet">
                        <label for="outlet_uuid" class="form-label">Pilih outlet</label>
                        <select class="form-control" name="outlet_uuid">
                            <?php foreach ($data['outlet'] as $outlet) : ?>
                                <option value="<?= $outlet['uuid'] ?>"><?= $outlet['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Pilih Role</label>
                        <select class="form-control" name="role">
                            <option value="Manager">Manager</option>
                            <option value="Sales">Sales</option>
                            <option value="Warehouse">Warehouse</option>
                            <option value="Analyzer">Data Analyse</option>
                            <option value="HR">Human Resource Manager</option>
                            <option value="Karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-danger fw-normal fs-6">
                            Masukkan password untuk user <b><?= $data['user']['username'] ?></b>:
                        </label>
                        <input type="password" class="form-control" name="password" placeholder="********" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-1" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn bg-gradient-primary mb-1">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/datatables.js"></script>

<script>
    $(function() {
        const BASEURL = window.location.href;

        $('.tombolActivation').on('click', function() {
            let id = $(this).data('id');

            // console.log(id);
            $('#switchModal form')[0].reset();
            $('#switchModal form').attr('action', `${BASEURL}/activateUser/${id}`);
        });

        $('.tombolTambahData').on('click', function() {
            $('#modalLabel').html('Tambah Data')
            $('#formModal .modal-footer button[type=submit]').html('Tambah Data');
            $("#formModal .modal-body form").attr("action", `${BASEURL}/insert`);
            $('#formModal .modal-body .password-container').show();
            $("#formModal .modal-body form")[0].reset();
        });

        $(".tampilModalUbah").click(function() {
            const id = $(this).data("id");

            $("#modalLabel").html("Ubah Data");
            $("#formModal .modal-footer button[type=submit]").html("Ubah Data");
            $("#formModal .modal-body form").attr("action", `${BASEURL}/update/${id}`);
            $('#formModal .modal-body .password-container').hide();

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#role').val(data.role || 'null');
                },
            })
        })
    });
</script>

<?php Get::view('templates/footer', $data) ?>