<?php 

class Landing extends Controller {
    public function index()
    {
        $data['judul'] = 'Selamat Datang di E-Perpus';
        
        $this->view('landing/index', $data);
    }
}