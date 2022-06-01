<?php

include 'config.php';

session_start();

if(!isset($_SESSION['email'])){
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

?>

<html>
    <head>
        <title>Toelist - Dashboard</title>
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/detail-tugas.css">
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
                    <a href="edit_profile.php" class="edit-profile">Edit profile</a>
                    <a href="logout.php" class="logout">logout</a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="contents">
                <h2>Detail <span>Tugas</span></h2>
                <table>
                    <tr>
                        <td class="label">
                            Mata Kuliah
                        </td>
                    </tr>
                    <tr>
                        <td class="content matkul">
                            <?php echo $nama; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Deskripsi</td>
                    </tr>
                    <tr>
                        <td class="content deskripsi">
                            <?php echo $deskripsi; ?>
                        </td>
                    <tr>
                        <td class="label">Deadline</td>
                    </tr>
                    <tr>
                        <td class="content deadline">
                            <?php echo $deadline; ?>
                        </td>
                    </tr>
                </table>
                <a href="dashboard.php" class="back-to-dashboard">Kembali ke dashboard</a>
            </div>
        </div>        
    </body>
</html>