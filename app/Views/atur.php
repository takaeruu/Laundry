<div class="col-md-5 grid-margin ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Atur Pesanan </h4>
                  
                  <form action="<?= base_url('home/aksi_atur')?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Kode Pemesanan</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="kode_pemesanan" placeholder="Masukkan Kode Pemesanan" value="<?=$dua->kode_pemesanan?>" readonly>
                    </div>
                    <label for="exampleInputUsername1">Jenis Paket</label>
                    <select class="form-control" name="jenis_pakaian[]">
              <option value="<?= $tiga->id_jpakaian ?>"><?= $tiga->jenis_pakaian ?></option>
              <?php foreach ($yoga as $item): ?>
                <option value="<?= $item->id_jpakaian ?>"><?= $item->jenis_pakaian ?></option>
              <?php endforeach; ?>
            </select>

            <label for="exampleInputUsername1">Jenis Pelayanan</label>
            <select class="form-control" name="jenis_pelayanan[]">
              <option value="<?= $empat->id_jpelayanan ?>"><?= $empat->jenis_pelayanan ?><</option>
              <?php foreach ($yoga2 as $item): ?>
                <option value="<?= $item->id_jpelayanan ?>"><?= $item->jenis_pelayanan ?></option>
              <?php endforeach; ?>
            </select>
                    <div class="form-group">
                    <label for="exampleInputUsername1">Status</label>
                    <select class="form-control" name="status">
        <option value="<?=$dua->status?>"><?=$dua->status?></option>
            <option value="DiKerjakan">DiKerjakan</option>
            <option value="DiAntar">DiAntar</option>
            <option value="Selesai">Selesai</option>
    </select>
    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Berat</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="berat" placeholder="Masukkan Berat" value="<?=$dua->berat?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="harga" placeholder="Masukkan Harga" value="<?=$dua->harga?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" disabled="" id="exampleInputEmail1" name="username" placeholder="Masukkan Nama" value="<?=$dua->username?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Telefon</label>
                      <input type="text" class="form-control" disabled id="exampleInputEmail1" name="nohp" placeholder="Masukkan Nomor Telefon" value="<?=$dua->nohp?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" disabled id="exampleInputEmail1" name="alamat" placeholder="Masukkan Alamat" value="<?=$dua->alamat?>">
                    </div>
                    
                    <input type="hidden" name="id" value="<?= $dua->id_pemesanan?>">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                   
                  </form>
                </div>
              </div>