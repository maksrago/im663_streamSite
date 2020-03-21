<?php
// Start session!
session_start();
// Include config, database, and twig...
include "../config.php";
include "../database.php";
include "../Classes/Chat.php";
include "../Classes/Streams.php";
include "../captcha/securimage.php";
// Declare classes
$Chat = new Chat();
$Streams = new Streams();
$securimage = new Securimage();

$stream_id = isset($_POST["stream_id"]) ? (int)$_POST["stream_id"] : null;
$message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
$user = $_SESSION["username"];

if (!$_SESSION["logged_in"]) {
    header("Location: " . access_point . "login.php");
    die();
}

if(!$Streams->CheckIfStreamExists($stream_id, $dbh) || !$Streams->StreamEnabledChat($stream_id, $dbh)) {
    header("Location: " . access_point . "streams.php");
    die();
}

if(empty($message)) {
    header("Location: " . access_point . "chat.php?id=" . $stream_id);
    die();
}

if(enable_captcha_for_chat) {
    if ($securimage->check($_POST['captcha_code']) == false) {
        header("Location: " . access_point . "chat.php?id=" . $stream_id);
        die();
    }
}

if($Chat->SendMessage($message, $user, $stream_id, $dbh)) {
header("Location: " . access_point . "chat.php?id=" . $stream_id);
die();
}