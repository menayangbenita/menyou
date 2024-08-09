<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-8">
                        <h5 class="card-title">Supplier</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <button class="btn bg-gradient-info d-lg-block" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" card-body pt-0 pb-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 search" id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Alamat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kontak</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data["supplier"] as $supplier) : ?>
                                <tr>
                                    <td>
                                        <p class="text-sm text-center font-weight-bold mb-0">
                                            <?= $i++; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-center font-weight-bold mb-0">
                                            <?= $supplier['nama']; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-center font-weight-bold mb-0 text-wrap">
                                            <?= $supplier['alamat']; ?>
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-sm font-weight-bold mb-0">
                                            <?= $supplier['kontak']; ?>
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-sm font-weight-bold mb-0">
                                            <?= $supplier['email']; ?>
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button class="btn bg-gradient-primary rounded-pill mb-0 tampilModalUbah" 
                                            type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $supplier['id']; ?>">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                        <a href="<?= BASEURL; ?>/supplier/delete/<?= $supplier['id'] ?>" 
                                            class="btn bg-gradient-dark rounded-pill mb-0" onclick="return confirm ('Hapus data?')">
                                            <i class="fa fa-trash"></i>
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
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Tambah Data</h1>
                <button type="button" class="btn btn-dark mb-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/supplier/insert" method="post">
                    <?= csrf() ?>
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Kontak</label>
                        <input type="number" class="form-control" name="kontak" id="kontak">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-gradient-primary mb-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        const BASEURL = window.location.href;
        console.log(BASEURL)
        $('.tombolTambahData').on('click', function() {
            $('modalLabel').html('Tambah Data')
            $('.modal-footer button[type=submit]').html('Tambah Data');
            $(".modal-body form").attr("action", `${BASEURL}/insert`);
            $(".modal-body form")[0].reset();
        });

        $(".tampilModalUbah").click(function() {
            $("#modal").addClass("edit");
            $("#modalLabel").html("Ubah Data");
            $(".modal-footer button[type=submit]").html("Ubah Data");
            $(".modal-body form").attr("action", `${BASEURL}/update`);

            const id = $(this).data("id");
            console.log(id);

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: {id: id},
                method: "post",
                dataType: "json",
                success: function(data) {
                    $('#nama').val(data.nama);
                    $("#alamat").val(data.alamat);
                    $('#kontak').val(data.kontak);
                    $('#email').val(data.email);
                    $('#id').val(data.id);
                    console.log(data);
                },
            })
        })
    });
</script>

<?php Get::view('templates/footer', $data) ?>