<?php

include 'config.php';
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$email = $_SESSION['email'];


?>

<html>
    <head>
        <title>Toelist - Log</title>
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/TransitionIn.css">
        <link rel="stylesheet" href="./css/header.css">
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
                    <h2 class="h2-log">Log</h2>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Mata kuliah</th>
                            <th>Deskripsi</th>
                            <th>Date</th>
                        </tr>
                        <?php

                        $sql = "SELECT * FROM tugas_selesai WHERE owner = '$email' ORDER BY DATE DESC";
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        while($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>".$row['nama']."</td>";
                            echo "<td>".$row['deskripsi']."</td>";
                            // echo "<td>".$row['deadline']."</td>";
                            echo "<td>".date("Y-m-d H:i", strtotime($row['date']))."</td>";
                            echo "</tr>";
                            $i = $i + 1;
                        }
                        
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>