<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

$query = mysqli_query($conn, "SELECT users.id, users.nama, users.email, pendaftaran.jurusan, pendaftaran.status, pendaftaran.nik, pendaftaran.asal_sekolah FROM users LEFT JOIN pendaftaran ON users.id = pendaftaran.user_id WHERE users.role='user' ORDER BY users.id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #1f1f1f;
            padding: 30px 20px;
        }

        .sidebar a {
            display: block;
            color: #ddd;
            text-decoration: none;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background: #f4b400;
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .table-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="mb-4 text-white"><i class="bi bi-shield-lock-fill"></i> Admin PMB</h4>
        <a href="dashboard.php"><i class="bi bi-grid-fill"></i> Dashboard</a>
        <a href="pendaftar.php" class="active"><i class="bi bi-people-fill"></i> Data Pendaftar</a>
        <a href="verifikasi.php"><i class="bi bi-patch-check-fill"></i> Verifikasi</a>
        <a href="pengumuman.php"><i class="bi bi-megaphone-fill"></i> Pengumuman</a>
        <a href="pembayaran.php"><i class="bi bi-wallet2"></i> Pembayaran</a>
        <a href="../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="content">
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Data Pendaftar</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIK</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($d = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama']; ?></td>
                                <td><?= $d['email']; ?></td>
                                <td><?= $d['nik'] ?? '-'; ?></td>
                                <td><?= $d['asal_sekolah'] ?? '-'; ?></td>
                                <td><?= $d['jurusan'] ?? '-'; ?></td>
                                <td><span class="badge bg-warning text-dark"><?= $d['status'] ?? 'Belum Lengkap'; ?></span></td>
                                <td><a href="detail_pendaftaran.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-info text-white">Detail</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>