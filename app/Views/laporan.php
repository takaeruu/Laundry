<div class="typewriter">
    <div class="slide"><i></i></div>
    <div class="paper"></div>
    <div class="keyboard"></div>
</div>

<br>

<section class="section">
  <div class="row">
  <div class="col-lg-8"> <!-- Kolom pertama, setengah lebar -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Print PDF</h5>
            <!-- Form PDF -->
            <form action="<?= base_url('home/aksi_laporan_pdf') ?>" method="get" enctype="multipart/form-data">
                <!-- Input Tanggal Mulai -->
                <div class="row mb-3">
                    <label for="awal" class="col-sm-4 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="awal" name="awal">
                    </div>
                </div>
                <!-- Input Tanggal Selesai -->
                <div class="row mb-3">
                    <label for="akhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="akhir" name="akhir">
                    </div>
                </div>
                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-secondary">PDF</button>
                </div>
            </form>

        </div>
    </div>
</div>


    <div class="col-lg-8"> <!-- Kolom kedua, setengah lebar -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Print Excel</h5>
          <!-- Form Excel -->
          <form action="<?= base_url('home/aksi_laporan_excel') ?>" method="POST" enctype="multipart/form-data">
            <!-- Input Tanggal Mulai -->
            <div class="row mb-3">
              <label for="awal" class="col-sm-4 col-form-label">Tanggal Awal</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="awal2" name="awal2">
              </div>
            </div>
            <!-- Input Tanggal Selesai -->
            <div class="row mb-3">
              <label for="akhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="akhir2" name="akhir2">
              </div>
            </div>
            <!-- Tombol Submit -->
            <div class="text-center">
              <button type="submit" class="btn btn-danger"><i class="ri-file-pdf-fill">Excel</i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
  <div class="col-lg-8"> <!-- Kolom pertama, setengah lebar -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Print Windows PDF</h5>
            <!-- Form PDF -->
            <form action="<?= base_url('home/windows_print') ?>" method="POST" enctype="multipart/form-data">
                <!-- Input Tanggal Mulai -->
                <div class="row mb-3">
                    <label for="awal" class="col-sm-4 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="awal3" name="awal3">
                    </div>
                </div>
                <!-- Input Tanggal Selesai -->
                <div class="row mb-3">
                    <label for="akhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="akhir3" name="akhir3">
                    </div>
                </div>
                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Windows PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
