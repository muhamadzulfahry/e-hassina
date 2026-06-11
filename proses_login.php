<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Akun bypass sementara untuk tes masuk dashboard
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location.href='login.php';</script>";
    }
} else {
    header("Location: login.php");
    exit;
}
?>