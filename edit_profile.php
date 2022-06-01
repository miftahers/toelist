<?php

include 'config.php';
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$telepon = $row['telepon'];

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $telepon = $_POST['telepon'];

    $sql = "UPDATE users SET username = '$username', telepon = '$telepon' WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Gagal update profile, coba lagi.')</script>";
    }

}

if(isset($_POST['delete'])) {
    $sql = "DELETE FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header("Location: logout.php");
    } else {
        echo "<script>alert('Gagal delete profile, coba lagi.')</script>";
    }
}

?>

<html>
    <head>
        <title>Toelist - Edit Profile</title>
        <link rel="stylesheet" href="css/edit-profile.css">
        <link rel="stylesheet" href="css/TransitionIn.css">
        <link rel="stylesheet" href="css/header.css">
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
                <h2>Edit <span>Profile</span></h2>
                <form action="" method="POST">
                    <p class="label">Email:</p>
                    <input type="email" placeholder="Email" name="email" class="strict-update" value="<?php echo $email ?>" required disabled>
                    <p class="label">Username:</p>
                    <input type="text" placeholder="Username" name="username" value="<?php echo $username ?>"required>
                    <p class="label">Telepon:</p>
                    <input type="text" placeholder="Nomor Telepon 089x-xxxx-xxxx" name="telepon" value="<?php echo $telepon ?>" required>
                    <button name="submit">Update</button>
                    <button name="delete">Delete Profile</button>
                </form>
                <p class="atau">ATAU</p>
                <p class="home-capsule"><a href="index.php" >Halaman utama</a></p>
            </div>
        </div>
        
    </body>
</html>