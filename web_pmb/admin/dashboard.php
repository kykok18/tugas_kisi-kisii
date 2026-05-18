<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

$total_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role='user'"));
$total_pending = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pendaftaran WHERE status='Menunggu Verifikasi'"));
$total_lulus = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pendaftaran WHERE status='Lulus'"));
$total_pembayaran = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pembayaran WHERE status_pembayaran='Pending'"));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PMB</title>
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

        .stat-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-8px);
        }

        .stat-icon {
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
        <h4 class="mb-4"><i class="bi bi-shield-lock-fill"></i> Admin PMB</h4>
        <a href="dashboard.php" class="active"><i class="bi bi-grid-fill"></i> Dashboard</a>
        <a href="pendaftaran.php"><i class="bi bi-people-fill"></i> Data Pendaftar</a>
        <a href="verifikasi.php"><i class="bi bi-patch-check-fill"></i> Verifikasi</a>
        <a href="pengumuman.php"><i class="bi bi-megaphone-fill"></i> Pengumuman</a>
        <a href="pembayaran.php"><i class="bi bi-wallet2"></i> Pembayaran</a>
        <a href="../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="content">
        <div class="top-card mb-5">
            <h2 class="fw-bold">Halo Admin 👋</h2>
            <p>Selamat datang di dashboard PMB Kampus 2026</p>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                    <h3 class="fw-bold"><?= $total_user; ?></h3>
                    <p class="text-secondary">Total Pendaftar</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
                    <h3 class="fw-bold"><?= $total_pending; ?></h3>
                    <p class="text-secondary">Pending Verifikasi</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-patch-check-fill"></i></div>
                    <h3 class="fw-bold"><?= $total_lulus; ?></h3>
                    <p class="text-secondary">Mahasiswa Lulus</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-wallet2"></i></div>
                    <h3 class="fw-bold"><?= $total_pembayaran; ?></h3>
                    <p class="text-secondary">Pembayaran Pending</p>
                </div>
            </div>
        </div>
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Data Pendaftar Terbaru</h4>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT users.nama, users.email, pendaftaran.status FROM users LEFT JOIN pendaftaran ON users.id = pendaftaran.user_id WHERE users.role='user' ORDER BY users.id DESC LIMIT 5");
                        while ($d = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $d['nama']; ?></td>
                                <td><?= $d['email']; ?></td>
                                <td><span class="badge bg-warning text-dark"><?= $d['status'] ?? 'Belum Isi Form'; ?></span></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>