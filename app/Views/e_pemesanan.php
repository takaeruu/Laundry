<div class="col-md-5 grid-margin ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">PEMESANAN </h4>
                  
                  <form action="<?= base_url('home/aksi_e_pemesanan')?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Pelanggan</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="<?= $dua->username ?>"  readonly>
                    </div>
                  <div class="form-group">
    <label for="exampleInputUsername1">Jenis Pakaian</label>
    <select class="form-control" name="jenis_pakaian">
        <option value="<?= $dua->id_jpakaian ?>"><?= $dua->jenis_pakaian ?></option>
        <?php foreach ($jpakaian as $item): ?>
            <option value="<?= $item->id_jpakaian ?>"><?= $item->jenis_pakaian ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputUsername1">Jenis Pelayanan</label>
    <select class="form-control" name="jenis_pelayanan">
        <option value="<?= $dua->id_jpelayanan ?>"><?= $dua->jenis_pelayanan ?></option>
        <?php foreach ($jpelayanan as $item): ?>
            <option value="<?= $item->id_jpelayanan ?>"><?= $item->jenis_pelayanan ?></option>
        <?php endforeach; ?>
    </select>
</div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Telefon</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="no_telp" placeholder="Masukkan Nomor Telefon" value="<?= $dua->no_telp ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pengantaran</label>
                      <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal" placeholder="Masukkan Tanggal Pengantaran" value="<?= $dua->tanggal ?>">
                    </div>
                    <input type="hidden" name="id" value="<?= $dua->id_pemesanan?>">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>