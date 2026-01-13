<?php

class App {
    // Default Controller jika URL kosong
    protected $controller = 'Landing';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // 1. Cek Controller (URL Index ke-0)
        // File controller harus ada di folder app/controllers/
        if (isset($url[0])) {
            if (file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Cek Method (URL Index ke-1)
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Kelola Parameter (Sisa URL)
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Jalankan Controller & Method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Fungsi Pembantu: Memecah URL menjadi Array
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // Hapus slash di akhir
            $url = filter_var($url, FILTER_SANITIZE_URL); // Bersihkan URL dari karakter aneh
            $url = explode('/', $url); // Pecah berdasarkan slash
            return $url;
        }
    }
}