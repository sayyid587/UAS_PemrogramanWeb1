<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // --- 1. SCRIPT FLASH MESSAGE (SUKSES) ---
    const flashData = $('.flash-data').data('flashdata');
    const flashAksi = $('.flash-data').data('flashaksi');
    const flashTipe = $('.flash-data').data('flashtype') || 'success';
    // AMBIL JUDUL DARI VIEW (Jika tidak ada, default-nya 'Data Berhasil')
    const flashJudul = $('.flash-data').data('flashjudul') || 'Data Berhasil'; 

    if (flashData) {
        Swal.fire({
            title: flashJudul, // Gunakan variabel judul dinamis tadi
            text: 'Berhasil ' + flashAksi,
            icon: flashTipe,
            timer: 1600,
            showConfirmButton: false
        });
    }

    $(document).on('click', '.tombol-hapus', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Yakin mau menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        });
    });

    $('form').on('submit', function() {
        const btn = $(this).find('button[type="submit"]');

        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        btn.prop('disabled', true);
	});

	// ... (Script tombol-hapus yang sudah ada biarkan saja) ...

    // --- SCRIPT TOMBOL KEMBALIKAN BUKU ---
    $(document).on('click', '.tombol-kembali', function(e) {
        e.preventDefault(); // Mencegah link langsung pindah
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Kembalikan Buku?',
            text: "Pastikan buku fisik sudah diterima dengan baik.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Terima Buku!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik Ya, baru pindah halaman
                document.location.href = href;
            }
        });
    });
</script>

    <script>
        $(document).ready(function() {

            // A. ALERT UNTUK TOMBOL DAFTAR
            $('.btn-daftar').on('click', function(e) {
                e.preventDefault(); // Mencegah link bekerja (hash #)
                
                Swal.fire({
                    title: 'Pendaftaran Ditutup',
                    html: "Mohon maaf, pendaftaran mandiri saat ini sedang ditutup.<br>Silakan hubungi <b>Admin Perpustakaan</b> untuk pembuatan akun.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5', // Warna ungu sesuai tema Anda
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hubungi Admin via WA',
                    cancelButtonText: 'Tutup'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Opsional: Arahkan ke WhatsApp Admin jika ada
                        // window.location.href = 'https://wa.me/628xxxxxxx';
                        Swal.fire('Info', 'Silakan datang ke meja petugas.', 'success');
                    }
                });
            });

            // B. ALERT UNTUK TOMBOL 'PELAJARI' (Fitur belum tersedia)
            $('a[href="#fitur"]').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'success',
                    title: 'E-Perpus v1.0',
                    text: 'Fitur selengkapnya akan segera hadir! Silakan Login untuk mulai meminjam.',
                    confirmButtonColor: '#4f46e5'
                });
            });

        });
    </script>

</body>
</html>