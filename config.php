<?php 

date_default_timezone_set('Asia/Jakarta');
 
$server = "localhost";
$user = "root";
$pass = "";
$database = "id19010344_db_toelist";

$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<p>gagal tersambung ke database</p>");
}

#echo '<p>Connected succesfully</p>';
 
?>