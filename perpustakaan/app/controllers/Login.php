<?php

class Login extends Controller {
    public function index()
    {
        $data['title'] = 'Login Page';
        $this->view('templates/header', $data);
        $this->view('login/index', $data);
        $this->view('templates/footer');
    }

    // INI ADALAH TARGET URL "public/login/prosesLogin"
    public function prosesLogin()
    {
        // 1. Cek apakah ada kiriman data POST
        if(isset($_POST['username']) && isset($_POST['password'])) {
            
            // 2. Ambil data dari form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // 3. Panggil Model User untuk cari data berdasarkan username
            // Pastikan kamu sudah buat file app/models/User_model.php ya!
            $dataUser = $this->model('User_model')->getUserByUsername($username);

            // 4. Cek apakah usernamenya ada di database?
            if($dataUser) {
                // 5. Cek apakah passwordnya cocok? (Verify Hash)
                if(password_verify($password, $dataUser['password'])) {
                    
                    // 6. Kalau cocok, buat SESSION
                    $_SESSION['user_id'] = $dataUser['id'];
                    $_SESSION['username'] = $dataUser['username'];
                    $_SESSION['role'] = $dataUser['role']; // admin atau anggota
                    $_SESSION['nama_lengkap'] = $dataUser['nama_lengkap'];

                    // 7. Pindahkan ke halaman Dashboard (Home)
                    header('Location: ' . BASEURL . '/home');
                    exit;
                    
                } else {
                    // Password Salah
                    echo "<script>alert('Password Salah!'); window.location.href='" . BASEURL . "/login';</script>";
                }
            } else {
                // Username Tidak Ditemukan
                echo "<script>alert('Username tidak terdaftar!'); window.location.href='" . BASEURL . "/login';</script>";
            }
        }
    }

    public function logout()
    {
        // Hapus session
        session_destroy();
        // Kembalikan ke login
        header('Location: ' . BASEURL . '/login');
        exit;
    }
}