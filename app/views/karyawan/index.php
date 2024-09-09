<?php Get::view('templates/header', $data) ?>

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="symbol symbol-55px me-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-solid ki-profile-user text-primary fs-1"></i>
                                </span>
                            </div>
                            <div class="card-title align-items-start flex-column">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                    Manage Karyawan</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Human Resource</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Manage Karyawan</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-2 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-order-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Cari Karyawan" />
                            </div>
                            <!--end::Search-->
                            <!--begin::Export buttons-->
                            <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <a href="#" class="btn btn-primary tombolTambahData" data-bs-toggle="modal"
                                data-bs-target="#modalEditKaryawan">Tambah Karyawan</a>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                            id="kt_ecommerce_report_views_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-50px align-middle">Foto</th>
                                    <th class="min-w-150px align-middle">Nama Karyawan</th>
                                    <th class="min-w-100px align-middle">Posisi</th>
                                    <th class="min-w-100px align-middle">Status</th>
                                    <th class="min-w-100px align-middle">Email</th>
                                    <th class="min-w-150px align-middle">Gaji</th>
                                    <th class="text-end min-w-70px align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($data['karyawan'] as $karyawan): ?>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox"
                                                    value="<?= $karyawan['id']; ?>" />
                                            </div>
                                        </td>
                                        <td class="text-start pe-0">
                                            <!--begin::Thumbnail-->
                                            <div class="symbol symbol-50px">
                                                <span class="symbol-label"
                                                    style="background-image:url(<?= BASEURL; ?>/upload/karyawan/<?= !empty($karyawan['foto']) ? $karyawan['foto'] : 'tmp.jpg' ?>);"></span>
                                            </div>
                                            <!--end::Thumbnail-->
                                        </td>
                                        <td class="text-start pe-0">
                                            <span><?= $karyawan['nama'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span class="fw-bold"><?= $karyawan['posisi'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <?php if ($karyawan['status_karyawan'] == 'Aktif'): ?>
                                                <span class="badge badge-light-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge badge-light-secondary">Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span><?= $karyawan['email'] ?></span>
                                        </td>
                                        <td class="text-start pe-0">
                                            <span>Rp <?= number_format($karyawan['gaji_pokok'], 0, '.', '.') ?></span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="<?= BASEURL; ?>/karyawan/detail/<?= $karyawan['id'] ?>"
                                                        data-id="<?= $karyawan['id']; ?>" class="menu-link px-3">
                                                        Detail</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditKaryawan"
                                                        data-id="<?= $karyawan['id']; ?>">Edit</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="<?= BASEURL; ?>/karyawan/delete/<?= $karyawan['id'] ?>"
                                                        class="menu-link px-3" data-id="<?= $karyawan['id']; ?>"
                                                        data-kt-ecommerce-product-filter="delete_row">Hapus</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products-->
            </div>

            <!-- Modal Edit Karyawan -->
            <div class="modal fade" id="modalEditKaryawan" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content rounded">
                        <!--begin::Modal header-->
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="ki-outline ki-cross fs-1"></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--begin::Modal header-->
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <!--begin::Heading-->
                            <div class="mb-13 text-center">
                                <!--begin::Title-->
                                <h1 class="mb-3" id="modalLabel">Tambah Karyawan</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <form action="<?= BASEURL; ?>/karyawan/insert" method="post" enctype="multipart/form-data">
                                <?= csrf() ?>
                                <input type="hidden" name="id" id="id">
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="nik"><span class="required">NIK / ID Karyawan</span></label>
                                            <input type="text" class="form-control form-control-solid" name="nik"
                                                id="nik" placeholder="Cth: 0101011708450001" required />
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-rowmb-2">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="foto_karyawan"><span>Foto</span></label>
                                            <input class="form-control form-control-solid" type="file" name="foto"
                                                id="foto" accept=".jpg, .png, .jpeg" />
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="nama_karyawan"><span class="required">Nama</span></label>
                                            <input type="text" class="form-control form-control-solid" name="nama"
                                                id="nama" placeholder="Cth: John Doe" required />
                                        </div>
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                    for="jenis_kelamin"><span class="required">Status
                                                        Karyawan</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_karyawan"
                                                    id="karyawan_aktif" value="Aktif" checked required />
                                                <label class="form-check-label" for="karyawan_aktif">Aktif</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_karyawan"
                                                    id="karyawan_tidak_aktif" value="Tidak Aktif" required />
                                                <label class="form-check-label" for="karyawan_tidak_aktif">Tidak
                                                    Aktif</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="gaji_karyawan"><span class="required">Status
                                                    Pernikahan</span></label>
                                            <select class="form-select form-select-solid" name="status_nikah"
                                                id="status_nikah" required>
                                                <option value="TK0">TK0</option>
                                                <option value="TK1">TK1</option>
                                                <option value="TK2">TK2</option>
                                                <option value="TK3">TK3</option>
                                                <option value="TK4">TK4</option>
                                                <option value="K0">K0</option>
                                                <option value="K1">K1</option>
                                                <option value="K2">K2</option>
                                                <option value="K3">K3</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="posisi"><span class="required">Posisi</span></label>
                                            <input type="text" class="form-control form-control-solid" name="posisi"
                                                id="posisi" placeholder="Cth: Kasir" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="level"><span class="required">Level</span></label>
                                            <select class="form-select form-select-solid" name="level" id="level"
                                                aria-label="Status Karyawan" required>
                                                <option value="Staff">Staff</option>
                                                <option value="Supervisor">Supervisor</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="departement"><span class="required">Departemen</span></label>
                                            <input type="text" name="departement" id="departement"
                                                class="form-control form-control-solid" placeholder="Cth: Kitchen"
                                                required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="atasan_langsung"><span class="required">Atasan
                                                    Langsung</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="atasan_langsung" id="atasan_langsung"
                                                placeholder="Cth: Supervisor" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="lokasi"><span class="required">Lokasi</span></label>
                                            <input type="text" class="form-control form-control-solid" name="lokasi"
                                                id="lokasi" placeholder="Cth: Banjarmasin" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="mulai"><span class="required">Mulai Kerja</span></label>
                                            <input class="form-control form-control-solid" type="date"
                                                name="mulai_kerja" id="mulai_kerja" value="<?= date('Y-m-d') ?>"
                                                required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="tempat_lahir"><span class="required">Tempat Lahir</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="tempat_lahir" id="tempat_lahir" placeholder="Cth: Banjarmasin"
                                                required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="tanggal_lahir"><span class="required">Tanggal Lahir</span></label>
                                            <input type="date" class="form-control form-control-solid"
                                                name="tanggal_lahir" id="tanggal_lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                    for="jenis_kelamin"><span class="required">Jenis
                                                        Kelamin</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    name="jenis_kelamin" id="jenis_kelamin_l" value="Laki-laki"
                                                    required />
                                                <label class="form-check-label" for="jenis_kelamin_l">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    name="jenis_kelamin" id="jenis_kelamin_p" value="Perempuan"
                                                    required />
                                                <label class="form-check-label" for="jenis_kelamin_p">Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                    for="jenis_kelamin"><span class="required">Golongan
                                                        Darah</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gol_darah"
                                                    name="gol_darah" id="gol_darah_a" value="A" required />
                                                <label class="form-check-label" for="gol_darah_a">A</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gol_darah"
                                                    name="gol_darah" id="gol_darah_b" value="B" required />
                                                <label class="form-check-label" for="gol_darah_b">B</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gol_darah"
                                                    name="gol_darah" id="gol_darah_ab" value="AB" required />
                                                <label class="form-check-label" for="gol_darah_ab">AB</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gol_darah"
                                                    name="gol_darah" id="gol_darah_o" value="O" required />
                                                <label class="form-check-label" for="gol_darah_o">O</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="kt_pendidikan_terakhir"><span class="required">Pendidikan
                                                    Terakhir</span>
                                                (Laporan Disnaker)</label>
                                            <select class="form-select form-select-solid" name="kt_pendidikan_terakhir"
                                                id="kt_pendidikan_terakhir" required>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="SMK">SMK</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="D1">D1</option>
                                                <option value="D2">D2</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="pendidikan_terakhir"><span class="required">Pendidikan
                                                    Terakhir</span></label>
                                            <select class="form-select form-select-solid" name="pendidikan_terakhir"
                                                id="pendidikan_terakhir" required>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="SMK">SMK</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="D1">D1</option>
                                                <option value="D2">D2</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="agama"><span class="required">Agama</span></label>
                                            <select class="form-select form-select-solid" name="agama" id="agama"
                                                required>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="alamat"><span class="required">Alamat Rumah</span></label>
                                            <input type="text" name="alamat" id="alamat" cols="30"
                                                class="form-control form-control-solid" placeholder="JL. Merbabu No 12"
                                                required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="suku"><span class="required">Suku</span></label>
                                            <input type="text" class="form-control form-control-solid" name="suku"
                                                id="suku" placeholder="Cth: Dayak" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="no_telp"><span class="required">No. Telepon</span></label>
                                            <input type="tel" class="form-control form-control-solid" name="no_telp"
                                                id="no_telp" placeholder="Cth: 089510203040" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="email"><span class="required">Email</span></label>
                                            <input type="email" class="form-control form-control-solid" name="email"
                                                id="email" placeholder="Cth: sales@menune.com" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="nama_kontak_darurat"><span class="required">Nama Kontak
                                                    Darurat</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="nama_kontak_darurat" id="nama_kontak_darurat"
                                                placeholder="Cth: Jane Doe" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="telp_kontak_darurat"><span class="required">Nomor Kontak
                                                    Darurat</span></label>
                                            <input type="number" class="form-control form-control-solid"
                                                name="telp_kontak_darurat" id="telp_kontak_darurat"
                                                placeholder="Cth: 089550607080" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="no_ktp"><span class="required">Nomor KTP/Paspor</span></label>
                                            <input type="number" class="form-control form-control-solid" name="no_ktp"
                                                id="no_ktp" placeholder="0101011708450001" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="masa_ktp"><span class="required">Masa Berlaku
                                                    KTP/Paspor</span></label>
                                            <input type="text" class="form-control form-control-solid" name="masa_ktp"
                                                id="masa_ktp" value="Seumur Hidup" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="no_kk"><span class="required">Nomor Kartu Keluarga</span></label>
                                            <input type="number" class="form-control form-control-solid" name="no_kk"
                                                id="no_kk" placeholder="3172010502090981" required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="nama_ibu_kandung"><span class="required">Nama Ibu
                                                    Kandung</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="nama_ibu_kandung" id="nama_ibu_kandung" placeholder="Cth: Yanti"
                                                required>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="npwp"><span class="required">NPWP</span></label>
                                            <input type="text" class="form-control form-control-solid" name="npwp"
                                                id="npwp" placeholder="99.999.999.9-999.000" required>
                                        </div>
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                        class="required">Gaji Lembur</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_overtime"
                                                    id="ot_ya" value="1" required />
                                                <label class="form-check-label" for="ot_ya">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_overtime"
                                                    id="ot_tidak" value="0" required />
                                                <label class="form-check-label" for="ot_tidak">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                        class="required">Gaji Kehadiran</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_kehadiran"
                                                    id="kh_ya" value="1" required />
                                                <label class="form-check-label" for="kh_ya">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_kehadiran"
                                                    id="kh_tidak" value="0" required />
                                                <label class="form-check-label" for="kh_tidak">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                        class="required">Gaji Insentif</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_insentif"
                                                    id="in_ya" value="1" required />
                                                <label class="form-check-label" for="in_ya">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_insentif"
                                                    id="in_tidak" value="0" required />
                                                <label class="form-check-label" for="in_tidak">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                                        class="required">Bonus Lebaran (THR)</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_tunjangan"
                                                    id="tn_ya" value="1" required />
                                                <label class="form-check-label" for="tn_ya">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gaji_tunjangan"
                                                    id="tn_tidak" value="0" required />
                                                <label class="form-check-label" for="tn_tidak">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="bpjs_ketenagakerjaan"><span class="required">BPJS
                                                    Ketenagakerjaan</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="bpjs_ketenagakerjaan" id="bpjs_ketenagakerjaan" required />
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="bpjs_kesehatan"><span class="required">BPJS
                                                    Kesehatan</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="bpjs_kesehatan" id="bpjs_kesehatan" placeholder="103133911101"
                                                required />
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="bpjs_kesehatan_keluarga">BPJS Kesehatan (Istri, Suami,
                                                Anak)</label>
                                            <textarea class="form-control form-control-solid"
                                                name="bpjs_kesehatan_keluarga" id="bpjs_kesehatan_keluarga"
                                                placeholder="0000591500002"></textarea>
                                        </div>
                                        <div class="mb-8 fv-row">
                                            <div class="col-lg-12">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                    for="jenis_kelamin"><span class="required">Perusahaan Akan Membayar
                                                        Semua Pajak</span></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="bebas_pajak"
                                                    id="pajak_ya" value="1" required />
                                                <label class="form-check-label" for="pajak_ya">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="bebas_pajak"
                                                    id="pajak_tidak" value="0" required />
                                                <label class="form-check-label" for="pajak_tidak">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="ukuran_baju"><span class="required">Ukuran Baju</span></label>
                                            <select class="form-select form-select-solid" name="ukuran_baju"
                                                id="ukuran_baju" required>
                                                <option value="XXS">XXS</option>
                                                <option value="XS">XS</option>
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="XXL">XXL</option>
                                                <option value="XXXL">XXXL</option>
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                for="ukuran_sepatu"><span class="required">Ukuran Sepatu</span></label>
                                            <input type="number" class="form-control form-control-solid"
                                                name="ukuran_sepatu" id="ukuran_sepatu" placeholder="Cth: 41" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-15">
                                    <div class="col-lg-6 mb-3">
                                        <div class="card border-1 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                        for="nama_bank"><span class="required">Nama Bank</span></label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="nama_bank" id="nama_bank" placeholder="Cth: BRI" required>
                                                </div>
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                        for="keterangan_bank"><span class="required">Keterangan
                                                            Bank</span></label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="keterangan_bank" id="keterangan_bank" required>
                                                </div>
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                        for="akun_bank"><span class="required">Akun Bank</span></label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="akun_bank" id="akun_bank" required>
                                                </div>
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                        for="nama_pemilik_rek"><span class="required">Nama Pemilik
                                                            Rekening</span></label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="nama_pemilik_rek" placeholder="Cth: John Doe"
                                                        id="nama_pemilik_rek" required>
                                                </div>
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                        for="gaji_pokok"><span class="required">Gaji
                                                            Pokok</span></label>
                                                    <input type="number" class="form-control form-control-solid"
                                                        name="gaji_pokok" id="gaji_pokok" placeholder="Cth: 2500000"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border-1 shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2"
                                                        for="outlet_uuid">Pilih Outlet/Cabang</label>
                                                    <select class="form-control form-control-solid" id="outlet_uuid"
                                                        name="outlet_uuid">
                                                        <option value="null">Tidak ada</option>
                                                        <?php foreach ($data['outlet'] as $outlet): ?>
                                                            <option value="<?= $outlet['uuid'] ?>"
                                                                <?= ($outlet['uuid'] == $data['user']['outlet_uuid']) ? "selected" : '' ?>><?= $outlet['nama'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary mb-1"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary mb-1"
                                        onclick="return confirm('Apakah anda yakin ingin memproses data?')">Tambah
                                        Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!--begin::Javascript-->
                <script>var hostUrl = "assets/";</script>
                <!--begin::Global Javascript Bundle(mandatory for all pages)-->
                <script src="<?= BASEURL ?>/plugins/global/plugins.bundle.js"></script>
                <script src="<?= BASEURL ?>/js/scripts.bundle.js"></script>
                <!--end::Global Javascript Bundle-->
                <!--begin::Vendors Javascript(used for this page only)-->
                <script src="<?= BASEURL ?>/plugins/custom/datatables/datatables.bundle.js"></script>
                <!--end::Vendors Javascript-->
                <!--begin::Custom Javascript(used for this page only)-->
                <script src="<?= BASEURL ?>/js/custom/apps/ecommerce/reports/views/views.js"></script>
                <!--end::Custom Javascript-->
                <!--end::Javascript-->

                <script src="<?= BASEURL ?>/js/datatables.js"></script>

                <script src="<?= BASEURL; ?>/js/datatables.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                <script>
                    const dataTableSearch = new simpleDatatables.DataTable("#datatable-basic", {
                        searchable: true,
                        fixedHeight: true
                    });
                </script>

                <script>
                    const BASEURL = window.location.href;

                    $(function () {
                        $('.tombolTambahData').on('click', function () {
                            $("#modal").removeClass("edit");
                            $('#modalLabel').html('Tambah Data Karyawan')
                            $('.modal-footer button[type=submit]').html('Tambah Data');
                            $(".modal-body form").attr("action", `${BASEURL}/insert`);
                            $(".modal-body form")[0].reset();
                        });

                        $(".tampilModalUbah").click(function () {
                            $("#modal").addClass("edit");
                            $("#modalLabel").html("Ubah Data Karyawan");
                            $(".modal-footer button[type=submit]").html("Ubah Data");
                            $(".modal-body form").attr("action", `${BASEURL}/update`);

                            const id = $(this).data("id");

                            $.ajax({
                                url: `${BASEURL}/getubah`,
                                data: {
                                    id: id
                                },
                                method: "post",
                                dataType: "json",
                                success: function (data) {
                                    // console.log(data);
                                    $('#id').val(data.id);
                                    $('#nik').val(data.nik)
                                    $('#nama').val(data.nama)
                                    $(`input[name="status_karyawan"][value="${data.status_karyawan}"]`).prop('checked', true)
                                    $('#status_nikah').val(data.status_nikah)
                                    $('#posisi').val(data.posisi)
                                    $('#level').val(data.level)
                                    $('#departement').val(data.departement)
                                    $('#atasan_langsung').val(data.atasan_langsung)
                                    $('#lokasi').val(data.lokasi)
                                    $('#mulai_kerja').val(data.mulai_kerja)
                                    $('#tempat_lahir').val(data.tempat_lahir)
                                    $('#tanggal_lahir').val(data.tanggal_lahir)
                                    $(`input[name="jenis_kelamin"][value="${data.jenis_kelamin}"]`).prop('checked', true)
                                    $(`input[name="gol_darah"][value="${data.gol_darah}"]`).prop('checked', true)
                                    $('#kt_pendidikan_terakhir').val(data.kt_pendidikan_terakhir)
                                    $('#pendidikan_terakhir').val(data.pendidikan_terakhir)
                                    $('#agama').val(data.agama)
                                    $('#alamat').val(data.alamat)
                                    $('#suku').val(data.suku)
                                    $('#no_telp').val(data.no_telp)
                                    $('#email').val(data.email)
                                    $('#nama_kontak_darurat').val(data.nama_kontak_darurat)
                                    $('#telp_kontak_darurat').val(data.telp_kontak_darurat)
                                    $('#no_ktp').val(data.no_ktp)
                                    $('#masa_ktp').val(data.masa_ktp)
                                    $('#no_kk').val(data.no_kk)
                                    $('#nama_ibu_kandung').val(data.nama_ibu_kandung)
                                    $('#npwp').val(data.npwp)
                                    $(`input[name="gaji_overtime"][value="${data.gaji_overtime}"]`).prop('checked', true)
                                    $(`input[name="gaji_kehadiran"][value="${data.gaji_kehadiran}"]`).prop('checked', true)
                                    $(`input[name="gaji_insentif"][value="${data.gaji_insentif}"]`).prop('checked', true)
                                    $(`input[name="gaji_tunjangan"][value="${data.gaji_tunjangan}"]`).prop('checked', true)
                                    $('#bpjs_ketenagakerjaan').val(data.bpjs_ketenagakerjaan)
                                    $('#bpjs_kesehatan').val(data.bpjs_kesehatan)
                                    $('#bpjs_kesehatan_keluarga').val(data.bpjs_kesehatan_keluarga)
                                    $(`input[name="bebas_pajak"][value="${data.bebas_pajak}"]`).prop('checked', true)
                                    $('#ukuran_baju').val(data.ukuran_baju)
                                    $('#ukuran_sepatu').val(data.ukuran_sepatu)
                                    $('#nama_bank').val(data.nama_bank)
                                    $('#keterangan_bank').val(data.keterangan_bank)
                                    $('#akun_bank').val(data.akun_bank)
                                    $('#nama_pemilik_rek').val(data.nama_pemilik_rek)
                                    $('#gaji_pokok').val(data.gaji_pokok)
                                    $('#outlet_uuid').val(data.outlet_uuid || 'null')
                                },
                            })
                        })
                    });
                </script>


                <?php Get::view('templates/footer', $data) ?>