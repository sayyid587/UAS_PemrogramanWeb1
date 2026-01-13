<?php

class Controller {
    // Fungsi untuk memanggil View (Tampilan)
    public function view($view, $data = [])
    {
        // Mengecek file view di folder app/views/
        require_once 'app/views/' . $view . '.php';
    }

    // Fungsi untuk memanggil Model (Database)
    public function model($model)
    {
        require_once 'app/models/' . $model . '.php';
        // Mengembalikan object model baru
        return new $model;
    }
}