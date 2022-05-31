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
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>Edit Data</h2>
        <a href="dashboard.php">Kembali ke dashboard</a>
        <br><br>
        <form action="" method="post">
            <input type="text" name="nama" placeholder="Mata Kuliah" value="<?php echo $nama ?>" required>
            <br>
            <textarea name="deskripsi" cols="30" rows="5" placeholder="deskripsi" required><?php echo $deskripsi ?></textarea>
            <br>
            <input type="datetime-local" name="deadline" placeholder="Deadline" value="<?php echo date("Y-m-d\TH:i:s", strtotime($deadline)) ?>" required>
            <br>
            <button name="update">Update</button>
            <button name="delete" onClick='return confirm(`Yakin untuk menghapus tabel?`)'>Delete</button>
        </form>


        <?php
            echo $id;
            echo $nama;
            echo $deskripsi;
            echo $deadline;
        ?>
    </body>
</html>