<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM pengumuman WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1";
$query = mysqli_query($conn, $sql);
$data = ($query && mysqli_num_rows($query) > 0) ? mysqli_fetch_assoc($query) : [];
$pendaftaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status FROM pendaftaran WHERE user_id='$user_id'"));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Hasil Seleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .result-container {
            max-width: 600px;
            margin: 60px auto;
            background: white;
            border-radius: 25px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .result-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .lulus {
            color: #28a745;
        }

        .tidak-lulus {
            color: #dc3545;
        }

        .pending {
            color: #ffc107;
        }

        .btn-warning {
            background: #f4b400;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="result-container">
            <?php if (isset($data['hasil'])): ?>
                <?php if ($data['hasil'] == 'Lulus'): ?>
                    <div class="result-icon lulus"><i class="bi bi-trophy-fill"></i></div>
                    <h2 class="fw-bold text-success">SELAMAT!</h2>
                    <h3 class="mb-3">Anda <span class="text-success fw-bold">LULUS</span> Seleksi</h3>
                    <p class="text-secondary">Silahkan lanjutkan ke tahap pembayaran daftar ulang.</p>
                    <a href="pembayaran.php" class="btn btn-warning mt-3 px-4 py-2 text-white">Lanjut Pembayaran</a>
                <?php else: ?>
                    <div class="result-icon tidak-lulus"><i class="bi bi-emoji-frown-fill"></i></div>
                    <h2 class="fw-bold text-danger">MAAF</h2>
                    <h3 class="mb-3">Anda <span class="text-danger fw-bold">TIDAK LULUS</span> Seleksi</h3>
                    <p class="text-secondary">Terima kasih atas partisipasi anda. Tetap semangat!</p>
                <?php endif; ?>
            <?php else: ?>
                <div class="result-icon pending"><i class="bi bi-hourglass-split"></i></div>
                <h3 class="fw-bold">Pengumuman Belum Tersedia</h3>
                <p class="text-secondary">Status anda saat ini: <strong><?= $pendaftaran['status'] ?? 'Belum Lengkap'; ?></strong></p>
                <p>Silahkan lengkapi formulir dan upload berkas terlebih dahulu.</p>
                <a href="dashboard.php" class="btn btn-warning mt-3 px-4 py-2 text-white">Kembali ke Dashboard</a>
            <?php endif; ?>
            <a href="dashboard.php" class="btn btn-outline-secondary mt-3 w-100">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>