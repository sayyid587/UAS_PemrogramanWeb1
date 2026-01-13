<?php

class Peminjaman extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Data Transaksi';
        
        // 1. KONFIGURASI PAGINATION & SEARCH
        $jumlahDataPerHalaman = 5; // Mau tampil berapa baris per halaman?
        $jumlahData = 0;
        
        // Cek halaman aktif (dari URL ?page=2)
        $halamanAktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

        // Cek Keyword Pencarian
        $keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : '';

        // 2. LOGIKA ROLE (ADMIN vs ANGGOTA)
        $userId = null;
        if($_SESSION['role'] != 'admin') {
            // Jika bukan admin, kunci filter hanya untuk user yang login
            $userId = $_SESSION['user_id'];
        }

        // 3. PANGGIL MODEL (Versi Baru dengan Filter, Search & Limit)
        $peminjamanModel = $this->model('Peminjaman_model');
        
        // Ambil Data Sesuai Halaman, Keyword, dan User ID
        $data['peminjaman'] = $peminjamanModel->getPeminjamanPaginated($awalData, $jumlahDataPerHalaman, $keyword, $userId);
        
        // Hitung Total Data (Untuk menentukan jumlah halaman)
        $totalData = $peminjamanModel->countPeminjaman($keyword, $userId);
        $data['jumlah_halaman'] = ceil($totalData / $jumlahDataPerHalaman);
        $data['halaman_aktif'] = $halamanAktif;
        $data['keyword'] = $keyword; // Kirim balik keyword agar tidak hilang saat ganti halaman

        $this->view('templates/header', $data);
        $this->view('peminjaman/index', $data);
        $this->view('templates/footer');
    }
    
    public function pinjam($buku_id)
    {
        // 1. Cek apakah user sudah login
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        // 2. SIAPKAN DATA DALAM BENTUK ARRAY (Ini perbaikan utamanya)
        // Kita bungkus user_id dan buku_id jadi satu paket array
        $data_pinjam = [
            'user_id' => $_SESSION['user_id'],
            'buku_id' => $buku_id
        ];

        // 3. Kirim Array tersebut ke Model
        if( $this->model('Peminjaman_model')->tambahPeminjaman($data_pinjam) > 0 ) {
            // SUKSES
            Flasher::setFlash('berhasil', 'dipinjam', 'success');
            header('Location: ' . BASEURL . '/peminjaman');
            exit;
        } else {
            // GAGAL
            Flasher::setFlash('gagal', 'dipinjam', 'danger');
            header('Location: ' . BASEURL . '/buku'); // Kembalikan ke buku jika gagal
            exit;
        }
    }

   public function kembali($id)
    {
        // Panggil fungsi prosesKembali di Model
        // Jika hasilnya > 0 (artinya ada baris yang berubah/sukses)
       if( $this->model('Peminjaman_model')->prosesKembali($id) > 0 ) {
            // SUKSES
            Flasher::setFlash('berhasil', 'dikembalikan', 'success');
            header('Location: ' . BASEURL . '/peminjaman');
            exit;
        } else {
            // GAGAL
            Flasher::setFlash('gagal', 'dikembalikan', 'danger');
            header('Location: ' . BASEURL . '/peminjaman');
            exit;
        }
    }

    // Tambahkan method ini di dalam class Peminjaman
    public function cari()
    {
        $keyword = $_POST['keyword'];
        // Kita butuh userId jika yang login bukan admin, untuk memfilter search
        $userId = ($_SESSION['role'] != 'admin') ? $_SESSION['user_id'] : null;
        
        $data['peminjaman'] = $this->model('Peminjaman_model')->getPeminjamanPaginated(0, 100, $keyword, $userId);
        $this->view('peminjaman/data', $data);
    }
}