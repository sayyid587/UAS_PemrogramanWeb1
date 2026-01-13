<div class="container mt-4 mb-5">
    
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="bg-primary bg-gradient p-5 text-center text-white" style="height: 200px;">
            <h2 class="fw-bold opacity-80">PERPUSTAKAAN DIGITAL</h2>
        </div>
        
        <div class="card-body p-0">
            <div class="row g-0">
                
                <div class="col-md-4 text-center border-end bg-light">
                    <div class="p-4 pb-5">
                        <div class="position-relative d-inline-block" style="margin-top: -100px;">
                            <img src="<?= BASEURL; ?>img/avatar.jpg" alt="Profile" 
                                 class="img-fluid rounded-circle shadow border border-5 border-white" 
                                 style="width: 160px; height: 160px; object-fit: cover; background: #fff;">
                        </div>
                        
                        <h3 class="fw-bold mt-3 mb-1"><?= $data['user']['nama_lengkap']; ?></h3>
                        <p class="text-muted mb-3">@<?= $data['user']['username']; ?></p>
                        
                        <span class="badge bg-success rounded-pill px-4 py-2 fs-6 shadow-sm">
                            <i class="bi bi-check-circle-fill me-1"></i> Anggota Aktif
                        </span>

                        <div class="mt-4 d-grid gap-2 px-4">
                            <a href="<?= BASEURL; ?>/login/logout" class="btn btn-outline-danger rounded-pill">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="p-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold text-primary"><i class="bi bi-person-lines-fill me-2"></i> Informasi Akun</h4>
                            <a href="<?= BASEURL; ?>/home" class="btn btn-sm btn-light shadow-sm text-secondary">
                                <i class="bi bi-x-lg"></i> Tutup
                            </a>
                        </div>

                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="p-3 border rounded-3 bg-white shadow-sm h-100">
                                    <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                    <div class="fw-bold text-dark fs-5"><?= $data['user']['nama_lengkap']; ?></div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="p-3 border rounded-3 bg-white shadow-sm h-100">
                                    <small class="text-muted d-block mb-1">Username</small>
                                    <div class="fw-bold text-dark fs-5"><?= $data['user']['username']; ?></div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="p-3 border rounded-3 bg-white shadow-sm h-100">
                                    <small class="text-muted d-block mb-1">Role Akun</small>
                                    <div class="fw-bold text-primary">
                                        <i class="bi bi-shield-lock me-1"></i> User / Mahasiswa
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="p-3 border rounded-3 bg-white shadow-sm h-100">
                                    <small class="text-muted d-block mb-1">Status Keanggotaan</small>
                                    <div class="fw-bold text-success">Verified Member</div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4 d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                            <div>
                                Jika ingin mengubah data diri, silakan hubungi <b>Admin Perpustakaan</b> di Front Office.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>