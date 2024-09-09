<?php Get::view('templates/header', $data) ?>

<!-- <link rel="stylesheet" href="<?= BASEURL; ?>/css/invoice.css"> -->
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
            margin: 0;
            size: auto;
            box-shadow: 0;
        }

        page[size="thermal"] {
            margin: 0;
            size: auto;
            box-shadow: 0;
            font-family: 'Merchant Copy';
        }

        .page-break {
            display: block;
            page-break-before: always;
        }

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>


<!-- #region -->

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
                                    Cetak Surat</h1>
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
                                    <li class="breadcrumb-item text-muted">Reward & Punishment</li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Cetak Surat</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Page title-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <!--begin::Daterangepicker-->
                        <a href="<?= BASEURL; ?>/rewardpunishment" class="btn btn-secondary mb-0">
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
                                    <p class="mb-0">Cabang <?= $data['reward_punishment']['nama_outlet'] ?>,
                                        <?= $data['reward_punishment']['alamat_outlet'] ?>
                                    </p>
                                    <p class="mb-4">Telp. <?= $data['reward_punishment']['telp_outlet'] ?></p>

                                    <p class="mb-0">
                                        <strong><?= ($data['reward_punishment']['jenis'] == 'reward') ? 'Surat Apresiasi' : 'Surat Peringatan' ?></strong>
                                    </p>
                                    <p class="mb-5">No:
                                        <?= ($data['reward_punishment']['jenis'] == 'reward') ? 'SA' : 'SP' ?>/<?= date('Y') ?>/<?= date('m') ?>/<?= date('d') ?>/<?= $data['reward_punishment']['id'] ?>
                                    </p>
                                </div>

                                <p class="mb-3">Surat ini ditujukan Kepada :</p>
                                <table class="mb-3 table-borderless">
                                    <tr>
                                        <td>Nama</td>
                                        <td class="px-2">:</td>
                                        <td><?= $data['reward_punishment']['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Posisi</td>
                                        <td class="px-2">:</td>
                                        <td><?= $data['reward_punishment']['posisi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis</td>
                                        <td class="px-2">:</td>
                                        <td><?= ucfirst($data['reward_punishment']['jenis']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Besaran</td>
                                        <td class="px-2">:</td>
                                        <td>Rp <?= number_format($data['reward_punishment']['besaran'], 0, '.', '.') ?>
                                        </td>
                                    </tr>
                                </table>

                                <?php if ($data['reward_punishment']['jenis'] == 'reward'): ?>
                                    <p class="mb-3" style="text-align: justify; text-indent: 32px;">
                                        Kami ingin menekankan bahwa prestasi ini sesuai dengan kebijakan perusahaan,
                                        yaitu
                                        <strong><?= rtrim(strtolower($data["reward_punishment"]["keterangan"]), '.') ?></strong>
                                        dan berpotensi memberikan apresiasi lebih lanjut.
                                        Kami mengharapkan Anda untuk terus mempertahankan standar kinerja Anda guna meraih
                                        lebih
                                        banyak reward atau bonus di masa depan.
                                        Sesuai dengan kebijakan perusahaan yang berlaku, kami akan memberikan penghargaan
                                        berupa
                                        <strong>BONUS</strong> sebesar
                                        <strong>Rp
                                            <?= number_format($data['reward_punishment']['besaran'] * $data['reward_punishment']['jumlah'], 0, '', '.') ?></strong>.
                                        Dengan pemberian bonus ini, kami berharap agar Saudara
                                        <?= $data["reward_punishment"]["nama"] ?> dapat terus mempertahankan
                                        kinerja yang luar biasa dan dapat meraih prestasi yang lebih tinggi di masa depan.
                                    </p>
                                    <p class="mb-5" style="text-align: justify; text-indent: 32px;">
                                        Demikian surat ini dibuat sebagai bentuk penghargaan. Kami mengucapkan terima kasih
                                        atas
                                        dedikasi dan kontribusi yang luar biasa dari Saudara.
                                    </p>
                                <?php else: ?>
                                    <p class="mb-3" style="text-align: justify; text-indent: 32px;">
                                        Kami ingin menegaskan bahwa tindakan ini melanggar kebijakan perusahaan, yaitu
                                        <strong><?= rtrim(strtolower($data['reward_punishment']['keterangan']), '.') ?></strong>
                                        dan berpotensi mengakibatkan tindakan disiplin yang lebih lanjut. Kami mengharapkan
                                        Anda
                                        untuk segera memperbaiki perilaku Anda
                                        guna menghindari tindakan lebih lanjut yang mungkin diperlukan. Sesuai dengan
                                        peraturan
                                        perusahaan yang berlaku, kami akan
                                        menerapkan sanksi berupa <strong>POTONGAN</strong> sebesar <strong>Rp
                                            <?= number_format($data['reward_punishment']['besaran'] * $data['reward_punishment']['jumlah'], 0, '', '.') ?></strong>.
                                        Dengan pemberlakuan sanksi ini, kami berharap agar Saudara
                                        <?= $data["reward_punishment"]["nama"] ?> dapat menghindari tindakan yang serupa di
                                        masa
                                        depan.
                                    </p>
                                    <p class="mb-5" style="text-align: justify; text-indent: 32px;">
                                        Demikian surat peringatan ini dibuat untuk dijadikan bahan introspeksi. Atas
                                        perhatiannya, kami mengucapkan terima kasih.
                                    </p>
                                <?php endif; ?>


                                <div class="text-end">
                                    <p class="mb-0"><?= ucfirst($data['reward_punishment']['kota_outlet']) ?>,
                                        <?php
                                        $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'dd MMMM yyyy');
                                        echo $formatter->format(new DateTime());
                                        ?>
                                    </p>
                                    <p class="mb-7">Manajemen Perusahaan,</p>
                                    <p><?= $data['reward_punishment']['manager'] ?? 'Manager' ?></p>
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