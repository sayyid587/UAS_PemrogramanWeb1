<style>
    /* STYLE SETUP */
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    .glass-search {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: var(--glass-border);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        border-radius: 50px;
        padding: 5px;
        max-width: 600px;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }
    .glass-search:focus-within { transform: scale(1.02); background: #fff; }

    .table-container { 
        background: white; border-radius: 20px; 
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); 
        overflow: hidden; border: 1px solid #f3f4f6; 
    }
    .modern-table th { background: #f8fafc; padding: 1.2rem; font-size: 0.75rem; text-transform: uppercase; color: #64748b; font-weight: 700; }
    .modern-table td { padding: 1.2rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; }
</style>

<div class="container" style="margin-top: 5rem;">

    <?php if( isset($_SESSION['flash']) ) : ?>
        <div class="flash-data" 
             data-flashdata="<?= $_SESSION['flash']['pesan']; ?>" 
             data-flashaksi="<?= $_SESSION['flash']['aksi']; ?>"
             data-flashtype="<?= $_SESSION['flash']['tipe']; ?>"
             data-flashjudul="Data Anggota">
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="text-center mb-5 animate-up">
        <h1 class="display-5 fw-bold mb-2" style="color: #312e81; text-shadow: 0 2px 10px rgba(255,255,255,0.5);">
            Kelola Anggota
        </h1>
        <p class="mb-4 fs-5" style="color: #4338ca; font-weight: 500;">
            Manajemen data pengguna dan hak akses sistem.
        </p>

        <div class="glass-search d-flex align-items-center">
            <span class="ps-4 pe-2 text-primary"><i class="bi bi-search fs-5"></i></span>
            <input type="text" class="form-control border-0 bg-transparent fs-6" 
                   id="keyword" 
                   placeholder="Cari nama, username, atau nim..." autocomplete="off">
            <div id="loading-spinner" class="spinner-border text-primary spinner-border-sm mx-3 d-none" role="status"></div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4 px-2">
        <button type="button" class="btn btn-light text-primary border fw-bold shadow-sm rounded-pill px-4 py-2 tombolTambahData" data-bs-toggle="modal" data-bs-target="#formModal">
            <i class="bi bi-person-plus-fill me-2"></i>Tambah Anggota
        </button>
    </div>

    <div id="container-anggota">
        <?php require_once 'data.php'; ?>
    </div>

    <div id="container-pagination">
        <?php if($data['jumlah_halaman'] > 1) : ?>
        <div class="d-flex justify-content-center my-5">
            <nav>
                <ul class="pagination shadow rounded-pill overflow-hidden border-0">
                    <li class="page-item <?= ($data['halaman_aktif'] <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 px-3 py-2 text-dark" href="<?= BASEURL; ?>/anggota?page=<?= $data['halaman_aktif'] - 1; ?>"><i class="bi bi-chevron-left"></i></a>
                    </li>
                    <?php for($i = 1; $i <= $data['jumlah_halaman']; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link border-0 px-3 py-2 fw-bold <?= ($i == $data['halaman_aktif']) ? 'text-white' : 'text-muted'; ?>" 
                               style="<?= ($i == $data['halaman_aktif']) ? 'background: var(--primary-gradient);' : 'background: white;'; ?>"
                               href="<?= BASEURL; ?>/anggota?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($data['halaman_aktif'] >= $data['jumlah_halaman']) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 px-3 py-2 text-dark" href="<?= BASEURL; ?>/anggota?page=<?= $data['halaman_aktif'] + 1; ?>"><i class="bi bi-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </div>

</div>

<div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"> 
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      
      <div class="modal-header text-white p-4" style="background: var(--primary-gradient);">
        <h5 class="modal-title fw-bold"><i class="bi bi-person-plus me-2"></i>Tambah Anggota Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body p-4">
        
        <form action="<?= BASEURL; ?>/anggota/tambah" method="post">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 bg-light border-0" id="nama" name="nama" placeholder="Nama Lengkap" required>
                        <label for="nama">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control rounded-3 bg-light border-0" id="nim" name="nim" placeholder="NIM">
                        <label for="nim">NIM / NIP</label>
                    </div>

                    <div class="form-floating mb-3">
                         <select class="form-select rounded-3 bg-light border-0" id="jurusan" name="jurusan">
                            <option value="">Pilih Jurusan...</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Industri">Teknik Industri</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Pangan">Teknik Pangan</option>
                            <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                            <option value="Desain Komunikasi Visual">DKV</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <label for="jurusan">Jurusan</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3 bg-light border-0" id="email" name="email" placeholder="Email">
                        <label for="email">Email (Opsional)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 bg-light border-0" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3 bg-light border-0" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                </div>
            </div>

      </div>
      
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn text-white rounded-pill px-4 fw-bold" style="background: var(--primary-gradient);">Simpan</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        
        // 1. SEARCH LOGIC
        $('#keyword').on('keyup', function() {
            const keyword = $(this).val();
            
            if(keyword == '') {
                window.location.href = '<?= BASEURL; ?>/anggota';
                return;
            }

            $('#loading-spinner').removeClass('d-none');
            $('#container-pagination').hide();

            $.ajax({
                url: '<?= BASEURL; ?>/anggota/cari',
                method: 'post',
                data: { keyword: keyword },
                success: function(data) {
                    $('#container-anggota').html(data);
                    $('#loading-spinner').addClass('d-none');
                }
            });
        });

        // 2. RESET FORM MODAL SAAT DIBUKA
        $('.tombolTambahData').on('click', function() {
            // Kita kosongkan semua input agar bersih saat admin mau nambah data baru
            $('#nama').val('');
            $('#nrp').val('');
            $('#email').val('');
            $('#jurusan').val('');
            $('#username').val('');
            $('#password').val('');
        });

        // TIDAK ADA SCRIPT 'UBAH' DI SINI 
        // KARENA UBAH SUDAH PAKAI HALAMAN TERPISAH (edit.php)
    });
</script>