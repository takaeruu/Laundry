<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
    <!-- Pastikan ini adalah jQuery versi penuh, bukan yang "slim" -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="col-lg-10">
    <h5 class="card-title">Transaksi</h5>
    <div class="card">
        <div class="card-body" id="printableArea">
            <div class="text-center">
                <div class="card">
                    <div class="card-header bg-white border-0 pb-0 pt-4">
                        <div class="row text-center">
                            <div class="col-6 col-sm-7 pr-0">
                                <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                                    <li>NOTA :</li>
                                    <li>KASIR : <?= $kasir ?></li>
                                </ul>
                            </div>
                            <div class="col-4 col-sm-3 pl-0">
                                <ul class="pl-0 small" style="list-style: none;">
                                    <li>TGL : <?= date('Y-m-d') ?></li>
                                    <li>JAM : <?= date('H:i:s') ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body small pt-0">
                        <hr class="mt-0">
                        <table class="table" id="notaTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Kode Pemesanan</th>
                                    <th scope="col">Jenis Pakaian</th>
                                    <th scope="col">Jenis Pelayanan</th>
                                    <th scope="col">Berat</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($pemesananList) && is_array($pemesananList)) {
                                    foreach ($pemesananList as $pemesanan) { ?>
                                    
                                        <tr>
                                            <td><?= $pemesanan->username ?></td>
                                            <td><?= $pemesanan->kode_pemesanan ?></td>
                                            <td><?= $pemesanan->jenis_pakaian ?></td>
                                            <td><?= $pemesanan->jenis_pelayanan ?></td>
                                            <td><?= $pemesanan->berat ?></td>
                                            <td>Rp.<?= $pemesanan->harga ?>,00</td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="6">Data tidak ditemukan.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                      
                        <div class="col-12">
                            <hr class="mt-2">
                            <ul class="list-group border-0">
                          
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <b>Total</b>
                                    <span id="totalHarga">Rp.<?= $total_harga ?>,00</span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <b>Bayar</b>
                                    <span id="bayar">Rp.<?= $bayar ?>,00</span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <b>Kembalian</b>
                                    <span id="kembalian">Rp.<?= $kembalian ?>,00</span>
                                    <input type="hidden" id="inputIdUser" name="id_user" value="<?= $id_user ?>">
                                </li>
                             
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 text-center">
                        <p>* TERIMA KASIH *</p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-sm-12 mt-3 text-right no-print">
    <a href="<?= base_url('home/view_print_nota/' . $pemesanan->kode_pemesanan . '/' . $bayar) ?>" id="printButton">
    <button class="btn btn-info btn-sm mr-2">
        <i class="fa fa-print mr-1"></i> Print
    </button>
</a>

        <button class="btn btn-success btn-sm mr-2" id="simpanButton">
            <i class="fa fa-save mr-1"></i> Simpan
        </button>
       
    </div>
</div>

<script>
    
    $(document).ready(function() {
    $('#simpanButton').on('click', function() {
        var kodePemesanan = [];
        $('#notaTable tbody tr').each(function() {
            var kode = $(this).find('td:nth-child(2)').text();
            kodePemesanan.push(kode);
        });

        var data = {
            tanggal: "<?= date('Y-m-d H:i:s') ?>",
            total_harga: "<?= $total_harga ?>",
            kode_pemesanan: JSON.stringify(kodePemesanan),
            bayar: "<?= $bayar ?>",
            kembalian: "<?= $kembalian ?>",
            id_user: $("#inputIdUser").val()  // Tambahkan id_user di sini
        };

        $.post("<?= base_url('home/simpan_transaksi') ?>", data, function(response) {
            // Handle the response from the server
            alert('Transaksi berhasil disimpan');
            window.location.href = "<?= base_url('home/pemesanan_karyawan') ?>";
        }).fail(function(xhr, status, error) {
            // Handle the error
            alert('Terjadi kesalahan saat menyimpan transaksi');
        });
    });
});

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- base:js -->
  <script src="<?= base_url('vendors/js/vendor.bundle.base.js')?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?= base_url('vendors/chart.js/Chart.min.js')?>"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?= base_url('js/off-canvas.js')?>"></script>
  <script src="<?= base_url('js/hoverable-collapse.js')?>"></script>
  <script src="<?= base_url('js/template.js')?>"></script>
  <script src="<?= base_url('js/settings.js')?>"></script>
  <script src="<?= base_url('js/todolist.js')?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?= base_url('js/dashboard.js')?>"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- End custom js for this page-->
</body>
</html>
