<div class="col-md-5 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Detail Karyawan</h4>
            
            <form action="<?= base_url('home/aksi_e_karyawan') ?>" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Karyawan</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="namakaryawan" value="<?= $dua->username ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="<?= $dua->email ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Level</label>
                    <select class="form-control" name="level">
                        <!-- Option for the current level -->
                        <option value="<?= $dua->level ?>" selected><?= $dua->level ?></option>
                        <!-- Loop through the $level array to create other options -->
                        <?php foreach ($yoga as $item): ?>
            <option value="<?= $item ?>"><?= $item ?></option>
        <?php endforeach; ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="alamat" value="<?= $dua->alamat ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Telefon</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nohp" value="<?= $dua->nohp ?>">
                </div>
                <input type="hidden" name="id" value="<?= $dua->id_user?>">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
    </div>
</div>