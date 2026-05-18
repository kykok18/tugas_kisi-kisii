<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT users.*, pendaftaran.*, berkas.* FROM users LEFT JOIN pendaftaran ON users.id = pendaftaran.user_id LEFT JOIN berkas ON users.id = berkas.user_id WHERE users.id='$id'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .detail-card {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .info-group {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .info-label {
            font-weight: 600;
            color: #f4b400;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="detail-card">
            <div class="text-center mb-4">
                <i class="bi bi-person-badge fs-1 text-warning"></i>
                <h2 class="fw-bold mt-2">Detail Pendaftar</h2>
            </div>
            <div class="info-group">
                <div class="info-label">Nama Lengkap</div>
                <div><?= $data['nama'] ?? '-'; ?></div>
            </div>
            <div class="info-group">
                <div class="info-label">Email</div>
                <div><?= $data['email'] ?? '-'; ?></div>
            </div>
            <div class="info-group">
                <div class="info-label">NIK</div>
                <div><?= $data['nik'] ?? '-'; ?></div>
            </div>
            <div class="info-group">
                <div class="info-label">Asal Sekolah</div>
                <div><?= $data['asal_sekolah'] ?? '-'; ?></div>
            </div>
            <div class="info-group">
                <div class="info-label">Jurusan</div>
                <div><?= $data['jurusan'] ?? '-'; ?></div>
            </div>
            <div class="info-group">
                <div class="info-label">Status Pendaftaran</div>
                <div><span class="badge bg-warning text-dark"><?= $data['status'] ?? 'Belum Lengkap'; ?></span></div>
            </div>
            <?php if ($data['foto']): ?>
                <div class="info-group">
                    <div class="info-label">Foto</div>
                    <img src="../assets/upload/<?= $data['foto']; ?>" width="150" class="img-thumbnail">
                </div>
            <?php endif; ?>
            <a href="pendaftar.php" class="btn btn-secondary w-100 mt-3">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>