<?php
require_once __DIR__ . '/../config/koneksi.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$status = mysqli_real_escape_string($conn, $_POST['status']);

if ($id > 0) {
    mysqli_query($conn, "UPDATE pendaftaran SET status='$status' WHERE id='$id'");
}

header("Location: verifikasi.php");
