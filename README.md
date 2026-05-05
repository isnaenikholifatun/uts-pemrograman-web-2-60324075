# UTS Pemrograman Web 2 - CRUD Kategori Buku

Aplikasi ini adalah sistem manajemen kategori buku sederhana.
Dibangun untuk memenuhi tugas Ujian Tengah Semester (UTS) Pemrograman Web 2. 
Aplikasi ini memiliki fitur CRUD (Create, Read, Update, dan Delete) dengan fokus pada keamanan kode menggunakan *Prepared Statements*.

## Identitas Mahasiswa
- **Nama**: Isnaeni Kholifatun
- **NIM**: 60324075
- **Kelas**: Pemrograman WEB 2 (B)
- **Prodi**: Informatika 
- **Semester**: 4 (empat) 

## Deskripsi Singkat Aplikasi
Dengan aplikasi ini pustakawan dapat mengelola data kategori buku di perpustakaan mereka. Salah satu fitur utama adalah kemampuan untuk menampilkan daftar kategori yang menunjukkan apakah mereka aktif atau nonaktif. Fitur utama meliputi:
- Menampilkan daftar kategori dengan status aktif/nonaktif.
- Menambah kategori baru melalui form.
- Mengubah (Edit) data kategori yang sudah ada.
- Menghapus data kategori dengan konfirmasi keamanan.
- **Keamanan**: Menggunakan *PHP Prepared Statements* untuk mencegah SQL Injection.
- **Tampilan**: Layout rapi dan responsif menggunakan Bootstrap 5.

## Cara Instalasi dan Menjalankan Aplikasi
1. **Nyalakan Server Lokal**:
   - Buka aplikasi **XAMPP Control Panel**.
   - Tekan tombol **Start** pada modul **Apache** dan **MySQL**.

2. **Persiapan Folder**:
   - Pastikan folder proyek bernama `uts_60324075` sudah diletakkan di dalam direktori `htdocs` server lokal ( `C:\xampp\htdocs\uts_60324075`).

3. **Konfigurasi Database**:
   - Buka browser dan akses phpMyAdmin: `http://localhost/phpmyadmin`.
   - Buat database baru dengan nama `uts_perpustakaan_60324075`.
   - Pilih database tersebut, lalu klik tab **SQL**.
   - Buka file `uts_perpustakaan_60324075.sql` masukkan kueri struktur tabel kategori dan sample data dalam kotak di menu SQL tersebut dan klik tombol **Kirim (Go)**.
   - *(Langkah ini akan secara otomatis membuat tabel `kategori` dan mengisi 3 data sample awal).*

4. **Koneksi Database**:
   - Buka file `config/database.php`.
   - Pastikan bagian `DB_NAME` sudah terganti `uts_perpustakaan_60324075`.
   - Secara *default*, aplikasi ini menggunakan konfigurasi standar XAMPP:
     - `DB_SERVER` = 'localhost'
     - `DB_USERNAME` = 'root'
     - `DB_PASSWORD` = '' (kosong)
   - Sesuaikan jika server lokal menggunakan password.

5. **Menjalankan Aplikasi**:
   - Buka browser dan akses URL: `http://localhost/uts_60324075/index.php`.

## Cara Pengaplikasian
- **Navigasi Utama**: Gunakan halaman `index.php` untuk melihat seluruh daftar kategori buku.
- **Tambah Data**: Klik tombol **Tambah Kategori** untuk diarahkan ke halaman `create.php`.
- **Update Data**: Klik tombol **Edit** (kuning) untuk mengubah informasi kategori pada `edit.php`.
- **Hapus Data**: Klik tombol **Hapus** (merah). Sistem akan memunculkan konfirmasi sebelum menghapus data melalui `delete.php`.
- **Fitur Keamanan**: Jika mencoba memasukkan ID yang tidak valid secara manual di URL, sistem akan secara otomatis mendeteksi dan menampilkan pesan "ID tidak valid" atau "Data tidak ditemukan".

## Struktur Folder
Berikut adalah susunan file dalam proyek ini:
```text
uts_60324075/
├── config/
│   └── database.php                # Konfigurasi koneksi database
├── create.php                      # Form tambah data kategori
├── delete.php                      # Logika proses hapus data
├── edit.php                        # Form ubah data kategori
├── index.php                       # Halaman utama (Daftar Kategori)
├── README.md                       # Dokumentasi aplikasi
└── uts_perpustakaan_60324075.sql   # Export database MySQL

## Link Repository GitHub
<https://github.com/isnaenikholifatun/uts-pemrograman-web-2-60324075>