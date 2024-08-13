<div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pelayanan</h4>
                  <a class="nav-link text-Headings my-2" href="#" data-toggle="modal" data-target="#tambahPelayananModal">
  <span class="mdi mdi-cart-plus"></span> Tambah Pelayanan
</a>
                  <div class="table-responsive">
                    <table class="table">
                    
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Pelayanan</th>
                        </tr>
                      </thead>
                      <tbody>
              <?php
              $no = 1;
              foreach ($yoga as $key) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $key->jenis_pelayanan?></td>
                  
                  <td>
  <button class="btn btn-info" data-toggle="modal" data-target="#editPelayananModal" onclick="editPelayanan(<?= $key->id_jpelayanan ?>, '<?= $key->jenis_pelayanan ?>')">
    <i class="now-ui-icons ui-1_check"></i> Edit
  </button>
</td>

            <td>
			<a href="<?= base_url('home/hapus_pelayanan/' .$key->id_jpelayanan) ?>">
      <button class="btn btn-info">
      <i class="now-ui-icons ui-1_check"></i> Hapus
      </button>
      </a>
			</td>	
                  <td>
		</td>
                </tr>
              <?php } ?>
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL EDIT -->
            <div class="modal fade" id="editPelayananModal" tabindex="-1" role="dialog" aria-labelledby="editPelayananModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPelayananModalLabel">Edit Pelayanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editPelayananForm" action="<?= base_url('home/aksi_e_pelayanan') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="jenis_pelayanan">Nama Pelayanan</label>
            <input type="text" class="form-control" id="nama_pelayanan" name="nama_pelayanan" required>
            <input type="hidden" id="id_jpelayanan" name="id_jpelayanan">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah Pelayanan -->
<div class="modal fade" id="tambahPelayananModal" tabindex="-1" role="dialog" aria-labelledby="tambahPelayananModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahPelayananModalLabel">Tambah Pelayanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahPelayananForm" action="<?= base_url('home/aksi_t_pelayanan') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_pelayanan_tambah">Nama Pelayanan</label>
            <input type="text" class="form-control" id="nama_pelayanan_tambah" name="nama_pelayanan_tambah" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  function editPelayanan(id, namaPelayanan) {
    // Set value to form fields in the modal
    document.getElementById('id_jpelayanan').value = id;
    document.getElementById('nama_pelayanan').value = namaPelayanan;
  }
</script>