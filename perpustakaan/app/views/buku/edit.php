<style>
    /* Menyamakan Style dengan halaman lain */
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
    }
    .custom-card-header {
        background: var(--primary-gradient);
    }
    .btn-gradient {
        background: var(--primary-gradient);
        color: white;
        border: none;
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #4338ca 0%, #312e81 100%);
        color: white;
    }
    .img-preview-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    .img-preview-container:hover {
        transform: scale(1.02);
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate-up">
                
                <div class="card-header p-4 text-white custom-card-header">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Ubah Data Buku</h4>
                    <p class="mb-0 opacity-75 small">Perbarui informasi detail dan sampul buku.</p>
                </div>

                <div class="card-body p-5">
                    <form action="<?= BASEURL; ?>/buku/prosesUbah" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?= $data['buku']['id']; ?>">
                        <input type="hidden" name="gambarLama" value="<?= $data['buku']['gambar']; ?>">

                        <div class="row g-5">
                            
                            <div class="col-md-4 text-center">
                                <label class="form-label fw-bold text-secondary text-start w-100 mb-3">Sampul Buku</label>
                                
                                <div class="position-relative">
                                    <div class="card img-preview-container mx-auto" style="width: 100%; max-width: 220px;">
                                        <img src="<?= BASEURL; ?>/img/<?= $data['buku']['gambar']; ?>" 
                                             alt="Cover Buku" 
                                             class="img-fluid object-fit-cover" 
                                             id="img-preview" 
                                             style="height: 320px; width: 100%;">
                                    </div>

                                    <div class="mt-4">
                                        <label for="gambar" class="btn btn-outline-primary rounded-pill px-4 w-100 fw-bold cursor-pointer shadow-sm">
                                            <i class="bi bi-camera me-2"></i>Ganti Sampul
                                        </label>
                                        <input type="file" class="d-none" id="gambar" name="gambar" onchange="previewImage()">
                                        <div class="form-text small mt-2 text-muted">Format: JPG/PNG. Max 2MB.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold text-secondary mb-3">Informasi Detail</label>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-3 bg-light border-0" id="judul" name="judul" value="<?= $data['buku']['judul']; ?>" placeholder="Judul" required>
                                    <label for="judul" class="text-muted">Judul Buku Lengkap</label>
                                </div>

                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-3 bg-light border-0" id="pengarang" name="pengarang" value="<?= $data['buku']['pengarang']; ?>" placeholder="Pengarang">
                                            <label for="pengarang" class="text-muted">Nama Pengarang</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-3 bg-light border-0" id="penerbit" name="penerbit" value="<?= $data['buku']['penerbit']; ?>" placeholder="Penerbit">
                                            <label for="penerbit" class="text-muted">Nama Penerbit</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control rounded-3 bg-light border-0" id="tahun" name="tahun" value="<?= $data['buku']['tahun_terbit']; ?>" placeholder="Tahun">
                                            <label for="tahun" class="text-muted">Tahun Terbit</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control rounded-3 bg-light border-0" id="stok" name="stok" value="<?= $data['buku']['stok']; ?>" placeholder="Stok" required>
                                            <label for="stok" class="text-muted">Jumlah Stok</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 pt-4 border-top">
                                    <a href="<?= BASEURL; ?>/buku" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-muted border">Batal</a>
                                    <button type="submit" class="btn btn-gradient rounded-pill px-5 py-2 fw-bold shadow-sm">
                                        Simpan Perubahan
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const gambar = document.querySelector('#gambar');
        const imgPreview = document.querySelector('#img-preview');

        // Validasi sederhana (opsional)
        if(gambar.files && gambar.files[0]){
            const oFReader = new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    }
</script>