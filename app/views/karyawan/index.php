<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title mb-0">Manage Karyawan</h5>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end">
                        <button class="btn bg-gradient-primary d-lg-block mb-0 ms-2 tombolTambahData" type="button" data-bs-toggle="modal" data-bs-target="#modalEditKaryawan">
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-sm text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Posisi</th>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gaji</th>
                                    <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($data["karyawan"] as $karyawan) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $i++ ?></td>
                                        <td class="text-center align-middle">
                                            <img src="<?= BASEURL; ?>/upload/karyawan/<?= !empty($karyawan['foto']) ? $karyawan['foto'] : 'tmp.jpg' ?>" class="avatar" style="object-fit: cover" alt="foto_karyawan_1">
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0"><?= $karyawan['nama'] ?></td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0"><?= $karyawan['posisi'] ?></td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                            <?php if ($karyawan['status_karyawan'] == 'Aktif') : ?>
                                                <span class="badge bg-gradient-success">Aktif</span>
                                            <?php else : ?>
                                                <span class="badge bg-gradient-secondary">Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0"><?= $karyawan['email'] ?></td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0">Rp <?= number_format($karyawan['gaji_pokok'], 0, '.', '.') ?></td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                            <button class="btn bg-gradient-primary rounded-pill mb-0 btn-icon tampilModalUbah" data-toggle="tooltip" data-placement="bottom" title="Edit" data-bs-toggle="modal" data-bs-target="#modalEditKaryawan" data-id="<?= $karyawan['id']; ?>">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <a class="btn btn-danger rounded-pill mb-0 btn-icon delete-button" href="<?= BASEURL; ?>/karyawan/delete/<?= $karyawan['id'] ?>" onclick="return confirm ('Hapus data?')" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="<?= BASEURL; ?>/karyawan/detail/<?= $karyawan['id'] ?>" data-id="<?= $karyawan['id']; ?>" class="btn btn-info rounded-pill mb-0 btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail">
                                                <i class="fa fa-user"></i>
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


<!-- Modal Edit Karyawan -->
<div class="modal fade" id="modalEditKaryawan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Data Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/karyawan/insert" method="post" enctype="multipart/form-data">
                    <?= csrf() ?>
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label class="form-label" for="nik">NIK / ID Karyawan</label>
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="23080211" required />
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="foto_karyawan">Foto</label>
                                <input class="form-control" type="file" name="foto" id="foto" accept=".jpg, .png, .jpeg" />
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="nama_karyawan">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Cth: Tono" required />
                            </div>
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2" for="jenis_kelamin">Status Karyawan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_karyawan" id="karyawan_aktif" value="Aktif" checked required />
                                    <label class="form-check-label" for="karyawan_aktif">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_karyawan" id="karyawan_tidak_aktif" value="Tidak Aktif" required />
                                    <label class="form-check-label" for="karyawan_tidak_aktif">Tidak Aktif</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label me-2" for="gaji_karyawan">Status Pernikahan</label>
                                <select class="form-select" name="status_nikah" id="status_nikah" required>
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
                            <div class="mb-2">
                                <label class="form-label" for="posisi">Posisi</label>
                                <input type="text" class="form-control ps-2 border-start" name="posisi" id="posisi" placeholder="Cth: Kasir" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="level">Level</label>
                                <select class="form-select" name="level" id="level" aria-label="Status Karyawan" required>
                                    <option value="Staff">Staff</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="departement">Departemen</label>
                                <input type="text" name="departement" id="departement" class="form-control ps-2 border-start" placeholder="Cth: Kitchen" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="atasan_langsung">Atasan Langsung</label>
                                <input type="text" class="form-control" name="atasan_langsung" id="atasan_langsung" placeholder="Cth: Supervisor" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="lokasi">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Cth: Banjarmasin" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="muali">Mulai Kerja</label>
                                <input class="form-control" type="date" name="mulai_kerja" id="mulai_kerja" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Cth: Banjarmasin" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2" for="jenis_kelamin">Jenis Kelamin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin_l" value="Laki-laki" required />
                                    <label class="form-check-label" for="jenis_kelamin_l">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin_p" value="Perempuan" required />
                                    <label class="form-check-label" for="jenis_kelamin_p">Perempuan</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2" for="jenis_kelamin">Golongan Darah</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gol_darah" name="gol_darah" id="gol_darah_a" value="A" required />
                                    <label class="form-check-label" for="gol_darah_a">A</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gol_darah" name="gol_darah" id="gol_darah_b" value="B" required />
                                    <label class="form-check-label" for="gol_darah_b">B</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gol_darah" name="gol_darah" id="gol_darah_ab" value="AB" required />
                                    <label class="form-check-label" for="gol_darah_ab">AB</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gol_darah" name="gol_darah" id="gol_darah_o" value="O" required />
                                    <label class="form-check-label" for="gol_darah_o">O</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="kt_pendidikan_terakhir">Pendidikan Terakhir (Laporan Disnaker)</label>
                                <select class="form-select" name="kt_pendidikan_terakhir" id="kt_pendidikan_terakhir" required>
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
                            <div class="mb-2">
                                <label class="form-label" for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <select class="form-select" name="pendidikan_terakhir" id="pendidikan_terakhir" required>
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
                            <div class="mb-2">
                                <label class="form-label" for="agama">Agama</label>
                                <select class="form-select" name="agama" id="agama" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="alamat">Alamat Rumah</label>
                                <input type="text" name="alamat" id="alamat" cols="30" class="form-control" placeholder="JL. xxx" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="suku">Suku</label>
                                <input type="text" class="form-control" name="suku" id="suku" placeholder="Cth: Dayak" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="no_telp">No. Telepon</label>
                                <input type="tel" class="form-control" name="no_telp" id="no_telp" placeholder="08xxx" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="nama_kontak_darurat">Nama Kontak Darurat</label>
                                <input type="text" class="form-control" name="nama_kontak_darurat" id="nama_kontak_darurat" placeholder="Cth: Budi" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="telp_kontak_darurat">Nomor Kontak Darurat</label>
                                <input type="number" class="form-control" name="telp_kontak_darurat" id="telp_kontak_darurat" placeholder="08xxx" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="no_ktp">Nomor KTP/Paspor</label>
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="masa_ktp">Masa Berlaku KTP/Paspor</label>
                                <input type="text" class="form-control" name="masa_ktp" id="masa_ktp" value="Seumur Hidup" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label class="form-label" for="no_kk">Nomor Kartu Keluarga</label>
                                <input type="number" class="form-control" name="no_kk" id="no_kk" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="nama_ibu_kandung">Nama Ibu Kandung</label>
                                <input type="text" class="form-control" name="nama_ibu_kandung" id="nama_ibu_kandung" placeholder="Cth: Yanti" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="npwp">NPWP</label>
                                <input type="text" class="form-control" name="npwp" id="npwp" required>
                            </div>
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2">Gaji Lembur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_overtime" id="ot_ya" value="1" required />
                                    <label class="form-check-label" for="ot_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_overtime" id="ot_tidak" value="0" required />
                                    <label class="form-check-label" for="ot_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2">Gaji Kehadiran</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_kehadiran" id="kh_ya" value="1" required />
                                    <label class="form-check-label" for="kh_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_kehadiran" id="kh_tidak" value="0" required />
                                    <label class="form-check-label" for="kh_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2">Gaji Insentif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_insentif" id="in_ya" value="1" required />
                                    <label class="form-check-label" for="in_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_insentif" id="in_tidak" value="0" required />
                                    <label class="form-check-label" for="in_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2">Bonus Lebaran (THR)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_tunjangan" id="tn_ya" value="1" required />
                                    <label class="form-check-label" for="tn_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gaji_tunjangan" id="tn_tidak" value="0" required />
                                    <label class="form-check-label" for="tn_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="bpjs_ketenagakerjaan">BPJS Ketenagakerjaan</label>
                                <input type="text" class="form-control" name="bpjs_ketenagakerjaan" id="bpjs_ketenagakerjaan" required />
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="bpjs_kesehatan">BPJS Kesehatan</label>
                                <input type="text" class="form-control" name="bpjs_kesehatan" id="bpjs_kesehatan" required />
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="bpjs_kesehatan_keluarga">BPJS Kesehatan (Istri, Suami, Anak)</label>
                                <textarea class="form-control" name="bpjs_kesehatan_keluarga" id="bpjs_kesehatan_keluarga"></textarea>
                            </div>
                            <div class="mb-2">
                                <div class="col-lg-12">
                                    <label class="form-label me-2" for="jenis_kelamin">Perusahaan Akan Membayar Semua Pajak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bebas_pajak" id="pajak_ya" value="1" required />
                                    <label class="form-check-label" for="pajak_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bebas_pajak" id="pajak_tidak" value="0" required />
                                    <label class="form-check-label" for="pajak_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="ukuran_baju">Ukuran Baju</label>
                                <select class="form-select" name="ukuran_baju" id="ukuran_baju" required>
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
                            <div class="mb-2">
                                <label class="form-label" for="ukuran_sepatu">Ukuran Sepatu</label>
                                <input type="number" class="form-control" name="ukuran_sepatu" id="ukuran_sepatu" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="card border-1 shadow-none">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label" for="nama_bank">Nama Bank</label>
                                        <input type="text" class="form-control" name="nama_bank" id="nama_bank" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="keterangan_bank">Keterangan Bank</label>
                                        <input type="text" class="form-control" name="keterangan_bank" id="keterangan_bank" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="akun_bank">Akun Bank</label>
                                        <input type="text" class="form-control" name="akun_bank" id="akun_bank" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="nama_pemilik_rek">Nama Pemilik Rekening</label>
                                        <input type="text" class="form-control" name="nama_pemilik_rek" id="nama_pemilik_rek" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="gaji_pokok">Gaji Pokok</label>
                                        <input type="number" class="form-control" name="gaji_pokok" id="gaji_pokok" placeholder="Rp. xxx" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card border-1 shadow-none">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label" for="outlet_uuid">Pilih Outlet/Cabang</label>
                                        <select class="form-control" id="outlet_uuid" name="outlet_uuid">
                                            <option value="null">Tidak ada</option>
                                            <?php foreach ($data['outlet'] as $outlet) : ?>
                                                <option value="<?= $outlet['uuid'] ?>" <?= ($outlet['uuid'] == $data['user']['outlet_uuid']) ? "selected" : '' ?>><?= $outlet['nama'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-dark mb-1" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn bg-gradient-primary mb-1" onclick="return confirm('Apakah anda yakin ingin memproses data?')">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

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

    $(function() {
        $('.tombolTambahData').on('click', function() {
            $("#modal").removeClass("edit");
            $('#modalLabel').html('Tambah Data')
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

            $.ajax({
                url: `${BASEURL}/getubah`,
                data: {
                    id: id
                },
                method: "post",
                dataType: "json",
                success: function(data) {
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