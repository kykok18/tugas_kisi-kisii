<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berkas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .form-container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #f4b400;
            background: #fffbf0;
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
                <i class="bi bi-upload fs-1 text-warning"></i>
                <h2 class="fw-bold mt-2">Upload Berkas</h2>
                <p class="text-secondary">Upload dokumen persyaratan (Foto, Ijazah, KTP)</p>
            </div>
            <form action="proses_upload.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto (3x4)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Ijazah</label>
                    <input type="file" name="ijazah" class="form-control" accept=".pdf,.jpg,.png" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">KTP</label>
                    <input type="file" name="ktp" class="form-control" accept=".pdf,.jpg,.png" required>
                </div>
                <button type="submit" class="btn btn-warning w-100 py-2 text-white fw-semibold">
                    <i class="bi bi-cloud-upload"></i> Upload Berkas
                </button>
                <a href="dashboard.php" class="btn btn-outline-secondary w-100 mt-2">Kembali</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>