<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

$user_id = $_SESSION['id'];
$pembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pembayaran WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1"));
$pengumuman = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hasil FROM pengumuman WHERE user_id='$user_id'"));
$status_pembayaran = $pembayaran['status_pembayaran'] ?? 'Belum Bayar';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Daftar Ulang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .payment-container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .bank-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        .btn-warning {
            background: #f4b400;
            border: none;
        }

        .btn-warning:hover {
            background: #d89c00;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="payment-container">
            <div class="text-center mb-4">
                <i class="bi bi-wallet2 fs-1 text-warning"></i>
                <h2 class="fw-bold mt-2">Pembayaran Daftar Ulang</h2>
            </div>

            <?php if (($pengumuman['hasil'] ?? '') != 'Lulus'): ?>
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Anda belum dinyatakan LULUS seleksi. Silahkan cek pengumuman terlebih dahulu.
                </div>
                <a href="pengumuman.php" class="btn btn-warning w-100 py-2 text-white">Cek Pengumuman</a>
            <?php else: ?>
                <div class="bank-info">
                    <h5 class="fw-bold mb-3"><i class="bi bi-bank2"></i> Informasi Pembayaran</h5>
                    <p class="mb-1"><strong>Bank BNI</strong> - 1234567890 a.n Yayasan Pendidikan</p>
                    <p class="mb-1"><strong>Bank Mandiri</strong> - 9876543210 a.n PMB Kampus</p>
                    <p class="mb-0"><strong>Nominal</strong> : Rp 2.500.000</p>
                </div>

                <?php if ($status_pembayaran == 'Pending'): ?>
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-clock-history"></i> Pembayaran anda sedang diverifikasi...
                    </div>
                <?php elseif ($status_pembayaran == 'Lunas'): ?>
                    <div class="alert alert-success text-center">
                        <i class="bi bi-check-circle-fill"></i> Pembayaran anda sudah LUNAS! Selamat bergabung.
                    </div>
                <?php else: ?>
                    <form action="proses_pembayaran.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Upload Bukti Transfer</label>
                            <input type="file" name="bukti" class="form-control" accept="image/*,.pdf" required>
                            <small class="text-secondary">Upload bukti transfer (jpg, png, pdf) maks 2MB</small>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 py-2 text-white fw-semibold">
                            <i class="bi bi-cloud-upload"></i> Upload Bukti Pembayaran
                        </button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
            <a href="dashboard.php" class="btn btn-outline-secondary w-100 mt-3">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>