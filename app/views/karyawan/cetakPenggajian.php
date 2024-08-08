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

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>
<!-- #region -->
<div class="row">
    <div class="col-lg-12 card shadow-none">
        <div class="card-body">
            <div class="row no-print mb-4">
                <div class="col-lg-12 text-end">
                    <a href="<?= BASEURL; ?>/penggajian" class="btn bg-gradient-dark mb-0">
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
                <page size="a4" class="print-page" id="printable">
                    <div class="text-center">
                        <h4><strong><?= Get::model('Preferences')->getPreference('Nama_Perusahaan') ?></strong></h4>
                        <p class="mb-0">Cabang <?= $data['karyawan']['nama_outlet'] ?>,
                            <?= $data['karyawan']['alamat_outlet'] ?></p>
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
                            Sehubungan dengan itu, kami bermaksud untuk memberikan informasi mengenai rincian penggajian
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
                                <th class="text-uppercase text-secondary text-center text-xxs fw-bolder opacity-7">
                                    No</th>
                                <th class="text-uppercase text-secondary text-center text-xxs fw-bolder opacity-7"
                                    colspan="2">
                                    Nama Gaji</th>
                                <th class="text-uppercase text-secondary text-center text-xxs fw-bolder opacity-7">
                                    Nominal
                                </th>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <tr>
                                    <td class="text-sm text-center fw-bold mb-0">
                                        <?= $i++ ?>
                                    </td>
                                    <td class="text-sm fw-bold mb-0" colspan="2">
                                        Gaji Pokok
                                    </td>
                                    <td class="text-sm text-end fw-bold mb-0">
                                        Rp
                                        <?= number_format($data['karyawan']['gaji_pokok'], 0, '', '.') ?>
                                    </td>
                                </tr>
                                <?php $gajiSekunder = [] ?>
                                <?php foreach ($data['reward_punishment'] as $reward): ?>
                                    <?php if ($reward['jenis'] != 'reward')
                                        continue; ?>
                                    <tr>
                                        <td class="text-sm text-center fw-bold mb-0">
                                            <?= $i++ ?>
                                        </td>
                                        <td class="text-sm fw-bold mb-0">
                                            Reward
                                        </td>
                                        <td class="text-sm fw-bold mb-0">
                                            <?= $reward['keterangan'] ?>
                                        </td>
                                        <td class="text-sm text-success text-end fw-bold mb-0">
                                            Rp
                                            <?= number_format($reward['total'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <?php array_push($gajiSekunder, $reward['total']); ?>
                                <?php endforeach; ?>
                                <?php foreach ($data['reward_punishment'] as $punishment): ?>
                                    <?php if ($punishment['jenis'] != 'punishment')
                                        continue; ?>
                                    <tr>
                                        <td class="text-sm text-center fw-bold mb-0">
                                            <?= $i++ ?>
                                        </td>
                                        <td class="text-sm fw-bold mb-0">
                                            Punishment
                                        </td>
                                        <td class="text-sm fw-bold mb-0">
                                            <?= $punishment['keterangan'] ?>
                                        </td>
                                        <td class="text-sm text-danger text-end fw-bold mb-0">
                                            Rp -
                                            <?= number_format($punishment['total'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <?php array_push($gajiSekunder, ($punishment['total'] * -1)); ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td class="text-sm text-end fw-bolder mb-0 pe-3" colspan="3">
                                        Total
                                    </td>
                                    <td class="text-sm text-end fw-bolder mb-0">
                                        Rp
                                        <?= number_format($data['karyawan']['gaji_pokok'] + array_sum($gajiSekunder), 0, '', '.') ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mb-3" style="text-align: justify;">
                        Demikian surat penggajian ini kami sampaikan. Mohon untuk segera melakukan konfirmasi apabila
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