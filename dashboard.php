<!-- Connection -->
<?php
include 'config.php';
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: login.php");
}
$email = $_SESSION['email'];
function updatedData($id) {
    $sql = "UPDATE tugas SET status = 'selesai' WHERE id = '$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $sql2 = "DELETE FROM tugas WHERE id = '$id'";
    $result2 = mysqli_query($GLOBALS['conn'], $sql2);
    if($result && $result2) {
        header("Location: dashboard.php");
    }
}
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    updatedData($id);
}
?>
<!-- End of connection -->

<!-- HTML -->
<html>
    <!-- Head -->
    <head>
        <title>Toelist - Dashboard</title>
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/TransitionIn.css">
    </head>

    <!-- Body -->
    <body>
        <!-- Header -->
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
        
        <!-- Content -->
        <div class="container">
            <div class="contents">
                <div class="tabel">
                    <div class="btn">
                        <a href="history.php">History</a> <a href="input_tugas.php">Tugas baru</a>
                    </div>
                        <h3>List Tugas</h3>
                        <table>
                            <?php
                            $sql = "SELECT * FROM tugas WHERE owner = '$email'";
                            $result = mysqli_query($conn, $sql);
                            if($result->num_rows > 0) {
                                echo "
                                <tr>
                                    <th>No</th>
                                    <th>Mata kuliah</th>
                                    <th>Deskripsi</th>
                                    <th>Deadline</th>
                                    <th>Action</th>
                                </tr>
                                ";
                                $i = 1;
                                while($row = mysqli_fetch_array($result)) {
                                    $id = $row['id'];
                                    echo "<tr>";
                                    echo "<td>$i</td>";
                                    echo "<td>".$row['nama']."</td>";
                                    echo "<td>".$row['deskripsi']."</td>";
                                    // echo "<td>".$row['deadline']."</td>";
                                    echo "<td>".date("Y-m-d H:i", strtotime($row['deadline']))."</td>";
                                    echo "<td>
                                        <a href='edit_data.php?id=$id'>
                                        Edit
                                        </a>
                                        <a href='?delete=$id' onClick='return confirm(`Yakin untuk menyudahinya?`)'>
                                        Selesai
                                        </a>
                                    </td>";
                                    echo "</tr>";
                                    $i = $i + 1;
                                }
                                
                            } else {
                                echo "<p>Alhamdulillah tidak ada tugas</p>";
                            }
                            ?>
                        </table>
                    </div>  
            </div>
        </div>

    </body>
</html>