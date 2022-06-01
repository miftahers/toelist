<?php

include 'config.php';
session_start();

if(isset($_SESSION['email'])) {
    header("Location: dashboard.php");
}

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $telepon = $_POST['telepon'];

    if($password == $password2) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if(!$result->num_rows > 0) {
            $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                echo "<script>alert('Register sukses'); window.location = 'login.php';</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['password2'] = "";
                $telepon = "";
            } else {
                echo "<script>alert('Error occured')</script>";
            }
        } else {
            echo "<script>alert('Email sudah terdaftar')</script>";
        }
    } else {
        echo "<script>alert('Password konfirmasi sudah benar')</script>";
    }
}
?>

<html>
    <head>
        <title>Toelist - Daftar</title>
        <link rel="stylesheet" href="./css/style-login.css">
        <link rel="stylesheet" href="./css/TransitionIn.css">
    </head>
    <body>
        <div class="header">
            <div class="toelist-logo">
                <div class="logo"></div>
                <h1>TOELIST<span class="dot">.</span></h1>
            </div>
        <div class="container">
        <h2>Buat <span>Akun</span></h2>
            <form action="" method="POST">
                <label for="username">Nama Pengguna:</label>
                <input type="text" placeholder="Contoh: Miftah123" name="username" required>
                <label for="email">Email:</label>
                <input type="email" placeholder="Contoh: example@email.com" name="email" required>
                <label for="password">Kata Sandi:</label>
                <input type="password" placeholder="Tulis Kata Sandi Baru" name="password" required>
                <label for="password2">Konfirmasi Kata Sandi:</label>
                <input type="password" placeholder="Tulis Kembali Kata Sandi Baru" name="password2" required>
                <label for="telepon">Nomor WhatsApp:</label>
                <input type="text" placeholder="Contoh: 081XXXXXXXXX" name="telepon" required>
                <button name="submit">Daftar</button>
            </form>
            <p>Sudah punya akun?</p>
            <a href="login.php" class="login-btn">Masuk</a>
            <p>atau</p>
            <p><a href="index.php" class="home">Halaman utama</a></p>
            <br>
        </div>
        <p>Dibuat oleh Kelompok 2 - Toelist</p>
        <br>
    </body>
</html>