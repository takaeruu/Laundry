<?php

namespace App\Models;

use CodeIgniter\Model;

class M_laundry extends Model
{
    public function getEnumValues($table, $column)
    {
        $query = $this->db->query("SHOW COLUMNS FROM $table LIKE '$column'");
        $row = $query->getRow();
        preg_match("/^enum\(\'(.*)\'\)$/", $row->Type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
    public function tampil($yoga)
    {
        return $this->db->table($yoga)
            ->get()
            ->getResult();
    }
    public function tampilWhere($yoga, $whereCondition)
    {
        return $this->db->table($yoga)
            ->where($whereCondition)  // Menambahkan kondisi where
            ->get()
            ->getResult();
    }
    public function join($tabel1, $tabel2, $on)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on, 'left')
            ->get()
            ->getResult();
    }
    public function join1($tabel1, $tabel2, $on)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on, 'inner')
            ->get()
            ->getResult();
    }

    public function dataTransaksi($tabel1, $id_transaksi, $where = [])
    {
        $builder = $this->db->table($tabel1)
            ->select('
                user_transaksi.username AS transaksi_username,
                pemesanan.kode_pemesanan,
                jpakaian.jenis_pakaian,
                jpelayanan.jenis_pelayanan,
                pemesanan.berat,
                pemesanan.harga') // pastikan tanggal_nota ada dalam select
            ->join('pemesanan', 'transaksi.kode_pemesanan = pemesanan.kode_pemesanan', 'inner')
            ->join('user AS user_transaksi', 'pemesanan.id_user = user_transaksi.id_user', 'inner')
            ->join('jpakaian', 'pemesanan.id_jpakaian = jpakaian.id_jpakaian', 'inner')
            ->join('jpelayanan', 'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan', 'inner');

        // Apply where condition if provided
        if (!empty($where)) {
            $builder->where($where);
        }

        // Apply where condition for id_transaksi
        $builder->where('transaksi.id_transaksi', $id_transaksi);

        // Return the result
        return $builder->get()->getResult();
    }



    // tes print
    public function caritransaksi($tgl_awal, $tgl_selesai)
    {
        $query = "SELECT  transaksi.no_transaksi,
            user_transaksi.username AS transaksi_username, 
            pemesanan.kode_pemesanan, 
		    user_pemesanan.username AS pemesanan_username,
            jpakaian.jenis_pakaian, 
            jpelayanan.jenis_pelayanan,  
		    pemesanan.berat,  
            transaksi.total_harga,
		    transaksi.tanggal_nota,
            pemesanan.tipe
              FROM transaksi
              JOIN pemesanan ON transaksi.kode_pemesanan = pemesanan.kode_pemesanan
              JOIN user AS user_transaksi ON transaksi.id_user = user_transaksi.id_user
              JOIN user AS user_pemesanan ON pemesanan.id_user = user_pemesanan.id_user
              JOIN jpakaian ON pemesanan.id_jpakaian = jpakaian.id_jpakaian
              JOIN jpelayanan ON pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan
              WHERE transaksi.tanggal_nota BETWEEN ? AND ?";

        return $this->db->query($query, [$tgl_awal, $tgl_selesai])->getResult();
    }
    // tes print 

    public function dataPrint($tabel1, $tanggal_awal = null, $tanggal_akhir = null)
    {
        $builder = $this->db->table($tabel1)
            ->select('
            transaksi.no_transaksi,
            user_transaksi.username AS transaksi_username, 
            pemesanan.kode_pemesanan, 
		    user_pemesanan.username AS pemesanan_username,
            jpakaian.jenis_pakaian, 
            jpelayanan.jenis_pelayanan,  
		    pemesanan.berat,  
            transaksi.total_harga,
		    transaksi.tanggal_nota')
            ->join('pemesanan', 'transaksi.kode_pemesanan = pemesanan.kode_pemesanan', 'inner')
            ->join('user AS user_transaksi', 'transaksi.id_user = user_transaksi.id_user', 'inner')
            ->join('user AS user_pemesanan', 'pemesanan.id_user = user_pemesanan.id_user', 'inner')
            ->join('jpakaian', 'pemesanan.id_jpakaian = jpakaian.id_jpakaian', 'inner')
            ->join('jpelayanan', 'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan', 'inner');

        // Apply date range filter if provided
        if ($tanggal_awal && $tanggal_akhir) {
            $builder->where('transaksi.tanggal_nota >=', $tanggal_awal)
                ->where('transaksi.tanggal_nota <=', $tanggal_akhir);
        }

        // Debugging query
        $query = $builder->get();
        if (!$query) {
            // Display query error if any
            echo $this->db->getLastQuery();
            return false;
        }

        return $query->getResult();
    }

    public function dataPrint2($tabel1)
    {
        $builder = $this->db->table($tabel1)
            ->select('
            transaksi.no_transaksi,
            user_transaksi.username AS transaksi_username, 
            pemesanan.kode_pemesanan, 
		    user_pemesanan.username AS pemesanan_username,
            jpakaian.jenis_pakaian, 
            jpelayanan.jenis_pelayanan,  
		    pemesanan.berat,  
            transaksi.total_harga,
		    transaksi.tanggal_nota')
            ->join('pemesanan', 'transaksi.kode_pemesanan = pemesanan.kode_pemesanan', 'inner')
            ->join('user AS user_transaksi', 'transaksi.id_user = user_transaksi.id_user', 'inner')
            ->join('user AS user_pemesanan', 'pemesanan.id_user = user_pemesanan.id_user', 'inner')
            ->join('jpakaian', 'pemesanan.id_jpakaian = jpakaian.id_jpakaian', 'inner')
            ->join('jpelayanan', 'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan', 'inner');


        // Debugging query
        $query = $builder->get();
        if (!$query) {
            // Display query error if any
            echo $this->db->getLastQuery();
            return false;
        }

        return $query->getResult();
    }


    public function joinWherer($tabel1, $tabel2, $on, $where)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on, 'left')
            ->getWhere($where)
            ->getRow();
    }
    public function tambah($table, $isi)
    {
        return $this->db->table($table)
            ->insert($isi);
    }
    public function upload($file)
    {
        $imageName = $file->getName();
        $file->move(ROOTPATH . 'public/img', $imageName);
    }
    public function hapus($table, $where)
    {
        return $this->db->table($table)
            ->delete($where);
    }
    public function edit($tabel, $isi, $where)
    {
        return $this->db->table($tabel)
            ->update($isi, $where);
    }
    public function updatee($tabel, $isi)
    {
        return $this->db->table($tabel)
            ->update($isi);
    }
    public function getWhere($tabel, $where)
    {
        return $this->db->table($tabel)
            ->getwhere($where)
            ->getRow();
    }
    public function getWhereWithJoin($tabel1, $tabel2, $onCondition, $where)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $onCondition)
            ->getWhere($where)
            ->getRow();
    }
    public function join4tbl($tabel1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->join($tabel4, $on3, 'inner')
            ->get()
            ->getResult();
    }
    public function join4tblOrderBy($tabel1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $orderByColumn = null, $orderDirection = 'ASC')
    {
        $builder = $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->join($tabel4, $on3, 'inner');

        if ($orderByColumn) {
            $builder->orderBy($orderByColumn, $orderDirection);
        }

        return $builder->get()->getResult();
    }

    public function join4tblOrderBypemesanan($tabel1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $orderByColumn = null, $orderDirection = 'ASC')
    {
        $builder = $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->join($tabel4, $on3, 'inner')
            ->where("$tabel1.deleted_at", null); // Menambahkan kondisi where deleted_at is null

        if ($orderByColumn) {
            $builder->orderBy($orderByColumn, $orderDirection);
        }

        return $builder->get()->getResult();
    }

    public function join4tblOrderBypemesanan2($tabel1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $orderByColumn = null, $orderDirection = 'ASC')
    {
        $builder = $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->join($tabel4, $on3, 'inner')
            ->where("$tabel1.deleted_at IS NOT NULL");; // Menambahkan kondisi where deleted_at is null

        if ($orderByColumn) {
            $builder->orderBy($orderByColumn, $orderDirection);
        }

        return $builder->get()->getResult();
    }

    public function join3tbl($tabel1, $tabel2, $tabel3, $on1, $on2)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->get()
            ->getResult();
    }

    public function getById($id)
    {
        return $this->db->table('user')
            ->where('id_user', $id)
            ->get()
            ->getRow();
    }

    public function getWhereWithJoin1($tabel1, $tabel2, $tabel3, $tabel4, $onCondition1, $onCondition2, $onCondition3, $where)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $onCondition1)
            ->join($tabel3, $onCondition2)
            ->join($tabel4, $onCondition3)
            ->getWhere($where)
            ->getRow();
    }


    protected $pemesanan = 'pemesanan';
    protected $transaksi = 'transaksi';

    public function getJadwal($id_kelas, $id_blok, $id_bulan)
    {
        return $this->db->table('jadwal')
            ->select('jadwal.sesi, COALESCE(guru.nama_mapel, "Istirahat") as nama_mapel, jadwal.jam_mulai, jadwal.jam_selesai, COALESCE(guru.nama_guru, "-") as nama_guru')
            ->join('guru', 'guru.id_guru = jadwal.id_Guru', 'left')
            ->where('jadwal.id_kelas', $id_kelas)
            ->where('jadwal.id_blok', $id_blok)
            ->where('jadwal.id_bulan', $id_bulan)
            ->get()
            ->getResult();
    }
    public function getJadwalByKelasBlok($kelasId, $blokId, $bulanId)
    {
        return $this->db->table->select('jadwal.sesi, COALESCE(guru.nama_mapel, "Istirahat") as nama_mapel, jadwal.jam_mulai, jadwal.jam_selesai, COALESCE(guru.nama_guru, "-") as nama_guru')
            ->from('jadwal')
            ->join('guru', 'guru.id_guru = jadwal.id_guru', 'left')
            ->where('jadwal.id_kelas', $kelasId)
            ->where('jadwal.id_blok', $blokId)
            ->where('jadwal.id_bulan', $bulanId)
            ->get()
            ->result();
    }



    public function hapus_jadwal($id_kelas, $id_blok)
    {
        return $this->db->table('jadwal')
            ->where('id_kelas', $id_kelas)
            ->where('id_blok', $id_blok)
            ->delete();
    }
    public function isMapelExistInClassAndSesi($guruId, $sesi, $kelasId)
    {
        $query = $this->db->table('jadwal')
            ->where('id_guru', $guruId)
            ->where('sesi', $sesi)
            ->where('id_kelas', $kelasId)
            ->countAllResults();

        return $query > 0;
    }


    public function isScheduleConflict($guruId, $sesi, $kelasId, $jamMulai, $jamSelesai)
    {
        $query = $this->db->table('jadwal')
            ->where('id_guru', $guruId)
            ->where('sesi', $sesi)
            ->where('id_kelas', $kelasId)
            ->where('((jam_mulai < "' . $jamSelesai . '" AND jam_selesai > "' . $jamMulai . '") OR (jam_mulai < "' . $jamSelesai . '" AND jam_selesai > "' . $jamMulai . '"))')
            ->countAllResults();

        return $query > 0;
    }
    public function cari($kelas, $blok, $bulan)
    {
        $query = "SELECT jadwal.sesi, COALESCE(guru.nama_mapel, 'Istirahat') as nama_mapel, jadwal.jam_mulai, jadwal.jam_selesai, COALESCE(guru.nama_guru, '-') as nama_guru 
              FROM jadwal 
              JOIN guru ON jadwal.id_guru = guru.id_guru 
              JOIN kelas ON jadwal.id_kelas = kelas.id_kelas 
              JOIN blok ON jadwal.id_blok = blok.id_blok 
              JOIN bulan ON jadwal.id_bulan = bulan.id_bulan 
              WHERE jadwal.id_kelas = ?
                AND jadwal.id_blok = ? 
                AND jadwal.id_bulan = ?";

        return $this->db->query($query, [$kelas, $blok, $bulan])->getResult();
    }

    public function join4tblAndFilterByUser($tabel1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $id_user)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->join($tabel4, $on3, 'inner')
            ->where('pemesanan.id_user', $id_user)
            ->get()
            ->getResult();
    }
    public function tampil_karyawan($tabel1, $where, $where2)
    {
        return $this->db->table($tabel1)
            ->where('user.level', $where)
            ->orWhere('user.level', $where2)
            ->get()
            ->getResult();
    }
    public function generateUniqueCode()
    {
        $query = $this->db->query("SELECT kode_pemesanan FROM " . $this->pemesanan . " ORDER BY kode_pemesanan DESC LIMIT 1");
        if (!$query) {
            die("Query Error: " . $this->db->error()['message']);
        }
        $row = $query->getRow();
        if ($row) {
            $lastCode = $row->kode_pemesanan;
            $lastNumber = (int)substr($lastCode, 2); // Menghapus prefix 'PS'
            $newNumber = $lastNumber + 1;
            $newCode = 'PS' . str_pad($newNumber, 8, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'PS00000001';
        }
        return $newCode;
    }
    public function generateNoTransaksi($kodeToko = '01')
    {
        $today = date('ymd'); // Format tahun, bulan, tanggal
        $prefix = $kodeToko . $today;
        $query = $this->db->query("SELECT no_transaksi FROM " . $this->transaksi . " WHERE no_transaksi LIKE '" . $prefix . "%' ORDER BY no_transaksi DESC LIMIT 1");

        if (!$query) {
            die("Query Error: " . $this->db->error()['message']);
        }

        $row = $query->getRow();
        if ($row) {
            $lastCode = $row->no_transaksi;
            $lastNumber = (int)substr($lastCode, -2); // Mengambil dua angka terakhir
            $newNumber = $lastNumber + 1;
            $newCode = $prefix . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $newCode = $prefix . '01';
        }

        return $newCode;
    }


    public function transferToTransaksi($id_pemesanan)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // Ambil data dari tabel pemesanan
        $query = $db->table('pemesanan')->where('id_pemesanan', $id_pemesanan)->get();
        $pemesanan = $query->getRow();

        if ($pemesanan) {
            // Pindahkan data ke tabel transaksi
            $data = [
                'kode_pemesanan' => $pemesanan->kode_pemesanan,
                'id_user' => $pemesanan->id_user,
                'id_jpakaian' => $pemesanan->id_jpakaian,
                'id_jpelayanan' => $pemesanan->id_jpelayanan,
                'berat' => $pemesanan->berat,
                'harga' => $pemesanan->harga,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $db->table('transaksi')->insert($data);

            // Hapus data dari tabel pemesanan
            $db->table('pemesanan')->where('id_pemesanan', $id_pemesanan)->delete();
        }

        $db->transComplete();
        return $db->transStatus();
    }
    private function generateKodeCart()
    {
        $timestamp = time(); // Mendapatkan waktu saat ini dalam detik sejak Unix Epoch
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5); // String acak sepanjang 5 karakter
        return 'CART' . $timestamp . $randomString; // Format kode cart
    }
    public function getWhere1($table, $where)
    {
        return $this->db->table($table)->where($where)->get();
    }
    protected $table = 'user'; // Nama tabel
    protected $primaryKey = 'id_user';  // Primary key tabel
    protected $allowedFields = ['password'];
    public function resetPassword($id)
    {
        // Mengatur password menjadi '1' dan mengenkripsinya dengan MD5
        $hashedPassword = md5('1'); // Password yang diatur menjadi '1' setelah di-hash
        return $this->update($id, ['password' => $hashedPassword]);
    }

    public function getPassword($userId)
    {
        return $this->db->table('user')
            ->select('password')
            ->where('id_user', $userId)
            ->get()
            ->getRow()
            ->password;
    }


    public function get_by_kode($kode_pemesanan)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->where('kode_pemesanan', $kode_pemesanan);
        $query = $builder->get();
        $result = $query->getRow();

        return $result;
    }
    public function findUser($id_user)
    {
        return $this->asObject()->where('id_user', $id_user)->first();
    }
    public function get_by_kodes($kode_pemesanan_array)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan');
        $builder->join('user', 'user.id_user = pemesanan.id_user', 'left');
        $builder->join('jpakaian', 'jpakaian.id_jpakaian = pemesanan.id_jpakaian', 'left');
        $builder->join('jpelayanan', 'jpelayanan.id_jpelayanan = pemesanan.id_jpelayanan', 'left'); // Join tabel user
        $builder->whereIn('kode_pemesanan', $kode_pemesanan_array);
        $query = $builder->get();
        return $query->getResult();
    }
    public function joinFilterByUser($tabel1, $tabel2, $on1, $id_user)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->where('transaksi.pelanggan', $id_user)
            ->get()
            ->getResult();
    }
    public function saveToBackup($table, $data)
    {
        $this->db->table($table)->insert($data);
    }
    public function getBackupData($id_pemesanan)
    {
        return $this->db->table('pemesanan_backup')
            ->where('id_pemesanan', $id_pemesanan)
            ->orderBy('backup_at', 'DESC')
            ->get()
            ->getResult();
    }
}
