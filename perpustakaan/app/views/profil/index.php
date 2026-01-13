<style>
    .profile-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid #f1f5f9;
    }
    .profile-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        height: 180px;
        position: relative;
    }
    .profile-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: white;
        border-radius: 50% 50% 0 0 / 100% 100% 0 0; /* Efek melengkung */
        transform: scaleX(1.5);
    }
    .profile-avatar {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 6px solid white;
        margin-top: -90px;
        object-fit: cover;
        background: #fff;
        position: relative;
        z-index: 10;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    .info-value {
        font-weight: 500;
        color: #1e293b;
        background: #f8fafc;
        padding: 10px 15px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="container" style="margin-top: 5rem; margin-bottom: 5rem;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="profile-card animate-up">
                <div class="profile-header d-flex align-items-center justify-content-center">
                    <h2 class="text-white fw-bold" style="opacity: 0.2; margin-bottom: 30px;">PROFIL SAYA</h2>
                </div>
                
                <div class="text-center px-4">
                    <img src="https://ui-avatars.com/api/?name=<?= $data['user']['nama_lengkap']; ?>&size=256&background=random" alt="Profile" class="profile-avatar">
                    
                    <h3 class="mt-3 fw-bold mb-1 text-dark"><?= $data['user']['nama_lengkap']; ?></h3>
                    
                    <div class="mb-4">
                        <?php if($data['user']['role'] == 'admin') : ?>
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3">
                                <i class="bi bi-shield-lock-fill me-1"></i> Administrator
                            </span>
                        <?php else : ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill px-3">
                                <i class="bi bi-person-badge-fill me-1"></i> Anggota Perpustakaan
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body p-5 pt-2">
                    <hr class="mb-5 text-muted opacity-25">

                    <div class="row g-4">
                        
                        <div class="col-12 mb-2">
                            <h6 class="fw-bold text-primary"><i class="bi bi-person-lines-fill me-2"></i>Informasi Akun</h6>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Username</div>
                            <div class="info-value">@<?= $data['user']['username']; ?></div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Password</div>
                            <div class="info-value text-muted">•••••••• (Terenkripsi)</div>
                        </div>

                        <div class="col-12 mb-2 mt-4">
                            <h6 class="fw-bold text-primary"><i class="bi bi-card-heading me-2"></i>Data Pribadi</h6>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Nomor Induk (NIM/NIP)</div>
                            <div class="info-value"><?= $data['user']['nim'] ?? '-'; ?></div> 
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?= $data['user']['email'] ?? '-'; ?></div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Jurusan / Divisi</div>
                            <div class="info-value"><?= $data['user']['jurusan'] ?? '-'; ?></div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Status Keanggotaan</div>
                            <div class="info-value text-success"><i class="bi bi-check-circle-fill me-1"></i> Aktif</div>
                        </div>

                    </div>

                    <div class="mt-5 pt-3 text-center">
                        <a href="<?= BASEURL; ?>/login/logout" class="btn btn-outline-danger btn-lg rounded-pill px-5 fw-bold w-100 shadow-sm">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar dari Aplikasi
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>