<div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Transaksi</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th class="hide-when-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($nel as $key) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $key->no_transaksi?></td>
                            <td><?= $key->kode_pemesanan?></td>
                            <td><?= $key->tanggal_nota?></td>
                            <td>Rp.<?= $key->total_harga?>,00</td>
                            <td class="hide-when-print">
                                <a href="<?= base_url('home/print_nota/' .$key->id_transaksi) ?>">
                                    <button class="btn btn-info">
                                        <i class="now-ui-icons ui-1_check"></i> Print Nota
                                    </button>
                                </a>
                            </td>
                            <td class="hide-when-print">
                                <a href="<?= base_url('home/hapus_nota/' .$key->id_transaksi) ?>">
                                    <button class="btn btn-info">
                                        <i class="now-ui-icons ui-1_check"></i> Hapus
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

