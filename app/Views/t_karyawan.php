<div class="col-md-5 grid-margin ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Karyawan </h4>
                  
                  <form action="<?= base_url('home/aksi_t_karyawan')?>" method="POST">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Karyawan</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="namakaryawan" placeholder="Masukkan Nama Karyawan">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="password" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
    <label for="exampleInputUsername1">Level</label>
    <select class="form-control" name="level">
        <option value="">Pilih</option>
        <?php foreach ($yoga as $item): ?>
            <option value="<?= $item ?>"><?= $item ?></option>
        <?php endforeach; ?>
    </select>
</div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="alamat" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Telefon</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nohp" placeholder="Masukkan Nomor Telefon">
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    
                  </form>
                </div>
              </div>