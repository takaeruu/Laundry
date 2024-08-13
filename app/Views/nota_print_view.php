<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
    <style>
        body, div, ul, li, table {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-size: 6px; /* Set font size to 6px for better fitting */
            margin: 0; /* No margin to utilize full page space */
        }
        .table {
            margin: 0;
            padding: 0;
            border-collapse: separate; /* Menggunakan border-collapse: separate agar border-spacing bekerja */
            border-spacing: 0 5px; 
        }
        #notaTable th, #notaTable td {
            border: 1px solid #000;
            padding: 1px; /* Reduced padding */
            font-size: 5px; /* Set font size to 5px for table cells and headers */
        }
        #notaTable th {
            font-size: 8px; /* Explicitly set font size for table headers */
        }
        .text-center {
            text-align: center;
        }
        .small-text {
            font-size: 10px; /* Set font size to 6px */
        }
        .content {
            margin: 0;
            padding: 0;
        }
       
        .section-top, .section-bottom {
            text-align: center;
        }
        hr {
            margin: 0;
        }
    </style>
</head>
<body>
    <ul class="small-text" style="list-style: none;text-transform: uppercase;">
        <li>NOTA :</li>
        <li>KASIR : <?= htmlspecialchars($kasir, ENT_QUOTES, 'UTF-8') ?></li>
    </ul>
    <ul class="small-text" style="list-style: none;">
        <li>TGL : <?= date('Y-m-d') ?></li>
        <li>JAM : <?= date('H:i:s') ?></li>
    </ul>


<div class="section section-middle">
    <hr class="mt-0">
    <table class="table" id="notaTable">
        <thead>
            <tr>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Kode Pemesanan</th>
                <th scope="col">Jenis Pakaian</th>
                <th scope="col">Jenis Pelayanan</th>
                <th scope="col">Berat</th>
                <th scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($pemesananList) && is_array($pemesananList)) {
                foreach ($pemesananList as $pemesanan) { ?>
                    <tr>
                        <td class="small-text"><?= htmlspecialchars($pemesanan->username, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="small-text"><?= htmlspecialchars($pemesanan->kode_pemesanan, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="small-text"><?= htmlspecialchars($pemesanan->jenis_pakaian, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="small-text"><?= htmlspecialchars($pemesanan->jenis_pelayanan, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="small-text"><?= htmlspecialchars($pemesanan->berat, ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="small-text">Rp.<?= htmlspecialchars($pemesanan->harga, ENT_QUOTES, 'UTF-8') ?>,00</td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6">Data tidak ditemukan.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <hr>
    <ul class="small-text" style="list-style: none; padding: 0;">
        <li>
            <b>Total</b> : Rp.<?= htmlspecialchars($total_harga, ENT_QUOTES, 'UTF-8') ?>,00
        </li>
        <li>
            <b>Bayar</b> : Rp.<?= htmlspecialchars($bayar, ENT_QUOTES, 'UTF-8') ?>,00
        </li>
        <li>
            <b>Kembalian</b> : Rp.<?= htmlspecialchars($kembalian, ENT_QUOTES, 'UTF-8') ?>,00
        </li>
    </ul>
</div>

</body>
</html>
