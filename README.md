# UAS_PemrogramanWeb1

# E-Perpus (Sistem Informasi Perpustakaan Digital)

> **Repository ini disusun untuk memenuhi Ujian Akhir Semester (UAS) Mata Kuliah Pemrograman Web.**

Aplikasi **E-Perpus** adalah sistem informasi manajemen perpustakaan berbasis web yang dibangun menggunakan **PHP Native** dengan konsep arsitektur **MVC (Model-View-Controller)**. Aplikasi ini dirancang untuk mempermudah proses administrasi perpustakaan, mulai dari pengelolaan data buku, keanggotaan, hingga transaksi peminjaman dan pengembalian buku secara digital.

---

## 👨‍🎓 Identitas Mahasiswa

**Nama : Sayyid Sulthan Abyan**

**NIM : 312410496**

**Kelas : TI.24.A.5**

---

## 🌐 Link Demo & Dokumentasi

* **🌍 Live Demo:** [http://digital-library.rf.gd](http://digital-library.rf.gd)
* **📹 Video Dokumentasi (YouTube):** [LINK YOUTUBE KAMU DI SINI]

---

## 🛠️ Teknologi yang Digunakan (Tech Stack)

Aplikasi ini dibangun tanpa menggunakan Framework PHP (seperti Laravel/CI), melainkan membangun struktur MVC sendiri dari nol (*From Scratch*).

* **Backend Language:** PHP 8.0+ (OOP & MVC Pattern)
* **Database:** MySQL
* **Frontend Framework:** Bootstrap 5 (Responsive UI)
* **Styling:** CSS3 & Bootstrap Icons
* **Server:** Apache (XAMPP Localhost / InfinityFree Hosting)
* **Other Tools:** Git, Visual Studio Code

---

## 📚 Fitur & Fungsionalitas

Sistem ini memiliki dua aktor utama: **Admin (Pustakawan)** dan **User (Anggota/Mahasiswa)**.

### 1. Fitur Umum
* **Routing URL Cantik:** Menggunakan `.htaccess` untuk menyembunyikan ekstensi `.php` (URL terlihat bersih).
```
<IfModule mod_rewrite.c>
    Options -Multiviews
    RewriteEngine On

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    
    RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>
  ```

* **Security:** Proteksi SQL Injection (PDO Binding) dan XSS Prevention.
* **Alert System:** Notifikasi *Flasher* untuk memberi feedback sukses/gagal aksi.

### 2. Fitur Admin
* **Dashboard Statistik:** Melihat ringkasan jumlah buku, anggota, dan transaksi aktif.
* **Manajemen Buku (CRUD):** Menambah, mengedit, menghapus, dan mencari buku. Termasuk upload gambar sampul.
* **Transaksi Peminjaman:** Mencatat peminjaman buku oleh anggota.
* **Transaksi Pengembalian:** Memproses pengembalian buku, hitung denda otomatis (jika ada), dan update stok buku.
* **Manajemen Anggota:** Mengelola data pengguna.

### 3. Fitur User (Anggota)
* **Katalog Buku:** Melihat daftar buku yang tersedia beserta detail dan status stok.
* **Pencarian:** Mencari buku berdasarkan judul atau pengarang.
* **Profil Saya:** Halaman khusus untuk melihat biodata diri dan status keanggotaan.

---

## 📸 Dokumentasi & Screenshot Aplikasi

Berikut adalah tangkapan layar dari alur penggunaan aplikasi E-Perpus.

### A. Autentikasi (Login)
Halaman masuk yang dilengkapi validasi untuk membedakan hak akses Admin dan User.

![Halaman Login](assets/screenshots/login.jpg)
*Keterangan: Halaman Login dengan validasi username & password.*

---

### B. Hak Akses: ADMIN
Berikut adalah tampilan dan fitur yang hanya bisa diakses oleh Pustakawan.

#### 1. Dashboard Admin
Halaman utama setelah login, menampilkan ringkasan data perpustakaan.

![Dashboard Admin](assets/screenshots/dashboard_admin.jpg)

#### 2. Manajemen Data Buku (CRUD)
Admin dapat melihat daftar buku, menambah buku baru (upload cover), serta mengedit atau menghapus data.

![Daftar Buku](assets/screenshots/data_buku.jpg)
*Keterangan: Tampilan daftar buku dengan fitur pencarian dan tombol aksi.*

![Form Tambah Buku](assets/screenshots/tambah_buku.jpg)
*Keterangan: Modal/Form untuk input data buku baru.*

#### 3. Transaksi Peminjaman
Proses saat Admin mencatat peminjaman buku untuk anggota. Stok buku akan berkurang otomatis.

![Transaksi Peminjaman](assets/screenshots/peminjaman.jpg)

#### 4. Detail Buku
Melihat informasi lengkap buku termasuk stok yang tersedia.

![Detail Buku](assets/screenshots/detail_buku.jpg)

---

### C. Hak Akses: USER (ANGGOTA)
Berikut adalah tampilan dari sisi Mahasiswa/Anggota.

#### 1. Landing Page / Katalog Buku
Halaman depan yang menampilkan koleksi buku perpustakaan yang bisa dicari oleh user.

![Katalog Buku](assets/screenshots/user_home.jpg)

#### 2. Profil Member
Halaman biodata anggota yang menampilkan informasi akun secara estetik.

![Profil User](assets/screenshots/user_profile.jpg)

---

## 📂 Struktur Folder (MVC)

Project ini memisahkan *Logic* (App) dan *View* (Public) demi keamanan.

```text
/
├── app/                  # LOGIKA UTAMA (TIDAK BISA DIAKSES VIA BROWSER)
│   ├── config/           # Konfigurasi Database & BaseURL
│   ├── controllers/      # Pengendali alur (Jembatan View & Model)
│   ├── core/             # Core System (App, Controller, Database Wrapper)
│   ├── models/           # Query Database (CRUD Logic)
│   └── views/            # File Tampilan (HTML + PHP)
│
├── public/               # PUBLIC ACCESS (FILE YANG DIBUKA BROWSER)
│   ├── css/              # File Styling CSS
│   ├── img/              # Folder penyimpanan gambar/upload
│   ├── js/               # File JavaScript / Bootstrap JS
│   └── index.php         # Entry Point (Gerbang Utama Aplikasi)
│
└── assets/               # File pendukung README (Screenshot)
