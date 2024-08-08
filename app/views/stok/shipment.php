<?php Get::view('templates/header', $data) ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">Shipment</h5>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end">
                            <button class="btn bg-gradient-info d-lg-block tombolTambahData" type="button" data-bs-toggle="modal" data-bs-target="#formModal">
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0 pb-3">
                <div class="table-responsive">
                    <table class="table table-bordered align-items-center mb-0" style="border-collapse: collapse;" id="table">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                    No</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No Faktur</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanggal</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Deskripsi</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total Berat</th>
                                <th colspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Biaya EXW</th>
                                <th colspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Biaya Lainnya</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Diskon</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Harga All In / Kg</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Supplier</th>
                                <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                    Aksi</th>
                            </tr>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    List</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    List</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data["shipment"] as $shipment) : ?>
                                <tr>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $i++; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $shipment['no_faktur'] ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= date('d/m/Y', strtotime($shipment['tanggal'])) ?>
                                    </td>
                                    <td class="text-sm text-start font-weight-bold mb-0">
                                        <?= $shipment['deskripsi'] ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?= $shipment['total_berat'] ?> gram
                                    </td>
                                    <td class="text-sm text-start font-weight-bold table-responsive mb-0">
                                        <?php foreach (json_decode($shipment['detail_barang'], true) as $barang) : ?>
                                            - <?= $barang['nama'] ?> <?= $barang['jumlah']." ".$data['satuan'][$barang['nama']] ?> : Rp <?= number_format($barang['subtotal'], 0, ',', '.') ?> <br>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        Rp <?= number_format($shipment['total_exw'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-sm text-start font-weight-bold mb-0">
                                        <?php $biaya_lainnya = json_decode($shipment['biaya_lainnya'], true); ?>
                                        <?php if (empty($biaya_lainnya)) : ?>
                                            -
                                        <?php else : ?>
                                            <?php foreach ($biaya_lainnya as $key => $val) : ?>
                                                - <?= $key ?> : Rp <?= number_format($val, 0, ',', '.') ?> <br>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        Rp <?= number_format($shipment['total_biaya_lainnya'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        Rp <?= number_format($shipment['diskon'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        Rp <?= number_format($shipment['total'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        Rp <?= number_format($shipment['harga_all_in'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-sm text-center font-weight-bold mb-0">
                                        <?php foreach ($data['supplier'] as $supplier) : ?>
                                            <?= ($supplier['id'] == $shipment['supplier_id']) ? $supplier['nama'] : '' ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="align-middle text-sm text-center font-weight-bold mb-0">
                                        <button type="button" class="btn bg-gradient-info btn-md p-1 px-2 mb-0 align-middle acc-button tampilModalDetail" 
                                            data-bs-toggle="modal" data-bs-target="#detailModal" data-id="<?= $shipment['id'] ?>">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <button type="button" class="btn bg-gradient-primary btn-md p-1 px-2 mb-0 align-middle acc-button tampilModalUbah" 
                                            data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $shipment['id'] ?>">
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

<!-- Form Modal -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Tambah Data</h1>
                <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL ?>/shipment/insert" method="post">
                    <?= csrf() ?>
                    <div class="row mb-3 gy-2">
                        <div class="col-lg-4">
                            <label class="form-label" for="nama">No Faktur</label>
                            <input type="text" class="form-control" name="no_faktur" id="no_faktur" placeholder="F0001" required>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label" for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label" for="supplier_id">Supplier</label>
                            <select class="form-select" name="supplier_id" id="supplier_id" required>
                                <?php foreach ($data['supplier'] as $supplier) : ?>
                                    <option value="<?= $supplier['id'] ?>"><?= $supplier['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi shipment" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3 border-top pt-3 overflow-x-auto">
                        <div class="col-md-12">
                            <table class="w-full table table-responsive mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">No</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Nama Barang</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Jenis</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Jumlah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Satuan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Harga Satuan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Subtotal</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder px-1">
                                            <button class="btn btn-success btn-sm m-0 px-3" id="add-detail-barang" type="button">
                                                <i class="fa fa-plus text-sm"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="detail_barang">
                                    <!-- <tr> element on <script> tag bellow -->
                                </tbody>
                            </table>
                        </div>
                        <datalist id="barang">
                            <?php foreach ($data['barang'] as $barang) : ?>
                                <?php if ($barang['jenis'] == 'prepare') continue; ?>
                                <option value="<?= $barang['nama'] ?>" 
                                    data-satuan="<?= $barang['satuan'] ?>"
                                    data-jenis="<?= $barang['jenis'] ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    
                    <div class="row mb-3 border-top pt-2 mt-4">
                        <div class="col-md-6">
                            <label class="form-label" for="berat">Total Berat Shipment</label>
                            <div class="row pe-3">
                                <div class="col-10">
                                    <input type="number" class="form-control count" id="total_berat" placeholder="0" name="total_berat" min="0" required>
                                </div>
                                <div class="col-2 px-0">
                                    <input type="text" class="form-control" value="gram" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="total_exw">Total EXW</label>
                            <div class="input-group bg-light">
                                <span class="input-group-text bg-transparent">Rp</span>
                                <input type="number" class="form-control ps-2 bg-transparent" name="total_exw" id="total_exw" value="0" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Biaya Lainnya</label>
                                <button class="btn btn-success p-0 px-2 fs-6" id="add-biaya-lainnya" type="button">+</button>
                            </div>
                            <div id="biaya-lainnya" class="d-flex flex-column gap-2">
                                 <!-- .row element on <script> tag bellow -->
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-end">
                            <label class="form-label mt-2" for="total_biaya_lainnya">Total Biaya Lainnya</label>
                            <div class="input-group bg-light">
                                <span class="input-group-text bg-transparent">Rp</span>
                                <input type="number" class="form-control ps-2 bg-transparent" name="total_biaya_lainnya" id="total_biaya_lainnya" value="0" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label fs-6 mb-0 d-block text-end" for="diskon">Diskon</label>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control ps-2 count" name="diskon" id="diskon" value="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label fs-6 mb-0 d-block text-end" for="total">Total</label>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group bg-light">
                                <span class="input-group-text bg-transparent">Rp</span>
                                <input type="number" class="form-control ps-2 bg-transparent" name="total" id="total" value="0" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label fs-6 mb-0 d-block text-end" for="harga_all_in">Harga All In / kg</label>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group bg-light">
                                <span class="input-group-text bg-transparent">Rp</span>
                                <input type="number" class="form-control ps-2 bg-transparent" name="harga_all_in" id="harga_all_in" value="0" required readonly>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary mb-1" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-gradient-primary mb-1" onclick="return confirm(message)">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal modal-lg fade" id="detailModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Detail Shipment</h1>
            </div>
            <div class="modal-body">
                <h5 class="text-center fw-bolder mt-3 mb-4">Detail Barang</h5>
                <div class="table-responsive">
                    <table class="table table-bordered mb-4" style="border-collapse: collapse !important;" id="tabel-detail-barang">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Nama Barang</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Jenis</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Jumlah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Harga Satuan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder pb-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end text-sm fw-bolder pe-3">Total Biaya EXW :</td>
                                <td class="total text-sm text-end fw-bolder"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <h5 class="text-center fw-bolder mt-5 mb-4">Biaya Lainnya</h5>
                <div class="table-responsive px-4">
                    <table class="table table-striped border-top" style="border-collapse: collapse !important;" id="tabel-biaya-lainnya">
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end text-sm fw-bolder border-end pe-3">Total Biaya Lainnya :</td>
                                <td class="total text-sm text-end fw-bolder"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-1" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/js/custom/shipment.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let message = 'Apakah anda yakin ingin menambah data?';

    $(function() {
        const BASEURL = window.location.href;
        const formater = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        $('.tombolTambahData').click(function() {
            message = 'Apakah anda yakin ingin menambah data?';

            $("#formModal").removeClass("edit");
            $('#modalLabel').html('Tambah Data')
            $('.modal-footer button[type=submit]').html('Tambah Data');
            $(".modal-body form").attr("action", `${BASEURL}/insert`);
            $(".modal-body form")[0].reset();
            $("#tanggal").prop('disabled', false);

            detailBarang.innerHTML = `
                <tr>
                    <td class="text-center align-middle">1</td>
                    <td class="px-1">
                        <input type="text" class="form-control nama" name="nama[]" list="barang" autocomplete="off" placeholder="Nama Barang" required>
                    </td>
                    <td class="px-1">
                        <select class="form-select jenis" name="jenis[]" required disabled>
                            <option value="bahan">Bahan</option>
                            <option value="kemasan">Kemasan</option>
                        </select>
                    </td>
                    <td class="px-1">
                        <input type="number" class="form-control count-sub" name="jumlah[]" placeholder="0" min="0" required>
                    </td>
                    <td class="px-1">
                        <select class="form-select satuan" name="satuan[]" required disabled>
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
                    </td>
                    <td class="px-1">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control count-sub" name="harga_satuan[]" placeholder="0" min="0" required>
                        </div>
                    </td>
                    <td class="px-1">
                        <div class="input-group bg-light">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="subtotal[]" value="0" readonly required>
                        </div>
                    </td>
                    <td class="px-1 align-middle text-center">
                        <button class="btn btn-danger btn-sm m-0 px-3 remove-detail-barang" type="button">
                            <i class="fa fa-xmark text-sm"></i>
                        </button>
                    </td>
                </tr>
            `;

            biayaLainnya.innerHTML = `
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <button class="btn btn-danger m-0 px-3 remove-biaya-lainnya" type="button">
                                <i class="fa fa-xmark"></i>
                            </button>
                            <input type="text" class="form-control ps-2" name="nama_biaya_lainnya[]" placeholder="Nama biaya">
                        </div>
                    </div>
                    <div class="col-sm-6 ps-0">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control ps-2 biaya-lainnya" name="biaya_lainnya[]" placeholder="0" min="0">
                        </div>
                    </div>
                </div>
            `;

            refreshEvent();
        });

        $(".tampilModalUbah").click(function() {
            message = 'Apakah anda yakin ingin mengubah data?';
            const id = $(this).data("id");

            $("#formModal").addClass("edit");
            $("#modalLabel").html("Ubah Data");
            $(".modal-footer button[type=submit]").html("Ubah Data");
            $(".modal-body form").attr("action", `${BASEURL}/update/${id}`);
            $("#tanggal").prop('disabled', true);

            $.ajax({
                url: `${BASEURL}/getubah/${id}`,
                method: "get",
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $("#nama").val(data.nama);
                    $("#tanggal").val(data.tanggal);
                    $("#no_faktur").val(data.no_faktur);
                    $("#supplier_id").val(data.supplier_id);
                    $("#deskripsi").val(data.deskripsi);
                    $("#total_berat").val(data.total_berat);

                    // Detail barang
                    detailBarang.innerHTML = '';
                    let detail_barang = JSON.parse(data.detail_barang);
                    detail_barang.forEach((barang, i) => {
                        let find = barang_all.find(item => item.nama === barang.nama);
                        let jenis = find.jenis;
                        let satuan = find.satuan;

                        let row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="text-center align-middle">${i+1}</td>
                            <td class="px-1">
                                <input type="text" class="form-control nama" name="nama[]" value="${barang.nama}" list="barang" autocomplete="off" placeholder="Nama Barang" required>
                            </td>
                            <td class="px-1">
                                <select class="form-select jenis" name="jenis[]" required disabled>
                                    <option value="bahan"${jenis == 'bahan' ? ' selected' : ''}>Bahan</option>
                                    <option value="kemasan"${jenis == 'kemasan' ? ' selected' : ''}>Kemasan</option>
                                </select>
                            </td>
                            <td class="px-1">
                                <input type="number" class="form-control count-sub" name="jumlah[]" value="${barang.jumlah}" placeholder="0" min="0" required>
                            </td>
                            <td class="px-1">
                                <select class="form-select satuan" name="satuan[]" required disabled>
                                    <option value="Kg"${satuan == 'Kg' ? ' selected' : ''}>Kg</option>
                                    <option value="Ons"${satuan == 'Ons' ? ' selected' : ''}>Ons</option>
                                    <option value="Box"${satuan == 'Box' ? ' selected' : ''}>Box</option>
                                    <option value="Pack"${satuan == 'Pack' ? ' selected' : ''}>Pack</option>
                                    <option value="Liter"${satuan == 'Liter' ? ' selected' : ''}>Liter</option>
                                    <option value="Lusin"${satuan == 'Lusin' ? ' selected' : ''}>Lusin</option>
                                    <option value="Gros"${satuan == 'Gros' ? ' selected' : ''}>Gros</option>
                                    <option value="Rim"${satuan == 'Rim' ? ' selected' : ''}>Rim</option>
                                    <option value="Kodi"${satuan == 'Kodi' ? ' selected' : ''}>Kodi</option>
                                    <option value="pcs"${satuan == 'pcs' ? ' selected' : ''}>pcs</option>
                                    <option value="meter"${satuan == 'meter' ? ' selected' : ''}>meter</option>
                                </select>
                            </td>
                            <td class="px-1">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control count-sub" name="harga_satuan[]" value="${barang.harga_satuan}" placeholder="0" min="0" required>
                                </div>
                            </td>
                            <td class="px-1">
                                <div class="input-group bg-light">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="subtotal[]" value="${barang.subtotal}" readonly required>
                                </div>
                            </td>
                            <td class="px-1 align-middle text-center">
                                <button class="btn btn-danger btn-sm m-0 px-3 remove-detail-barang" type="button">
                                    <i class="fa fa-xmark text-sm"></i>
                                </button>
                            </td>
                        `;
                        detailBarang.appendChild(row);
                    });
                    $("#total_exw").val(data.total_exw);

                    // Detail biaya lainnya
                    let biaya_lainnya = JSON.parse(data.biaya_lainnya);
                    biayaLainnya.innerHTML = '';

                    for (let key in biaya_lainnya) {
                        let biaya = document.createElement('div');
                        biaya.setAttribute('class', 'row');
                        biaya.innerHTML = `
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <button class="btn btn-danger m-0 px-3 remove-biaya-lainnya" type="button">
                                        <i class="fa fa-xmark"></i>
                                    </button>
                                    <input type="text" class="form-control ps-2" name="nama_biaya_lainnya[]" value=${key} placeholder="Nama biaya">
                                </div>
                            </div>
                            <div class="col-sm-6 ps-0">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control ps-2 biaya-lainnya" name="biaya_lainnya[]" value=${biaya_lainnya[key]} placeholder="0" min="0">
                                </div>
                            </div>
                        `;
                        biayaLainnya.appendChild(biaya);
                    }

                    $("#total_biaya_lainnya").val(data.total_biaya_lainnya);
                    $("#diskon").val(data.diskon);
                    $("#total").val(data.total);
                    $("#harga_all_in").val(data.harga_all_in);

                    refreshEvent();
                },
            });
        });

        $(".tampilModalDetail").click(function() {
            const id = $(this).data("id");

            $("#tabel-detail-barang tbody").html('');
            $("#tabel-biaya-lainnya tbody").html('');
            $("#tabel-biaya-lainnya").hide();

            $.ajax({
                url: `${BASEURL}/getubah/${id}`,
                method: "get",
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    let detail_barang = JSON.parse(data.detail_barang);
                    detail_barang.forEach((barang, i) => {
                        let detail = barang_all.find(item => item.nama === barang.nama);

                        $("#tabel-detail-barang tbody").append(`
                            <tr>
                                <td class="text-sm text-center">${i+1}</td>
                                <td class="text-sm text-start">${barang.nama}</td>
                                <td class="text-sm text-center">${detail.jenis}</td>
                                <td class="text-sm text-center">${barang.jumlah} ${detail.satuan}</td>
                                <td class="text-sm text-center">${formater.format(barang.harga_satuan).replace(',00', '')}</td>
                                <td class="text-sm text-end fw-bold">${formater.format(barang.subtotal).replace(',00', '')}</td>
                            </tr>
                        `);
                    });
                    $('#tabel-detail-barang .total').html(formater.format(data.total_exw).replace(',00', ''))

                    if (data.biaya_lainnya !== '{}') {
                        let biaya_lainnya = JSON.parse(data.biaya_lainnya);
                        
                        $("#tabel-biaya-lainnya").show();
                        let i = 1;
                        for (let nama in biaya_lainnya) {
                            $("#tabel-biaya-lainnya tbody").append(`
                                <tr>
                                    <td class="text-sm text-center">${i++}</td>
                                    <td class="text-sm text-start">${nama}</td>
                                    <td class="text-sm text-end fw-bold">${formater.format(biaya_lainnya[nama]).replace(',00', '')}</td>
                                </tr>
                            `);
                        }
                        $('#tabel-biaya-lainnya .total').html(formater.format(data.total_biaya_lainnya).replace(',00', ''))
                    }
                },
            });
        });
    });
</script>

<?php Get::view('templates/footer', $data) ?>