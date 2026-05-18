<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

// Proses simpan pengumuman
if (isset($_POST['simpan'])) {
    $user_id = intval($_POST['user_id']);
    $hasil = mysqli_real_escape_string($conn, $_POST['hasil']);

    $cek = mysqli_query($conn, "SELECT * FROM pengumuman WHERE user_id='$user_id'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE pengumuman SET hasil='$hasil' WHERE user_id='$user_id'");
    } else {
        mysqli_query($conn, "INSERT INTO pengumuman(user_id, hasil) VALUES ('$user_id', '$hasil')");
    }

    // Update status pendaftaran jika Lulus
    if ($hasil == 'Lulus') {
        mysqli_query($conn, "UPDATE pendaftaran SET status='Lulus' WHERE user_id='$user_id'");
    }
}

$query = mysqli_query($conn, "SELECT pendaftaran.*, users.nama, users.email FROM pendaftaran JOIN users ON pendaftaran.user_id = users.id WHERE pendaftaran.status IN ('Lulus', 'Ditolak')");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengumuman</title>
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
        <a href="pengumuman.php" class="active"><i class="bi bi-megaphone-fill"></i> Pengumuman</a>
        <a href="pembayaran.php"><i class="bi bi-wallet2"></i> Pembayaran</a>
        <a href="../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="content">
        <div class="table-card">
            <h4 class="fw-bold mb-4">Kelola Pengumuman Hasil Seleksi</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>Status Verifikasi</th>
                            <th>Aksi Pengumuman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($d = mysqli_fetch_assoc($query)) {
                            $peng = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hasil FROM pengumuman WHERE user_id='{$d['user_id']}'"));
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama']; ?></td>
                                <td><?= $d['email']; ?></td>
                                <td><?= $d['jurusan']; ?></td>
                                <td><span class="badge bg-success"><?= $d['status']; ?></span></td>
                                <td>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="user_id" value="<?= $d['user_id']; ?>">
                                        <select name="hasil" class="form-select form-select-sm d-inline w-auto" required>
                                            <option value="Lulus" <?= ($peng['hasil'] ?? '') == 'Lulus' ? 'selected' : ''; ?>>Lulus</option>
                                            <option value="Tidak Lulus" <?= ($peng['hasil'] ?? '') == 'Tidak Lulus' ? 'selected' : ''; ?>>Tidak Lulus</option>
                                        </select>
                                        <button type="submit" name="simpan" class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (mysqli_num_rows($query) == 0): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pendaftar yang diverifikasi</td>
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