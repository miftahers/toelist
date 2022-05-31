<?php

include 'config.php';
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
}

if(isset($_POST['submit'])) {
    $owner = $_SESSION['email'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $input_date = date("Y-m-d H:i:s");
    $status = "Belum selesai";

    $sql = "INSERT INTO tugas VALUES(null, '$owner', '$nama', '$deskripsi', '$input_date', '$deadline', '$status', 0)";
    $result = mysqli_query($conn, $sql);
    if($result) {
        header("Location: dashboard.php");
    }
}
?>

<html>
    <head>
        <title>Toelist - Input Tugas</title>
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/TransitionIn.css">
    </head>
    <body>
        <div class="header">
            <div class="toelist-logo">
                <div class="logo"></div>
                <h1>TOELIST<span class="dot">.</span></h1>
            </div>
            <div class="user">
                <h2>Selamat datang, <span><?php echo $_SESSION['username']; ?>!</span></h2>
                <div class="top-btn">
            <a href="edit_profile.php" class="edit-profile">Edit profile</a> <a href="logout.php" class="logout">logout</a>
        </div>
            </div>
        </div>

        <div class="container">
            <div class="contents">
                <div class="tabel">
                <a href="dashboard.php" class="back-to-dashboard">Kembali ke dashboard</a>
                <br>
                <h2 class="h2-input">Input Tugas</h2>
                <br><br>
                <form action="" method="post">
                    <input class="input-tugas-input" type="text" name="nama" placeholder="Mata Kuliah" required>
                    <br>
                    <textarea class= "input-tugas-textarea" name="deskripsi" cols="30" rows="5" placeholder="deskripsi tugas" required></textarea>
                    <br>
                    <input class="input-tugas-input datetime" type="datetime-local" name="deadline" placeholder="Deadline" required>
                    <br>
                    <button class="input-tugas-btn" name="submit">Masukan Tugas Baru</button>
                </form>    
            </div>
            </div>
        </div>
    </body>
</html>