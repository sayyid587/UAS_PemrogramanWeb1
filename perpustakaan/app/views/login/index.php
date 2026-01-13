<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Perpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body class="login-body">

    <div class="shape-blob shape-1"></div>
    <div class="shape-blob shape-2"></div>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-card shadow-lg overflow-hidden">
            <div class="row g-0 h-100">
                
                <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center text-white p-5 login-sidebar">
                    <div class="bg-overlay"></div>
                    <div class="position-relative text-center z-1 animate-up">
                        <div class="mb-4">
                            <i class="bi bi-book-half display-1 text-white opacity-75"></i>
                        </div>
                        <h2 class="fw-bold display-6 mb-3">E-Perpus Digital</h2>
                        <p class="lead opacity-75">"Membaca adalah jendela dunia. Masuk untuk mulai menjelajah ribuan koleksi buku kami."</p>
                    </div>
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center p-5 bg-white position-relative">
                    
                    <div class="login-form-content animate-fade">
                        <div class="text-center mb-5">
                            <h3 class="fw-bold text-dark">Selamat Datang! 👋</h3>
                            <p class="text-muted">Silakan login akun Anda untuk melanjutkan.</p>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <?php Flasher::flash(); ?>
                            </div>
                        </div>

                        <form action="<?= BASEURL; ?>/login/prosesLogin" method="post">
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3 border-0 bg-light" id="username" name="username" placeholder="Username" required>
                                <label for="username" class="text-muted"><i class="bi bi-person me-2"></i>Username</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control rounded-3 border-0 bg-light" id="password" name="password" placeholder="Password" required>
                                <label for="password" class="text-muted"><i class="bi bi-lock me-2"></i>Password</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label text-muted small" for="remember">Ingat Saya</label>
                                </div>
                                <a href="#" class="text-decoration-none small text-primary fw-bold" onclick="infoLupaPass()">Lupa Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm btn-gradient hover-scale">
                                MASUK SEKARANG <i class="bi bi-arrow-right ms-2"></i>
                            </button>

                        </form>

                        <div class="text-center mt-4">
                            <small class="text-muted">Belum punya akun? <a href="#" class="text-primary fw-bold text-decoration-none" onclick="infoDaftar()">Hubungi Admin</a></small>
                        </div>

<script>
    // Fungsi Alert Lupa Password
    function infoLupaPass() {
        Swal.fire({
            title: 'Lupa Password?',
            text: 'Silakan datang ke Perpustakaan dan temui Petugas Admin untuk mereset password Anda.',
            icon: 'info', // Ikon tanda seru biru
            confirmButtonText: 'Oke, Mengerti',
            confirmButtonColor: '#3085d6' // Warna tombol biru
        });
    }

    // Fungsi Alert Daftar Baru
    function infoDaftar() {
        Swal.fire({
            title: 'Pendaftaran Anggota',
            // Bisa pakai HTML biar teksnya bisa di-bold
            html: `
                Silakan hubungi Admin via WhatsApp:<br>
                <b style="font-size: 1.2rem;">0812-9999-8888</b><br><br>
                Atau datang langsung ke Perpustakaan membawa KTM.
            `,
            icon: 'success', // Ikon centang hijau (biar beda)
            confirmButtonText: 'Siap!',
            confirmButtonColor: '#198754' // Warna tombol hijau
        });
    }
</script>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>