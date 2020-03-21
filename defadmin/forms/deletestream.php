<?php
// Delete stream
// Start session!
session_start();
// Include config, database, and twig...
include "../../config.php";
include "../../database.php";
// Include streams class for getting the streams for the dashboard
include "../../Classes/Streams.php";
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$Streams = new Streams();

if(!$_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "index.php");
    die();
}

// Delete stream
$Streams->DeleteStream($id, $dbh);

header("Location: " . access_point . admin_panel);
die();