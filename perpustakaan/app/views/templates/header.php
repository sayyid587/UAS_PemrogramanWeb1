<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>

<?php if(isset($_SESSION['user_id'])) : ?>
    <div class="navbar-container fixed-top p-3">
        <nav class="navbar navbar-expand-lg glass-nav rounded-4 shadow-sm">
            <div class="container-fluid px-4">
                
                <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="<?= BASEURL; ?>/home">
                    <div class="logo-icon me-2">
                        <i class="bi bi-book-half text-white"></i>
                    </div>
                    <span class="text-gradient">E-Perpus</span>
                </a>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 custom-nav-pills">
                        <li class="nav-item">
                            <a class="nav-link px-3 <?= strpos($_GET['url'] ?? '', 'home') !== false ? 'active' : ''; ?>" href="<?= BASEURL; ?>/home">
                                <i class="bi bi-grid me-1"></i> Dashboard
                            </a>
                        </li>
                        
                        <?php if($_SESSION['role'] == 'admin') : ?>
                            <li class="nav-item">
                                <a class="nav-link px-3 <?= strpos($_GET['url'] ?? '', 'buku') !== false ? 'active' : ''; ?>" href="<?= BASEURL; ?>/buku">
                                    <i class="bi bi-collection me-1"></i> Buku
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 <?= strpos($_GET['url'] ?? '', 'anggota') !== false ? 'active' : ''; ?>" href="<?= BASEURL; ?>/anggota">
                                    <i class="bi bi-people me-1"></i> Anggota
                                </a>
                            </li>
                        <?php else: ?>
                             <li class="nav-item">
                                <a class="nav-link px-3 <?= strpos($_GET['url'] ?? '', 'buku') !== false ? 'active' : ''; ?>" href="<?= BASEURL; ?>/buku">
                                    <i class="bi bi-search me-1"></i> Cari Buku
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link px-3 <?= strpos($_GET['url'] ?? '', 'peminjaman') !== false ? 'active' : ''; ?>" href="<?= BASEURL; ?>/peminjaman">
                                <i class="bi bi-arrow-left-right me-1"></i> Transaksi
                            </a>
                        </li>
                    </ul>
                    
                    <div class="d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle hide-arrow user-pill p-1 pe-3 rounded-pill" 
                               href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['nama_lengkap']); ?>&background=2563eb&color=fff&size=128" 
                                     class="rounded-circle" width="38" height="38" alt="Avatar">
                                <div class="ms-2 d-none d-sm-block text-start" style="line-height: 1.2;">
                                    <span class="d-block fw-bold text-dark small"><?= explode(' ', $_SESSION['nama_lengkap'])[0]; ?></span>
                                    <span class="d-block text-muted" style="font-size: 10px;"><?= ucfirst($_SESSION['role']); ?></span>
                                </div>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2 p-2 animate-slide-in">
                                <li><a class="dropdown-item rounded-3" href="<?= BASEURL; ?>/profil"><i class="bi bi-person me-2"></i> Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= BASEURL; ?>/login/logout" id="tombol-logout">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>

                                    <script>
                                        document.getElementById('tombol-logout').addEventListener('click', function(e) {
                                            e.preventDefault(); // Mencegah logout langsung

                                            const href = this.getAttribute('href'); // Ambil link logout

                                            Swal.fire({
                                                title: 'Yakin ingin keluar?',
                                                text: "Sesi Anda akan diakhiri!",
                                                icon: 'warning', // Ikon segitiga kuning
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33', // Merah
                                                cancelButtonColor: '#3085d6', // Biru
                                                confirmButtonText: 'Ya, Logout!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // Jika user klik Ya, baru arahkan ke link logout
                                                    document.location.href = href;
                                                }
                                            });
                                        });
                                    </script>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div style="height: 150px;"></div>
<?php endif; ?>

<div class="main-content container pb-5">