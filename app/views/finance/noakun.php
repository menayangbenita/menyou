<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="card-title">
                            <i class="bi bi-journal-text me-2"></i>
                            Nomor Akuntansi
                        </h5>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex justify-content-end">
                            <button class="btn bg-gradient-primary d-lg-block mb-0" type="button" data-bs-toggle="modal"
                                data-bs-target="#formModal">
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-items-center mb-0" id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nomor Akuntansi</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Sub Kategori</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Deskripsi</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data['akuntansi'] as $nomor) : ?>
                                <tr <?= ($nomor['note']) ? 'class="bg-warning-subtle"' : '' ?>>
                                    <td class="text-sm text-center font-weight-bold mb-0 bg-transparent">
                                        <?= $i++; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $nomor['akun'] ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $nomor['subkategori'] ?>
                                    </td>
                                    <td class="text-sm text-start font-weight-bold px-3 mb-0">
                                        <?= $nomor['deskripsi'] ?>
                                    </td>
                                    <td class="align-middle text-center bg-transparent">
                                        <a href="<?= BASEURL; ?>/finance/update/<?= $nomor['id'] ?>"
                                            data-bs-toggle="modal" data-bs-target="#formModal"
                                            data-id="<?= $nomor['id']; ?>"
                                            class="btn bg-gradient-primary rounded-pill mb-0 tampilModalUbah">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <?php if ($nomor['note']) : ?>
                                            <button
                                                onclick="alert('Tidak bisa menghapus no akun default!')"
                                                class="btn bg-gradient-secondary rounded-pill mb-0">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        <?php else : ?>
                                            <a href="<?= BASEURL; ?>/finance/delete/<?= $nomor['id'] ?>"
                                                onclick="return confirm('Hapus data?')"
                                                class="btn bg-gradient-dark rounded-pill mb-0">
                                                <i class="fa fa-trash"></i>
                                            </a>
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

<!-- modal -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Tambah Data</h1>
                <button type="button" class="btn btn-dark mb-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/akuntansi/insert" method="post">
                    <?= csrf() ?>
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="akun" class="form-label">Nomor Akuntansi</label>
                        <input type="text" class="form-control" name="akun" id="akun">
                    </div>
                    <div class="mb-3">
                        <label for="subkategori" class="form-label">Sub Kategori</label>
                        <input type="text" class="form-control" name="subkategori" id="subkategori">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary mb-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/datatables.js"></script>
<script>
    $(function () {
        const BASEURL = window.location.href;
        
        $('.tombolTambahData').on('click', function () {
            $('#modalLabel').html('Tambah Data')
            $('.modal-footer button[type=submit]').html('Tambah Data');
            $(".modal-body form")[0].reset();
            $(".modal-body form").attr("action", `${BASEURL}/insert`);
        });

        $(".tampilModalUbah").click(function () {
            $("#modal").addClass("edit");
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
                    $('#akun').val(data.akun);
                    $('#subkategori').val(data.subkategori);
                    $('#deskripsi').val(data.deskripsi);
                },
            })
        })
    });
</script>

<?php Get::view('templates/footer', $data) ?>