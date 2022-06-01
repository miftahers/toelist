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
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/TransitionIn.css">
    </head>
    <body>
        <h2>Detail Tugas</h2>
        <table>
            <tr>
                <td>Mata Kuliah</td>
                <td>:</td>
                <td><?php echo $nama ?></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>:</td>
                <td><?php echo $deskripsi ?></td>
            </tr>
            <tr>
                <td>Deadline</td>
                <td>:</td>
                <td><?php echo $deadline ?></td>
            </tr>
        </table>
    </body>
</html>