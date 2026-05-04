<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once 'config/database.php';
    
    $errors = [];
    $kode = '';
    $nama = '';
    $deskripsi = '';
    $status = 'Aktif'; // Default aktif
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // TODO: Ambil dan sanitasi data dari form
        $kode = htmlspecialchars(trim($_POST['kode_kategori']));
        $nama = htmlspecialchars(trim($_POST['nama_kategori']));
        $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
        // Status diambil dari radio button
        if(isset($_POST['status'])) {
            $status = $_POST['status'];
        }
        
        // TODO: Validasi kode kategori & Cek duplikasi kode
        if (empty($kode)) {
            $errors[] = "Kode Kategori wajib diisi.";
        } else {
            // Panjang 4-10 karakter
            if (strlen($kode) < 4 || strlen($kode) > 10) {
                $errors[] = "Kode Kategori harus antara 4 hingga 10 karakter.";
            }
            // Format harus diawali "KAT-"
            if (substr($kode, 0, 4) !== "KAT-") {
                $errors[] = "Kode Kategori harus diawali dengan 'KAT-'.";
            }
            
            // Cek duplikasi kode ke database
            $stmt_cek = $conn->prepare("SELECT kode_kategori FROM kategori WHERE kode_kategori = ?");
            $stmt_cek->bind_param("s", $kode);
            $stmt_cek->execute();
            $stmt_cek->store_result();
            if ($stmt_cek->num_rows > 0) {
                $errors[] = "Kode Kategori '$kode' sudah digunakan. Silakan masukkan kode lain.";
            }
            $stmt_cek->close();
        }
        
        // TODO: Validasi nama kategori
        if (empty($nama)) {
            $errors[] = "Nama Kategori wajib diisi.";
        } else {
            if (strlen($nama) < 3 || strlen($nama) > 50) {
                $errors[] = "Nama Kategori harus antara 3 hingga 50 karakter.";
            }
        }
        
        // TODO: Validasi deskripsi
        if (!empty($deskripsi) && strlen($deskripsi) > 200) {
            $errors[] = "Deskripsi maksimal 200 karakter.";
        }

        // Validasi status (opsional tapi bagus untuk keamanan)
        if ($status !== 'Aktif' && $status !== 'Nonaktif') {
            $errors[] = "Pilihan status tidak valid.";
        }
        
        // TODO: Jika tidak ada error, insert data
        if (empty($errors)) {
            $sql = "INSERT INTO kategori (kode_kategori, nama_kategori, deskripsi, status) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $kode, $nama, $deskripsi, $status);
            
            if ($stmt->execute()) {
                // TODO: Redirect jika berhasil
                header("Location: index.php?pesan=Kategori baru berhasil ditambahkan!");
                exit;
            } else {
                $errors[] = "Terjadi kesalahan sistem saat menyimpan data: " . $conn->error;
            }
        }
    }
    ?>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kategori Baru</h4>
                    </div>
                    <div class="card-body">
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <strong>Gagal menyimpan data!</strong> Perbaiki kesalahan berikut:
                                <ul class="mb-0 mt-1">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="kode_kategori" class="form-label">Kode Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" value="<?php echo $kode; ?>" required>
                                <div class="form-text">Wajib diawali 'KAT-' (contoh: KAT-004), panjang 4-10 karakter.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo $nama; ?>" required>
                                <div class="form-text">Panjang 3-50 karakter.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo $deskripsi; ?></textarea>
                                <div class="form-text">Opsional. Maksimal 200 karakter.</div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label d-block">Status <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusAktif" value="Aktif" <?php echo ($status == 'Aktif') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="statusAktif">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusNonaktif" value="Nonaktif" <?php echo ($status == 'Nonaktif') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="statusNonaktif">Nonaktif</label>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>