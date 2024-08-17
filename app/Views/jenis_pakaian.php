<div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Paket</h4>
                  <a class="nav-link text-Headings my-2" href="#" data-toggle="modal" data-target="#tambahPaketModal">
  <span class="mdi mdi-cart-plus"></span> Tambah Paket
</a>
                  <div class="table-responsive">
                    <table class="table">
                    
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Paket</th>
                        </tr>
                      </thead>
                      <tbody>
              <?php
              $no = 1;
              foreach ($yoga as $key) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $key->jenis_pakaian?></td>
                  
                  <td>
  <button class="btn btn-info" data-toggle="modal" data-target="#editPaketModal" onclick="editPaket(<?= $key->id_jpakaian ?>, '<?= $key->jenis_pakaian ?>')">
    <i class="now-ui-icons ui-1_check"></i> Edit
  </button>
</td>

            <td>
			<a href="<?= base_url('home/hapus_paket/' .$key->id_jpakaian) ?>">
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
            <div class="modal fade" id="editPaketModal" tabindex="-1" role="dialog" aria-labelledby="editPaketModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPaketModalLabel">Edit Paket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editPaketForm" action="<?= base_url('home/aksi_e_paket') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="jenis_pakaian">Nama Paket</label>
            <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
            <input type="hidden" id="id_jpakaian" name="id_jpakaian">
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

<!-- Modal Tambah Paket -->
<div class="modal fade" id="tambahPaketModal" tabindex="-1" role="dialog" aria-labelledby="tambahPaketModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahPaketModalLabel">Tambah Paket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahPaketForm" action="<?= base_url('home/aksi_t_paket') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_paket_tambah">Nama Paket</label>
            <input type="text" class="form-control" id="nama_paket_tambah" name="nama_paket_tambah" required>
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
  function editPaket(id, namaPaket) {
    // Set value to form fields in the modal
    document.getElementById('id_jpakaian').value = id;
    document.getElementById('nama_paket').value = namaPaket;
  }
</script>