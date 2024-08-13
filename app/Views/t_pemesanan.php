<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">PEMESANAN</h4>
      
      <form action="<?= base_url('home/aksi_t_pemesanan')?>" method="POST">
        <div class="form-group">
        <label for="exampleInputUsername1">Username</label>
            <select class="form-control" name="username">
              <option value="">Pilih</option>
              <?php foreach ($yoga3 as $item): ?>
                <option value="<?= $item->id_user ?>">ID : <?= $item->id_user ?> | Nama : <?= $item->username ?></option>
              <?php endforeach; ?>
            </select>
        </div>

        <div id="pemesanan-container">
          <!-- Form Group Template -->
          <div class="form-group pemesanan-group">
            <label for="exampleInputUsername1">Jenis Paket</label>
            <select class="form-control" name="jenis_pakaian[]">
              <option value="">Pilih</option>
              <?php foreach ($yoga as $item): ?>
                <option value="<?= $item->id_jpakaian ?>"><?= $item->jenis_pakaian ?></option>
              <?php endforeach; ?>
            </select>

            <label for="exampleInputUsername1">Jenis Pelayanan</label>
            <select class="form-control" name="jenis_pelayanan[]">
              <option value="">Pilih</option>
              <?php foreach ($yoga2 as $item): ?>
                <option value="<?= $item->id_jpelayanan ?>"><?= $item->jenis_pelayanan ?></option>
              <?php endforeach; ?>
            </select>

            <div class="form-group">
                      <label for="exampleInputEmail1">Berat</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="berat[]" placeholder="Masukkan Berat">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="harga[]" placeholder="Masukkan Harga">
                    </div>

            <br><hr>

            <button type="button" class="btn btn-danger remove-row">Hapus</button>
          </div>
        </div>

        <button type="button" id="add-row" class="btn btn-primary">Tambah Pemesanan</button>
        
                <br>
        
        <label for="exampleInputUsername1">Tipe Pemesanan</label>
            <select class="form-control" name="tipe">
              <option value="">Pilih</option>
                <option value="Antar & Bayar Nanti">Antar & Bayar Nanti</option>
                <option value="Pickup & Bayar Nanti">Pickup & Bayar Nanti</option>
                <option value="Antar & Bayar Langsung">Antar & Bayar Langsung</option>
                <option value="Pickup & Bayar Langsung">Pickup & Bayar Langsung</option>
            </select>

        <br>

       
       <br>
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <button class="btn btn-light">Cancel</button>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
  // Add row
  document.getElementById('add-row').addEventListener('click', () => {
    const container = document.getElementById('pemesanan-container');
    const newRow = document.querySelector('.pemesanan-group').cloneNode(true);
    
    // Clear values in new row
    const inputs = newRow.querySelectorAll('input, select');
    inputs.forEach(input => input.value = '');
    
    // Append new row
    container.appendChild(newRow);
  });

  // Remove row
  document.getElementById('pemesanan-container').addEventListener('click', (event) => {
    if (event.target.classList.contains('remove-row')) {
      if (document.querySelectorAll('.pemesanan-group').length > 1) {
        event.target.closest('.pemesanan-group').remove();
      } else {
        alert('Tidak dapat menghapus semua baris.');
      }
    }
  });
});
</script>
