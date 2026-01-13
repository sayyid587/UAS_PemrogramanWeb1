<style>
    /* KONFIGURASI STYLE DASHBOARD (SAMA DENGAN MENU BUKU) */
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); /* Indigo Deep */
        --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
        --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* 1. HERO SECTION */
    .dashboard-hero {
        background: var(--primary-gradient);
        border-radius: 24px;
        padding: 3.5rem 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.3);
        margin-bottom: 3rem;
    }

    /* Dekorasi Lingkaran Abstrak di Background Hero */
    .hero-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }
    .shape-1 { width: 300px; height: 300px; top: -100px; right: -50px; }
    .shape-2 { width: 150px; height: 150px; bottom: -30px; left: 10%; }

    /* Badge Tanggal Glassmorphism */
    .glass-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    /* 2. MENU CARDS (Premium Look) */
    .menu-card {
        background: white;
        border: 1px solid #f3f4f6;
        border-radius: 20px;
        padding: 2rem;
        height: 100%;
        text-decoration: none;
        display: block;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--hover-shadow);
        border-color: rgba(79, 70, 229, 0.2);
    }

    /* Icon Container yang Glowing */
    .icon-wrapper {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        transition: transform 0.4s ease;
    }

    .menu-card:hover .icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }

    /* Varian Warna Gradient Icon */
    .gradient-purple { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3); }
    .gradient-blue { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3); }
    .gradient-orange { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: white; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3); }
    .gradient-teal { background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); color: white; box-shadow: 0 10px 20px rgba(20, 184, 166, 0.3); }

    .card-title-pro {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937; /* Dark Gray */
        margin-bottom: 0.5rem;
    }

    .card-desc-pro {
        color: #6b7280; /* Medium Gray */
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Tombol Panah Kecil */
    .action-arrow {
        position: absolute;
        bottom: 2rem;
        right: 2rem;
        opacity: 0;
        transform: translateX(-20px);
        transition: all 0.3s ease;
        color: #4f46e5;
    }

    .menu-card:hover .action-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    /* 3. INFO SECTION */
    .info-box {
        background: #f8fafc;
        border-radius: 20px;
        border: 2px dashed #e2e8f0;
    }
</style>

<div class="container mt-4 mb-5">

    <div class="dashboard-hero d-flex flex-column flex-md-row align-items-md-center justify-content-between animate-fade">
        <div class="hero-shape shape-1"></div>
        <div class="hero-shape shape-2"></div>

        <div class="position-relative z-1">
            <h1 class="fw-bold display-6 mb-2">Selamat Datang, <?= explode(' ', $_SESSION['nama_lengkap'])[0]; ?>! 👋</h1>
            
            <p class="mb-0 opacity-90 fs-5 fw-light">
                <?php if($_SESSION['role'] == 'admin') : ?>
                    Apa yang ingin Anda kelola hari ini? 🛠️
                <?php else : ?>
                    Buku apa yang ingin Anda baca hari ini? 📚
                <?php endif; ?>
            </p>
        </div>
        
        <div class="mt-4 mt-md-0 position-relative z-1">
            <div class="glass-badge">
                <i class="bi bi-calendar-event me-2"></i>
                <?= date('d F Y'); ?>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-4">
            <a href="<?= BASEURL; ?>/buku" class="menu-card">
                <div class="icon-wrapper gradient-purple">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <h5 class="card-title-pro">Koleksi Pustaka</h5>
                <p class="card-desc-pro">Jelajahi katalog buku, tambah koleksi baru, dan update stok tersedia.</p>
                
                <i class="bi bi-arrow-right fs-4 action-arrow"></i>
            </a>
        </div>

        <div class="col-md-4">
            <a href="<?= BASEURL; ?>/peminjaman" class="menu-card">
                <div class="icon-wrapper gradient-blue">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <h5 class="card-title-pro">Sirkulasi & Transaksi</h5>
                <p class="card-desc-pro">Pantau aktivitas peminjaman, pengembalian, dan hitung denda otomatis.</p>

                <i class="bi bi-arrow-right fs-4 action-arrow"></i>
            </a>
        </div>

        <?php if($_SESSION['role'] == 'admin') : ?>
        <div class="col-md-4">
            <a href="<?= BASEURL; ?>/anggota" class="menu-card">
                <div class="icon-wrapper gradient-orange">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h5 class="card-title-pro">Data Anggota</h5>
                <p class="card-desc-pro">Manajemen akun pengguna, registrasi anggota baru, dan hak akses.</p>

                <i class="bi bi-arrow-right fs-4 action-arrow"></i>
            </a>
        </div>
        <?php else: ?>
        <div class="col-md-4">
            <div class="menu-card" style="cursor: default;">
                <div class="icon-wrapper gradient-teal">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5 class="card-title-pro">Status Akun</h5>
                <p class="card-desc-pro">Status keanggotaan Anda <strong>Aktif</strong>. Selamat membaca!</p>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="info-box p-4 d-flex align-items-center">
                <div class="me-4 text-primary opacity-50 d-none d-md-block">
                    <i class="bi bi-info-circle-fill display-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark text-uppercase small mb-2">💡 Informasi Perpustakaan</h6>
                    <p class="text-muted mb-0">
                        Pastikan untuk mengembalikan buku sebelum <strong>7 hari</strong> peminjaman. 
                        Sistem akan otomatis menghitung denda sebesar <span class="text-danger fw-bold">Rp 1.000/hari</span> jika terjadi keterlambatan.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>