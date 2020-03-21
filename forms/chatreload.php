<?php

// Start session!
session_start();
// Include config
include "../config.php";
include_once "../database.php";
include "../Classes/UserAccount.php";
include "../Classes/Chat.php";
include "../Classes/Streams.php";
// Declare classes and variables
$stream_id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
$UserAccount = new UserAccount();
$Chat = new Chat();
$Streams = new Streams();

// If logged in, redirect to dashboard
if (!$_SESSION["logged_in"]) {
    header("Location: " . access_point . "login.php");
    die();
}

if (!$Streams->CheckIfStreamExists($stream_id, $dbh)) {
    header("Location: " . access_point . "streams.php");
    die();
}
foreach($Chat->GetMessagesReload($stream_id, $dbh) as $message) {
    foreach($UserAccount->GetUserBadges($username, $stream_id, $dbh) as $badge) {
        if($badge["username"] == $message["user"]) {
            echo "<p><img src=badges/" . $badge["filename"] . ">" . $message["user"] . ": " . $message["date"] . ": " . $message["message"] . "</p>";
        } else {
            echo "<p>" . $message["user"] . ": " . $message["date"] . ": " . $message["message"] . "</p>";
        }
    }
}