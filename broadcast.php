<?php

include 'config.php';

//require_once ('vendor/autoload.php'); // if you use Composer
require_once('api/ultramsg.php'); // if you download ultramsg.class.php

$ultramsg_token="m644rvsabbl9jwd3"; // Ultramsg.com token
$instance_id="instance8757"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

$sql = "SELECT tugas.*, users.telepon, users.username FROM tugas LEFT JOIN users ON tugas.owner = users.email";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $now = new DateTime(date("Y-m-d H:i:s"));
    //$deadline = date("Y-m-d H:i", strtotime($row['deadline']));
    $deadline = new DateTime($row['deadline']);
    $diff = $deadline->diff($now)->format("%d");

    if($diff <= 3 and $row['reminded'] < 1 or $diff <= 1 and $row['reminded'] < 2) {

        $telepon = '+62'.substr($row['telepon'], 1);
        $deadline2 = date("Y-m-d H:i", strtotime($row['deadline']));

        echo $row['id'];
        echo "<br />";
        echo $row['nama'];
        echo "<br />";
        echo $row['deskripsi'];
        echo "<br />";
        echo $telepon;
        echo "<br />";
        
        $str = <<<EOD
*Toelist App*
Hallo {$row['username']}, deadline tugas {$row['nama']}
tentang {$row['deskripsi']}
sebentar lagi nih.
*Deadline*: {$deadline2}
Semangat yak!
EOD;

        $api=$client->sendChatMessage($telepon,$str);
        print_r($api);

        
        if($diff <= 1 and $row['reminded'] < 2) {
            $sql2 = "UPDATE tugas SET reminded = 2 WHERE id = '$id'";
            mysqli_query($conn, $sql2);
        } elseif($diff <= 3 and $row['reminded'] < 1) {
            $sql2 = "UPDATE tugas SET reminded = 1 WHERE id = '$id'";
            mysqli_query($conn, $sql2);
        }
    }  
}





// $to="+6285156025504"; 
// $body="test drive halo hola"; 
// $api=$client->sendChatMessage($to,$str);
// print_r($api);


?>