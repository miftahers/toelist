<?php 

date_default_timezone_set('Asia/Jakarta');
 
$server = "localhost";
$user = "u187056228_Toelist";
$pass = "Toelist123";
$database = "u187056228_toelist";

$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<p>gagal tersambung ke database</p>");
}

#echo '<p>Connected succesfully</p>';
 
?>