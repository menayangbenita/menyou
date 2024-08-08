<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- icon -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?= BASEURL ?>/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= BASEURL ?>/img/favicon.png">
    <!-- stylesheet -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- CSS -->
    <link href="<?= BASEURL ?>/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= BASEURL ?>/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= BASEURL ?>/icon/fa/css/fontawesome.min.css">
    <link id="pagestyle" href="<?= BASEURL ?>/css/soft-ui-dashboard.css" rel="stylesheet" />
    <!-- scripts -->
    <script src="<?= BASEURL ?>/js/plugins/fontawesome.js" crossorigin="anonymous"></script>
    <script src="<?= BASEURL ?>/js/plugins/chartjs.min.js"></script>
    <script src="<?= BASEURL ?>/js/jquery-1.10.2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!-- title -->
    <title>POS - <?= $data['title'] ?></title>

    <!-- styles -->
    <style>
        /* * {
            outline: 1px solid red !important;
        } */

        .hidden {
            display: none;
        }

        #chart-container {
            width: 60%;
            max-width: 450px;
            /* Mengurangi ukuran maksimal dari 600px ke 450px (75%) */
        }

        .chart,
        #chart-container {
            text-align: center;
        }

        .chart-canvas,
        #myPieChart {
            width: 100% !important;
            height: auto;
        }

        .center-text {
            text-align: center;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            table {
                visibility: visible;
            }
        }

        .animation-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 1rem;
            transition: transform 0.3s ease-in-out
        }

        .animation-card:hover {
            transform: scale(1.03);
        }

        .panel-title h6.text-secondary {
            border-bottom: 1px solid #ccc;
            padding-top: 10px;
            margin-bottom: 20px;
        }

        .text-secondary {
            padding-bottom: 15px;
        }

        @media (max-width: 768px) {

            div.dataTables_wrapper div.dataTables_length,
            div.dataTables_wrapper div.dataTables_filter,
            div.dataTables_wrapper div.dataTables_info,
            div.dataTables_wrapper div.dataTables_paginate {
                text-align: start;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                justify-content: end !important;
            }
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin-top: 10px;
            white-space: nowrap;
            justify-content: flex-end;
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

        .rounded-pill {
            border-radius: 50rem !important;
        }

        .btn-icon {
            padding: 0;
            width: calc(2.309375rem + 2px);
            height: calc(2.309375rem + 2px);
            display: inline-flex;
            flex-shrink: 0;
            justify-content: center;
            align-items: center;
        }

        .dataTables_scrollBody::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        .dataTables_scrollBody::-webkit-scrollbar {
            height: 8px;
            background-color: #F5F5F5;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #9e9a9a9a;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb:hover {
            border-radius: 10px;
            background-color: #9e9a9a;
        }

        .page-link {
            color: white;
        }

        #ofBar {
            display: none;
        }

        .qrcode-img img {
            height: 350px;
        }

        @media (max-width: 768px) {
            .qrcode-img img {
                height: 240px;
            }
        }

        @media (max-width: 1224px) {
            .qrcode-img img {
                height: 200px;
            }
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white float-end" href="<?= BASEURL ?>">
                <?= Get::model('Preferences')->getPreference('Nama_Perusahaan') ?>
            </a>
            <div class="navbar-brand font-weight-bolder me-lg-0 me-3 text-white float-start" href="<?= BASEURL ?>">
                <a href="<?= BASEURL ?>/absensi" class="btn bg-gradient-dark mb-0">
                    <i class="bi bi-chevron-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('<?= BASEURL ?>/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-3">Scan Here!</h1>
                        <p class="text-lead text-white">Scan the QR code to take attendance</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-lg-n15 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-3 col-md-5 mb-3">
                    <div class="card z-index-0">
                        <div class="card-body">
                            <form role="form text-left">
                                <div class="card bg-transparent shadow-xl">
                                    <div class="overflow-hidden position-relative border-radius-xl"
                                        style="background-image: url('<?= BASEURL ?>/img/curved-images/curved14.jpg');">
                                        <span class="mask bg-gradient-dark"></span>
                                        <div class="card-body position-relative z-index-1 p-3">
                                            <i class="fas fa-clock text-white p-2"></i>
                                            <p class="text-sm text-white mt-2 mb-2 opacity-8">Status: <a
                                                    class="text-white font-weight-bolder">Clock Out (16.00 : 18.00)</a>
                                            </p>
                                            <h1 class="jam text-white mt-1 pb-2">jam</h1>
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <p class="text-white text-sm opacity-8 mb-0" id="datelabel">Date</p>
                                                    <h6 class="text-white mb-0" id="datevalue"></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <div class="qrcode-img text-center">
                                <img src="<?= BASEURL ?>/img/qrcode.jpg" alt="" draggable="false">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="card move-on-hover overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex">
                                <h6 class="mb-0 me-3">08:00</h6>
                                <h6 class="mb-0">Clock In
                                    <small class="text-secondary font-weight-normal">Green</small>
                                </h6>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <h6 class="mb-0 me-3">08:00</h6>
                                <h6 class="mb-0">Clock In
                                    <small class="text-secondary font-weight-normal">Green</small>
                                </h6>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <h6 class="mb-0 me-3">08:00</h6>
                                <h6 class="mb-0">Clock In
                                    <small class="text-secondary font-weight-normal">Green</small>
                                </h6>
                            </div>
                        </div>
                        <a href="javascript:;" class="bg-gray-100 w-100 text-center py-1" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Show More">
                            <i class="fas fa-chevron-down text-primary"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-4 ">
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-dribbble"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-pinterest"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-github"></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> MeatGenkz. All right reserved Tiga Pilar Garuda
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!--   Core JS Files   -->
    <script src="<?= BASEURL ?>/js/core/popper.min.js"></script>
    <script src="<?= BASEURL ?>/js/core/bootstrap.min.js"></script>
    <script src="<?= BASEURL ?>/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= BASEURL ?>/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= BASEURL ?>/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

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