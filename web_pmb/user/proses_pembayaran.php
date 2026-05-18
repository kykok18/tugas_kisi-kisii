<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['id'];
$uploadsDir = __DIR__ . '/../assets/upload/';

if (!empty($_FILES['bukti']['name']) && is_uploaded_file($_FILES['bukti']['tmp_name'])) {
    $ext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
    $name = time() . '_' . $user_id . '_pembayaran.' . $ext;
    $target = $uploadsDir . $name;

    if (move_uploaded_file($_FILES['bukti']['tmp_name'], $target)) {
        $cek = mysqli_query($conn, "SELECT * FROM pembayaran WHERE user_id='$user_id'");
        if (mysqli_num_rows($cek) > 0) {
            mysqli_query($conn, "UPDATE pembayaran SET bukti_pembayaran='$name', status_pembayaran='Pending' WHERE user_id='$user_id'");
        } else {
            mysqli_query($conn, "INSERT INTO pembayaran(user_id, bukti_pembayaran, status_pembayaran) VALUES ('$user_id', '$name', 'Pending')");
        }
    }
}

header('Location: pembayaran.php');
