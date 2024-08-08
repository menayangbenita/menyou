<?php Get::view('templates/header', $data) ?>

<style>
    .profile {
        object-fit: cover;
        height: 80px;
        width: 80px;
    }

    img[data-bs-toggle="modal"]:hover {
        filter: brightness(0.7);
        cursor: pointer;
    }

    .overlay {
        position: relative;
        display: none;
    }

    .overlay i {
        position: absolute;
        top: 50%;
        right: 20%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: #ffffff75;
    }

    img[data-bs-toggle="modal"]:hover+.overlay {
        display: block;
    }

    img[data-bs-toggle="modal"]:hover+.overlay i {
        display: block;
    }

    .btn-close {
        --bs-btn-close-color: #000;
        --bs-btn-close-bg: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e);
        --bs-btn-close-opacity: 0.5;
        --bs-btn-close-hover-opacity: 0.75;
        --bs-btn-close-focus-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        --bs-btn-close-focus-opacity: 1;
        --bs-btn-close-disabled-opacity: 0.25;
        --bs-btn-close-white-filter: invert(1) grayscale(100%) brightness(200%);
        box-sizing: content-box;
        width: 1em;
        height: 1em;
        padding: 0.25em 0.25em;
        color: var(--bs-btn-close-color);
        background: transparent var(--bs-btn-close-bg) center/1em auto no-repeat;
        border: 0;
        border-radius: 0.375rem;
        opacity: var(--bs-btn-close-opacity);
    }
</style>

<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?= BASEURL ?>/img/curved-images/curved0.jpg'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
</div>
<div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="<?= BASEURL ?>/upload/karyawan/<?= $data['karyawan']['foto'] ?>" alt="profile_image" class="border-radius-lg shadow-sm profile" draggable="false" data-bs-toggle="modal" data-bs-target="#imageModal">
                <div class="overlay" data-bs-toggle="modal" data-bs-target="#imageModal">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">
                    <?= $data['karyawan']['nama'] ?>
                </h5>
                <p class="mb-0 font-weight-bold text-sm">
                    <?= $data['karyawan']['posisi'] ?>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Hero -->

<!-- Card -->
<div class="container-fluid py-4 fade show" id="attendance-card">
    <div class="card mb-4 ">
        <div class="card-body">

            <div class="card-body">
                <div class="card-header p-0 mb-2">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h2 class="mb-0 fs-3">Informasi Karyawan</h2>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="<?= BASEURL ?>/karyawan" class="btn btn-secondary mb-0">
                                <i class="bi bi-chevron-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">NIK / ID No:</strong>
                                &nbsp; <?= $data['karyawan']['nik'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nama:</strong>
                                &nbsp; <?= $data['karyawan']['nama'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Status Karyawan:</strong>
                                &nbsp; <?= $data['karyawan']['status_karyawan'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Status Nikah:</strong>
                                &nbsp; <?= $data['karyawan']['status_nikah'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Posisi Saat Ini:</strong>
                                &nbsp; <?= $data['karyawan']['posisi'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Level:</strong>
                                &nbsp; <?= $data['karyawan']['level'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Departemen:</strong>
                                &nbsp; <?= $data['karyawan']['departement'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Atasan Langsung:</strong>
                                &nbsp; <?= $data['karyawan']['atasan_langsung'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Lokasi:</strong>
                                &nbsp; <?= $data['karyawan']['lokasi'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tanggal Mulai Kerja:</strong>
                                &nbsp; <?= date('d-m-Y', strtotime($data['karyawan']['mulai_kerja'])) ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Periode Kerja:</strong>
                                <?php $current = new DateTime(); $diff = $current->diff(new DateTime($data['karyawan']['mulai_kerja'])); ?>
                                &nbsp;<?= $diff->y . ' th, ' . $diff->m . ' bln' ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tempat Lahir:</strong>
                                &nbsp; <?= $data['karyawan']['tempat_lahir'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tanggal Lahir:</strong>
                                &nbsp; <?= date('d-m-Y', strtotime($data['karyawan']['tanggal_lahir'])) ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Usia:</strong>
                                <?php $current = new DateTime(); $diff = $current->diff(new DateTime($data['karyawan']['tanggal_lahir'])); ?>
                                &nbsp;<?= $diff->y . ' th, ' . $diff->m . ' bln' ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Jenis Kelamin:</strong>
                                &nbsp; <?= $data['karyawan']['jenis_kelamin'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Golongan Darah:</strong>
                                &nbsp; <?= $data['karyawan']['gol_darah'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pendidikan Terakhir (Laporan Disnaker):</strong>
                                &nbsp; <?= $data['karyawan']['kt_pendidikan_terakhir'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pendidikan Terakhir:</strong>
                                &nbsp; <?= $data['karyawan']['pendidikan_terakhir'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Agama:</strong>
                                &nbsp; <?= $data['karyawan']['agama'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat Rumah:</strong>
                                &nbsp; <?= $data['karyawan']['alamat'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Suku:</strong>
                                &nbsp; <?= $data['karyawan']['suku'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No. Telepon:</strong>
                                &nbsp; <?= $data['karyawan']['no_telp'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                &nbsp; <?= $data['karyawan']['email'] ?></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kontak Darurat:</strong>
                                &nbsp; <?= $data['karyawan']['nama_kontak_darurat'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No. Kontak Darurat:</strong>
                                &nbsp; <?= $data['karyawan']['telp_kontak_darurat'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No. KTP/Paspor:</strong>
                                &nbsp; <?= $data['karyawan']['no_ktp'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Masa Berlaku KTP/Paspor:</strong>
                                &nbsp; <?= $data['karyawan']['masa_ktp'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No. Kartu Keluarga:</strong>
                                &nbsp; <?= $data['karyawan']['no_kk'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nama Ibu Kandung:</strong>
                                &nbsp; <?= $data['karyawan']['nama_ibu_kandung'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">NPWP:</strong>
                                &nbsp; <?= $data['karyawan']['npwp'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gaji Lembur:</strong>
                                &nbsp; <?= ($data['karyawan']['gaji_overtime'] == '1') ? 'Iya' : 'Tidak' ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gaji Kehadiran:</strong>
                                &nbsp; <?= ($data['karyawan']['gaji_kehadiran'] == '1') ? 'Iya' : 'Tidak' ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gaji Insentif:</strong>
                                &nbsp; <?= ($data['karyawan']['gaji_insentif'] == '1') ? 'Iya' : 'Tidak' ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Bonus Lebaran (THR):</strong>
                                &nbsp; <?= ($data['karyawan']['gaji_tunjangan'] == '1') ? 'Iya' : 'Tidak' ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">BPJS Ketenagakerjaan:</strong>
                                &nbsp; <?= $data['karyawan']['bpjs_ketenagakerjaan'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">BPJS Kesehatan:</strong>
                                &nbsp; <?= $data['karyawan']['bpjs_kesehatan'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">BPJS Kesehatan (Istri, Suami, Anak):</strong>
                                &nbsp; <?= $data['karyawan']['bpjs_kesehatan_keluarga'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Perusahaan Akan Membayar Semua Pajak:</strong>
                                &nbsp; <?= ($data['karyawan']['bebas_pajak'] == '1') ? 'Iya' : 'Tidak' ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Ukuran Baju:</strong>
                                &nbsp; <?= $data['karyawan']['ukuran_baju'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Ukuran Sepatu:</strong>
                                &nbsp; <?= $data['karyawan']['ukuran_sepatu'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nama Bank:</strong>
                                &nbsp; <?= $data['karyawan']['nama_bank'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Keterangan Bank:</strong>
                                &nbsp; <?= $data['karyawan']['keterangan_bank'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Akun Bank:</strong>
                                &nbsp; <?= $data['karyawan']['akun_bank'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nama Pemilik Rekening:</strong>
                                &nbsp; <?= $data['karyawan']['nama_pemilik_rek'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gaji Pokok:</strong>
                                &nbsp; Rp <?= number_format($data['karyawan']['gaji_pokok'], 0, '.', '.') ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Foto -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFotoTitle">Foto Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <img src="<?= BASEURL ?>/upload/karyawan/<?= $data['karyawan']['foto'] ?>" alt="Foto Karyawan" class="img-fluid" style="max-height: 75vh;">
            </div>
        </div>
    </div>
</div>
<!-- End Modal Foto -->

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-basic", {
        searchable: true,
        fixedHeight: true
    });
</script>

<script>
    $(function() {
        const BASEURL = window.location.href;
        console.log(BASEURL)
        $('.tombolTambahData').on('click', function() {
            $('modalLabel').html('Tambah Data')
            $('.modal-footer button[type=submit]').html('Tambah Data');

        });

        $(".tampilModalUbah").click(function() {
            $("#modal").addClass("edit");
            $("#modalLabel").html("Ubah Data Karyawan");
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
                    $('#nik').val(data.nik);
                    $('#nama').val(data.nama);
                    $("#alamat").val(data.alamat);
                    $('#no_telp').val(data.no_telp);
                    $('#email').val(data.email);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tgllahir').val(data.tgllahir);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#jabatan').val(data.jabatan);
                    $('#statuss').val(data.statuss);
                    $('#gaji').val(data.gaji);
                    $('#fotoLama').val(data.foto);
                    $('#id').val(data.id);
                    console.log(data);
                },
            })
        })
    });
</script>

<?php Get::view('templates/footer', $data) ?>