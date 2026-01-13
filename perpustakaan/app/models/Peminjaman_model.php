<?php

class Peminjaman_model {
    private $table = 'peminjaman';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPeminjaman()
    {
        // PERBAIKAN: Menggunakan user_id dan buku_id sesuai database
        $query = "SELECT peminjaman.*, 
                         users.nama_lengkap as nama_peminjam, 
                         buku.judul as judul_buku 
                  FROM " . $this->table . "
                  LEFT JOIN users ON peminjaman.user_id = users.id
                  LEFT JOIN buku ON peminjaman.buku_id = buku.id
                  ORDER BY peminjaman.id DESC";
        
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tambahPeminjaman($data)
    {
        // A. Insert Data ke Tabel Peminjaman
        $query = "INSERT INTO " . $this->table . " 
                  (user_id, buku_id, tgl_pinjam, tgl_kembali_rencana, status, denda)
                  VALUES (:user_id, :buku_id, :tgl_pinjam, :tgl_rencana, 'dipinjam', 0)";
        
        $this->db->query($query);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('buku_id', $data['buku_id']);
        $this->db->bind('tgl_pinjam', date('Y-m-d')); // Tanggal hari ini
        
        // Default pinjam 7 hari
        $tgl_rencana = date('Y-m-d', strtotime('+7 days'));
        $this->db->bind('tgl_rencana', $tgl_rencana);
        
        $this->db->execute();

        // B. Jika Insert Berhasil, KURANGI STOK BUKU
        if ($this->db->rowCount() > 0) {
            $queryBuku = "UPDATE buku SET stok = stok - 1 WHERE id = :buku_id";
            $this->db->query($queryBuku);
            $this->db->bind('buku_id', $data['buku_id']);
            $this->db->execute();
            return 1; // Sukses
        }

        return 0; // Gagal
    }

    // Nama fungsi disesuaikan dengan Controller kamu: prosesKembali
    public function prosesKembali($id)
    {
        // 1. Ambil Data Peminjaman
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        $pinjam = $this->db->single();

        // Cek apakah data ketemu?
        if(!$pinjam) { 
            die("Error: Data Peminjaman dengan ID $id tidak ditemukan di database."); 
        }

        // 2. Hitung Denda
        $tgl_rencana = $pinjam['tgl_kembali_rencana'];
        $tgl_sekarang = date('Y-m-d');
        
        $denda = 0;
        if($tgl_sekarang > $tgl_rencana) {
            $selisih = strtotime($tgl_sekarang) - strtotime($tgl_rencana);
            $hari_telat = floor($selisih / (60 * 60 * 24));
            $denda = $hari_telat * 1000;
        }

        // 3. Eksekusi Update (DEBUG MODE ON)
        try {
            $query = "UPDATE " . $this->table . " 
                      SET status = 'dikembalikan', 
                          denda = :denda,
                          tgl_kembali_real = :tgl_real 
                      WHERE id = :id";
                      
            $this->db->query($query);
            $this->db->bind('denda', $denda);
            $this->db->bind('tgl_real', $tgl_sekarang);
            $this->db->bind('id', $id);
            $this->db->execute();

            // 4. Update Stok Buku
            $queryStok = "UPDATE buku SET stok = stok + 1 WHERE id = :buku_id";
            $this->db->query($queryStok);
            $this->db->bind('buku_id', $pinjam['buku_id']);
            $this->db->execute();

            return 1; // Paksa return 1 jika kode sampai sini (sukses)

        } catch (PDOException $e) {
            // --- INI AKAN MENAMPILKAN ERROR DI LAYAR ---
            die("SQL Error: " . $e->getMessage());
        }
    }

    // FUNGSI 1: Ambil Data dengan Limit, Search, dan Filter User
    public function getPeminjamanPaginated($start, $limit, $keyword = null, $userId = null)
    {
        // Query Dasar
        $query = "SELECT peminjaman.*, 
                         users.nama_lengkap as nama_peminjam, 
                         buku.judul as judul_buku 
                  FROM " . $this->table . "
                  LEFT JOIN users ON peminjaman.user_id = users.id
                  LEFT JOIN buku ON peminjaman.buku_id = buku.id";

        // Tambahan Logika WHERE
        $conditions = [];
        
        // Jika User Biasa (Bukan Admin), filter ID-nya
        if ($userId != null) {
            $conditions[] = "peminjaman.user_id = $userId";
        }

        // Jika ada pencarian (Keyword)
        if ($keyword != null) {
            // Cari di Nama Peminjam ATAU Judul Buku
            $conditions[] = "(users.nama_lengkap LIKE :keyword OR buku.judul LIKE :keyword)";
        }

        // Gabungkan WHERE jika ada kondisi
        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $query .= " ORDER BY peminjaman.id DESC LIMIT :start, :limit";

        $this->db->query($query);
        
        // Binding Parameter
        if ($keyword != null) {
            $this->db->bind('keyword', "%$keyword%");
        }
        
        $this->db->bind('start', $start);
        $this->db->bind('limit', $limit);

        return $this->db->resultSet();
    }

    // FUNGSI 2: Hitung Total Data (Untuk Navigasi Pagination)
    public function countPeminjaman($keyword = null, $userId = null)
    {
        $query = "SELECT COUNT(*) as total 
                  FROM " . $this->table . "
                  LEFT JOIN users ON peminjaman.user_id = users.id
                  LEFT JOIN buku ON peminjaman.buku_id = buku.id";

        $conditions = [];

        if ($userId != null) {
            $conditions[] = "peminjaman.user_id = $userId";
        }

        if ($keyword != null) {
            $conditions[] = "(users.nama_lengkap LIKE :keyword OR buku.judul LIKE :keyword)";
        }

        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $this->db->query($query);

        if ($keyword != null) {
            $this->db->bind('keyword', "%$keyword%");
        }

        $result = $this->db->single();
        return $result['total'];
    }
}