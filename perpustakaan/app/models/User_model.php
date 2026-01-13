<?php 

class User_model {
    private $table = 'users'; 
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // ... method login & get user by id biarkan ...
    public function getUserByUsername($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // 1. Tambah Data
    public function tambahDataAnggota($data)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (nama_lengkap, nim, email, jurusan, username, password, role)
                  VALUES (:nama, :nim, :email, :jurusan, :user, :pass, 'anggota')";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('user', $data['username']);
        
        $pass_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->bind('pass', $pass_hash);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // 2. UBAH DATA (Nama Fungsi Disesuaikan: prosesUbah)
    public function ubahDataAnggota($data)
    {
        // Cek apakah password diisi?
        if(empty($data['password'])) {
            // Update TANPA password
            $query = "UPDATE " . $this->table . " SET 
                        nama_lengkap = :nama, 
                        nim = :nim, 
                        email = :email,
                        jurusan = :jurusan,
                        username = :user 
                      WHERE id = :id";
            
            $this->db->query($query);
        } else {
            // Update DENGAN password
            $query = "UPDATE " . $this->table . " SET 
                        nama_lengkap = :nama, 
                        nim = :nim, 
                        email = :email,
                        jurusan = :jurusan,
                        username = :user, 
                        password = :pass 
                      WHERE id = :id";
            
            $this->db->query($query);
            $pass_hash = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->db->bind('pass', $pass_hash);
        }

        // BINDING DATA
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);         // Pastikan di View name="nim"
        $this->db->bind('email', $data['email']);     // Pastikan di View name="email"
        $this->db->bind('jurusan', $data['jurusan']); // Pastikan di View name="jurusan"
        $this->db->bind('user', $data['username']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // ... method search, count, hapus di bawah ini biarkan ...
    
    public function getAnggotaPaginated($start, $limit, $keyword = null)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE role != 'admin'";
        if ($keyword != null) {
            $query .= " AND (nama_lengkap LIKE :keyword OR username LIKE :keyword OR nim LIKE :keyword)";
        }
        $query .= " ORDER BY id DESC LIMIT :start, :limit";
        $this->db->query($query);
        if ($keyword != null) { $this->db->bind('keyword', "%$keyword%"); }
        $this->db->bind('start', $start);
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }

    public function countAnggota($keyword = null)
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE role != 'admin'";
        if ($keyword != null) {
            $query .= " AND (nama_lengkap LIKE :keyword OR username LIKE :keyword OR nim LIKE :keyword)";
        }
        $this->db->query($query);
        if ($keyword != null) { $this->db->bind('keyword', "%$keyword%"); }
        $result = $this->db->single();
        return $result['total'];
    }

    public function hapusDataAnggota($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}