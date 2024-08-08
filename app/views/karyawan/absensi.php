<?php Get::view('templates/header', $data) ?>

<!-- Generate Code -->
<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('<?= BASEURL; ?>/img/curved-images/curved14.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <h5>Rekap Kehadiran Karyawan MeatGenkz</h5>
        <p>Bulan: <?php echo date('F', mktime(0, 0, 0, $data['filter']['bulan'], 10)); ?> <br> Tahun:
            <?php echo $data['filter']['tahun']; ?>
        </p>
        <form action="<?= BASEURL; ?>/Absen/import/" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="btn_excel" style="display:none">
            <button type="button" class="btn bg-gradient-primary mb-0" onclick="importexcel('#btn_excel')">
                Import Data Dari excel
            </button>
            <button type="submit" class="btn bg-gradient-dark mb-0">
                kirim
            </button>
        </form>
        <!-- Filter -->
        <div class="mt-4 mb-5">
            <form class="row g-3 align-middle" method="post">
                <div class="col-md-3">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select class="form-select" name="bulan" id="bulan">
                        <?php $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] ?>
                        <?php foreach ($months as $i => $month) : ?>
                            <option value="<?= $i + 1 ?>" <?= ($i == $data['filter']['bulan'] - 1) ? ' selected' : '' ?>>
                                <?= $month ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select class="form-select" name="tahun" id="tahun">
                        <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++) : ?>
                            <option value="<?= $i ?>" <?= ($i == $data['filter']['tahun']) ? ' selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-2 pb-0 mt-5 d-flex flex-column">
                    <button type="submit" class="btn bg-gradient-primary mb-0"><i class="fa fa-search-plus" aria-hidden="true"></i> Search</button>
                </div>
        <div class="row gx-4">
            <div class="col-md-12 mb-lg-0 mb-4">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5 class="mb-0">Generate Code</h5>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#editdeskripsimodal"
                            href="javascript:;">Edit Deskripsi</a>
                    </div>
                </div>  
                <div class="card-body px-0">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between align-middle">
                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center
                            flex-row">
                                <h5 class="kode mb-0">f3klkj90okklkn23ajkqvm78</h5>
                                <div class="ms-auto" data-bs-toggle="modal" data-bs-target="#generatemodal">
                                    <i class="fas fa-sync ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Generate code"></i>
                                </div>
                            </div>
                            <a href="<?= BASEURL ?>/absensi/qrcode">
                                <div class="card-body text-center py-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Show QR Code">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-dark shadow text-center border-radius-lg">
                                        <i class="fas fa-qrcode opacity-10"></i>
                                    </div>
                                    <h6 class="mt-2 mb-0 text-sm">Preview</h6>
                                </div>
                            </a>
                        </div>

                <div class="col-md-4 pb-0 mt-5 d-flex flex-column align-items-end">
                    <div class="dropdown">
                        <button class="btn bg-gradient-dark mb-0 dropdown-toggle" type="button" id="exportButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Export Laporan
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportButton">
                            <li>
                                <a class="dropdown-item" href="#" id="printAction">Print</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" id="excelAction">Excel</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table id="table1" class="table table-sm table-bordered table-hover text-nowrap">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-wrap">Nama</th>
                        <th colspan="<?= $data['hari'] ?>" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Hadir</th>
                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Terlambat</th>
                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Menit Terlambat</th>
                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Jam Kerja</th>

                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= $data['hari']; $i++) { ?>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $i; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['result'] as $row) :
                        $num = $no++; ?>
                        <tr>
                            <td class="text-sm text-center font-weight-bold mb-0"><?= $num; ?></td>
                            <td class="text-sm text-start font-weight-bold mb-0"><?= $row['karyawan']; ?></td>
                            <?php for ($i = 1; $i <= $data['hari']; $i++) { ?>
                                <?php
                                // Determine status and class based on lateness
                                $status_id = $row['tgl_' . $i];
                                $terlambat = $row['terlambat_' . $i];
                                $status_text = ($terlambat > 0) ? 'terlambat' : status($status_id);
                                $status_class = ($terlambat > 0) ? 'bg-gradient-warning text-light' : getClass($status_id);
                                $tooltip = ($terlambat > 0) ? 'data-toggle="tooltip" title="Terlambat ' . $terlambat . ' menit"' : '';
                                ?>
                                <td class="<?= $status_class; ?> text-sm text-center font-weight-bold mb-0" <?= $tooltip; ?>>
                                    <?= $status_text; ?>
                                </td>
                            <?php } ?>
                            <td class="text-sm text-center font-weight-bold mb-0"><?= $row['total_hadir']; ?></td>
                            <td class="text-sm text-center font-weight-bold mb-0"><?= $row['total_terlambat']; ?></td>
                            <td class="text-sm text-center font-weight-bold mb-0"><?= $row['total_menit_terlambat']; ?> menit</td>
                            <td class="text-sm text-center font-weight-bold mb-0"><?= $row['total_jam_kerja']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
function status($id)
{
    $arr = [
        0 => 'alpha',
        1 => 'hadir'
    ];

    return $arr[$id];
}

function getClass($id)
{
    $bg = [
        0 => 'bg-gradient-danger text-light', // Alpha
        1 => 'bg-gradient-success text-light' // Hadir
    ];

    return $bg[$id];
}
?>

<!-- Initialize Bootstrap Tooltip -->
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


<!-- Tabel -->
<div class="container-fluid mt-5" id="dataDetailAbsen">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Rekap Kehadiran Karyawan</h5>
                    <p>Bulan: November <br> Tahun: 2023</p>
                    <!-- Filter -->
                    <div class="mt-4 mb-5">
                        <form class="row g-3 align-middle">
                            <div class="col-md-3">
                                <label for="month" class="form-label">Bulan</label>
                                <select class="form-select" name="month" id="month" aria-label="Default select example">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="year" class="form-label">Tahun</label>
                                <select class="form-select" name="year" id="year" aria-label="Default select example">
                                </select>
                            </div>
                            <div class="col-md-2 pb-0 mt-5 d-flex flex-column">
                                <button type="button" class="btn bg-gradient-dark mb-0"><i class="fa fa-search-plus"
                                        aria-hidden="true"></i> Search</button>
                            </div>
                            <div class="col-md-4 pb-0 mt-5 d-flex flex-column align-items-end">

                                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <button type="button" class="btn bg-gradient-dark mb-0">Ekspor
                                            Laporan</button>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                        aria-labelledby="dropdownMenuButton">
                                        <li class="mb-2">
                                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                                <div class="d-flex py-1" id="printBtn">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1"><i
                                                                class="fa fa-print me-1"></i>Print </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                                <div class="d-flex py-1" id="exportBtn">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <span class="font-weight-bold"><i
                                                                    class="fa fa-print me-1"></i>Excel</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">

                            <table id="table-absen" class="table table-sm table-bordered table-hover text-nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:100px">Nama</th>
                                        <th colspan="13" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                        <th rowspan="2" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Hadir</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">1</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">2</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">3</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">4</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">5</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">4</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">5</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">6</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">7</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">8</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">6</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">7</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:40px">8</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">1</td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Anjana Anjayani</td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Izin
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Alpha
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Izin
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Izin
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">Hadir
                                        </td>
                                        <td class="align-middle text-sm text-center font-weight-bold mb-0 px-3">26</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

<!-- End Tabel -->


<!-- Generate Modal -->
<div class="modal fade" id="generatemodal" tabindex="-1" aria-labelledby="generatemodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdata">Masukkan Password</h5>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <label for="deskripsi">Password</label>
                    <input type="text" class="form-control" id="deskripsi" placeholder="Masukkan password login admin"
                        required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn bg-gradient-primary">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Deskripsi Modal -->
<div class="modal fade" id="editdeskripsimodal" tabindex="-1" aria-labelledby="editdeskripsimodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdata">Edit Deskripsi</h5>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <label for="deskripsi">Date</label>
                    <input type="date" class="form-control" id="tanggal" required>
                    <label class="mt-1" for="deskripsi">Status</label>
                    <select name="type" class="form-control form-select" required="">
                        <option disabled value=""> </option>
                        <option value="1"> Clock In (16.00 : 18.00) </option>
                        <option value="2"> Clock Out (16.00 : 18.00)</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn bg-gradient-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?php Get::view('templates/footer', $data) ?>

<script>
    $(document).ready(function () {
        var table = $('#table1').DataTable({
            lengthChange: false,

            fixedColumns: {
                left: 2,
                right: 0
            },
            paging: true,
            scrollX: true,
            language: {
                paginate: {
                    previous: '<i class="bi bi-chevron-left"></i>',
                    next: '<i class="bi bi-chevron-right"></i>'
                }
            }
        });

        table.buttons().container()
            .appendTo('#table_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const rejectButtons = document.querySelectorAll(".delete-button");
    rejectButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data ini akan terhapus.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ea0606",
                cancelButtonColor: "#344767",
                confirmButtonText: "Ya, Saya Yakin",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Data berhasil dihapus.",
                        showConfirmButton: false,
                        timer: 1200,
                    });
                }
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        var table = document.getElementById("table1");
        var wb = XLSX.utils.table_to_book(table, {
            sheet: "Sheet JS"
        });
        var wbout = XLSX.write(wb, {
            bookType: 'xlsx',
            type: 'binary'
        });

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }

        var fileName = "datakeuangan.xlsx";
        saveAs(new Blob([s2ab(wbout)], {
            type: "application/octet-stream"
        }), fileName);
    }

    document.getElementById("excelAction").addEventListener("click", exportToExcel);

    function printContent() {
        var table = document.getElementById("table1");
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: "Open Sans", sans-serif; }');
        printWindow.document.write('table { border-collapse: collapse; width: 100%; }');
        printWindow.document.write('th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }');
        printWindow.document.write('th { background-color: #f2f2f2; }');
        printWindow.document.write('</style></head><body>');
        printWindow.document.write('<table>');
        printWindow.document.write(table.innerHTML);
        printWindow.document.write('</table>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

    document.getElementById("printAction").addEventListener("click", printContent);
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>


<script>
    function importexcel(id) {
        const btn = document.querySelector(id);
        btn.click();

    }
</script>

</body>

</html>