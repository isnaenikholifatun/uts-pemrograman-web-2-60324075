# UTS Pemrograman Web 2 - CRUD Kategori Buku

Aplikasi ini adalah sistem manajemen kategori buku sederhana yang dibangun untuk memenuhi tugas Ujian Tengah Semester (UTS) Pemrograman Web 2. Aplikasi ini memiliki fitur CRUD (Create, Read, Update, Delete) dengan fokus pada keamanan kode menggunakan *Prepared Statements*.

## Identitas Mahasiswa
- **Nama**: Isnaeni Kholifatun
- **NIM**: 60324075
- **Kelas**: Pemrograman WEB 2 (B)
- **Prodi**: Informatika 

## Deskripsi Singkat Aplikasi
Aplikasi ini memungkinkan pustakawan untuk mengelola data kategori buku dalam perpustakaan. Fitur utama meliputi:
- Menampilkan daftar kategori dengan status aktif/nonaktif.
- Menambah kategori baru melalui form.
- Mengubah (Edit) data kategori yang sudah ada.
- Menghapus data kategori dengan konfirmasi keamanan.
- **Keamanan**: Menggunakan *PHP Prepared Statements* untuk mencegah SQL Injection.
- **Tampilan**: Layout rapi dan responsif menggunakan Bootstrap 5.

## Cara Instalasi dan Menjalankan Aplikasi
1. **Persiapan Folder**:
   - Pastikan folder proyek bernama `UTS_60324075` berada di dalam direktori `htdocs` server lokal Anda (seperti XAMPP).
2. **Konfigurasi Database**:
   - Buka phpMyAdmin (`localhost/phpmyadmin`).
   - Buat database baru dengan nama `uts_perpustakaan_60324075`.
   - Pilih menu **Import** dan unggah file `uts_perpustakaan_60324075.sql` yang tersedia di root proyek.
3. **Koneksi Database**:
   - Buka file `config/database.php` dan sesuaikan pengaturan *host*, *user*, *password*, serta nama database dengan server Anda.
4. **Menjalankan Aplikasi**:
   - Pastikan modul Apache dan MySQL di XAMPP sudah aktif.
   - Buka browser dan akses: `http://localhost/UTS_60324075/index.php`.

## Cara Pengaplikasian
- **Navigasi Utama**: Gunakan halaman `index.php` untuk melihat seluruh daftar kategori buku.
- **Tambah Data**: Klik tombol **Tambah Kategori** untuk diarahkan ke halaman `create.php`.
- **Update Data**: Klik tombol **Edit** (kuning) untuk mengubah informasi kategori pada `edit.php`.
- **Hapus Data**: Klik tombol **Hapus** (merah). Sistem akan memunculkan konfirmasi sebelum menghapus data melalui `delete.php`.
- **Fitur Keamanan**: Jika mencoba memasukkan ID yang tidak valid secara manual di URL, sistem akan secara otomatis mendeteksi dan menampilkan pesan "ID tidak valid" atau "Data tidak ditemukan".

## Struktur Folder
Berikut adalah susunan file dalam proyek ini:
```text
UTS_60324075/
├── config/
│   └── database.php                # Konfigurasi koneksi database
├── create.php                      # Form tambah data kategori
├── delete.php                      # Logika proses hapus data
├── edit.php                        # Form ubah data kategori
├── index.php                       # Halaman utama (Daftar Kategori)
├── README.md                       # Dokumentasi aplikasi
└── uts_perpustakaan_60324075.sql   # Export database MySQL

## Link Repository GitHub