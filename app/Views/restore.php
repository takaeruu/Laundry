<div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Restore</h4>
            <div class="table-responsive">
               
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pemesanan</th>
                            <th>Jenis Paket</th>
                            <th>Jenis Pelayanan</th>
                            <th>Status</th>
                            <th>Berat</th>
                            <th>Harga</th>
                            <th>Nama</th>
                            <th>Nomor Telefon</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Tipe Pemesanan</th>
                            <th class="hide-when-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($yoga as $key) {
                            if ($status = $key->status === 'DiKerjakan'|| $status = $key->status === 'DiAntar') :
                        ?>
                        <tr data-id="<?= $key->id_pemesanan ?>" data-kode="<?= $key->kode_pemesanan ?>" data-harga="<?= $key->harga ?>">
                            <td><?= $no++ ?></td>
                            <td><?= $key->kode_pemesanan?></td>
                            <td><?= $key->jenis_pakaian?></td>
                            <td><?= $key->jenis_pelayanan?></td>
                            <td><?= $key->status?></td>
                            <td><?= $key->berat?></td>
                            <td>Rp.<?= $key->harga?>,00</td>
                            <td><?= $key->username?></td>
                            <td><?= $key->nohp?></td>
                            <td><?= $key->alamat?></td>
                            <td><?= $key->status?></td>
                            <td><?= $key->tipe?></td>
                            <td class="hide-when-print">
    <a href="<?= base_url('home/aksi_restore/' .$key->id_pemesanan) ?>">
        <button class="btn btn-info">
            <i class="now-ui-icons ui-1_check"></i> Restore
        </button>
    </a>
    <a href="<?= base_url('home/hapus_permanent/' .$key->id_pemesanan) ?>">
        <button class="btn btn-danger">
            <i class="now-ui-icons ui-1_simple-remove"></i> Hapus
        </button>
    </a>
   
   
   
</td>
                        </tr>
                        
                        <?php endif ;?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

