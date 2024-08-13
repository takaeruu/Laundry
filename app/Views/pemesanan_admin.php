<div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pemesanan</h4>
            <div class="table-responsive">
                <a class="nav-link text-Headings my-2" href="<?= base_url('home/t_pemesanan')?>">
                    <span class="mdi mdi-cart-plus"></span>
                </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pemesanan</th>
                            <th>Jenis Paket</th>
                            <th>Jenis Pelayanan</th>
                            <th>Status</th>
                            <th>Berat</th>
                            <th>Harga</th>
                            <th>Nama</th>
                            <th>Nomor Telefon</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Tipe Pemesanan</th>
                            <th class="hide-when-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($yoga as $key) {
                            if ($status = $key->status === 'DiKerjakan'|| $status = $key->status === 'DiAntar') :
                        ?>
                        <tr data-id="<?= $key->id_pemesanan ?>" data-kode="<?= $key->kode_pemesanan ?>" data-harga="<?= $key->harga ?>">
                            <td><?= $no++ ?></td>
                            <td><?= $key->kode_pemesanan?></td>
                            <td><?= $key->jenis_pakaian?></td>
                            <td><?= $key->jenis_pelayanan?></td>
                            <td><?= $key->status?></td>
                            <td><?= $key->berat?></td>
                            <td>Rp.<?= $key->harga?>,00</td>
                            <td><?= $key->username?></td>
                            <td><?= $key->nohp?></td>
                            <td><?= $key->alamat?></td>
                            <td><?= $key->status?></td>
                            <td><?= $key->tipe?></td>
                            <td class="hide-when-print">
    <a href="<?= base_url('home/atur/' .$key->id_pemesanan) ?>">
        <button class="btn btn-info">
            <i class="now-ui-icons ui-1_check"></i> Edit
        </button>
    </a>
    <a href="<?= base_url('home/hapus_pemesanan/' .$key->id_pemesanan) ?>">
        <button class="btn btn-danger">
            <i class="now-ui-icons ui-1_simple-remove"></i> Hapus
        </button>
    </a>
   
    <button class="btn btn-success btn-bayar" data-kode="<?= $key->kode_pemesanan ?>" data-id="<?= $key->id_pemesanan ?>" data-harga="<?= $key->harga ?>" data-pemesanan="<?= $key->id_pemesanan ?>">
    <i class="now-ui-icons ui-1_simple-add"></i> Bayar
</button>
<?Php 
$tipe = $key->tipe;
if ($tipe === 'Antar & Bayar Nanti') :
?>
<button class="btn btn-success btn-print" data-kode="<?= $key->kode_pemesanan ?>" data-id="<?= $key->id_pemesanan ?>" data-harga="<?= $key->harga ?>" data-pemesanan="<?= $key->id_pemesanan ?>">
    <i class="now-ui-icons ui-1_simple-add"></i> Print
</button>
<?Php 
endif;
?>   
</td>
                        </tr>
                        
                        <?php endif ;?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="modalBayarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBayarLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBayar">
                    <div class="form-group">
                        <label for="inputKodePemesanan">Kode Pemesanan</label>
                        <input type="text" class="form-control" id="inputKodePemesanan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputTotalHarga">Total Harga</label>
                        <input type="text" class="form-control" id="inputTotalHarga" readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputJumlahBayar">Jumlah Bayar</label>
                        <input type="number" class="form-control" id="inputJumlahBayar" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
   $(document).ready(function() {
    $('.btn-bayar').on('click', function() {
        var kodePemesanan = $(this).data('kode');
        var totalHarga = 0;

        // Menghitung total harga dari semua pemesanan dengan kode yang sama
        $('.btn-bayar[data-kode="' + kodePemesanan + '"]').each(function() {
            totalHarga += parseFloat($(this).data('harga'));
        });

        $('#inputKodePemesanan').val(kodePemesanan);
        $('#inputTotalHarga').val(totalHarga.toFixed(2));
        $('#modalBayar').modal('show');
    });

    $('#formBayar').on('submit', function(event) {
        event.preventDefault();
        var kodePemesanan = $('#inputKodePemesanan').val();
        var jumlahBayar = parseFloat($('#inputJumlahBayar').val());
        var totalHarga = parseFloat($('#inputTotalHarga').val());

        // Validasi jika jumlah bayar kurang dari total harga
        if (jumlahBayar < totalHarga) {
            alert('Jumlah bayar tidak boleh kurang dari total harga!');
            return false;
        }

        // Redirect ke view nota dengan parameter kode_pemesanan dan jumlah_bayar
        window.location.href = "<?= base_url('home/view_nota') ?>/" + kodePemesanan + "/" + jumlahBayar;
    });
});

$(document).ready(function() {
    $('.btn-print').on('click', function() {
        var kodePemesanan = $(this).data('kode');
        var jumlahBayar = 0; // Set jumlah bayar tetap

        // Redirect ke view nota dengan parameter kode_pemesanan dan jumlah_bayar
        window.location.href = "<?= base_url('home/view_nota2') ?>/" + kodePemesanan + "/" + jumlahBayar;
    });
});



</script>