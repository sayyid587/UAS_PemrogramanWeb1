<?php

class Anggota extends Controller {
    
    public function __construct()
    {
        // Cek Login (sesuaikan dengan session login Anda)
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Daftar Anggota';
        
        // --- LOGIKA SEARCH & PAGINATION ---
        if(isset($_POST['cari'])) {
            $_SESSION['keyword'] = $_POST['keyword'];
        } else if (isset($_POST['reset'])) {
            unset($_SESSION['keyword']);
        }
        
        $data['keyword'] = isset($_SESSION['keyword']) ? $_SESSION['keyword'] : '';

        $jumlahDataPerHalaman = 2;
        // Panggil User_model -> countAnggota
        $jumlahData = $this->model('User_model')->countAnggota($data['keyword']);
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        $halamanAktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        
        if($halamanAktif < 1) { $halamanAktif = 1; }
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

        // Panggil User_model -> getAnggotaPaginated
        $data['anggota'] = $this->model('User_model')->getAnggotaPaginated($awalData, $jumlahDataPerHalaman, $data['keyword']);
        
        $data['halaman_aktif'] = $halamanAktif;
        $data['jumlah_halaman'] = $jumlahHalaman;
        
        $this->view('templates/header', $data);
        $this->view('anggota/index', $data);
        $this->view('templates/footer');
    }

    // --- LOGIKA TAMBAH ---
    public function tambah()
    {
        // Panggil User_model -> tambahDataAnggota
        if( $this->model('User_model')->tambahDataAnggota($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/anggota');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/anggota');
            exit;
        }
    }

    // --- LOGIKA HAPUS ---
    public function hapus($id)
    {
        // Panggil User_model -> hapusDataAnggota
        if( $this->model('User_model')->hapusDataAnggota($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/anggota');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/anggota');
            exit;
        }
    }

    // --- LOGIKA EDIT (HALAMAN) ---
    public function edit($id)
    {
        $data['title'] = 'Ubah Data Anggota';
        
        // PERBAIKAN DI SINI:
        // Gunakan 'User_model' dan method 'getUserById' (sesuai file model kamu)
        $data['anggota'] = $this->model('User_model')->getUserById($id);
        
        // Cek jika ID tidak ditemukan / user iseng ganti angka di URL
        if( !$data['anggota'] ) {
            header('Location: ' . BASEURL . '/anggota');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('anggota/edit', $data);
        $this->view('templates/footer');
    }

    // --- LOGIKA PROSES UBAH ---
    public function prosesUbah()
    {
        // Panggil User_model -> ubahDataAnggota
        if( $this->model('User_model')->ubahDataAnggota($_POST) >= 0 ) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/anggota');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/anggota');
            exit;
        }
    }

    // --- LOGIKA CARI (AJAX) ---
    public function cari()
    {
        $keyword = $_POST['keyword'];
        // Tampilkan 100 data saat search agar user lihat semua hasil
        $data['anggota'] = $this->model('User_model')->getAnggotaPaginated(0, 100, $keyword);
        $this->view('anggota/data', $data);
    }
}