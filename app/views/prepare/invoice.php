<?php Get::view('templates/header', $data) ?>

<style>
    .table-responsive {
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        word-wrap: break-word;
        overflow: hidden;
        max-width: 58mm;
    }
</style>
<link rel="stylesheet" href="<?= BASEURL; ?>/css/invoice.css">

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="no-print float-end me-8">
                <a href="<?= BASEURL ?>/prepare/request" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
                <button class="btn btn-primary" id="actprint">
                    <i class="bi bi-printer-fill"></i>
                    Print
                </button>
            </div>
            <!--begin::Content container-->
            <page size="thermal" class="card rounded-0 shadow-none">
                <div class="card-body p-0" style="font-family: 'Merchant Copy';">

                    <div id="printable" class="table-responsive">
                        <table border="0" cellspacing="0" cellpadding="1" class="m-0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">
                                        <table border="0" cellspacing="0" cellpadding="0" class="lh-sm">

                                            <?php
                                            $prepare = $data['prepare'];
                                            $detailItems = json_decode($prepare['detail_items'], true);
                                            usort($detailItems, fn($a, $b) => strcmp($a['item'], $b['item']));
                                            ?>
                                            <tr>
                                                <td valign="middle" style="text-align: center; font-size:16px;"
                                                    class="fs-7 fw-bold pt-0 pb-3">
                                                    Detail Prepare
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle" style="text-align: center; font-size:20px;"
                                                    class="fs-6">
                                                    <?= Get::model('Preferences')->getPreference('Nama_Perusahaan') ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle"
                                                    style="text-align: center; font-size:16px;; font-size: 16px;"
                                                    class="pb-2 fs7">
                                                    Cabang: <?= $prepare['nama_outlet'] ?? '-' ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle"
                                                    style="text-align: center; font-size:16px;; font-size: 16px;">
                                                    <?= $prepare['alamat_outlet'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="float-start pt-4" style=" font-size:16px;">
                                                    <?= date('d/M/Y', strtotime($prepare['created_at'])) ?>
                                                </td>
                                                <td class="float-end pt-4" style=" font-size:16px;">
                                                    <?= date('H:i:s', strtotime($prepare['created_at'])) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="float-start" style="font-size:16px;">
                                                    Transaksi
                                                </td>
                                                <td class="float-end" style="font-size:16px;">
                                                    TRX-<?= str_pad($prepare['id'], 2, '0', STR_PAD_LEFT) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pt-2 text-center">
                                                    ====================
                                                </td>
                                            </tr>
                                            <?php foreach ($detailItems as $item): ?>
                                                <tr>
                                                    <td class="pt-2" style="font-size:16px;">
                                                        <div class="float-start">
                                                            <?= $item['item'] ?>
                                                        </div>
                                                        <div class="float-end" style="font-size:16px;">
                                                            <?= $item['amount'] ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td class="pt-2 text-center">
                                                    ====================
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pt-2" style="font-size:16px;">
                                                    Deskripsi:
                                                    <?= $prepare['deskripsi'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pt-2 text-center">
                                                    ====================
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pt-2 text-center" style="font-size:16px;">
                                                    Hanya untuk Dapur
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </page>

            <script>
                $(document).ready(function () {
                    // initiate layout and plugins
                    $("#actprint").click(function () {
                        window.print();
                    });

                    window.onload = function () {
                        printPage();
                    }
                });
            </script>

            <script>
                function addPrintStyles() {
                    var style = document.createElement('style');
                    style.type = 'text/css';
                    style.media = 'print';
                    style.innerHTML = `
        @page { margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-left: 0; }
        body { margin: 0; padding-left: 0; }
      `;
                    document.head.appendChild(style);
                }

                window.onbeforeprint = addPrintStyles;
            </script>

            <?php Get::view('templates/footer') ?>