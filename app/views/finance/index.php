    <?php Get::view('templates/header', $data) ?>

    <?php
    $kuartal_option = [
        '1' => 'Kuartal 1 | Januari - Maret',
        '2' => 'Kuartal 2 | April - Juni',
        '3' => 'Kuartal 3 | Juli - September',
        '4' => 'Kuartal 4 | Oktober - Desember',
    ];

    $bulan = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $saldo = 0;
    $pemasukan = 0;
    $pengeluaran = 0;

    foreach ($data['finance'] as $finance) {
        if ($finance['kategori'] == 'masuk') {
            $pemasukan += $finance['jumlah'];
        } else {
            $pengeluaran += $finance['jumlah'];
        }
    }
    ?>
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
                                        <i class="ki-solid ki-bank text-primary fs-1"></i>
                                    </span>
                                </div>
                                <div class="card-title align-items-start flex-column">
                                    <!--begin::Title-->
                                    <h1
                                        class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                        Finance</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Finance</li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Rekapitulasi</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                            </div>
                        </div>
                        <!--end::Page title-->
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center gap-2 gap-lg-3 mx-300px">
                            <div class="w-100 mw-150px">
                                <select class="form-select form-select-solid" name="tahun" id="tahun">
                                    <?php $currentYear = date('Y');
                                    for ($i = $currentYear - 5; $i <= $currentYear; $i++): ?>
                                        <option value='<?= $i ?>' <?= ($i == $data['tahun']) ? 'selected' : '' ?>>
                                            <?= $i ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="w-100 mw-150px">
                                <select class="form-select form-select-solid" name="kuartal" id="kuartal">
                                    <?php foreach ($kuartal_option as $key => $opt): ?>
                                        <option value="<?= $key ?>" <?= ($key == $data['kuartal']) ? 'selected' : '' ?>>
                                            <?= $opt ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex flex align-items-end justify-content-center">
                                <button type="submit" class="btn btn-secondary m-0 px-4 filter">
                                    <i class="ki-solid ki-magnifier pe-0"></i>
                                </button>
                            </div>
                            <div class="d-flex flex align-items-end justify-content-center">
                                <button type="reset" class="btn btn-secondary m-0 px-4 filter"
                                    onclick="window.location.href = '<?= BASEURL ?>/finance'">
                                    <i class="ki-solid ki-cross-circle pe-0"></i>
                                </button>
                            </div>
                        </div>
                        <!--end::Actions-->
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
                    <div class="row mb-5">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="card card-flush">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="symbol symbol-55px me-8">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-solid ki-chart-simple-2 text-primary fs-1"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fs-5 fw-bold pb-2">Total Pemasukan</span>
                                            <div class="d-flex align-items-center">
                                                <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2">Rp
                                                    <?= number_format($pemasukan, 0, ',', '.') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="card card-flush">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="symbol symbol-55px me-8">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-solid ki-chart-simple-3 text-primary fs-1"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fs-5 fw-bold pb-2">Total Pengeluaran</span>
                                            <div class="d-flex align-items-center">
                                                <span class="fs-1 fw-bold text-gray-900 lh-1 ls-n2">Rp
                                                    <?= number_format($pengeluaran, 0, ',', '.') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Products-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <h1
                                        class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0 me-3">
                                        <?= $data['tahun'] ?>
                                    </h1>
                                    <h5
                                        class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                        <?= $kuartal_option[$data['kuartal']] ?>
                                    </h5>
                                </div>
                                <!--end::Search-->
                                <!--begin::Export buttons-->
                                <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                                <!--end::Export buttons-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <!--begin::Export dropdown-->
                                <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-outline ki-exit-up fs-2"></i>Ekspor Laporan</button>
                                <!--begin::Menu-->
                                <div id="kt_ecommerce_report_views_export_menu"
                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="copy">Copy to
                                            clipboard</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="excel">Export as
                                            Excel</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="csv">Export as
                                            CSV</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="pdf">Export as
                                            PDF</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Export dropdown-->
                                <!--begin::Add product-->
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#formModal">Tambah Data</a>
                                <!--end::Add product-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5"
                                    id="kt_ecommerce_report_views_table">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                        value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-175px align-middle">Tanggal</th>
                                            <th class="min-w-150px align-middle">Kode</th>
                                            <th class="text-center min-w-75px align-middle">No. Akun</th>
                                            <th class="min-w-250px align-middle">Deskripsi</th>
                                            <th class="min-w-150px align-middle">Debit</th>
                                            <th class="min-w-150px align-middle">Kredit</th>
                                            <th class="min-w-200px align-middle">Saldo</th>
                                            <th class="text-end min-w-70px align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        <?php foreach ($data['finance'] as $finance): ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="<?= $finance['id']; ?>" />
                                                    </div>
                                                </td>
                                                <td class="text-start pe-0">
                                                    <span class="fw-bold">
                                                        <?= date('d', strtotime($finance['tanggal'])) ?>
                                                        <?= $bulan[date('n', strtotime($finance['tanggal'])) - 1] ?>
                                                        <?= date('Y', strtotime($finance['tanggal'])) ?>
                                                    </span>
                                                </td>
                                                <td class="text-start pe-0">
                                                    <a
                                                        class="badge badge-light-<?= ($finance['kategori'] == 'masuk') ? 'success' : 'danger' ?> copy-badge">
                                                        <i
                                                            class="ki-solid  ki-archive-tick me-2 text-<?= ($finance['kategori'] == 'masuk') ? 'success' : 'danger' ?>"></i>
                                                        <span><?= $finance['kode'] ?></span>
                                                    </a>
                                                </td>
                                                <td class="text-center pe-0">
                                                    <span class="fw-bold"><?= $finance['no_akun'] ?></span>
                                                </td>
                                                <td class="text-start pe-0">
                                                    <span class="fw-bold"><?= $finance['deskripsi'] ?></span>
                                                </td>
                                                <td class="text-start pe-0">
                                                    <?= ($finance['kategori'] == 'masuk') ? 'Rp ' . number_format($finance['jumlah'], 0, ',', '.') : '' ?>
                                                </td>
                                                <td class="text-start pe-0">
                                                    <?= ($finance['kategori'] == 'keluar') ? 'Rp ' . number_format($finance['jumlah'], 0, ',', '.') : '' ?>
                                                </td>
                                                <?php
                                                if ($finance['kategori'] == 'masuk') {
                                                    $saldo += $finance['jumlah'];
                                                } else {
                                                    $saldo -= $finance['jumlah'];
                                                }
                                                ?>
                                                <td class="text-start pe-0">
                                                    Rp <?= number_format($saldo, 0, ',', '.') ?>
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
                                                            <a class="menu-link px-3 tampilModalUbah" data-bs-toggle="modal"
                                                                data-bs-target="#formModal"
                                                                data-id="<?= $finance['id']; ?>">Edit</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="<?= BASEURL; ?>/finance/delete/<?= $finance['id'] ?>"
                                                                class="menu-link px-3" data-id="<?= $finance['id']; ?>"
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
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Products-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->

            <script src="<?= BASEURL ?>/js/datatables.js"></script>

            <!-- modal -->
            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
                    <div class="modal-content rounded">
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <i class="ki-outline ki-cross fs-1"></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                            <!--begin::Heading-->
                            <div class="mb-13 mt-0 text-center">
                                <!--begin::Title-->
                                <h1 class="mb-3" id="modalLabel">Tambah Data Finance</h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <form action="<?= BASEURL ?>/finance/insert" method="post" enctype="multipart/form-data">
                                <?= csrf() ?>
                                <input type="hidden" name="id" id="id">
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">No. Akun</label>
                                        <input class="form-control form-control-solid" placeholder="Pilih nomor akuntansi"
                                            name="no_akun" id="no_akun" list="akuntansi">
                                        <datalist id="akuntansi">
                                            <?php foreach ($data['akuntansi'] as $nomor): ?>
                                                <option value="<?= $nomor['akun'] ?>">
                                                <?php endforeach; ?>
                                        </datalist>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Tanggal</label>
                                        <!--begin::Input-->
                                        <div class="position-relative d-flex align-items-center">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Datepicker-->
                                            <input type="date" class="form-control form-control-solid ps-12"
                                                placeholder="Pilih tanggal" name="tanggal" id="tanggal"
                                                value="<?= date('Y-m-d') ?>" />
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                                    <!--begin:Option-->
                                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                                        <!--begin:Label-->
                                        <span class="d-flex align-items-center me-2">
                                            <!--begin::Icon-->
                                            <span class="symbol symbol-50px me-6">
                                                <span class="symbol-label">
                                                    <i class="ki-outline ki-chart-simple-2 fs-1 text-gray-600"></i>
                                                </span>
                                            </span>
                                            <!--end::Icon-->
                                            <!--begin::Description-->
                                            <span class="d-flex flex-column">
                                                <span class="fw-bold text-gray-800 text-hover-primary fs-5">Pemasukan</span>
                                                <span class="fs-6 fw-semibold text-muted">Semua pendapatan yang diterima yang mendukung operasional restoran</span>
                                            </span>
                                            <!--end:Description-->
                                        </span>
                                        <!--end:Label-->
                                        <!--begin:Input-->
                                        <span class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="kategori" id="masuk"
                                                value="masuk" />
                                        </span>
                                        <!--end:Input-->
                                    </label>
                                    <!--end::Option-->
                                    <!--begin:Option-->
                                    <label class="d-flex flex-stack mb-5 cursor-pointer">
                                        <!--begin:Label-->
                                        <span class="d-flex align-items-center me-2">
                                            <!--begin::Icon-->
                                            <span class="symbol symbol-50px me-6">
                                                <span class="symbol-label">
                                                    <i class="ki-outline ki-chart-simple-3 fs-1 text-gray-600"></i>
                                                </span>
                                            </span>
                                            <!--end::Icon-->
                                            <!--begin::Description-->
                                            <span class="d-flex flex-column">
                                                <span
                                                    class="fw-bold text-gray-800 text-hover-primary fs-5">Pengeluaran</span>
                                                <span class="fs-6 fw-semibold text-muted">Semua biaya yang dikeluarkan untuk kebutuhan restoran</span>
                                            </span>
                                            <!--end:Description-->
                                        </span>
                                        <!--end:Label-->
                                        <!--begin:Input-->
                                        <span class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="kategori" id="keluar"
                                                value="keluar" />
                                        </span>
                                        <!--end:Input-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                                    <textarea class="form-control form-control-solid" name="deskripsi" id="deskripsi"
                                        placeholder="Cth: Biaya shipment"></textarea>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nominal / Jumlah</label>
                                    <input type="number" class="form-control form-control-solid" name="jumlah" id="jumlah"
                                        placeholder="Cth: 20000">
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--begin::Javascript-->
                <script>
                    var hostUrl = "assets/";
                </script>
                <!--begin::Global Javascript Bundle(mandatory for all pages)-->
                <script src="<?= BASEURL ?>/plugins/global/plugins.bundle.js"></script>
                <script src="<?= BASEURL ?>/js/scripts.bundle.js"></script>
                <!--end::Global Javascript Bundle-->
                <!--begin::Vendors Javascript(used for this page only)-->
                <script src="<?= BASEURL ?>/js/widgets.bundle.js"></script>
                <script src="<?= BASEURL ?>/js/custom/widgets.js"></script>
                <script src="<?= BASEURL ?>/plugins/custom/datatables/datatables.bundle.js"></script>\
                <script src="<?= BASEURL ?>/js/custom/apps/ecommerce/reports/views/views.js"></script>
                <!--end::Custom Javascript-->
                <!--end::Javascript-->

                <script>
                    $(function() {
                        const BASEURL = window.location.href;
                        const no_akun = Array.from(document.getElementById('akuntansi').options).map(opt => opt.value);

                        $('#no_akun').on('change', function() {
                            let val = $(this).val();
                            let find = no_akun.find(no => no == val);
                            if (!find) {
                                alert('No akun tidak ada dalam daftar!');
                                $(this).val('');
                            }
                        });

                        $('.tombolTambahData').on('click', function() {
                            $('#modalLabel').html('Tambah Data')
                            $('.modal-footer button[type=submit]').html('Tambah Data Finance');
                            $(".modal-body form")[0].reset();
                            $(".modal-body form").attr("action", `${BASEURL}/insert`);
                        });

                        $(".tampilModalUbah").click(function() {
                            $("#modalLabel").html("Ubah Data Finance");
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
                                    console.log(data);
                                    $('#id').val(data.id); // Set nilai ID
                                    $('#tanggal').val(data.tanggal);
                                    $('#no_akun').val(data.no_akun);
                                    $(`#${data.kategori}`).prop('checked', true);
                                    $('#deskripsi').val(data.deskripsi);
                                    $('#jumlah').val(data.jumlah);
                                },
                            })
                        })
                    });
                </script>

                <?php Get::view('templates/footer', $data) ?>