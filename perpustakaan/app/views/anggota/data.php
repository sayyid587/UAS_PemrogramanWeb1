<div class="table-container animate-fade">
    <div class="table-responsive">
        <table class="table modern-table mb-0">
            <thead>
                <tr>
                    <th>Profil</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                    <th class="text-end pe-4">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['anggota'])) : ?>
                    <tr><td colspan="4" class="text-center py-5 text-muted">Data anggota tidak ditemukan.</td></tr>
                <?php else : ?>
                    <?php foreach( $data['anggota'] as $usr ) : ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($usr['nama_lengkap']); ?>&background=random&color=fff&bold=true&size=128" 
                                     class="rounded-3 shadow-sm me-3" width="45" height="45">
                                <div>
                                    <div class="fw-bold text-dark"><?= $usr['nama_lengkap']; ?></div>
                                    <div class="text-muted small">@<?= $usr['username']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if($usr['role'] == 'admin') : ?>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">
                                    <i class="bi bi-shield-lock me-1"></i> Admin
                                </span>
                            <?php else : ?>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3">
                                    <i class="bi bi-person me-1"></i> Anggota
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="text-muted small fw-medium">
                                <i class="bi bi-calendar3 me-1"></i> <?= date('d M Y', strtotime($usr['created_at'])); ?>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm rounded-pill" role="group">
                                    <a href="<?= BASEURL; ?>/anggota/edit/<?= $usr['id']; ?>" class="btn btn-sm btn-white border text-warning"><i class="bi bi-pencil-square"></i></a>
                                  <a href="<?= BASEURL; ?>/anggota/hapus/<?= $usr['id']; ?>" class="btn btn-sm tombol-hapus btn-white border text-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>