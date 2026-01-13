<div class="table-container animate-fade">
    <div class="table-responsive">
        <table class="table modern-table mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <?php if($_SESSION['role'] == 'admin') : ?>
                    <th class="text-end pe-4">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['peminjaman'])) : ?>
                    <tr><td colspan="7" class="text-center py-5 text-muted">Belum ada data transaksi.</td></tr>
                <?php else : ?>
                    <?php 
                    $no = isset($_POST['keyword']) ? 1 : (1 + (5 * ($data['halaman_aktif'] - 1))); 
                    ?>
                    <?php foreach( $data['peminjaman'] as $pinjam ) : ?>
                    <tr>
                        <td class="fw-bold text-secondary"><?= $no++; ?></td>
                        
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($pinjam['nama_peminjam']); ?>&background=random&color=fff&bold=true" 
                                     class="rounded-circle me-3 shadow-sm" width="40" height="40">
                                <div>
                                    <div class="fw-bold text-dark"><?= $pinjam['nama_peminjam']; ?></div>
                                    <div class="text-muted small" style="font-size: 11px;">ID: #<?= $pinjam['user_id']; ?></div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-2 bg-light rounded d-flex align-items-center justify-content-center text-primary border" style="width: 35px; height: 50px;">
                                    <i class="bi bi-book-fill"></i>
                                </div>
                                <span class="fw-bold text-dark small"><?= substr($pinjam['judul_buku'], 0, 30); ?></span>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-muted small">Pinjam: <span class="text-dark fw-bold"><?= date('d/m/y', strtotime($pinjam['tgl_pinjam'])); ?></span></span>
                                <span class="text-muted small">Target: <span class="text-danger fw-bold"><?= date('d/m/y', strtotime($pinjam['tgl_kembali_rencana'])); ?></span></span>
                            </div>
                        </td>

                        <td>
                            <?php if($pinjam['status'] == 'dikembalikan') : ?>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3"><i class="bi bi-check-circle-fill"></i> Selesai</span>
                            <?php else : ?>
                                <?php 
                                    $tgl_sekarang = date('Y-m-d');
                                    $terlambat = $tgl_sekarang > $pinjam['tgl_kembali_rencana'];
                                ?>
                                <?php if($terlambat) : ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3"><i class="bi bi-exclamation-circle-fill"></i> Telat</span>
                                <?php else : ?>
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3"><i class="bi bi-clock-fill"></i> Aktif</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if($pinjam['denda'] > 0) : ?>
                                <span class="text-danger fw-bold small">Rp <?= number_format($pinjam['denda'], 0, ',', '.'); ?></span>
                            <?php else : ?>
                                <span class="text-muted small">-</span>
                            <?php endif; ?>
                        </td>

                        <?php if($_SESSION['role'] == 'admin') : ?>
                        <td class="text-end pe-4">
                            <?php if($pinjam['status'] == 'dipinjam') : ?>
                                <a href="<?= BASEURL; ?>/peminjaman/kembali/<?= $pinjam['id']; ?>" 
   class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm fw-bold tombol-kembali">
   Kembalikan
</a>
                            <?php else : ?>
                                <i class="bi bi-check-all text-success fs-4"></i>
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>