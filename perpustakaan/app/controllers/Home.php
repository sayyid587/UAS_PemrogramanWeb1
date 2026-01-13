<?php

class Home extends Controller {
    public function __construct()
    {
        // PENTING: Cek apakah user sudah login?
        // Jika belum, paksa pindah ke halaman login
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard Perpustakaan';
        
        // Memanggil file View yang sudah kita perbagus
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}