<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($setting) ? $setting->nama_website : 'Update Setting' ?></title>
  <!-- Sertakan CSS dan JavaScript di sini -->
</head>
<body>
  <div class="col-md-5 grid-margin">
    <div class="card">
      <div class="card-body">
      <form action="<?= base_url('home/aksi_e_setting') ?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= isset($setting) ? $setting->id_setting : '' ?>">
  <div class="form-group">
    <label for="siteName">Nama Website</label>
    <input type="text" class="form-control" id="siteName" name="namawebsite" placeholder="Masukkan Nama Website" value="<?= isset($setting) ? $setting->nama_website : '' ?>">
  </div>
  <div class="form-group">
    <label for="favicon">Upload Favicon</label>
    <input type="file" id="img" name="img" accept="image/*">
  </div>
  <div class="form-group">
    <label for="favicon">Logo Website</label>
    <input type="file" id="logo" name="logo" accept="image/*">
  </div>
  <div class="form-group">
    <label for="favicon">Login Icon</label>
    <input type="file" id="login" name="login" accept="image/*">
  </div>
  <button type="submit" class="btn btn-primary mr-2">Submit</button>
</form>

      </div>
    </div>
  </div>
</body>
</html>