<div class="container">
  <section class="section mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Print Laporan</h5>
            <!-- Form PDF -->
            <form action="" method="get" enctype="multipart/form-data">
              <!-- Input Tanggal Mulai -->
              <div class="mb-3 row">
                <label for="awal" class="col-sm-4 col-form-label">Tanggal Awal</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="awal" name="awal">
                </div>
              </div>
              <!-- Input Tanggal Selesai -->
              <div class="mb-3 row">
                <label for="akhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="akhir" name="akhir">
                </div>
              </div>
              <!-- Tombol Submit -->
              <div class="text-center">
                <button type="submit" formaction="<?= base_url('home/aksi_laporan_pdf') ?>" class="btn btn-secondary me-2">PDF</button>
                <button type="submit" formaction="<?= base_url('home/aksi_laporan_excel') ?>" class="btn btn-primary me-2">Excel</button>
                <button type="submit" formaction="<?= base_url('home/windows_print') ?>" class="btn btn-danger">Windows</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
