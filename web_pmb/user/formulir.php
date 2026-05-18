<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}
require_once __DIR__ . '/../config/koneksi.php';

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM pendaftaran WHERE user_id='$user_id'";
$data = mysqli_query($conn, $sql);
$d = ($data && mysqli_num_rows($data) > 0) ? mysqli_fetch_assoc($data) : [];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .form-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
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
        <div class="form-container">
            <div class="text-center mb-4">
                <i class="bi bi-file-earmark-text-fill fs-1 text-warning"></i>
                <h2 class="fw-bold mt-2">Formulir Pendaftaran</h2>
                <p class="text-secondary">Isi data diri dengan benar</p>
            </div>
            <form action="proses_formulir.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIK</label>
                    <input type="text" name="nik" class="form-control" value="<?= $d['nik'] ?? ''; ?>" required placeholder="Masukkan NIK">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" class="form-control" value="<?= $d['asal_sekolah'] ?? ''; ?>" required placeholder="Masukkan asal sekolah">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <select name="jurusan" class="form-select" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="Teknik Informatika" <?= ($d['jurusan'] ?? '') == 'Teknik Informatika' ? 'selected' : ''; ?>>Teknik Informatika</option>
                        <option value="Sistem Informasi" <?= ($d['jurusan'] ?? '') == 'Sistem Informasi' ? 'selected' : ''; ?>>Sistem Informasi</option>
                        <option value="Manajemen" <?= ($d['jurusan'] ?? '') == 'Manajemen' ? 'selected' : ''; ?>>Manajemen</option>
                        <option value="Akuntansi" <?= ($d['jurusan'] ?? '') == 'Akuntansi' ? 'selected' : ''; ?>>Akuntansi</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning w-100 py-2 text-white fw-semibold">
                    <i class="bi bi-save"></i> Simpan Formulir
                </button>
                <a href="dashboard.php" class="btn btn-outline-secondary w-100 mt-2">Kembali</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>