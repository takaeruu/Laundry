<?php

namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\M_laundry;
use Dompdf\Dompdf;

class Home extends BaseController
{
	public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
	public function dashboard()
	{
		if(session()->get('id')>0){
			
		$id_user = session()->get('id');
		$where = 'Admin';
		$where2 = 'Karyawan';
		$model = new M_laundry;
		$where3 = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
		// $data['yoga'] = $model->join4tbl('pemesanan', 'jpakaian', 'jpelayanan', 'user',
		//  'pemesanan.id_jpakaian = jpakaian.id_jpakaian',
		// 'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan',
		// 'pemesanan.id_user = user.id_user');

		$data['yoga'] = $model->tampil_karyawan('user', $where, $where2);
		
		echo view ('header', $data);
		echo view ('menu', $data);
		echo view('dashboard',$data);
		echo view('footer');
		
		} else {
			return redirect()->to('home/login');
		}
	}
	public function login()
	{
		$model = new M_laundry;
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
		echo view ('header', $data);
		echo view('login', $data);
		
	}
	public function aksi_login()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $captcha_response = $this->request->getPost('g-recaptcha-response');
    $backup_captcha = $this->request->getPost('backup_captcha');

    if (empty($captcha_response) && empty($backup_captcha)) {
        return redirect()->to('home/login')->with('error', 'CAPTCHA is required.');
    }

    // Validate reCAPTCHA
    if (!empty($captcha_response)) {
        $secret_key = '6LeWmSUqAAAAAK4S-ldt-C6V66shotK8rUTXk25M';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_response");
        $response_keys = json_decode($response, true);
    
        if (intval($response_keys["success"]) !== 1) {
            return redirect()->to('home/login')->with('error', 'reCAPTCHA validation failed.');
        }
    }

    // Validate offline CAPTCHA
    if (!empty($backup_captcha)) {
        if (!$this->validateOfflineCaptcha($backup_captcha)) {
            return redirect()->to('home/login')->with('error', 'Offline CAPTCHA validation failed.');
        }
    }

    // Check user credentials
    $model = new M_laundry();
    $user = $model->getWhere('user', [
        'username' => $username,
        'password' => md5($password),
    ]);

    if ($user) {
        session()->set('username', $user->username);
        session()->set('id', $user->id_user);
        session()->set('level', $user->level);

        return redirect()->to('home/dashboard');
    } else {
        return redirect()->to('home/login')->with('error', 'Invalid username or password.');
    }
}

private function validateOfflineCaptcha($captcha)
{
    $stored_captcha = session()->get('captcha_code');
    return $captcha === $stored_captcha;
}

public function generateCaptcha()
{
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    // Store the CAPTCHA code in the session
    session()->set('captcha_code', $code);

    // Generate the image
    $image = imagecreatetruecolor(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
    imagestring($image, 5, 10, 10, $code, $textColor);

    // Set the content type header - in this case image/png
    header('Content-Type: image/png');

    // Output the image
    imagepng($image);

    // Free up memory
    imagedestroy($image);
}
		public function logout()

	{
		session()->destroy();
		return redirect()->to('home/login');
	}
	public function register()

	{
		$model = new M_laundry;
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
		echo view ('header', $data);
		echo view('register');
		
	}
	public function aksi_t_user()
	{
		
		$yoga = $this -> request ->getPost('username');
		$yoga1 = $this -> request ->getPost('password');
		$a = $this -> request ->getPost('email');
		$b = $this -> request ->getPost('alamat');
		$c = $this -> request ->getPost('nohp');
		
		$yoga3= array(

			'username'=>$yoga,
			'password'=>md5($yoga1),
			'level' => 'Pelanggan',
			'email' => $a,
			'alamat' => $b,
			'nohp' => $c,
		);

		$model=new M_laundry();
		$model->tambah('user',$yoga3);
		return redirect()->to('home/login');
		
	}
	public function pemesanan()
	{
		if(session()->get('id')>0){
			if(session()->get('level') == 'Pelanggan'){
			
		$id_user = session()->get('id');
		$model = new M_laundry;
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
		// $data['yoga'] = $model->join4tbl('pemesanan', 'jpakaian', 'jpelayanan', 'user',
		//  'pemesanan.id_jpakaian = jpakaian.id_jpakaian',
		// 'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan',
		// 'pemesanan.id_user = user.id_user');

		$data['yoga'] = $model->join4tblAndFilterByUser('pemesanan', 'user', 'jpakaian', 'jpelayanan',
		 'pemesanan.id_user=user.id_user',
		'pemesanan.id_jpakaian=jpakaian.id_jpakaian',
		'pemesanan.id_jpelayanan=jpelayanan.id_jpelayanan',
		$id_user);
		
		echo view ('header', $data);
		echo view ('menu', $data);
		echo view('pemesanan',$data);
		echo view('footer');
		} else {
				return redirect()->to('home/error');
			}
		} else {
			return redirect()->to('home/login');
		}
	}
	public function t_pemesanan()
{
	if(session()->get('id')>0){
    if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
        $model = new M_laundry();
		$where2 = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where2)->getRow();
        // Cek apakah kode pemesanan sudah ada di sesi
        if (!session()->has('kode_pemesanan')) {
            // Menghasilkan kode pemesanan unik
            $kode_pemesanan = $model->generateUniqueCode();
            session()->set('kode_pemesanan', $kode_pemesanan);
		}
		$whereCondition = ['level' => 'Pelanggan'];
        $data['yoga'] = $model->tampil('jpakaian');
        $data['yoga2'] = $model->tampil('jpelayanan');
		$data['yoga3'] = $model->tampilWhere('user', $whereCondition);
        $where = array('id_user' => session()->get('id'));
        $data['darren'] = $model->getWhere('user', $where);

        echo view('header', $data);
        echo view('menu', $data);
        echo view('t_pemesanan', $data);
    } else {
        return redirect()->to('home/error');
    }
	} else {
		return redirect()->to('home/login');
	}
}

public function aksi_t_pemesanan()
{
    $jenis_pakaian = $this->request->getPost('jenis_pakaian');
    $jenis_pelayanan = $this->request->getPost('jenis_pelayanan');
    $id_user = session()->get('id');
	$id = $this->request->getPost('username');
    // $notelp = $this->request->getPost('notelp');
    $berat = $this->request->getPost('berat');
    $harga = $this->request->getPost('harga');
    $tipe = $this->request->getPost('tipe');
    $kode_pemesanan = session()->get('kode_pemesanan'); // Ambil kode pemesanan dari sesi

    $model = new M_laundry();
    
    // Proses data pemesanan
    foreach ($jenis_pakaian as $index => $pakaian) {
        $darren = array(
            'id_jpakaian' => $pakaian,
            'id_jpelayanan' => $jenis_pelayanan[$index],
            'status' => 'DiKerjakan',
            'id_user' => $id,
            'berat' => $berat[$index], // Ambil berat yang sesuai dengan indeks
            'harga' => $harga[$index],
            'tipe' => $tipe,
            'kode_pemesanan' => $kode_pemesanan,
			'create_by' => $id_user,
       		'create_at' => date('Y-m-d H:i:s')
        );

        // Menambahkan data ke tabel pemesanan
        $model->tambah('pemesanan', $darren);
    }

    // Setelah selesai, hapus kode pemesanan dari sesi
    session()->remove('kode_pemesanan');

    // Mengarahkan kembali ke halaman pemesanan
    return redirect()->to('home/pemesanan_karyawan');
}


	public function e_pemesanan($id)
	{
        if(session()->get('id')>0){
			if(session()->get('level') == 'Pelanggan'){
			
            $model = new M_laundry();
		$where2 = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where2)->getRow();
            $where=array('id_pemesanan'=>$id);

            $data['jpakaian'] = $model->tampil('jpakaian');
			$data['jpelayanan'] = $model->tampil('jpelayanan');
			$data['dua']=$model->getWhereWithJoin1('pemesanan', 'jpakaian', 'jpelayanan', 'user',
			'pemesanan.id_jpakaian = jpakaian.id_jpakaian',
			'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan',
			'pemesanan.id_user = user.id_user',
			['pemesanan.id_pemesanan' => $id]);
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('e_pemesanan', $data);
            echo view('footer');
			} else {
				return redirect()->to('home/error');
			}
    } else {
        return redirect()->to('home/login');
    }
	}
	public function aksi_e_pemesanan()
	{
		$id= $this->request->getPost('id');
		$b = $this -> request ->getPost('jenis_pakaian');
		$c = $this -> request ->getPost('jenis_pelayanan');
		$d = $this -> request ->getPost('tanggal');
		$e = $this -> request ->getPost('no_telp');
		$id_user = session()->get('id');
		$where=array('id_pemesanan'=>$id);

		$darren=array(
			
			'id_jpakaian'=>$b,
			'id_jpelayanan'=>$c,
			'tanggal'=>$d,
			'no_telp'=>$e,
			'update_by' => $id_user,
       		'update_at' => date('Y-m-d H:i:s')
			
		);

		$model=new M_laundry;
		$model->edit('pemesanan',$darren, $where);
		return redirect()->to('home/pemesanan');
	}
	public function cancel_pemesanan($id){
		$model = new M_laundry();
		$where=array('id_pemesanan'=>$id);
		$model->hapus('pemesanan', $where);

		return redirect()->to('Home/pemesanan');	
	}
	public function pemesanan_karyawan()
	{
		if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
			$model = new M_laundry();
			$where = array('id_setting' => '1');
            $where1 = array('pemesanan.deleted_at' => NULL);

			$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
		$data['yoga'] = $model->join4tblwhere('pemesanan', 'user', 'jpakaian', 'jpelayanan',
		 'pemesanan.id_user=user.id_user',
		'pemesanan.id_jpakaian=jpakaian.id_jpakaian',
		'pemesanan.id_jpelayanan=jpelayanan.id_jpelayanan', $where1);

		// $id_user = session()->get('id');  // Ambil id user dari session
		// $data['nel'] = $model->join4tblAndFilterByUser(
		// 	'pemesanan', 
		// 	'jpakaian', 
		// 	'jpelayanan', 
		// 	'user',
		// 	'pemesanan.id_jpakaian = jpakaian.id_jpakaian',
		// 	'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan',
		// 	'pemesanan.id_user = user.id_user',
		// 	$id_user
		// );
		echo view ('header', $data);
		echo view ('menu', $data);
		echo view('pemesanan_admin',$data);
		echo view('footer');
		} else {
				return redirect()->to('home/error');
			}
	} else {
        return redirect()->to('home/login');
    }
	}

    public function restore()
	{
		if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
			$model = new M_laundry();
			$where = array('id_setting' => '1');
            

			$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
		$data['yoga'] = $model->join4tblnotnull('pemesanan', 'user', 'jpakaian', 'jpelayanan',
		 'pemesanan.id_user=user.id_user',
		'pemesanan.id_jpakaian=jpakaian.id_jpakaian',
		'pemesanan.id_jpelayanan=jpelayanan.id_jpelayanan', 'pemesanan.deleted_at');

		// $id_user = session()->get('id');  // Ambil id user dari session
		// $data['nel'] = $model->join4tblAndFilterByUser(
		// 	'pemesanan', 
		// 	'jpakaian', 
		// 	'jpelayanan', 
		// 	'user',
		// 	'pemesanan.id_jpakaian = jpakaian.id_jpakaian',
		// 	'pemesanan.id_jpelayanan = jpelayanan.id_jpelayanan',
		// 	'pemesanan.id_user = user.id_user',
		// 	$id_user
		// );
		echo view ('header', $data);
		echo view ('menu', $data);
		echo view('restore',$data);
		echo view('footer');
		} else {
				return redirect()->to('home/error');
			}
	} else {
        return redirect()->to('home/login');
    }
	}
    public function aksi_restore($id)
	{
		$where=array('id_pemesanan'=>$id);

		$darren=array(
			'deleted_at'=>NULL
		);

		$model=new M_laundry;
		$model->edit('pemesanan',$darren, $where);
		return redirect()->to('home/restore');
	}
	public function atur($id)
	{
        if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
			
            $model = new M_laundry();
			
		$where2 = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where2)->getRow();
            $where=array('id_pemesanan'=>$id);
            $data['yoga'] = $model->tampil('jpakaian');
            $data['yoga2'] = $model->tampil('jpelayanan');
			$data['dua']=$model->getWhereWithJoin('pemesanan', 'user', 'pemesanan.id_user=user.id_user', ['pemesanan.id_pemesanan' => $id]);
			$data['tiga']=$model->getWhereWithJoin('pemesanan', 'jpakaian', 'pemesanan.id_jpakaian=jpakaian.id_jpakaian', ['pemesanan.id_pemesanan' => $id]);
			$data['empat']=$model->getWhereWithJoin('pemesanan', 'jpelayanan', 'pemesanan.id_jpelayanan=jpelayanan.id_jpelayanan', ['pemesanan.id_pemesanan' => $id]);
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('atur', $data);
            echo view('footer');
			} else {
				return redirect()->to('home/error');
			}
    } else {
        return redirect()->to('home/login');
    }
	}
	public function aksi_atur()
	{
		
		$id= $this->request->getPost('id');
		$b = $this -> request ->getPost('status');
		$c = $this -> request ->getPost('berat');
		$d = $this -> request ->getPost('harga');
		$id_user = session()->get('id');
		
		$where=array('id_pemesanan'=>$id);

		$darren=array(
			
			'status'=>$b,
			'berat'=>$c,
			'harga'=>$d,
			'update_by' => $id_user,
       		'update_at' => date('Y-m-d H:i:s'),
			
		);

		$model=new M_laundry;
		$model->edit('pemesanan',$darren, $where);
		return redirect()->to('home/pemesanan_karyawan');
	}
	public function hapus_pemesanan($id){
		$model = new M_laundry();
		$where=array('id_pemesanan'=>$id);
        $isi=array(
            'deleted_at'=>date('Y-m-d H:i:s')
        );
		$model->edit('pemesanan',$isi, $where);

		return redirect()->to('Home/pemesanan_karyawan');	
	}
    public function hapus_permanent($id){
		$model = new M_Laundry();
		$where=array('id_pemesanan'=>$id);
		$model->hapus('pemesanan', $where);

		return redirect()->to('Home/restore');	
	}
	public function selesai_pemesanan($id){
		$model = new M_laundry();
		$where=array('id_pemesanan'=>$id);

		$data = array (
			'Status' => 'Selesai'
		);

		$model->edit('pemesanan',$data, $where);

		return redirect()->to('Home/pemesanan_admin');	
	}
	public function simpan_transaksi()
{
    $model = new M_laundry();
    $tanggal = $this->request->getPost('tanggal');
    $total_harga = $this->request->getPost('total_harga');
    $kode_pemesanan_json = $this->request->getPost('kode_pemesanan');
    $bayar = $this->request->getPost('bayar');
    $kembalian = $this->request->getPost('kembalian');
    $id_user = $this->request->getPost('id_user'); // Ambil id_user dari post data
	$id = session()->get('id');
    // Debugging: Cek id_user
    log_message('info', 'ID User: ' . $id_user);

    // Decode JSON data menjadi array
    $kode_pemesanan = json_decode($kode_pemesanan_json);

    // Generate nomor transaksi
    $no_transaksi = $model->generateNoTransaksi();

    // Debugging: Cek nomor transaksi
    log_message('info', 'Nomor Transaksi: ' . $no_transaksi);

    // Data yang akan disimpan
    $data = array(
        'no_transaksi' => $no_transaksi,
        'pelanggan' => $id_user, // Simpan id_user dari post data
		'id_user' => $id,
        'tanggal_nota' => $tanggal,
        'total_harga' => $total_harga,
        'bayar' => $bayar,
        'kembalian' => $kembalian,
        'kode_pemesanan' => implode(',', $kode_pemesanan),
        'create_by' => $id,
        'create_at' => date('Y-m-d H:i:s'),
    );	
    
    // Debugging: Cek data yang akan disimpan
    log_message('info', 'Data Transaksi: ' . print_r($data, true));

    // Simpan data ke database
    $model->tambah('transaksi', $data);
    return redirect()->to('home/pemesanan_karyawan');
}


public function view_nota($kode_pemesanan, $jumlah_bayar)
{
    if (session()->get('id') > 0) {
        require_once(ROOTPATH . 'Vendor/autoload.php');
        $model = new M_laundry();
        $where = array('id_setting' => '1');
        $data2['yogi'] = $model->getWhere1('setting', $where)->getRow();

        $kasirId = session()->get('id');
        $kodeArray = explode(', ', $kode_pemesanan);

        // Ambil semua data pemesanan berdasarkan kode
        $pemesananList = $model->get_by_kodes($kodeArray);

        if (!$pemesananList) {
            throw new \Exception("Data pemesanan tidak ditemukan.");
        }

        // Ambil nama kasir dari session
        $kasir = $model->findUser($kasirId);

        if (!$kasir) {
            throw new \Exception("Data kasir tidak ditemukan.");
        }
        $data['kasir'] = $kasir->username;

        // Hitung total harga dari semua pemesanan
        $total_harga = array_sum(array_column($pemesananList, 'harga'));
        $data['total_harga'] = $total_harga;
        $data['bayar'] = $jumlah_bayar;
        $data['kembalian'] = $jumlah_bayar - $total_harga;
        $data['pemesananList'] = $pemesananList;
        
        // Ambil id_user dari data pemesanan
        $data['id_user'] = $pemesananList[0]->id_user; // Asumsi id_user sama untuk semua pemesanan

        echo view('header', $data2);
        echo view('menu', $data2);
        echo view('nota_view', $data);
    } else {
        return redirect()->to('home/dashboard');
    }
}

public function view_print_nota($kode_pemesanan, $jumlah_bayar)
{
    if (session()->get('id') > 0) {
        require_once(ROOTPATH . 'Vendor/autoload.php');
        
        $pdf = new \TCPDF();
        $model = new M_laundry();
        $where = array('id_setting' => '1');
        $data2['yogi'] = $model->getWhere1('setting', $where)->getRow();

        $kasirId = session()->get('id');
        $kodeArray = explode(', ', $kode_pemesanan);

        // Ambil semua data pemesanan berdasarkan kode
        $pemesananList = $model->get_by_kodes($kodeArray);

        if (!$pemesananList) {
            throw new \Exception("Data pemesanan tidak ditemukan.");
        }

        // Ambil nama kasir dari session
        $kasir = $model->findUser($kasirId);

        if (!$kasir) {
            throw new \Exception("Data kasir tidak ditemukan.");
        }
        $data['kasir'] = $kasir->username;

        // Hitung total harga dari semua pemesanan
        $total_harga = array_sum(array_column($pemesananList, 'harga'));
        $data['total_harga'] = $total_harga;
        $data['bayar'] = $jumlah_bayar;
        $data['kembalian'] = $jumlah_bayar - $total_harga;
        $data['pemesananList'] = $pemesananList;
        
        // Ambil id_user dari data pemesanan
        $data['id_user'] = $pemesananList[0]->id_user; // Asumsi id_user sama untuk semua pemesanan

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Nota');
        $pdf->SetSubject('Nota');
        $pdf->SetKeywords('Nota, PDF');
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Set margins
        $pdf->SetMargins(5, 5, 5); // Left, Top, Right
        $pdf->AddPage('L', array(200, 110));
$backgroundPath = ROOTPATH . 'public/images/family_tree.png';
        $pdf->SetAlpha(0.25);
        $pdf->Image(
            $backgroundPath,   // Path to the image
            40,                // X position
            35,                // Y position
            120,                // Image width
            100,                // Image height
            '',                // No specific image file type
            '',                // No specific URL
            '',                // No specific image alignment
            false,             // No interlaced option
            150,               // DPI
            '',                // No specific color profile
            false,             // No alpha channel
            false,             // No transparency
            0,                 // No rotation
            '',                // No specific image stretch
            false,             // No resizing option
            false,             // No image format
            false,             // No clip option
            false,             // No auto orientation
            false,             // No image alignment
            false              // No image transparency
        );
        $pdf->SetAlpha(1.0);

        // Set font
        $pdf->SetFont('helvetica', '', 8); // Set font size to 6px

    // Set some content to print
    $html = view('nota_print_view', $data); // Ganti 'your_pdf_view' dengan nama view Anda

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('nota.pdf', 'I');
    exit();
    } else {
        return redirect()->to('home/dashboard');
    }
}

public function view_nota2($kode_pemesanan, $jumlah_bayar)
{
    if (session()->get('id') > 0) {
        $model = new M_laundry();
        $where = array('id_setting' => '1');
        $data2['yogi'] = $model->getWhere1('setting', $where)->getRow();

        $kasirId = session()->get('id');
        $kodeArray = explode(', ', $kode_pemesanan);

        // Ambil semua data pemesanan berdasarkan kode
        $pemesananList = $model->get_by_kodes($kodeArray);

        if (!$pemesananList) {
            throw new \Exception("Data pemesanan tidak ditemukan.");
        }

        // Ambil nama kasir dari session
        $kasir = $model->findUser($kasirId);

        if (!$kasir) {
            throw new \Exception("Data kasir tidak ditemukan.");
        }
        $data['kasir'] = $kasir->username;

        // Hitung total harga dari semua pemesanan
        $total_harga = array_sum(array_column($pemesananList, 'harga'));
        $data['total_harga'] = $total_harga;
        $data['bayar'] = $jumlah_bayar;
        $data['kembalian'] = $jumlah_bayar - $total_harga;
        $data['pemesananList'] = $pemesananList;
        
        // Ambil id_user dari data pemesanan
        $data['id_user'] = $pemesananList[0]->id_user; // Asumsi id_user sama untuk semua pemesanan

        echo view('header', $data2);
        echo view('menu', $data2);
        echo view('nota_view2', $data);
    } else {
        return redirect()->to('home/dashboard');
    }
}
public function view_print_nota2($kode_pemesanan, $jumlah_bayar)
{
    if (session()->get('id') > 0) {
        require_once(ROOTPATH . 'Vendor/autoload.php');
        
        $pdf = new \TCPDF();
        $model = new M_laundry();
        $where = array('id_setting' => '1');
        $data2['yogi'] = $model->getWhere1('setting', $where)->getRow();

        $kasirId = session()->get('id');
        $kodeArray = explode(', ', $kode_pemesanan);

        // Ambil semua data pemesanan berdasarkan kode
        $pemesananList = $model->get_by_kodes($kodeArray);

        if (!$pemesananList) {
            throw new \Exception("Data pemesanan tidak ditemukan.");
        }

        // Ambil nama kasir dari session
        $kasir = $model->findUser($kasirId);

        if (!$kasir) {
            throw new \Exception("Data kasir tidak ditemukan.");
        }
        $data['kasir'] = $kasir->username;

        // Hitung total harga dari semua pemesanan
        $total_harga = array_sum(array_column($pemesananList, 'harga'));
        $data['total_harga'] = $total_harga;
        $data['bayar'] = $jumlah_bayar;
        $data['kembalian'] = $jumlah_bayar - $total_harga;
        $data['pemesananList'] = $pemesananList;
        
        // Ambil id_user dari data pemesanan
        $data['id_user'] = $pemesananList[0]->id_user; // Asumsi id_user sama untuk semua pemesanan

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Nota');
        $pdf->SetSubject('Nota');
        $pdf->SetKeywords('Nota, PDF');
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Set margins
        $pdf->SetMargins(5, 5, 5); // Left, Top, Right
        $pdf->AddPage('L', array(200, 110));
$backgroundPath = ROOTPATH . 'public/images/family_tree.png';
        $pdf->SetAlpha(0.25);
        $pdf->Image(
            $backgroundPath,   // Path to the image
            40,                // X position
            35,                // Y position
            120,                // Image width
            100,                // Image height
            '',                // No specific image file type
            '',                // No specific URL
            '',                // No specific image alignment
            false,             // No interlaced option
            150,               // DPI
            '',                // No specific color profile
            false,             // No alpha channel
            false,             // No transparency
            0,                 // No rotation
            '',                // No specific image stretch
            false,             // No resizing option
            false,             // No image format
            false,             // No clip option
            false,             // No auto orientation
            false,             // No image alignment
            false              // No image transparency
        );
        $pdf->SetAlpha(1.0);

        // Set font
        $pdf->SetFont('helvetica', '', 8); // Set font size to 6px

    // Set some content to print
    $html = view('nota_print_view', $data); // Ganti 'your_pdf_view' dengan nama view Anda

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('nota.pdf', 'I');
    exit();
    } else {
        return redirect()->to('home/dashboard');
    }
}
public function antar_pemesanan($id)
{
    if (session()->get('id') > 0) {
            $model = new M_laundry;
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
            $where = array('id_user' => $id);
            $where2 = array('kode_pemesanan' => $id);
            $isi = array(
                'status' => 'DiAntar'
            );

            $model->edit('pemesanan', $isi, $where2);
            return redirect()->to('home/pemesanan_karyawan');
   
    } else {
        return redirect()->to('home/login');
    }
}

	public function transaksi()
{
	if(session()->get('id')>0){
		if(session()->get('level') == 'Pelanggan'){
    $model = new M_laundry();

    // Ambil data setting dengan id 1
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Ambil id_user dari session
    $id_user = session()->get('id');

    // Gabungkan tabel dan ambil data transaksi
    $data2['nel'] = $model->joinFilterByUser(
        'transaksi', 
        'user', 
        'transaksi.id_user = user.id_user',
		$id_user
    );

    // Tampilkan view dengan data
    echo view('header', $data);
    echo view('menu', $data);
    echo view('transaksi', $data2);
    echo view('footer');
	} else {
		return redirect()->to('home/error');
	}
	} else {
	return redirect()->to('home/login');
	}
}
	
	public function laporan()
	{
        if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
			
            $model = new M_laundry();
			$where = array('id_setting' => '1');
			$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
            
			$data['dua']=$model->join('pemesanan', 'user', 'pemesanan.id_user=user.id_user');
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('laporan', $data);
            echo view('footer');
			} else {
				return redirect()->to('home/error');
			}
    } else {
        return redirect()->to('home/login');
    }
	}

	public function karyawan()
	{
		if(session()->get('id')>0){
			if(session()->get('level') == 'Admin'){
		$model = new M_laundry;
		$where3 = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
		$data['yoga'] = $model->tampil('user');
		echo view ('header', $data);
		echo view ('menu', $data);
		echo view('karyawan',$data);
		echo view('footer');
	} else {
		return redirect()->to('home/error');
	}
	} else {
		return redirect()->to('home/login');
	}
	}
	public function t_karyawan()
{
    if(session()->get('id')>0){
		if(session()->get('level') == 'Admin'){
	$model = new M_laundry;
	$where3 = array('id_setting' => '1');
	$data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
    $data['yoga'] = $model->getEnumValues('user', 'level');

    echo view('header', $data);
    echo view('menu', $data);
    echo view('t_karyawan', $data);
    echo view('footer');
} else {
	return redirect()->to('home/error');
}
} else {
	return redirect()->to('home/login');
}
}
public function aksi_t_karyawan()
	{
		
		$yoga = $this -> request ->getPost('namakaryawan');
		$cahya = $this -> request ->getPost('password');
		$oga = $this -> request ->getPost('email');
		$oga1 = $this -> request ->getPost('level');
		$oga2 = $this -> request ->getPost('alamat');
		$oga3 = $this -> request ->getPost('nohp');
		
		$darren=array(
			'username'=>$yoga,
			'password'=>md5($cahya),
			'email'=>$oga,
			'level'=>$oga1,
			'alamat'=>$oga2,
			'nohp'=>$oga3,



		);
		$model=new M_laundry;
		$model->tambah('user',$darren);
		return redirect()->to('home/karyawan');
		
	}

	public function detail_karyawan($id)
{
    if (session()->get('id') > 0) {
        if (session()->get('level') == 'Admin') {
            $model = new M_laundry;
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
            $where3 = array('id_user' => $id);
            $data['dua'] = $model->getWhere1('user', $where3)->getRow();
            $data['yoga2'] = $model->tampil('user'); // Data for levels, if needed
            $data['yoga'] = $model->getEnumValues('user', 'level');

            // Assuming you need to fetch levels from the database or define them

            echo view('header', $data);
            echo view('menu', $data);
            echo view('detail_karyawan', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/error');
        }
    } else {
        return redirect()->to('home/login');
    }
}


public function edit_karyawan($id)
{
    if (session()->get('id') > 0) {
        if (session()->get('level') == 'Admin') {
            $model = new M_laundry;
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
            $where = array('id_user' => $id);
            $data['satu'] = $model->getWhere1('user', $where)->getRow();
            $data['yoga2'] = $model->tampil('user'); // Pastikan ini adalah level atau data yang diperlukan

            echo view('header', $data);
            echo view('menu', $data);
            echo view('detail_karyawan', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/error');
        }
    } else {
        return redirect()->to('home/login');
    }
}

public function aksi_e_karyawan()
    {
        if(session()->get('id') > 0) {
            $model = new M_laundry();
            $yoga = $this->request->getPost('namakaryawan');
            $leo = $this->request->getPost('email');
            $yoga1 = $this->request->getPost('level');
            $yoga2 = $this->request->getPost('alamat');
            $yoga3 = $this->request->getPost('nohp');
            $id = $this->request->getPost('id'); // Pastikan nama parameter sesuai

            $where = array('id_user' => $id);

            $isi = array(
                'username' => $yoga,
                'email' => $leo,
                'level' => $yoga1,
                'alamat' => $yoga2,
                'nohp' => $yoga3,
                
            );

            $model->edit('user', $isi, $where);

            return redirect()->to('home/karyawan');
        } else {
            return redirect()->to('home/login');
        }
    }

	public function hapus_karyawan($id){
		$model = new M_Laundry();
		$where=array('id_user'=>$id);
		$model->hapus('user', $where);

		return redirect()->to('Home/karyawan');	
	}
	public function resetpassword($id)
	{
		$model = new M_Laundry();
		$model->resetPassword($id);
		return redirect()->to('home/karyawan');
	}
	public function setting()
	{
		if(session()->get('id')>0){
			if(session()->get('level') == 'Admin'){
		$model = new M_Laundry;
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
		echo view ('header', $data);
		echo view ('menu');
		echo view('setting',$data);
		echo view('footer');
	} else {
		return redirect()->to('home/error');
	}
	} else {
		return redirect()->to('home/login');
	}
}
	public function aksi_e_setting()
{
    $model = new M_Laundry();
    $namaWebsite = $this->request->getPost('namawebsite');
    $id = $this->request->getPost('id'); 
	$id_user = session()->get('id');
    $where = array('id_setting' => '1');

    $data = array(
        'nama_website' => $namaWebsite,
		'update_by' => $id_user,
    	'update_at' => date('Y-m-d H:i:s')
    );

    // Cek apakah ada file yang diupload untuk favicon
    $favicon = $this->request->getFile('img');
    if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {
        // Beri nama file unik
        $faviconNewName = $favicon->getRandomName();
        // Pindahkan file ke direktori public/images
        $favicon->move(WRITEPATH . '../public/images', $faviconNewName);

        // Tambahkan nama file ke dalam array data
        $data['tab_icon'] = $faviconNewName;
    }

    // Cek apakah ada file yang diupload untuk logo
    $logo = $this->request->getFile('logo');
    if ($logo && $logo->isValid() && !$logo->hasMoved()) {
        // Beri nama file unik
        $logoNewName = $logo->getRandomName();
        // Pindahkan file ke direktori public/images
        $logo->move(WRITEPATH . '../public/images', $logoNewName);

        // Tambahkan nama file ke dalam array data
        $data['logo_website'] = $logoNewName;
    }

	// Cek apakah ada file yang diupload untuk logo
    $login = $this->request->getFile('login');
    if ($login && $login->isValid() && !$login->hasMoved()) {
        // Beri nama file unik
        $loginNewName = $login->getRandomName();
        // Pindahkan file ke direktori public/images
        $login->move(WRITEPATH . '../public/images', $loginNewName);

        // Tambahkan nama file ke dalam array data
        $data['login_icon'] = $loginNewName;
    }

    $model->edit('setting', $data, $where);

    // Optionally set a flash message here
    return redirect()->to('home/setting');
}
public function transaksi_karyawan()
{
	if(session()->get('id')>0){
		if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
    $model = new M_laundry();

    // Ambil data setting dengan id 1
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Ambil id_user dari session
    $id_user = session()->get('id');

    // Gabungkan tabel dan ambil data transaksi
    $data2['nel'] = $model->join(
        'transaksi', 
        'user', 
        'transaksi.id_user = user.id_user'
    );

    // Tampilkan view dengan data
    echo view('header', $data);
    echo view('menu', $data);
    echo view('transaksi_admin', $data2);
    echo view('footer');
	} else {
		return redirect()->to('home/dashboard');
	}
	} else {
	return redirect()->to('home/login');
	}
}
public function print_nota($id)
{
    if (session()->get('id') > 0) {
        if (session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan' || session()->get('level') == 'Pelanggan') {
            require_once(ROOTPATH . 'Vendor/autoload.php');
        
            $pdf = new \TCPDF();
            $model = new M_laundry();

            // Ambil data setting dengan id 1
            $where = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

            // Ambil id_user dari session
            $id_user = session()->get('id');

            // Gabungkan tabel dan ambil data transaksi
            $where3 = ['transaksi.id_transaksi' => $id];
            $data2['transaksi'] = $model->dataTransaksi('transaksi', $id);

            // Debugging
            if (is_null($data2['transaksi'])) {
                echo "Transaksi data is null";
                // Output bisa digunakan untuk debugging
                var_dump($data2['transaksi']);
                exit();
            }

            $where2 = array('id_transaksi' => $id);
            $data2['dua'] = $model->getWhereWithJoin('transaksi', 'user',
                'transaksi.id_user = user.id_user', ['transaksi.id_transaksi' => $id]);

             // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Nota');
        $pdf->SetSubject('Nota');
        $pdf->SetKeywords('Nota, PDF');
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Set margins
        $pdf->SetMargins(5, 5, 5); // Left, Top, Right
        $pdf->AddPage('L', array(200, 110));
$backgroundPath = ROOTPATH . 'public/images/family_tree.png';
        $pdf->SetAlpha(0.25);
        $pdf->Image(
            $backgroundPath,   // Path to the image
            40,                // X position
            35,                // Y position
            120,                // Image width
            100,                // Image height
            '',                // No specific image file type
            '',                // No specific URL
            '',                // No specific image alignment
            false,             // No interlaced option
            150,               // DPI
            '',                // No specific color profile
            false,             // No alpha channel
            false,             // No transparency
            0,                 // No rotation
            '',                // No specific image stretch
            false,             // No resizing option
            false,             // No image format
            false,             // No clip option
            false,             // No auto orientation
            false,             // No image alignment
            false              // No image transparency
        );
        $pdf->SetAlpha(1.0);

        // Set font
        $pdf->SetFont('helvetica', '', 8); // Set font size to 6px

    // Set some content to print
    $html = view('print_nota', $data2); // Ganti 'your_pdf_view' dengan nama view Anda

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('nota.pdf', 'I');
    exit();
           
            
        } else {
            return redirect()->to('home/dashboard');
        }
    } else {
        return redirect()->to('home/login');
    }
}

public function hapus_nota($id){
	$model = new M_laundry();
	$where=array('id_transaksi'=>$id);
	$model->hapus('transaksi', $where);

	return redirect()->to('Home/transaksi_karyawan');	
}
	
public function print()
{
	if(session()->get('id')>0){
		if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
    $model = new M_laundry();

    // Ambil data setting dengan id 1
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Ambil id_user dari session
    $id_user = session()->get('id');

    // Gabungkan tabel dan ambil data transaksi
	$data2['nel'] = $model->dataPrint('transaksi');
    
    if (!$data2['nel']) {
        // Menangani jika data tidak ditemukan atau terjadi error
        echo "Data transaksi tidak ditemukan.";
        return;
    }
    
    // Tampilkan view dengan data
    echo view('header', $data);
    echo view('print', $data2);

} else {
	return redirect()->to('home/error');
}
} else {
return redirect()->to('home/login');
}
}

public function aksi_laporan_pdf(){
    $model = new M_Laundry();
    // $id_user = session()->get('id');
	$tanggal_awal = $this->request->getGet('awal');
    $tanggal_akhir = $this->request->getGet('akhir');

	$data['transaksi'] = $model->caritransaksi($tanggal_awal, $tanggal_akhir);

    // Load library Dompdf
    $dompdf = new \Dompdf\Dompdf();

    // Render view 'print' menjadi HTML
    $html = view('print', $data);

    // Load HTML ke Dompdf
    $dompdf->loadHtml($html);

    // Setting ukuran dan orientasi kertas
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (Halaman)
    $dompdf->render();

    // Output file PDF (Download atau Tampil di browser)
    $dompdf->stream("Laporan Laundry.pdf", array("Attachment" => false));
}

public function aksi_laporan_excel(){
    $model = new M_Laundry();
    $tanggal_awal = $this->request->getPost('awal2');
    $tanggal_akhir = $this->request->getPost('akhir2');

    $data['transaksi'] = $model->caritransaksi($tanggal_awal, $tanggal_akhir);

    // Membuat objek Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul laporan
    $sheet->setCellValue('A1', 'Laporan Laundry');

    // Merge cell untuk judul laporan
    $sheet->mergeCells('A1:J1');

    // Set style untuk judul laporan
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

    // Set style untuk cell judul laporan
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Set header untuk kolom
    $sheet->setCellValue('A2', 'No Transaksi');
    $sheet->setCellValue('B2', 'Nama Admin');
    $sheet->setCellValue('C2', 'Kode Pemesanan');
    $sheet->setCellValue('D2', 'Nama Pelanggan');
    $sheet->setCellValue('E2', 'Jenis Paket');
    $sheet->setCellValue('F2', 'Jenis Pelayanan');
    $sheet->setCellValue('G2', 'Berat');
    $sheet->setCellValue('H2', 'Total Harga');
    $sheet->setCellValue('I2', 'Tipe Pemesanan');
    $sheet->setCellValue('J2', 'Tanggal');

    // Mengatur lebar kolom
    $sheet->getColumnDimension('A')->setWidth(15);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(30);
    $sheet->getColumnDimension('D')->setWidth(15);
    $sheet->getColumnDimension('E')->setWidth(15);
    $sheet->getColumnDimension('F')->setWidth(15);
    $sheet->getColumnDimension('G')->setWidth(10);
    $sheet->getColumnDimension('H')->setWidth(20);
    $sheet->getColumnDimension('I')->setWidth(25);
    $sheet->getColumnDimension('J')->setWidth(25);

    // Membuat judul tebal
    $sheet->getStyle('A2:J2')->getFont()->setBold(true);

    // Mengisi data ke dalam sheet
    $rowIndex = 3; // Mulai dari baris 3 setelah judul dan header
    foreach ($data['transaksi'] as $row) {
        $sheet->setCellValue('A' . $rowIndex, $row->no_transaksi);
        $sheet->setCellValue('B' . $rowIndex, $row->transaksi_username);
        $sheet->setCellValue('C' . $rowIndex, $row->kode_pemesanan);
        $sheet->setCellValue('D' . $rowIndex, $row->pemesanan_username);
        $sheet->setCellValue('E' . $rowIndex, $row->jenis_pakaian);
        $sheet->setCellValue('F' . $rowIndex, $row->jenis_pelayanan);
        $sheet->setCellValue('G' . $rowIndex, $row->berat);
        $sheet->setCellValue('H' . $rowIndex, $row->total_harga);
        $sheet->setCellValue('I' . $rowIndex, $row->tipe);
        $sheet->setCellValue('J' . $rowIndex, $row->tanggal_nota); // Ubah dari berat ke tanggal_nota

        $rowIndex++;
    }

    // Menambahkan total harga
    $sheet->setCellValue('G' . $rowIndex, 'Total Semua Harga');
    $sheet->setCellValue('H' . $rowIndex, '=SUM(H3:H' . ($rowIndex-1) . ')');

    // Menambahkan format "Rp. harga,00" pada kolom harga
    $hargaStyle = [
        'numberFormat' => [
            'formatCode' => '"Rp." #,##0.00',
        ],
    ];
    $sheet->getStyle('H3:H' . ($rowIndex))->applyFromArray($hargaStyle);

    // Menambahkan border
    $lastColumn = $sheet->getHighestColumn();
    $lastRow = $sheet->getHighestRow();
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $sheet->getStyle('A2:' . $lastColumn . $lastRow)->applyFromArray($styleArray);

    // Setelah mengisi data, simpan spreadsheet ke dalam file atau kirim ke browser
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'laporan.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
}
public function windows_print()
{
	if(session()->get('id')>0){
		if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
    $model = new M_laundry();

    // Ambil data setting dengan id 1
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    $tanggal_awal = $this->request->getPost('awal3');
    $tanggal_akhir = $this->request->getPost('akhir3');

    $data2['transaksi'] = $model->caritransaksi($tanggal_awal, $tanggal_akhir);

    
    // Tampilkan view dengan data
    echo view('header', $data);
    echo view('windows_print', $data2);
} else {
	return redirect()->to('home/error');
}
} else {
return redirect()->to('home/login');
}
}

public function jenis_paket()
	{
        if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
			
            $model = new M_laundry();
			$where = array('id_setting' => '1');
			$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
            
			$data2['yoga']=$model->tampil('jpakaian');
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('jenis_pakaian', $data2);
            echo view('footer');
			} else {
				return redirect()->to('home/error');
			}
    } else {
        return redirect()->to('home/login');
    }
	}

	public function aksi_t_paket()
	{
		$nama_paket = $this->request->getPost('nama_paket_tambah');
		$id_user = session()->get('id');
	

		$darren=array(
			
			'jenis_pakaian'=>$nama_paket,
			'create_by' => $id_user,
       		 'create_at' => date('Y-m-d H:i:s')
			
		);

		$model=new M_laundry;
		$model->tambah('jpakaian',$darren);
		return redirect()->to('home/jenis_paket');
	}

	public function aksi_e_paket()
	{
		$id= $this->request->getPost('id_jpakaian');
		$b = $this -> request ->getPost('nama_paket');
		$id_user = session()->get('id');
		$where=array('id_jpakaian'=>$id);

		$darren=array(
			
			'jenis_pakaian'=>$b,
			'update_by' => $id_user,
       		 'update_at' => date('Y-m-d H:i:s')
			
			
		);

		$model=new M_laundry;
		$model->edit('jpakaian',$darren, $where);
		return redirect()->to('home/jenis_paket');
	}
	public function hapus_paket($id){
		$model = new M_laundry();
		$where=array('id_jpakaian'=>$id);
		$model->hapus('jpakaian', $where);

		return redirect()->to('Home/jenis_paket');	
	}

	public function jenis_pelayanan()
	{
        if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan'){
			
            $model = new M_laundry();
			$where = array('id_setting' => '1');
			$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
            
			$data2['yoga']=$model->tampil('jpelayanan');
    
            echo view('header', $data);
            echo view('menu', $data);
            echo view('jenis_pelayanan', $data2);
            echo view('footer');
			} else {
				return redirect()->to('home/error');
			}
    } else {
        return redirect()->to('home/login');
    }
	}

	public function aksi_t_pelayanan()
	{
		$nama_pelayanan = $this->request->getPost('nama_pelayanan_tambah');

		$id_user = session()->get('id');

		$darren=array(
			
			'jenis_pelayanan'=>$nama_pelayanan,
			'create_by' => $id_user,
       		 'create_at' => date('Y-m-d H:i:s')
			
			
		);

		$model=new M_laundry;
		$model->tambah('jpelayanan',$darren);
		return redirect()->to('home/jenis_pelayanan');
	}

	public function aksi_e_pelayanan()
	{
		$id= $this->request->getPost('id_jpelayanan');
		$b = $this -> request ->getPost('nama_pelayanan');
		$id_user = session()->get('id');
		$where=array('id_jpelayanan'=>$id);

		$darren=array(
			
			'jenis_pelayanan'=>$b,
			'update_by' => $id_user,
       		 'update_at' => date('Y-m-d H:i:s')
			
		);

		$model=new M_laundry;
		$model->edit('jpelayanan',$darren, $where);
		return redirect()->to('home/jenis_pelayanan');
	}
	public function hapus_pelayanan($id){
		$model = new M_laundry();
		$where=array('id_jpelayanan'=>$id);
		$model->hapus('jpelayanan', $where);

		return redirect()->to('Home/jenis_pelayanan');	
	}
	public function profile()
	{
		if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan' || session()->get('level') == 'Pelanggan'){
			
            $model = new M_laundry();
			$where3 = array('id_setting' => '1');
			$data['yogi'] = $model->getWhere1('setting', $where3)->getRow();

		$where=array('id_user'=>session()->get('id'));
		 $data['darren'] = $model->getwhere('user',$where);
		
		echo view ('header', $data);
		echo view ('menu', $data);
		echo view('profile',$data);
		echo view('footer');
			} else {
				return redirect()->to('home/error');
			}
		} else {
		return redirect()->to('home/login');
		}
}
	public function editfoto()
	{
		$model = new M_laundry();
		$userData = $model->getById(session()->get('id'));
	
		if ($this->request->getFile('foto')) {
	
			$file = $this->request->getFile('foto');
			$newFileName = $file->getRandomName(); 
			$file->move(ROOTPATH . 'public/img', $newFileName);
	
			if ($userData->foto && file_exists(ROOTPATH . 'public/img/' . $userData->foto)) {
		unlink(ROOTPATH . 'public/img/' . $userData->foto);
	}
			$userId = ['id_user' => session()->get('id')];
			$userData = ['foto' => $newFileName];
			$model->edit('user', $userData, $userId);
		}
		return redirect()->to('home/profile');
	}
	public function aksi_e_profile()
    {
        if(session()->get('id') > 0) {
            $model = new M_laundry();
            $yoga = $this->request->getPost('username');
			$yoga1 = $this->request->getPost('email');
			$yoga2 = $this->request->getPost('phone');
            $id = $this->request->getPost('id'); 

			$where = array('id_user' => $id); // Jika id_user adalah kunci utama untuk menentukan record


            $isi = array(
                'username' => $yoga,
				'email' => $yoga1,
				'nohp' => $yoga2,
            );

            $model->edit('user', $isi, $where);
            return redirect()->to('home/profile');
			// print_r($yoga);
			// print_r($id);
        } else {
            return redirect()->to('home/login');
        }
    }
	public function changepassword()
	{
		if(session()->get('id')>0){
			if(session()->get('level') == 'Admin' || session()->get('level') == 'Karyawan' || session()->get('level') == 'Pelanggan'){
			
            $model = new M_laundry();
			$where3 = array('id_setting' => '1');
			$data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
		$where=array('id_user'=>session()->get('id'));
		 $data['darren'] = $model->getwhere('user',$where);
		
		echo view ('header', $data);
		echo view ('menu', $data);
		echo view('changepassword',$data);
		echo view('footer');
	} else {
		return redirect()->to('home/error');
	}
} else {
return redirect()->to('home/login');
}
	}
public function aksi_changepass() {
    $model = new M_laundry();
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
    $userId = session()->get('id');

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($userId);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }

    // Update password baru
    $data = [
        'password' => md5($newPassword),
        'update_by' => $userId,
        'update_at' => date('Y-m-d H:i:s')
    ];
    $where = ['id_user' => $userId];
    
    $model->edit('user', $data, $where);
    
    // Set pesan sukses
    session()->setFlashdata('success', 'Password berhasil diperbarui.');
    return redirect()->to('home/changepassword');
}
}

