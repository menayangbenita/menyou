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
        html, body {
            width: 210mm;
            height: 297mm;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #printable, #printable * {
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
<div class="row">
    <div class="col-lg-12">
        <page size="a4" class="card shadow-none" id="printable">
            <div class="card-body">
                <div class="row no-print mb-4">
                    <div class="col-lg-12 text-end">
                        <a href="<?= BASEURL; ?>/rewardpunishment" class="btn bg-gradient-dark mb-0">
                            <strong>
                                <i class="bi bi-chevron-left me-2"></i>
                                Back
                            </strong>
                        </a>
                        <button class="btn bg-gradient-primary mb-0" id="actprint">
                            <i class="bi bi-printer-fill"></i>
                            Print
                        </button>
                    </div>
                </div>

                <div contenteditable="true">
                    <div class="text-center">
                    <h4><strong><?= Get::model('Preferences')->getPreference('Nama_Perusahaan') ?></strong></h4>
                        <p class="mb-0">Cabang <?= $data['reward_punishment']['nama_outlet'] ?>, <?= $data['reward_punishment']['alamat_outlet'] ?></p>
                        <p class="mb-4">Telp. <?= $data['reward_punishment']['telp_outlet'] ?></p>
                        
                        <p class="mb-0"><strong><?= ($data['reward_punishment']['jenis'] == 'reward') ? 'Surat Apresiasi' : 'Surat Peringatan' ?></strong></p>
                        <p class="mb-5">No: <?= ($data['reward_punishment']['jenis'] == 'reward') ? 'SA' : 'SP' ?>/<?= date('Y') ?>/<?= date('m') ?>/<?= date('d') ?>/<?= $data['reward_punishment']['id'] ?></p>
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
                            <td>Rp <?= number_format($data['reward_punishment']['besaran'], 0, '.', '.') ?></td>
                        </tr>
                    </table>

                    <?php if ($data['reward_punishment']['jenis'] == 'reward') : ?>
                        <p class="mb-3" style="text-align: justify; text-indent: 32px;">
                            Kami ingin menekankan bahwa prestasi ini sesuai dengan kebijakan perusahaan, 
                            yaitu <strong><?= rtrim(strtolower($data["reward_punishment"]["keterangan"]), '.') ?></strong> dan berpotensi memberikan apresiasi lebih lanjut. 
                            Kami mengharapkan Anda untuk terus mempertahankan standar kinerja Anda guna meraih lebih banyak reward atau bonus di masa depan. 
                            Sesuai dengan kebijakan perusahaan yang berlaku, kami akan memberikan penghargaan berupa <strong>BONUS</strong> sebesar 
                            <strong>Rp <?= number_format($data['reward_punishment']['besaran'] * $data['reward_punishment']['jumlah'], 0, '', '.') ?></strong>. 
                            Dengan pemberian bonus ini, kami berharap agar Saudara <?= $data["reward_punishment"]["nama"] ?> dapat terus mempertahankan 
                            kinerja yang luar biasa dan dapat meraih prestasi yang lebih tinggi di masa depan.
                        </p>
                        <p class="mb-5" style="text-align: justify; text-indent: 32px;">
                            Demikian surat ini dibuat sebagai bentuk penghargaan. Kami mengucapkan terima kasih atas dedikasi dan kontribusi yang luar biasa dari Saudara.
                        </p>
                    <?php else : ?>
                        <p class="mb-3" style="text-align: justify; text-indent: 32px;">
                            Kami ingin menegaskan bahwa tindakan ini melanggar kebijakan perusahaan, yaitu <strong><?= rtrim(strtolower($data['reward_punishment']['keterangan']), '.') ?></strong> 
                            dan berpotensi mengakibatkan tindakan disiplin yang lebih lanjut. Kami mengharapkan Anda untuk segera memperbaiki perilaku Anda 
                            guna menghindari tindakan lebih lanjut yang mungkin diperlukan. Sesuai dengan peraturan perusahaan yang berlaku, kami akan 
                            menerapkan sanksi berupa <strong>POTONGAN</strong> sebesar <strong>Rp <?=  number_format($data['reward_punishment']['besaran'] * $data['reward_punishment']['jumlah'], 0, '', '.') ?></strong>. 
                            Dengan pemberlakuan sanksi ini, kami berharap agar Saudara <?= $data["reward_punishment"]["nama"] ?> dapat menghindari tindakan yang serupa di masa depan.
                        </p>    
                        <p class="mb-5" style="text-align: justify; text-indent: 32px;">
                            Demikian surat peringatan ini dibuat untuk dijadikan bahan introspeksi. Atas perhatiannya, kami mengucapkan terima kasih.
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
                </div>
                
            </div>
        </page>
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