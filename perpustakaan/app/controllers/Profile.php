<?php 

class Profil extends Controller {
    public function index()
    {
        $data['judul'] = 'Profil Saya';
        // Ambil data user berdasarkan Session ID yang sedang login
        $data['user'] = $this->model('User_model')->getUserById($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('profil/index', $data);
        $this->view('templates/footer');
    }
}