<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh; // Database Handler
    private $stmt; // Statement

    public function __construct()
    {
        // Data Source Name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // Optimasi koneksi
        $option = [
            PDO::ATTR_PERSISTENT => true, // Agar koneksi terjaga
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Mode error
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    // Fungsi untuk menulis query SQL
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Fungsi untuk binding data (Mencegah SQL Injection)
    // Contoh: WHERE id = :id
    public function bind($param, $value, $type = null)
    {
        if(is_null($type)) {
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Eksekusi query
    public function execute()
    {
        $this->stmt->execute();
    }

    // Mengambil banyak data (Select All)
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil satu data (Select Single)
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Menghitung jumlah baris yang berubah (untuk cek keberhasilan Insert/Update/Delete)
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}