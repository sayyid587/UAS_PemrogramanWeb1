<?php 

class Buku_model {
    private $table = 'buku';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // 1. Ambil Semua Buku (Standar)
    public function getAllBuku()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    // 2. Ambil Buku dengan Limit & Search (PENTING UNTUK SEARCH & PAGINATION)
    public function getBukuLimit($start, $limit, $keyword = null)
    {
        if( $keyword ) {
            // Query Pencarian
            // Perhatikan spasi setelah nama tabel dan sebelum WHERE
            $query = "SELECT * FROM " . $this->table . " 
                      WHERE judul LIKE :keyword 
                      OR pengarang LIKE :keyword 
                      OR penerbit LIKE :keyword
                      LIMIT :start, :limit";
            
            $this->db->query($query);
            $this->db->bind('keyword', "%$keyword%");
            $this->db->bind('start', $start);
            $this->db->bind('limit', $limit);

        } else {
            // Query Standar
            $query = "SELECT * FROM " . $this->table . " LIMIT :start, :limit";
            
            $this->db->query($query);
            $this->db->bind('start', $start);
            $this->db->bind('limit', $limit);
        }

        return $this->db->resultSet();
    }

    // 3. Hitung Jumlah Data (Untuk Pagination)
    public function countBuku($keyword = null)
    {
        if( $keyword ) {
            $query = "SELECT COUNT(*) as total FROM " . $this->table . " 
                      WHERE judul LIKE :keyword 
                      OR pengarang LIKE :keyword 
                      OR penerbit LIKE :keyword";
            
            $this->db->query($query);
            $this->db->bind('keyword', "%$keyword%");
        } else {
            $query = "SELECT COUNT(*) as total FROM " . $this->table;
            $this->db->query($query);
        }

        $result = $this->db->single();
        return $result['total'];
    }

    // 4. Ambil Buku by ID
    public function getBukuById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // 5. Tambah Data Buku
    public function tambahDataBuku($data)
    {
        $query = "INSERT INTO buku 
                    (judul, pengarang, penerbit, tahun_terbit, stok, gambar)
                  VALUES 
                    (:judul, :pengarang, :penerbit, :tahun, :stok, :gambar)";
        
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('pengarang', $data['pengarang']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('stok', $data['stok']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // 6. Hapus Data Buku
    public function hapusDataBuku($id)
    {
        // Cek dulu apakah buku sedang dipinjam (Relational Check)
        // Jika tabel peminjaman Anda bernama 'peminjaman' dan kolom foreign key 'id_buku'
        $this->db->query("SELECT COUNT(*) as jumlah FROM peminjaman WHERE id = :id AND status = 'dipinjam'");
        $this->db->bind('id', $id);
        $cek = $this->db->single();

        if($cek['jumlah'] > 0) {
            return -1; // Kode error: Buku sedang dipinjam
        }

        $query = "DELETE FROM buku WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // 7. Ubah Data Buku
    public function ubahDataBuku($data)
    {
        $query = "UPDATE buku SET
                    judul = :judul,
                    pengarang = :pengarang,
                    penerbit = :penerbit,
                    tahun_terbit = :tahun,
                    gambar = :gambar,
                    stok = :stok
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('pengarang', $data['pengarang']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('tahun', $data['tahun']); // Pastikan name di form edit adalah 'tahun'
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}