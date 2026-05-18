<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';

if (!isset($conn)) {
    if (isset($koneksi) && $koneksi instanceof mysqli) {
        $conn = $koneksi;
    } elseif (isset($db) && $db instanceof mysqli) {
        $conn = $db;
    } else {
        die('Database connection not initialized.');
    }
}

if (!($conn instanceof mysqli)) {
    die('Invalid database connection.');
}

$email    = mysqli_real_escape_string($conn, trim($_POST['email']));
$password = md5($_POST['password']);
$captcha  = $_POST['captcha'];

if ($captcha != $_SESSION['captcha']) {

    echo "
    <script>
        alert('Captcha salah!');
        window.location='login.php';
    </script>
    ";

    exit;
}

$query = mysqli_query($conn, "
    SELECT * FROM users
    WHERE email='$email'
    AND password='$password'
");

$data = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) > 0) {

    $_SESSION['id']    = $data['id'];
    $_SESSION['nama']  = $data['nama'];
    $_SESSION['role']  = $data['role'];

    // FILTER ROLE
    if ($data['role'] == 'admin') {

        header("Location: ../admin/dashboard.php");
    } elseif ($data['role'] == 'user') {

        header("Location: ../user/dashboard.php");
    }
} else {

    echo "
    <script>
        alert('Email atau password salah!');
        window.location='login.php';
    </script>
    ";
}
