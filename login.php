<?php

include 'config.php';
session_start();

if(isset($_SESSION['email'])) {
    header("Location: dashboard.php");
}

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Email atau password salah')</script>";
    }
}



?>

<html>
    <head>
        <title>Toelist - Login</title>
        <link rel="stylesheet" href="./css/style-login.css">
        <link rel="stylesheet" href="./css/TransitionIn.css">
    </head>
    <body>
        <div class="header">
            <div class="toelist-logo">
                <div class="logo"></div>
                <h1>TOELIST<span class="dot">.</span></h1>
            </div>
        </div>
        <div class="container">
            <h2>Log<span>In</span></h2>
            <form action="" method="POST">
                <label for="email">Email:</label>
                <input type="email" placeholder="example@email.com" name="email" required>
                <label for="password">Password:</label>
                <input type="password" placeholder="Password" name="password" required>
                <button name="submit">Login</button>
            </form>
            <p>Belum punya akun? <a href="register.php" class="reg-btn">Register</a> </p>
            <p>atau</p>
            <p><a href="index.php" class="home">Halaman utama</a></p>
            <br>
        </div>
        <p>Made by Kelompok 2 - Toelist</p>
    </body>
</html>