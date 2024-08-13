<div class="col-md-5 grid-margin ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Atur Pesanan </h4>
                  
                  <form action="<?= base_url('home/aksi_e_karyawan')?>" method="POST">
                 
                    <div class="form-group">
    <label for="exampleInputUsername1">Level</label>
    <select class="form-control" name="level">
        <option value="<?=$dua->level?>"><?=$dua->level?></option>
        <?php foreach ($level as $item): ?>
            <option value="<?= $item ?>"><?= $item ?></option>
        <?php endforeach; ?>
    </select>
</div>
   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Masukkan Username" value="<?=$dua->username?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="exampleInputEmail1" name="password" placeholder="Masukkan Password" value="<?=$dua->password?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" class="form-control"  id="exampleInputEmail1" name="email" placeholder="Masukkan Email" value="<?=$dua->email?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="alamat" placeholder="Masukkan Alamat" value="<?=$dua->alamat?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Telefon</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nohp" placeholder="Masukkan Nomor Telefon" value="<?=$dua->nohp?>">
                    </div>
                    
                    <input type="hidden" name="id" value="<?= $dua->id_user?>">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                   
                  </form>
                </div>
              </div>