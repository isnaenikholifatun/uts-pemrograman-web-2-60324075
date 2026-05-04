<?php
require_once 'config/database.php';

// Cek apakah parameter id_kategori ada dan tidak kosong
if (!isset($_GET['id_kategori']) || empty($_GET['id_kategori'])) {
    header("Location: index.php?pesan=ID tidak valid");
    exit;
}

$id_kategori = $_GET['id_kategori'];

// Cek keberadaan data (Bagian dari Validasi ID)
$stmt_check = $conn->prepare("SELECT id_kategori FROM kategori WHERE id_kategori = ?");
$stmt_check->bind_param("i", $id_kategori);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    // Jika ID tidak ditemukan di database
    header("Location: index.php?pesan=Data tidak ditemukan");
    exit;
}

// Gunakan prepared statement untuk keamanan
$stmt_del = $conn->prepare("DELETE FROM kategori WHERE id_kategori = ?");
$stmt_del->bind_param("i", $id_kategori);
$stmt_del->execute();

// Cek affected_rows untuk memastikan ada baris yang terhapus
if ($stmt_del->affected_rows > 0) {
    header("Location: index.php?pesan=Berhasil menghapus kategori");
} else {
    header("Location: index.php?pesan=Gagal menghapus data");
}

exit;
?>