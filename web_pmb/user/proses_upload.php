<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['id'];
$uploadsDir = __DIR__ . '/../assets/upload/';
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

$files = ['foto', 'ijazah', 'ktp'];
$saved = [];

foreach ($files as $f) {
    if (!empty($_FILES[$f]['name']) && is_uploaded_file($_FILES[$f]['tmp_name'])) {
        $ext = pathinfo($_FILES[$f]['name'], PATHINFO_EXTENSION);
        $name = time() . '_' . $user_id . '_' . $f . '.' . $ext;
        $target = $uploadsDir . $name;
        if (move_uploaded_file($_FILES[$f]['tmp_name'], $target)) {
            $saved[$f] = $name;
        }
    }
}

$cek = mysqli_query($conn, "SELECT * FROM berkas WHERE user_id='$user_id'");
if (mysqli_num_rows($cek) > 0) {
    mysqli_query($conn, "UPDATE berkas SET foto='{$saved['foto']}', ijazah='{$saved['ijazah']}', ktp='{$saved['ktp']}' WHERE user_id='$user_id'");
} else {
    mysqli_query($conn, "INSERT INTO berkas(user_id, foto, ijazah, ktp) VALUES ('$user_id', '{$saved['foto']}', '{$saved['ijazah']}', '{$saved['ktp']}')");
}

header('Location: dashboard.php');
