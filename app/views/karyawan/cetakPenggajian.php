<!-- <link rel="stylesheet" href="<?= BASEURL; ?>/css/invoice.css"> -->
<?php Get::view('templates/header', $data) ?>

<style>
    page[size="A4"] {
        background: white;
        width: 21cm;
        height: 29.7cm;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        font-size: 12px;

        html,
        body {
            width: 210mm;
            height: 297mm;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #printable,
        #printable * {
            visibility: visible;
        }

        #printable {
            position: absolute;
            left: 0;
            top: 0;
        }

        body {
            size: auto;
            margin: 0;
            box-shadow: 0;
        }

        page[size="A4"] {
            padding-top: -10cm;
            margin: 0;
            margin-top: -10cm;
            size: auto;
            box-shadow: 0;
        }

        page[size="thermal"] {
            margin: 0;
            size: auto;
            box-shadow: 0;
            font-family: 'Merchant Copy';
        }

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>

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
                                    Cetak Penggajian</h1>
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
                                    <li class="breadcrumb-item text-muted">Penggajian</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Cetak Penggajian</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <!--begin::Daterangepicker-->
                        <a href="<?= BASEURL; ?>/penggajian" class="btn btn-secondary mb-0">
                            <strong>
                                <i class="bi bi-chevron-left me-2"></i>
                                Back
                            </strong>
                        </a>
                        <!--end::Daterangepicker-->
                        <button class="btn btn-primary mb-0" id="actprint">
                            <i class="bi bi-printer-fill"></i>
                            Cetak
                        </button>
                    </div>
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
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div contenteditable="true">
                            <page size="a4" class="print-page" id="printable">
                                <div class="text-center">
                                    <h4><strong><?= Get::model('Preferences')->getPreference('Nama_Perusahaan') ?></strong>
                                    </h4>
                                    <p class="mb-0">Cabang <?= $data['karyawan']['nama_outlet'] ?>,
                                        <?= $data['karyawan']['alamat_outlet'] ?>
                                    </p>
                                    <p class="mb-4">Telp. <?= $data['karyawan']['telp_outlet'] ?></p>

                                    <p class="mb-0"><strong>Surat Keterangan Gaji</strong></p>
                                    <?php $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; ?>
                                    <p class="mb-5">Periode 1
                                        <?= $namaBulan[$data['bulan'] - 1] ?>
                                        <?= $data['tahun'] ?> -
                                        <?= date('t', strtotime($data['tahun'] . '-' . $data['bulan'] . '-01')) ?>
                                        <?= $namaBulan[$data['bulan'] - 1] ?>
                                        <?= $data['tahun'] ?>
                                    </p>
                                </div>

                                <div class="mb-4" style="text-align: justify;">
                                    <p class="mb-0">Kepada,</p>
                                    <p class="mb-0">
                                        <?= $data['karyawan']['nama'] ?>
                                    </p>
                                    <p class="mb-0">
                                        <?= $data['karyawan']['alamat'] ?>
                                    </p>
                                    <br>
                                    <p class="mb-2">Dengan hormat,</p>
                                    <p class="mb-3" style="text-indent: 32px;">
                                        Sehubungan dengan itu, kami bermaksud untuk memberikan informasi mengenai
                                        rincian penggajian
                                        Anda
                                        pada bulan
                                        <?= $namaBulan[$data['bulan'] - 1] ?> tahun
                                        <?= $data['tahun'] ?>.
                                        Berikut adalah rincian penghasilan dan potongan yang telah diterapkan:
                                    </p>
                                </div>

                                <div class="table-responsive my-3">
                                    <table class="table table-bordered w-100" style=" border-collapse: collapse;">
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="text-center min-w-50px">
                                                    No</th>
                                                <th class="text-start min-w-175px" colspan="2">
                                                    Nama Gaji</th>
                                                <th class="text-end min-w-175px">
                                                    Nominal
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <tr>
                                                <td class="text-center fw-bold">
                                                    <span><?= $i++ ?></span>
                                                </td>
                                                <td class="text-start fw-bold" colspan="2">
                                                    <span>Gaji Pokok</span>
                                                </td>
                                                <td class="text-end fw-bold">
                                                    Rp
                                                    <?= number_format($data['karyawan']['gaji_pokok'], 0, '', '.') ?>
                                                </td>
                                            </tr>
                                            <?php $gajiSekunder = [] ?>
                                            <?php foreach ($data['reward_punishment'] as $reward): ?>
                                                <?php if ($reward['jenis'] != 'reward')
                                                    continue; ?>
                                                <tr>
                                                    <td class="text-center fw-bold">
                                                        <?= $i++ ?>
                                                    </td>
                                                    <td class="text-start fw-bold">
                                                        Reward
                                                    </td>
                                                    <td class="text-start fw-bold">
                                                        <?= $reward['keterangan'] ?>
                                                    </td>
                                                    <td class="text-success text-end fw-bold">
                                                        Rp <?= number_format($reward['total'], 0, '', '.') ?>
                                                    </td>
                                                </tr>
                                                <?php array_push($gajiSekunder, $reward['total']); ?>
                                            <?php endforeach; ?>
                                            <?php foreach ($data['reward_punishment'] as $punishment): ?>
                                                <?php if ($punishment['jenis'] != 'punishment')
                                                    continue; ?>
                                                <tr>
                                                    <td class="text-center fw-bold">
                                                        <?= $i++ ?>
                                                    </td>
                                                    <td class="text-start fw-bold">
                                                        Punishment
                                                    </td>
                                                    <td class="text-start fw-bold">
                                                        <?= $punishment['keterangan'] ?>
                                                    </td>
                                                    <td class="text-danger text-end fw-bold">
                                                        Rp -
                                                        <?= number_format($punishment['total'], 0, '', '.') ?>
                                                    </td>
                                                </tr>
                                                <?php array_push($gajiSekunder, ($punishment['total'] * -1)); ?>
                                            <?php endforeach; ?>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <td class="text-end fw-bolder pe-3" colspan="3">
                                                    Total
                                                </td>
                                                <td class="text-end fw-bolder">
                                                    Rp
                                                    <?= number_format($data['karyawan']['gaji_pokok'] + array_sum($gajiSekunder), 0, '', '.') ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="mb-3" style="text-align: justify;">
                                    Demikian surat penggajian ini kami sampaikan. Mohon untuk segera melakukan
                                    konfirmasi apabila
                                    terdapat ketidaksesuaian atau pertanyaan lebih lanjut.
                                </p>

                                <p class="mb-3" style="text-align: justify;">
                                    Terima kasih atas dedikasi dan kerja keras Anda.
                                </p>

                                <div class="text-end">
                                    <p class="mb-0"><?= ucfirst($data['karyawan']['kota_outlet']) ?>,
                                        <?php
                                        $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'dd MMMM yyyy');
                                        echo $formatter->format(new DateTime());
                                        ?>
                                    </p>
                                    <p class="mb-7">Manajemen Perusahaan,</p>
                                    <p><?= $data['karyawan']['manager'] ?? 'Manager' ?></p>
                                </div>
                            </page>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    // initiate layout and plugins
                    $("#actprint").click(function () {
                        window.print();
                        return false;
                    });
                });
            </script>
            <?php Get::view('templates/footer', $data) ?>