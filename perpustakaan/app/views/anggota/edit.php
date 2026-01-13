<style>
    /* Style sama seperti sebelumnya */
    :root { --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
    .edit-card { background: white; border-radius: 20px; box-shadow: var(--card-shadow); overflow: hidden; border: 1px solid #f3f4f6; max-width: 900px; margin: 0 auto; }
    .edit-header { background: var(--primary-gradient); color: white; padding: 2rem; position: relative; overflow: hidden; }
    .edit-header::after { content: ''; position: absolute; top: -50%; right: -10%; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; }
    .form-control, .form-select { background-color: #f8fafc; border: 1px solid #e2e8f0; }
    .form-control:focus, .form-select:focus { background-color: #fff; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); border-color: #4f46e5; }
</style>

<div class="container" style="margin-top: 5rem; margin-bottom: 5rem;">

    <div class="edit-card animate-up">
        <div class="edit-header">
            <h2 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Ubah Data Anggota</h2>
            <p class="mb-0 opacity-75 mt-1">Perbarui informasi akun anggota perpustakaan.</p>
        </div>

        <div class="p-5">
            <form action="<?= BASEURL; ?>/anggota/prosesUbah" method="post">
                
                <input type="hidden" name="id" value="<?= $data['anggota']['id']; ?>">

                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-3" id="nama" name="nama" 
                                   placeholder="Nama Lengkap" 
                                   value="<?= $data['anggota']['nama_lengkap']; ?>" required>
                            <label for="nama">Nama Lengkap</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control rounded-3" id="nim" name="nim" 
                                   placeholder="NIM"
                                   value="<?= $data['anggota']['nim'] ?? ''; ?>">
                            <label for="nim">NIM / NIP</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control rounded-3" id="email" name="email" 
                                   placeholder="Email" 
                                   value="<?= $data['anggota']['email'] ?? ''; ?>">
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select rounded-3" id="jurusan" name="jurusan">
                                <option value="">Pilih Jurusan...</option>
                                <?php 
                                    $jurusan = $data['anggota']['jurusan'] ?? ''; 
                                    $options = ['Teknik Informatika', 'Teknik Industri', 'Teknik Mesin', 'Teknik Pangan', 'Teknik Lingkungan', 'Desain Komunikasi Visual', 'Lainnya'];
                                    
                                    foreach($options as $opt) : 
                                        $selected = ($jurusan == $opt) ? 'selected' : '';
                                ?>
                                    <option value="<?= $opt; ?>" <?= $selected; ?>><?= $opt; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="jurusan">Jurusan</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-3" id="username" name="username" 
                                   placeholder="Username" 
                                   value="<?= $data['anggota']['username']; ?>" required>
                            <label for="username">Username</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-4 rounded-3 border border-dashed bg-light">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-shield-lock text-primary fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Ganti Password</h6>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                                </div>
                            </div>
                            
                            <div class="form-floating">
                                <input type="password" class="form-control rounded-3 bg-white" id="password" name="password" placeholder="Password Baru">
                                <label for="password">Password Baru (Opsional)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                    <a href="<?= BASEURL; ?>/anggota" class="btn btn-light border text-secondary fw-bold px-4 py-2 rounded-pill">
                        Batal
                    </a>
                    <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-pill" style="background: var(--primary-gradient);">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>