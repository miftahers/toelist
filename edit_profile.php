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
    }

}

?>

<html>
    <head>
        <title>Toelist - Edit Profile</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>Edit Profile</h2>
        <div>
            <form action="" method="POST">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email ?>" required disabled>
                <input type="text" placeholder="Username" name="username" value="<?php echo $username ?>"required>
                <input type="text" placeholder="Nomor Telepon 089x-xxxx-xxxx" name="telepon" value="<?php echo $telepon ?>" required>
                <button name="submit">Update</button>
            </form>
            
            <a href="index.php">Halaman utama</a>
        </div>
    </body>
</html>