<?php Get::view('templates/header', $data) ?>

<div class="container-fluid mb-5">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('<?= BASEURL ?>/img/curved-images/curved14.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="<?= BASEURL ?>/img/datafoto/pp.png" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm" draggable="false">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Hello Adel!
                    </h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active" id="attedance-tab" data-bs-toggle="tab"
                                href="javascript:;" role="tab" aria-selected="true">
                                <i class="fa fa-qrcode"></i>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(603.000000, 0.000000)">
                                                <path class="color-background"
                                                    d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                    opacity="0.7"></path>
                                                <path class="color-background"
                                                    d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                    opacity="0.7"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                                </svg>
                                <span class="ms-1">Attendance</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1" id="histori-tab" data-bs-toggle="tab" href="javascript:;"
                                role="tab" aria-selected="false">
                                <i class="fa fa-calendar"></i>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(154.000000, 300.000000)">
                                                <path class="color-background"
                                                    d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                    opacity="0.603585379"></path>
                                                <path class="color-background"
                                                    d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                                </svg>
                                <span class="ms-1">Histori</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero -->

<!-- Card Absensi -->
<div class="container-fluid fade show" id="attendance-card">
    <div class="card mb-4 pb-0">
        <div class="card-body mb-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl"
                            style="background-image: url('<?= BASEURL ?>/img/curved-images/curved14.jpg');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body position-relative z-index-1 p-3">
                                <i class="fas fa-clock text-white mb-3 p-2"></i>
                                <h1 class="jam text-white mt-3 mb-5 pb-2">jam</h1>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <p class="text-white text-sm opacity-8 mb-0" id="datelabel">Date</p>
                                        <h6 class="text-white mb-0" id="datevalue"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-1">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-start align-items-center">
                                <i class="fa fa-clipboard-list me-2 fs-5"></i>
                                <h6 class="mb-0">Form Izin</h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan"
                                        placeholder="Cth: Sakit" oninput="toTitleCase(this)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Bukti Foto</label>
                                    <div id="preview"
                                        class="w-100 mb-2 rounded-2 overflow-hidden d-flex align-items-center justify-content-center"
                                        style="max-height: 12rem;"></div>
                                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                </div>
                                <button type="submit" class="btn bg-gradient-dark float-end mb-0">Simpan</button>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fa fa-clipboard-list me-2 fs-5"></i>
                                    <h6 class="mb-0">Form Izin</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                                            placeholder="Cth: Sakit" oninput="toTitleCase(this)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Bukti Foto</label>
                                        <div id="preview"
                                            class="w-100 mb-2 rounded-2 overflow-hidden d-flex align-items-center justify-content-center"
                                            style="max-height: 12rem;"></div>
                                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn bg-gradient-dark float-end mb-0">Simpan</button>
                                </form>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Card Absensi -->

<!-- Card Riwayat -->
<div class="container-fluid" id="histori-card">
    <div class="card mb-4 ">
        <div class="card-body mb-0">
            <div class="card-header py-0 px-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Your Attendance's</h6>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <i class="far fa-calendar-alt me-2"></i>
                        <small>Nov 2023</small>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Alpha</h6>
                                    <span class="text-xs">27 Nov 2023, at 12:30 PM</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                                Alpha
                            </div>
                        </div>
                        <hr class="horizontal dark mt-3 mb-1" />
                    </li>
                    <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Alpha</h6>
                                    <span class="text-xs">27 Nov 2023, at 12:30 PM</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                                Alpha
                            </div>
                        </div>
                        <hr class="horizontal dark mt-3 mb-1" />
                    </li>
                    <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Hadir</h6>
                                    <span class="text-xs">27 Nov 2023, at 12:30 PM</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                                Hadir
                            </div>
                        </div>
                        <hr class="horizontal dark mt-3 mb-1" />
                    </li>
                    <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Hadir</h6>
                                    <span class="text-xs">27 Nov 2023, at 12:30 PM</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                                Hadir
                            </div>
                        </div>
                        <hr class="horizontal dark mt-3 mb-1" />
                    </li>
                    <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Hadir</h6>
                                    <span class="text-xs">27 Nov 2023, at 12:30 PM</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                                Hadir
                            </div>
                        </div>
                        <hr class="horizontal dark mt-3 mb-1" />
                    </li>
                    <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Izin</h6>
                                    <span class="text-xs">27 Nov 2023, at 12:30 PM</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center text-info text-gradient text-sm font-weight-bold ms-auto">
                                Izin
                            </div>
                        </div>
                        <hr class="horizontal dark mt-3 mb-1" />
                    </li>
                    <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                        class="fas fa-arrow-down"></i></button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Izin</h6>
                                    <span class="text-xs">27 Nov 2023, at 12:30 PM</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center text-info text-gradient text-sm font-weight-bold ms-auto">
                                Izin
                            </div>
                        </div>
                        <hr class="horizontal dark mt-3 mb-1" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Card Riwayat -->


<!-- Modal Absen -->
<div class="modal fade" id="modalabsen" tabindex="-1" aria-labelledby="modalabsen" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan Here</h5>
            </div>
            <div class="modal-body">
                <div id="reader"></div>
                <div id="result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Absen -->

<!-- Modal Izin -->
<div class="modal fade" id="modalizin" tabindex="-1" aria-labelledby="modalizin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sakit / Izin</h5>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="izin_sakit" id="izin" value="izin">
                        <label class="form-check-label" for="izin">Izin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="izin_sakit" id="sakit" value="sakit">
                        <label class="form-check-label" for="sakit">Sakit</label>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn bg-gradient-primary">Kirim</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Izin -->
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


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"
    integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"
    integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w=="
    crossorigin="anonymous"></script>

<script>
    const scanner = new Html5QrcodeScanner('reader', {
        // Scanner will be initialized in DOM inside element with id of 'reader'
        qrbox: {
            width: 250,
            height: 250,
        },  // Sets dimensions of scanning box (set relative to reader element width)
        fps: 20, // Frames per second to attempt a scan
    });


    scanner.render(success, error);
    // Starts scanner

    function success(result) {

        document.getElementById('result').innerHTML = `
          <h2>Success!</h2>
          <p><a href="${result}">${result}</a></p>
          `;
        // Prints result as a link inside result element

        scanner.clear();
        // Clears scanning instance

        document.getElementById('reader').remove();
        // Removes reader element from DOM since no longer needed

    }

    function error(err) {
        console.error(err);
        // Prints any errors to the console
    }

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Default: Tampilkan kartu "Attendance" dan sembunyikan kartu "Histori"
        $("#attendance-card").show();
        $("#histori-card").hide();

        // Saat tombol "Histori" ditekan
        $("#histori-tab").click(function () {
            // Sembunyikan kartu "Attendance"
            $("#attendance-card").hide();
            // Tampilkan kartu "Histori"
            $("#histori-card").show();
        });

        // Saat tab "Attendance" ditekan
        $("#attedance-tab").click(function () {
            // Tampilkan kartu "Attendance"
            $("#attendance-card").show();
            // Sembunyikan kartu "Histori"
            $("#histori-card").hide();
        });
    });
</script>

<script>
    // Mendapatkan tanggal dan waktu saat ini
    var currentDateTime = new Date();

    // Mendapatkan tanggal
    var date = currentDateTime.toDateString();

    // Menampilkan tanggal dalam elemen dengan id "datevalue"
    document.getElementById("datevalue").textContent = date;
</script>

<script>
    // Fungsi untuk memperbarui jam setiap detik
    function updateClock() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();

        // Membuat format jam dan menambahkan nol jika kurang dari 10
        var formattedHours = hours < 10 ? "0" + hours : hours;
        var formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
        var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

        // Menampilkan waktu dalam elemen dengan kelas "jam"
        var jamElement = document.querySelector(".jam");
        jamElement.textContent = formattedHours + ":" + formattedMinutes + ":" + formattedSeconds;
    }

    // Memanggil fungsi updateClock() untuk pertama kali
    updateClock();

    // Memperbarui jam setiap detik
    setInterval(updateClock, 1000);
</script>


</body>

</html>