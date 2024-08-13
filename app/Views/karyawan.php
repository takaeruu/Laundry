<div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Karyawan</h4>
                  <a class="nav-link text-Headings my-2" href="<?= base_url('home/t_karyawan')?>">
    <span class="mdi mdi-cart-plus"></span>
  </a>
                  <div class="table-responsive">
                    <table class="table">
                    
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Karyawan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
              <?php
              $no = 1;
              foreach ($yoga as $key) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $key->username?></td>
                
                  <td>
                  <a href="<?= base_url('home/detail_karyawan/' .$key->id_user) ?>">
        <button class="btn btn-danger">
            <i class="now-ui-icons ui-1_check"></i> Detail
        </button>
    </a>
    <a href="<?= base_url('home/hapus_karyawan/' .$key->id_user) ?>">
        <button class="btn btn-danger">
            <i class="now-ui-icons ui-1_check"></i> Delete
        </button>
    </a>
<td>
<a href="<?= base_url('home/resetpassword/' . $key->id_user) ?>" onclick="return confirm('Apakah Anda yakin ingin mereset password?');">
    <button class="btn btn-danger">
        <i class="now-ui-icons ui-1_check"></i> Reset Password
    </button>
</a>

  		</td>
                </tr>
              <?php } ?>
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>