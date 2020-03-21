<?php
// Start session!
session_start();
// Include config
include "config.php";
require_once 'vendor/autoload.php';
include_once "database.php";
include "Classes/UserAccount.php";
include "Classes/Chat.php";
include "Classes/Streams.php";
// Declare classes and variables
$stream_id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
// Load twig
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
$UserAccount = new UserAccount();
$Chat = new Chat();
$Streams = new Streams();

// If logged in, redirect to dashboard
if (!$_SESSION["logged_in"]) {
    header("Location: " . access_point . "login.php");
    die();
}

if(!$Streams->CheckIfStreamExists($stream_id, $dbh)) {
    header("Location: " . access_point . "streams.php");
    die();
}

echo $twig->render('chat.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'access_point' => access_point,
    'error' => $error,
    'chat_messages' => $Chat->GetMessages($stream_id, $dbh),
    'stream_name' => $Streams->GetStreamName($stream_id, $dbh),
    'stream_id' => $stream_id,
    'enable_captcha_for_chat' => enable_captcha_for_chat,
    'user_badges' => $UserAccount->GetUserBadges($username, $stream_id, $dbh),
));