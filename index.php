<?php

session_start();

if(isset($_SESSION['email'])) {
    header("Location: dashboard.php");
}

?>

<html>
    <head>
        <title>Toelist</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/TransitionIn.css">
    </head>
    <body>
        <div class="container">
            <div class="toelist-logo">
                <div class="logo"></div>
                <h1>TOELIST<span class="dot">.</span></h1>
            </div>
            <div class="login">
                <a href="login.php" class="login-btn">Login</a>
                <a href="register.php" class="reg-btn">Register</a>
            </div>
        </div>
    </body>
</html>