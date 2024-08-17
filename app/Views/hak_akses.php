<div class="col-md-5 grid-margin ">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pengaturan Hak Akses </h4>
            <form action="<?= base_url('home/update_hak_akses/' . $level) ?>" method="post">
                <label>
                    <input type="checkbox" name="permissions[]" value="dashboard"
                        <?= in_array('dashboard', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Dashboard
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="pemesanan"
                        <?= in_array('pemesanan', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Pemesanan
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="transaksi"
                        <?= in_array('transaksi', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Transaksi
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="pemesanan_karyawan"
                        <?= in_array('pemesanan_karyawan', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Pemesanan Karyawan
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="transaksi_karyawan"
                        <?= in_array('transaksi_karyawan', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Transaksi Karyawan
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="laporan"
                        <?= in_array('laporan', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Laporan
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="jenis_paket"
                        <?= in_array('jenis_paket', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Jenis Paket
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="jenis_pelayanan"
                        <?= in_array('jenis_pelayanan', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Jenis Pelayanan
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="karyawan"
                        <?= in_array('karyawan', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Karyawan
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="setting"
                        <?= in_array('setting', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Setting
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="log_activity"
                        <?= in_array('log_activity', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Log Activity
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="restore_data"
                        <?= in_array('restore_data', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Restore Data
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="level"
                        <?= in_array('level', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Level
                </label>
                <br>
                <label>
                    <input type="checkbox" name="permissions[]" value="restore_edit"
                        <?= in_array('restore_edit', array_column($permissions, 'menu_name')) ? 'checked' : '' ?>>
                    Restore Edit
                </label>
                <br>
                <button type="submit" class="btn btn-primary">Simpan Hak Akses</button>
            </form>


        </div>
    </div>