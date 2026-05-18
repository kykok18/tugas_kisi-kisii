<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

$user_id = $_SESSION['id'];
$sql = "SELECT p.*, 
        (SELECT COUNT(*) FROM berkas WHERE user_id='$user_id') as total_berkas 
        FROM pendaftaran p WHERE p.user_id='$user_id'";
$cek = mysqli_query($conn, $sql);
$data = ($cek && mysqli_num_rows($cek) > 0) ? mysqli_fetch_assoc($cek) : [];
$status = $data['status'] ?? 'Belum Lengkap';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - PMB</title>
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

        .sidebar h4 {
            color: white;
            font-weight: 700;
        }

        .sidebar a {
            display: block;
            color: #ddd;
            text-decoration: none;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: .3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #f4b400;
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .top-card {
            background: linear-gradient(135deg, #f4b400, #ffd54f);
            border-radius: 25px;
            padding: 35px;
            color: white;
        }

        .menu-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            transition: .3s;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .menu-card:hover {
            transform: translateY(-8px);
        }

        .menu-icon {
            width: 70px;
            height: 70px;
            background: rgba(244, 180, 0, 0.15);
            color: #f4b400;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .status-badge {
            background: white;
            color: #1f1f1f;
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
        }

        @media(max-width: 768px) {
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
        <h4 class="mb-4"><i class="bi bi-mortarboard-fill"></i> PMB</h4>
        <a href="dashboard.php" class="active"><i class="bi bi-grid-fill"></i> Dashboard</a>
        <a href="formulir.php"><i class="bi bi-file-earmark-text-fill"></i> Formulir</a>
        <a href="upload.php"><i class="bi bi-upload"></i> Upload Berkas</a>
        <a href="pengumuman.php"><i class="bi bi-megaphone-fill"></i> Pengumuman</a>
        <a href="pembayaran.php"><i class="bi bi-wallet2"></i> Pembayaran</a>
        <a href="../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="content">
        <div class="top-card mb-5">
            <h2 class="fw-bold">Halo, <?= $_SESSION['nama']; ?> 👋</h2>
            <p>Selamat datang di sistem PMB Kampus 2026</p>
            <div class="status-badge mt-3">Status : <?= $status; ?></div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <h5 class="fw-bold">Formulir PMB</h5>
                    <p class="text-secondary">Lengkapi biodata pendaftaran</p>
                    <a href="formulir.php" class="btn btn-warning rounded-pill text-white">Isi Formulir</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="menu-icon"><i class="bi bi-upload"></i></div>
                    <h5 class="fw-bold">Upload Berkas</h5>
                    <p class="text-secondary">Upload dokumen persyaratan</p>
                    <a href="upload.php" class="btn btn-warning rounded-pill text-white">Upload</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="menu-icon"><i class="bi bi-megaphone-fill"></i></div>
                    <h5 class="fw-bold">Pengumuman</h5>
                    <p class="text-secondary">Lihat hasil seleksi</p>
                    <a href="pengumuman.php" class="btn btn-warning rounded-pill text-white">Lihat</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="menu-card">
                    <div class="menu-icon"><i class="bi bi-wallet2"></i></div>
                    <h5 class="fw-bold">Pembayaran</h5>
                    <p class="text-secondary">Upload bukti pembayaran</p>
                    <a href="pembayaran.php" class="btn btn-warning rounded-pill text-white">Bayar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>