<?php

include 'config.php';
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$email = $_SESSION['email'];

$id = $_GET['id'];
$sql = "SELECT * FROM tugas WHERE id='$id' AND owner = '$email'";
$result = mysqli_query($conn, $sql);

if($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $nama = $row['nama'];
    $deskripsi = $row['deskripsi'];
    $deadline = $row['deadline'];
} else {
    header("Location: dashboard.php");
}

if(isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];

    $sql = "UPDATE tugas SET nama = '$nama', deskripsi = '$deskripsi', deadline = '$deadline' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    header("Location: dashboard.php");
}

if(isset($_POST['delete'])) {
    $sql = "DELETE FROM tugas WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        header("Location: dashboard.php");
    }
}

?>


<html>
    <head>
        <title>Toelist - Edit Data</title>
        <link rel="stylesheet" href="./css/edit-data.css">
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
                <a href="dashboard.php">Kembali ke dashboard</a>
                <h2>Edit <span>Data</span></h2>
                <br><br>
                <form action="" method="post">
                    <input type="text" name="nama" placeholder="Mata Kuliah" value="<?php echo $nama ?>" required>
                    <br>
                    <textarea name="deskripsi" cols="30" rows="5" placeholder="deskripsi" required><?php echo $deskripsi ?></textarea>
                    <br>
                    <input type="datetime-local" name="deadline" placeholder="Deadline" value="<?php echo date("Y-m-d\TH:i:s", strtotime($deadline)) ?>" required>
                    <br>
                    <button name="update" class="btn1">Update</button>
                    <button name="delete" onClick='return confirm(`Yakin untuk menghapus tabel?`)'>Delete</button>
                </form>
            </div>
        </div>

        <?php
            // echo $id;
            // echo $nama;
            // echo $deskripsi;
            // echo $deadline;
        ?>
    </body>
</html>