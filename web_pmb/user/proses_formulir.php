<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['id'];
$nik = mysqli_real_escape_string($conn, trim($_POST['nik']));
$asal_sekolah = mysqli_real_escape_string($conn, trim($_POST['asal_sekolah']));
$jurusan = mysqli_real_escape_string($conn, trim($_POST['jurusan']));

$cek = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE user_id='$user_id'");

if ($cek && mysqli_num_rows($cek) > 0) {
    mysqli_query($conn, "UPDATE pendaftaran SET nik='$nik', asal_sekolah='$asal_sekolah', jurusan='$jurusan', status='Menunggu Verifikasi' WHERE user_id='$user_id'");
} else {
    mysqli_query($conn, "INSERT INTO pendaftaran(user_id, nik, asal_sekolah, jurusan, status) VALUES ('$user_id', '$nik', '$asal_sekolah', '$jurusan', 'Menunggu Verifikasi')");
}

header("Location: dashboard.php");
