<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: 1px solid rgba(255, 255, 255, 0.5);
        --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* SEARCH BAR GLASS */
    .glass-search {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: var(--glass-border);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        border-radius: 50px;
        padding: 5px;
        max-width: 700px;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }
    .glass-search:focus-within { transform: scale(1.02); background: #fff; }

    /* CARD DESIGN (USER) */
    .premium-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        height: 100%;
    }
    .premium-card:hover { transform: translateY(-10px); box-shadow: var(--hover-shadow); }

    /* IMAGE FIX */
    .card-img-wrapper {
        height: 280px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 20px;
        transition: transform 0.4s ease;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.15));
    }
    .premium-card:hover .card-img-top { transform: scale(1.08) translateY(-5px); }

    /* BADGE STOK */
    .floating-badge {
        position: absolute;
        top: 15px; right: 15px;
        background: rgba(255,255,255,0.95);
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* TOMBOL PINJAM */
    .btn-action { width: 100%; border-radius: 12px; font-weight: 600; padding: 10px 0; border: none; }
    .btn-pinjam { background: var(--primary-gradient); color: white; }
    .btn-pinjam:hover { opacity: 0.9; color: white; }

    /* TABLE DESIGN (ADMIN) */
    .table-container { background: white; border-radius: 20px; box-shadow: var(--card-shadow); overflow: hidden; }
    .modern-table th { background: #f9fafb; padding: 1.2rem; font-size: 0.75rem; text-transform: uppercase; color: #64748b; }
    .modern-table td { padding: 1.2rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
</style>

<div class="container" style="margin-top: 5rem;"> 
    
    <?php if( isset($_SESSION['flash']) ) : ?>
        <div class="flash-data" 
             data-flashdata="<?= $_SESSION['flash']['pesan']; ?>" 
             data-flashaksi="<?= $_SESSION['flash']['aksi']; ?>"
             data-flashtype="<?= $_SESSION['flash']['tipe']; ?>"
             data-flashjudul="Data Buku">
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <div class="text-center mb-5 animate-up">
        <h1 class="display-5 fw-bold mb-2" style="color: #312e81; text-shadow: 0 2px 10px rgba(255,255,255,0.5);">
            Perpustakaan Digital
        </h1>
        <p class="mb-4 fs-5" style="color: #4338ca; font-weight: 500;">
            Jelajahi ribuan literasi dalam satu genggaman.
        </p>

        <div class="glass-search d-flex align-items-center">
            <span class="ps-4 pe-2 text-primary"><i class="bi bi-search fs-5"></i></span>
            
            <input type="text" class="form-control border-0 bg-transparent fs-6" 
                   id="keyword" 
                   placeholder="Cari judul, penulis, atau topik..." 
                   autocomplete="off">
            
            <div id="loading-spinner" class="spinner-border text-primary spinner-border-sm mx-3 d-none" role="status"></div>
        </div>
    </div>

    <?php if($_SESSION['role'] == 'admin') : ?>
        <div class="d-flex justify-content-end mb-4 px-2">
            <button type="button" class="btn btn-light text-primary border fw-bold shadow-sm rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#formModal">
                <i class="bi bi-plus-lg me-2"></i>Tambah Koleksi
            </button>
        </div>
    <?php endif; ?>

    <div id="container-buku">
        <?php require_once 'data.php'; ?>
    </div>

    <div id="container-pagination">
        <?php if($data['jumlah_halaman'] > 1) : ?>
        <div class="d-flex justify-content-center my-5">
            <nav>
                <ul class="pagination shadow rounded-pill overflow-hidden border-0">
                    <li class="page-item <?= ($data['halaman_aktif'] <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 px-3 py-2 text-dark" href="<?= BASEURL; ?>/buku?page=<?= $data['halaman_aktif'] - 1; ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $data['jumlah_halaman']; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link border-0 px-3 py-2 fw-bold <?= ($i == $data['halaman_aktif']) ? 'text-white' : 'text-muted'; ?>" 
                               style="<?= ($i == $data['halaman_aktif']) ? 'background: var(--primary-gradient);' : 'background: white;'; ?>"
                               href="<?= BASEURL; ?>/buku?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($data['halaman_aktif'] >= $data['jumlah_halaman']) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 px-3 py-2 text-dark" href="<?= BASEURL; ?>/buku?page=<?= $data['halaman_aktif'] + 1; ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
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
        <h5 class="modal-title fw-bold"><i class="bi bi-journal-plus me-2"></i>Tambah Data Buku</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-5">
        <form action="<?= BASEURL; ?>/buku/tambah" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-3 bg-light border-0" id="judul" name="judul" placeholder="Judul" required>
                <label for="judul">Judul Buku Lengkap</label>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 bg-light border-0" id="pengarang" name="pengarang" placeholder="Pengarang">
                        <label for="pengarang">Pengarang</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 bg-light border-0" id="penerbit" name="penerbit" placeholder="Penerbit">
                        <label for="penerbit">Penerbit</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="number" class="form-control rounded-3 bg-light border-0" id="tahun" name="tahun" placeholder="Tahun">
                        <label for="tahun">Tahun</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="number" class="form-control rounded-3 bg-light border-0" id="stok" name="stok" placeholder="Stok" required>
                        <label for="stok">Stok</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 border border-dashed text-center">
                        <label for="gambar" class="small fw-bold text-primary cursor-pointer mb-0">
                             Upload Cover
                        </label>
                        <input type="file" class="form-control mt-2" id="gambar" name="gambar" style="font-size: 0.8rem;">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn text-white rounded-pill px-5 fw-bold" style="background: var(--primary-gradient);">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    $('#keyword').on('keyup', function() {
        const keyword = $(this).val();
        
        // [PERBAIKAN] Cek jika keyword kosong (dihapus habis)
        if(keyword == '') {
            // Kembalikan ke halaman awal (agar pagination muncul lagi & data ter-reset)
            window.location.href = '<?= BASEURL; ?>/buku';
            return;
        }

        // Jika ada ketikan, sembunyikan pagination
        $('#container-pagination').hide();
        $('#loading-spinner').removeClass('d-none');

        $.ajax({
            url: '<?= BASEURL; ?>/buku/cari', 
            data: { keyword: keyword },
            method: 'post',
            dataType: 'html', 
            success: function(data) {
                $('#container-buku').html(data);
                $('#loading-spinner').addClass('d-none');
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX: " + error);
            }
        });
    });

});
</script>