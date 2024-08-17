<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Restore Edit</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pemesanan</th>
                            <th>Jenis Pakaian</th>
                            <th>Jenis Pelayanan</th>
                            <th>Status</th>
                            <th>Berat</th>
                            <th>Harga</th>
                            <th>Edited By</th>
                            <th>Edited At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($backupData as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item->kode_pemesanan ?></td>
                                <td><?= $item->jenis_pakaian ?></td>
                                <td><?= $item->jenis_pelayanan ?></td>
                                <td><?= $item->status ?></td>
                                <td><?= $item->berat ?></td>
                                <td><?= $item->harga ?></td>
                                <td><?= $item->backup_by ?> / <?= $item->username ?></td>
                                <td><?= $item->backup_at ?></td>
                                <td>
                                    <form action="<?= base_url('home/restore_data_edit/' . $item->id_pemesanan) ?>" method="POST">
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>