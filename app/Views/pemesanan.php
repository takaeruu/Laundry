<div class="col-lg-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Pemesanan</h4>
      <a class="nav-link text-Headings my-2" href="<?= base_url('home/t_pemesanan') ?>">
        <span class="mdi mdi-cart-plus"></span>
      </a>
      <div class="table-responsive">
        <table class="table">

          <thead>
            <tr>
              <th>No</th>
              <th>Kode Pemesanan</th>
              <th>Jenis Paket</th>
              <th>Jenis Pelayanan</th>
              <th>Nomor Telefon</th>
              <th>Alamat</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($yoga as $key) {
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $key->kode_pemesanan ?></td>
                <td><?= $key->jenis_pakaian ?></td>
                <td><?= $key->jenis_pelayanan ?></td>
                <td><?= $key->nohp ?></td>
                <td><?= $key->alamat ?></td>
                <td><?= $key->status ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>