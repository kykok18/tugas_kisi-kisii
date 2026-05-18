<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

// Proses verifikasi pembayaran
if (isset($_POST['verifikasi'])) {
    $id = intval($_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    mysqli_query($conn, "UPDATE pembayaran SET status_pembayaran='$status' WHERE id='$id'");
}

$query = mysqli_query($conn, "SELECT pembayaran.*, users.nama, users.email FROM pembayaran JOIN users ON pembayaran.user_id = users.id ORDER BY pembayaran.id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pembayaran</title>
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
        <a href="pendaftar.php"><i class="bi bi-people-fill"></i> Data Pendaftar</a>
        <a href="verifikasi.php"><i class="bi bi-patch-check-fill"></i> Verifikasi</a>
        <a href="pengumuman.php"><i class="bi bi-megaphone-fill"></i> Pengumuman</a>
        <a href="pembayaran.php" class="active"><i class="bi bi-wallet2"></i> Pembayaran</a>
        <a href="../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="content">
        <div class="table-card">
            <h4 class="fw-bold mb-4">Verifikasi Pembayaran</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($d = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama']; ?></
                                        <td><?= $d['email']; ?></td>
                                <td>
                                    <?php if ($d['bukti_pembayaran']): ?>
                                        <a href="../assets/upload/<?= $d['bukti_pembayaran']; ?>" target="_blank" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> Lihat Bukti
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Belum Upload</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($d['status_pembayaran'] == 'Lunas'): ?>
                                        <span class="badge bg-success">LUNAS</span>
                                    <?php elseif ($d['status_pembayaran'] == 'Pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum Bayar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($d['status_pembayaran'] == 'Pending'): ?>
                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $d['id']; ?>">
                                            <select name="status" class="form-select form-select-sm d-inline w-auto" required>
                                                <option value="Lunas">Verifikasi & Lunas</option>
                                                <option value="Pending">Tolak / Pending</option>
                                            </select>
                                            <button type="submit" name="verifikasi" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle"></i> Proses
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (mysqli_num_rows($query) == 0): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data pembayaran</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>