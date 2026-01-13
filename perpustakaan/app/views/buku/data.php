<?php if($_SESSION['role'] == 'admin') : ?>
    
    <div class="table-container animate-fade">
        <div class="table-responsive">
            <table class="table modern-table mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Detail Penulis</th>
                        <th class="text-center">Ketersediaan</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['buku'])) : ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted">Data buku tidak ditemukan.</td></tr>
                    <?php else : ?>
                        <?php 
                        $no = isset($_POST['keyword']) ? 1 : (1 + (4 * ($data['halaman_aktif'] - 1))); 
                        ?>
                        <?php foreach( $data['buku'] as $buku ) : ?>
                        <tr>
                            <td class="fw-bold text-secondary"><?= $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= BASEURL; ?>/img/<?= $buku['gambar']; ?>" class="img-avatar me-3" style="width: 45px; height: 60px; object-fit: cover; border-radius: 6px;">
                                    <div>
                                        <div class="fw-bold text-dark"><?= $buku['judul']; ?></div>
                                        <div class="small text-muted"><?= $buku['penerbit']; ?> (<?= $buku['tahun_terbit']; ?>)</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-3">
                                    <i class="bi bi-pen me-1"></i><?= $buku['pengarang']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if($buku['stok'] > 5) : ?>
                                    <div class="d-inline-flex align-items-center text-success fw-bold small">
                                        <span class="spinner-grow spinner-grow-sm me-2" role="status" aria-hidden="true"></span>
                                        Stok: <?= $buku['stok']; ?>
                                    </div>
                                <?php elseif($buku['stok'] > 0) : ?>
                                    <div class="d-inline-flex align-items-center text-warning fw-bold small">
                                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                                        Sisa: <?= $buku['stok']; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="d-inline-flex align-items-center text-danger fw-bold small">
                                        <i class="bi bi-x-circle-fill me-2"></i> Habis
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm rounded-pill" role="group">
                                    <a href="<?= BASEURL; ?>/buku/edit/<?= $buku['id']; ?>" class="btn btn-sm btn-white border text-warning"><i class="bi bi-pencil-square"></i></a>
                                  <a href="<?= BASEURL; ?>/buku/hapus/<?= $buku['id']; ?>" class="btn btn-sm tombol-hapus btn-white border text-danger"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php else : ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5 animate-fade">
        <?php if(empty($data['buku'])) : ?>
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-journal-x fs-1 opacity-50 mb-3 d-block"></i>
                <h4 class="fw-light">Maaf, buku tidak ditemukan.</h4>
            </div>
        <?php else : ?>
            <?php foreach( $data['buku'] as $buku ) : ?>
            <div class="col">
                <div class="premium-card h-100 d-flex flex-column">
                    
                    <div class="floating-badge text-<?= $buku['stok'] > 0 ? 'success' : 'danger'; ?>">
                        <?= $buku['stok'] > 0 ? '● Ready' : '● Habis'; ?>
                    </div>

                    <div class="card-img-wrapper">
                        <img src="<?= BASEURL; ?>/img/<?= $buku['gambar']; ?>" class="card-img-top" alt="<?= $buku['judul']; ?>">
                    </div>
                    
                    <div class="card-body p-4 d-flex flex-column flex-grow-1">
                        <div class="mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-1">
                                <?= $buku['tahun_terbit']; ?>
                            </span>
                            <span class="badge bg-light text-muted border rounded-1 ms-1">
                                <?= substr($buku['pengarang'], 0, 15); ?>...
                            </span>
                        </div>

                        <h5 class="card-title fw-bold text-dark mb-1" style="font-family: 'Outfit', sans-serif;">
                            <?= substr($buku['judul'], 0, 40) . (strlen($buku['judul']) > 40 ? '...' : ''); ?>
                        </h5>
                        <p class="text-muted small mb-4"><?= $buku['penerbit']; ?></p>
                        
                        <div class="mt-auto">
                            <?php if($buku['stok'] > 0) : ?>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small fw-bold">Sisa Stok</span>
                                    <span class="fw-bolder text-dark fs-5"><?= $buku['stok']; ?></span>
                                </div>
                                <a href="<?= BASEURL; ?>/peminjaman/pinjam/<?= $buku['id']; ?>" class="btn btn-action btn-pinjam shadow-sm">
                                    Pinjam Sekarang
                                </a>
                            <?php else : ?>
                                <button class="btn btn-action btn-secondary opacity-50 w-100 rounded-pill py-2 border-0" disabled>
                                    Stok Habis
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php endif; ?>