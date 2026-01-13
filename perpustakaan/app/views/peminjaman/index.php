<style>
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
             data-flashjudul="Data Peminjaman">
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="text-center mb-5 animate-up">
        <h1 class="display-5 fw-bold mb-2" style="color: #312e81; text-shadow: 0 2px 10px rgba(255,255,255,0.5);">
            Sirkulasi & Transaksi
        </h1>
        <p class="mb-4 fs-5" style="color: #4338ca; font-weight: 500;">
            Pantau aliran peminjaman buku secara realtime.
        </p>

        <div class="glass-search d-flex align-items-center">
            <span class="ps-4 pe-2 text-primary"><i class="bi bi-search fs-5"></i></span>
            <input type="text" class="form-control border-0 bg-transparent fs-6" 
                   id="keyword" 
                   placeholder="Cari peminjam atau judul buku..." autocomplete="off">
            <div id="loading-spinner" class="spinner-border text-primary spinner-border-sm mx-3 d-none" role="status"></div>
        </div>
    </div>

    <div id="container-peminjaman">
        <?php require_once 'data.php'; ?>
    </div>

    <div id="container-pagination">
        <?php if($data['jumlah_halaman'] > 1) : ?>
        <div class="d-flex justify-content-center my-5">
            <nav>
                <ul class="pagination shadow rounded-pill overflow-hidden border-0">
                    <li class="page-item <?= ($data['halaman_aktif'] <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 px-3 py-2 text-dark" href="<?= BASEURL; ?>/peminjaman?page=<?= $data['halaman_aktif'] - 1; ?>"><i class="bi bi-chevron-left"></i></a>
                    </li>
                    <?php for($i = 1; $i <= $data['jumlah_halaman']; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link border-0 px-3 py-2 fw-bold <?= ($i == $data['halaman_aktif']) ? 'text-white' : 'text-muted'; ?>" 
                               style="<?= ($i == $data['halaman_aktif']) ? 'background: var(--primary-gradient);' : 'background: white;'; ?>"
                               href="<?= BASEURL; ?>/peminjaman?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($data['halaman_aktif'] >= $data['jumlah_halaman']) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 px-3 py-2 text-dark" href="<?= BASEURL; ?>/peminjaman?page=<?= $data['halaman_aktif'] + 1; ?>"><i class="bi bi-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            const keyword = $(this).val();
            $('#loading-spinner').removeClass('d-none');
            
            if(keyword == '') {
                window.location.href = '<?= BASEURL; ?>/peminjaman';
                return;
            }

            $('#container-pagination').hide();

            $.ajax({
                url: '<?= BASEURL; ?>/peminjaman/cari',
                method: 'post',
                data: { keyword: keyword },
                success: function(data) {
                    $('#container-peminjaman').html(data);
                    $('#loading-spinner').addClass('d-none');
                }
            });
        });
    });
</script>