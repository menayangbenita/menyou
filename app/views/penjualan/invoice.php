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

<?php $pembayaran = $data['pembayaran']; ?>

<page size="thermal" class="card rounded-0 shadow-none">
    <div class="card-body p-1" style="font-family: 'Merchant Copy';">

        <div id="printable" class="table-responsive">
            <table border="0" cellspacing="0" cellpadding="1" class="m-0">
                <tbody>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellspacing="0" cellpadding="0" class="lh-sm">
                                <?php if ($pembayaran['status_order'] === 1): ?>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:20px;"
                                            class="fs-5 fw-bold">
                                            <?= Get::model('Preferences')->getPreference('Nama_Perusahaan') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:16px;" class="pb-2">
                                            <?= $pembayaran['nama_outlet'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:16px;">
                                            <?= $pembayaran['alamat_outlet'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:16px;">
                                            Telp. <?= $pembayaran['telp_outlet'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start pt-4" style="font-size:16px;">
                                            <?= date('d/M/Y', strtotime($pembayaran['created_at'])) ?>
                                        </td>
                                        <td class="float-end pt-4" style="font-size:16px;">
                                            <?= date('H:i:s', strtotime($pembayaran['created_at'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Transaksi
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            TRX-<?= str_pad($pembayaran['id'], 2, '0', STR_PAD_LEFT) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Kasir
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= $pembayaran['kasir'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Pelanggan
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= $pembayaran['pelanggan'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            No. WhatsApp
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= $pembayaran['nomor_telp'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-2 text-center">
                                            ====================
                                        </td>
                                    </tr>
                                    <?php
                                    $detail_pembayaran = [];
                                    foreach (json_decode($pembayaran['detail_pembayaran'], true) as $item) {
                                        if (isset($detail_pembayaran[$item['id']])) {
                                            $detail_pembayaran[$item['id']]['subtotal'] += $item['subtotal'];
                                            $detail_pembayaran[$item['id']]['amount'] += $item['amount'];
                                        } else {
                                            $detail_pembayaran[$item['id']] = [
                                                'item' => $item['item'],
                                                'amount' => $item['amount'],
                                                'subtotal' => $item['subtotal'],
                                            ];
                                        }
                                    }
                                    ?>
                                    <?php foreach ($detail_pembayaran as $detail): ?>
                                        <tr>
                                            <td class="pt-2" style="font-size:16px;">
                                                <?= $detail['item'] ?><br>
                                                <div class="float-start">
                                                    <?= $detail['amount'] ?>
                                                </div>
                                                <div class="float-end">
                                                    <?= number_format($detail['subtotal'], 0, '', '.') ?>
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
                                        <td class="float-start pt-2" style="font-size:16px;">
                                            Subtotal
                                        </td>
                                        <td class="float-end pt-2" style="font-size:16px;">
                                            <?= number_format($pembayaran['subtotal'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Pajak (<?= $pembayaran['pajak_outlet'] ?>%)
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= number_format($pembayaran['pajak'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Total
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= number_format($pembayaran['total'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Bayar
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= number_format($pembayaran['bayar'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Kembali
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= number_format($pembayaran['kembali'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-2 text-center">
                                            ====================
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-2 text-center">
                                            Terima Kasih<br>Atas Kunjungan Anda
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php
                                    $detailPembayaran = json_decode($pembayaran['detail_pembayaran'], true);
                                    usort($detailPembayaran, fn($a, $b) => strcmp($a['item'], $b['item']));
                                    ?>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:16px;"
                                            class="fs-7 fw-bold pt-0 pb-3">
                                            Detail Order
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:20px;" class="fs-6">
                                            <?= Get::model('Preferences')->getPreference('Nama_Perusahaan') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:16px;; font-size: 16px;"
                                            class="pb-2 fs7">
                                            Cabang: <?= $pembayaran['nama_outlet'] ?? '-' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle" style="text-align: center; font-size:16px;; font-size: 16px;">
                                            <?= $pembayaran['alamat_outlet'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start pt-4"  style=" font-size:16px;">
                                            <?= date('d/M/Y', strtotime($pembayaran['created_at'])) ?>
                                        </td>
                                        <td class="float-end pt-4" style=" font-size:16px;">
                                            <?= date('H:i:s', strtotime($pembayaran['created_at'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Transaksi
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            TRX-<?= str_pad($pembayaran['id'], 2, '0', STR_PAD_LEFT) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Kasir
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= $pembayaran['kasir'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            Pelanggan
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= $pembayaran['pelanggan'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="float-start" style="font-size:16px;">
                                            No. WhatsApp
                                        </td>
                                        <td class="float-end" style="font-size:16px;">
                                            <?= $pembayaran['nomor_telp'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-2 text-center">
                                            ====================
                                        </td>
                                    </tr>
                                    <?php foreach ($detailPembayaran as $item): ?>
                                        <tr>
                                            <td class="pt-2" style="font-size:16px;">
                                                <div class="float-start">
                                                    <?= $item['item'] ?> <?= $item['take_away'] ? '<b>(TA)</b>' : '' ?>
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
                                            Note: 
                                            <?= ($pembayaran['note']) ? htmlspecialchars($pembayaran['note']) : '-' ?>
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
                                <?php endif; ?>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</page>
<div class="position-fixed no-print" style="bottom: 0.5rem; right: 2rem;">
    <a href="<?= BASEURL ?>/pesanan" class="btn btn-dark">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
    <button class="btn bg-gradient-primary-custom" id="actprint">
        <i class="bi bi-printer-fill"></i>
        Print
    </button>
</div>

<script src="<?= BASEURL; ?>/js/jquery-1.10.2.js"></script>

<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        $("#actprint").click(function () {
            window.print();
        });

        window.onload = function() {
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
        @page { margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; }
        body { margin: 0; }
      `;
      document.head.appendChild(style);
    }

    window.onbeforeprint = addPrintStyles;
  </script>

<?php Get::view('templates/footer') ?>