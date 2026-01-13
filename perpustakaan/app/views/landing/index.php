<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* 1. NAVBAR */
        .navbar {
            padding: 1.2rem 0;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.5);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-box {
            width: 45px;
            height: 45px;
            background: #4f46e5;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
            font-size: 1.3rem;
        }

        /* 2. HERO SECTION */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 100px; 
            padding-bottom: 50px;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.6;
        }
        .blob-1 { width: 500px; height: 500px; background: #818cf8; top: -10%; right: -10%; }
        .blob-2 { width: 400px; height: 400px; background: #38bdf8; bottom: -10%; left: -10%; }

        .hero-img-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            padding: 15px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            transform: rotate(-3deg);
            transition: transform 0.5s ease;
            margin-top: 2rem;
        }
        .hero-img-card:hover {
            transform: rotate(0deg) scale(1.02);
        }

        /* Tombol CTA */
        .btn-cta {
            background: #4f46e5;
            color: white;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
            border: none;
            transition: all 0.3s;
        }
        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4);
            background: #4338ca;
            color: white;
        }

        .btn-outline-cta {
            border: 2px solid #4f46e5;
            color: #4f46e5;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            background: transparent;
            transition: all 0.3s;
        }
        .btn-outline-cta:hover {
            background: #4f46e5;
            color: white;
        }

        .display-title {
            font-size: 3.5rem;
            line-height: 1.15;
            letter-spacing: -1px;
        }
        
        @media (max-width: 991px) {
            .display-title { font-size: 2.5rem; }
            .hero-section { padding-top: 120px; text-align: center; }
            .btn-group-responsive { justify-content: center; }
            .stats-container { justify-content: center; }
        }
    </style>
</head>
<body>

    <nav class="navbar fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <span class="logo-box">
                    <i class="bi bi-book-half"></i>
                </span>
                <span style="color: #312e81; font-weight: 800;">E-Perpus</span>
            </a>
            
            <div>
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <a href="<?= BASEURL; ?>/home" class="btn btn-cta btn-sm px-4">Dashboard</a>
                <?php else : ?>
                    <a href="<?= BASEURL; ?>/login" class="btn btn-outline-cta btn-sm px-4 me-2">Masuk</a>
                    
                    <a href="#" class="btn btn-cta btn-sm px-4 btn-daftar">
                        Daftar
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>

        <div class="container position-relative z-1">
            <div class="row align-items-center">
                
                <div class="col-lg-6 mb-5 mb-lg-0">
                    
                    <div class="d-inline-block mb-4"> <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm fw-bold border border-primary border-opacity-25 d-flex align-items-center gap-2">
                            <i class="bi bi-rocket-takeoff-fill"></i> Perpustakaan Masa Depan
                        </span>
                    </div>

                    <h1 class="display-title fw-bolder mb-4" style="color: #1e1b4b;">
                        Jelajahi Dunia <br> Lewat <span class="text-primary position-relative">
                            Membaca.
                            <svg class="position-absolute start-0 bottom-0 w-100" height="10" viewBox="0 0 100 10" preserveAspectRatio="none" style="z-index: -1; opacity: 0.3; fill: #4f46e5;">
                                <path d="M0 5 Q 50 10 100 5" stroke="none" />
                            </svg>
                        </span>
                    </h1>

                    <p class="lead text-secondary mb-5 pe-lg-5" style="font-weight: 400;">
                        Akses ribuan koleksi buku digital dan fisik dengan mudah. Kelola peminjaman, baca di mana saja, dan tambah wawasanmu hari ini.
                    </p>
                    
                    <div class="d-flex gap-3 mb-5 btn-group-responsive">
                        <a href="<?= BASEURL; ?>/login" class="btn btn-cta shadow-lg">Mulai Sekarang <i class="bi bi-arrow-right ms-2"></i></a>
                        
                        <a href="#fitur" class="btn btn-white text-dark shadow-sm rounded-pill px-4 py-2 d-flex align-items-center fw-bold border bg-white btn-pelajari">
                            <i class="bi bi-play-circle-fill text-primary fs-4 me-2"></i> Pelajari
                        </a>
                    </div>

                    <div class="d-flex align-items-center gap-4 pt-3 border-top stats-container">
                        <div>
                            <h3 class="fw-bold mb-0 text-dark">5k+</h3>
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Koleksi Buku</small>
                        </div>
                        <div class="vr opacity-25"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark">1.2k+</h3>
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Anggota Aktif</small>
                        </div>
                        <div class="vr opacity-25"></div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark">24/7</h3>
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Akses Digital</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <div class="hero-img-card position-relative">
                        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=2070&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm w-100" alt="Library" style="object-fit: cover; height: 500px;">
                        
                        <div class="position-absolute bottom-0 start-0 bg-white p-3 rounded-4 shadow-lg m-4 d-flex align-items-center animate-up border" style="max-width: 220px; transform: rotate(3deg);">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-check-lg fs-3"></i>
                            </div>
                            <div class="text-start">
                                <p class="mb-0 small text-muted fw-bold text-uppercase" style="font-size: 0.65rem;">Status System</p>
                                <p class="mb-0 fw-bold text-dark">Peminjaman Mudah</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            
            // 1. Logic untuk tombol Daftar
            $('.btn-daftar').on('click', function(e) {
                e.preventDefault();
                console.log("Tombol daftar diklik!"); // Debugging di Console

                Swal.fire({
                    title: 'Pendaftaran Ditutup',
                    html: "Mohon maaf, pendaftaran mandiri ditutup.<br>Silakan hubungi <b>Admin Perpustakaan</b> jika ingin mendaftar.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hubungi Admin',
                    cancelButtonText: 'Tutup'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Aksi jika user klik Hubungi Admin (misal alert sukses dulu)
                        Swal.fire('Info', 'Silakan menuju meja petugas di perpustakaan.', 'success');
                    }
                });
            });

            // 2. Logic untuk tombol Pelajari
            $('.btn-pelajari').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'success',
                    title: 'Selamat Datang!',
                    text: 'Silakan Login untuk mulai meminjam buku.',
                    confirmButtonColor: '#4f46e5'
                });
            });

        });
    </script>
</body>
</html>