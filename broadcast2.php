<?php

include 'config.php';

require_once 'twilio/twilio-php/src/Twilio/autoload.php';
use Twilio\Rest\Client;

// Create a client with your Account SID and Auth Token from twilio.com/console
$sid = 'AC66437ef08378765768334cdb038b4fcd';
$token = '0ab8255e9948ef43fdf41a11c2279c9e';
$client = new Client($sid, $token);

$client->messages->create(
    '+6282128556921',
    array(
        'from' => '+19784812296',
        'body' => 'Your homework is coming up on July 21 at 3PM',
    )
);

echo "broadcast";
?>