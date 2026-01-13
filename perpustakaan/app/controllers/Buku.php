<?php

class Buku extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Daftar Buku';
        
        // Search Logic
        if(isset($_POST['cari'])) {
            $_SESSION['keyword'] = $_POST['keyword'];
        } else if (isset($_POST['reset'])) {
            unset($_SESSION['keyword']);
        }
        
        $data['keyword'] = isset($_SESSION['keyword']) ? $_SESSION['keyword'] : '';

        // Pagination Logic
        $jumlahDataPerHalaman = 4;
        $jumlahData = $this->model('Buku_model')->countBuku($data['keyword']);
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        $halamanAktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        
        // Mencegah halaman aktif kurang dari 1
        if($halamanAktif < 1) { $halamanAktif = 1; }

        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

        $data['buku'] = $this->model('Buku_model')->getBukuLimit($awalData, $jumlahDataPerHalaman, $data['keyword']);
        $data['halaman_aktif'] = $halamanAktif;
        $data['jumlah_halaman'] = $jumlahHalaman;
        
        $this->view('templates/header', $data);
        $this->view('buku/index', $data);
        $this->view('templates/footer');
    }

    // --- LOGIKA UPLOAD ---
    public function upload()
    {
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        if( $error === 4 ) {
            return 'default.jpg'; 
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        
        if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
            // Kita pakai Flasher kalau gagal upload
            Flasher::setFlash('gagal', 'diupload (bukan gambar)', 'danger');
            return false;
        }

        if( $ukuranFile > 2000000 ) {
            Flasher::setFlash('gagal', 'diupload (ukuran terlalu besar)', 'danger');
            return false;
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;
    }

    public function tambah()
    {
        // 1. Cek apakah user login sebagai admin
        if($_SESSION['role'] != 'admin') { 
            header('Location: ' . BASEURL . '/buku'); 
            exit; 
        }

        // 2. Jalankan Upload Gambar
        $gambar = $this->upload();
        
        // JIKA UPLOAD GAGAL: Redirect kembali
        if( !$gambar ) { 
            header('Location: ' . BASEURL . '/buku');
            exit; 
        }

        // 3. Masukkan nama gambar ke array $_POST
        $_POST['gambar'] = $gambar;

        // 4. Masukkan ke Database
        if( $this->model('Buku_model')->tambahDataBuku($_POST) > 0 ) {
            // SUKSES
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            // GAGAL
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    } // <--- KURUNG TUTUP INI YANG TADI HILANG

    public function hapus($id)
    {
        if($_SESSION['role'] != 'admin') { header('Location: ' . BASEURL . '/buku'); exit; }
        
        // Ambil data buku dulu (untuk hapus gambar fisik)
        $buku = $this->model('Buku_model')->getBukuById($id);
        $hasil = $this->model('Buku_model')->hapusDataBuku($id);

        if( $hasil > 0 ) {
            // 1. Hapus file gambar jika bukan default
            if($buku['gambar'] != 'default.jpg' && file_exists('img/' . $buku['gambar'])) {
                unlink('img/' . $buku['gambar']);
            }
            // 2. Pakai Flasher agar SweetAlert Muncul
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;

        } elseif ( $hasil == -1 ) {
            // Gagal karena relasi database (sedang dipinjam)
            Flasher::setFlash('gagal', 'dihapus (Buku sedang dipinjam)', 'error');
            header('Location: ' . BASEURL . '/buku');
            exit;
            
        } else {
            // Gagal umum
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }

    public function edit($id)
    {
        if($_SESSION['role'] != 'admin') { header('Location: ' . BASEURL . '/buku'); exit; }

        $data['title'] = 'Ubah Data Buku';
        $data['buku'] = $this->model('Buku_model')->getBukuById($id);
        
        $this->view('templates/header', $data);
        $this->view('buku/edit', $data);
        $this->view('templates/footer');
    }

    public function prosesUbah()
    {
        $gambarLama = $_POST['gambarLama'];
        
        // Cek apakah user pilih gambar baru
        if( $_FILES['gambar']['error'] === 4 ) {
            $gambar = $gambarLama;
        } else {
            $gambar = $this->upload();
            
            // Jika upload gagal (format salah dll), stop proses
            if (!$gambar) {
                header('Location: ' . BASEURL . '/buku');
                exit;
            }

            // Hapus gambar lama jika upload sukses
            if($gambarLama != 'default.jpg' && file_exists('img/' . $gambarLama)) {
                 unlink('img/' . $gambarLama);
            }
        }

        $_POST['gambar'] = $gambar;

        if( $this->model('Buku_model')->ubahDataBuku($_POST) >= 0 ) {
            // Pakai Flasher
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }

   public function cari()
    {
        $keyword = $_POST['keyword'];
        
        // Ambil data buku
        $data['buku'] = $this->model('Buku_model')->getBukuLimit(0, 100, $keyword);
        
        // [PERBAIKAN] Tambahkan baris ini!
        // Kita perlu mengirim 'halaman_aktif' agar view data.php tidak error undefined index
        $data['halaman_aktif'] = 1; 

        $this->view('buku/data', $data);
    }
}