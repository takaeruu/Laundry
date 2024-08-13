<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- ganti dengan path CSS Anda -->
    <style>
        .report-header, .report-footer {
            text-align: center;
            margin: 20px 0;
        }
        .report-title {
            font-size: 24px;
            font-weight: bold;
        }
        .report-date {
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .total-harga {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
            margin-right: 20px;
        }
    </style>
</head>
<body>

<div class="report-header">
    <div class="report-title">Laporan Transaksi Laundry</div>
    <div class="report-date">Tanggal Cetak: <?= date('d-m-Y') ?></div>
</div>

<table class="table" id="notaTable">
    <thead>
        <tr>
            <th scope="col">No Transaksi</th>
            <th scope="col">Nama Karyawan</th>
            <th scope="col">Kode Pemesanan</th>
            <th scope="col">Nama Pelanggan</th>
            <th scope="col">Jenis Paket</th>
            <th scope="col">Jenis Pelayanan</th>
            <th scope="col">Berat</th>
            <th scope="col">Harga</th>
            <th scope="col">Tipe Pemesanan</th>
            <th scope="col">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalHarga = 0;
        if (isset($transaksi) && is_array($transaksi)) {
            foreach ($transaksi as $key) {
                $totalHarga += $key->total_harga; ?>
                <tr>
                    <td><?= $key->no_transaksi ?></td>
                    <td><?= $key->transaksi_username ?></td>
                    <td><?= $key->kode_pemesanan ?></td>
                    <td><?= $key->pemesanan_username ?></td>
                    <td><?= $key->jenis_pakaian ?></td>
                    <td><?= $key->jenis_pelayanan ?></td>
                    <td><?= $key->berat ?></td>
                    <td><?= $key->total_harga ?></td>
                    <td><?= $key->tipe ?></td>
                    <td><?= $key->tanggal_nota ?></td>
                </tr>
            <?php } 
        } else { ?>
            <tr>
                <td colspan="9">Data tidak ditemukan.</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="report-footer">
    <div class="total-harga">Total Harga Keseluruhan: <?= $totalHarga ?></div>
</div>

</body>
</html>
