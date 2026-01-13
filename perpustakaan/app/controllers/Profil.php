<?php

class Profil extends Controller {
    public function index()
    {
        $data['title'] = 'Profil Saya';
        
        // Ambil ID user dari Session Login
        $id_user = $_SESSION['user_id'];
        
        // AMBIL DATA TERBARU DARI MODEL USER
        // Pastikan User_model punya method getUserById($id)
        $data['user'] = $this->model('User_model')->getUserById($id_user);

        $this->view('templates/header', $data);
        $this->view('profil/index', $data); // Pastikan folder view-nya 'profil'
        $this->view('templates/footer');
    }
}