<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once 'config/database.php';

    // 1. Ambil ID dari GET
    if (!isset($_GET['id_kategori']) || empty($_GET['id_kategori'])) {
        header("Location: index.php?pesan=ID tidak valid");
        exit;
    }

    $id_kategori = $_GET['id_kategori'];
    $errors = [];

    // 2. Retrieve data berdasarkan ID untuk pre-fill form
    $stmt = $conn->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
    $stmt->bind_param("i", $id_kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $kategori = $result->fetch_assoc();

    if (!$kategori) {
        header("Location: index.php?pesan=Data tidak ditemukan");
        exit;
    }

    // 3. Jika POST, proses update
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kode_kategori = $_POST['kode_kategori'];
        $nama_kategori = $_POST['nama_kategori'];

        // Validasi input
        if (empty($kode_kategori)) $errors[] = "Kode kategori wajib diisi";
        if (empty($nama_kategori)) $errors[] = "Nama kategori wajib diisi";

        // Validasi Duplikasi
        $stmt_check = $conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori = ? AND id_kategori != ?");
        $stmt_check->bind_param("si", $kode_kategori, $id_kategori);
        $stmt_check->execute();
        if ($stmt_check->get_result()->num_rows > 0) {
            $errors[] = "Kode kategori sudah digunakan!";
        }

        // Eksekusi Update jika tidak ada error
        if (empty($errors)) {
            $stmt_upd = $conn->prepare("UPDATE kategori SET kode_kategori = ?, nama_kategori = ? WHERE id_kategori = ?");
            $stmt_upd->bind_param("ssi", $kode_kategori, $nama_kategori, $id_kategori);
            
            if ($stmt_upd->execute()) {
                header("Location: index.php?pesan=Berhasil memperbarui kategori");
                exit;
            } else {
                $errors[] = "Gagal mengupdate database";
            }
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">Edit Kategori</h4>
                    </div>
                    <div class="card-body">
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $e): ?>
                                        <li><?= htmlspecialchars($e) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Kode Kategori</label>
                                <input type="text" name="kode_kategori" class="form-control" 
                                       value="<?= htmlspecialchars($kategori['kode_kategori']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control" 
                                       value="<?= htmlspecialchars($kategori['nama_kategori']); ?>">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-warning">Update Data</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>