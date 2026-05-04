<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    require_once 'config/database.php';
    
    // TODO: Query data kategori
    $sql = "SELECT * FROM kategori ORDER BY id_kategori DESC";
    
    // TODO: Cek hasil query dengan prepared statement
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Kategori Buku</h2>
            <a href="create.php" class="btn btn-primary">Tambah Kategori</a>
        </div>
        
        <?php if (isset($_GET['pesan'])): 
            // Penentuan warna alert: Hijau jika sukses, Merah jika gagal/not found
            $pesan = $_GET['pesan'];
            $alertClass = (strpos($pesan, 'Berhasil') !== false) ? 'alert-success' : 'alert-danger';
        ?>
            <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
                <?php echo $pesan; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th width="100">Kode</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th width="100">Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // TODO: Loop data dan tampilkan
                            if ($result->num_rows > 0) {
                                $no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    // Penentuan warna badge
                                    if ($row['status'] == 'Aktif') {
                                        $badge = 'bg-success';
                                    } else {
                                        $badge = 'bg-danger';
                                    }
                            ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['kode_kategori']; ?></td>
                                        <td><?php echo $row['nama_kategori']; ?></td>
                                        <td><?php echo $row['deskripsi']; ?></td>
                                        <td><span class="badge <?php echo $badge; ?>"><?php echo $row['status']; ?></span></td>
                                        <td>
                                            <a href="edit.php?id_kategori=<?php echo $row['id_kategori']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <button onclick="confirmDelete(<?php echo $row['id_kategori']; ?>)" class="btn btn-danger btn-sm">Hapus</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                // Jika data kosong
                                echo "<tr><td colspan='6' class='text-center'>Belum ada data kategori.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div> </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmDelete(id) {
        if (confirm('Yakin ingin menghapus kategori ini?')) {
            window.location.href = 'delete.php?id_kategori=' + id;
        }
    }
    </script>
</body>
</html>