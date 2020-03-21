<?php
// Create stream!

// Start session!
session_start();
// Include config, database, and twig...
include "../../config.php";
include "../../database.php";
// Include streams class for getting the streams for the dashboard
include "../../Classes/Streams.php";
// Require twig
require_once "../vendor/autoload.php";
// Declare twig and classes
$loader = new Twig\Loader\FilesystemLoader("../" . templates_folder);
$twig = new Twig\Environment($loader);
$Streams = new Streams();
// Get variables
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);

if(!$_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "index.php");
    die();
}

// Update if update_btn was clicked
if(isset($_POST["create_btn"])) {
    $stream_name = filter_input(INPUT_POST, "streamname", FILTER_SANITIZE_STRING);
    $stream_description = filter_input(INPUT_POST, "streamdescription", FILTER_SANITIZE_STRING);
    $stream_username = filter_input(INPUT_POST, "streamusername", FILTER_SANITIZE_STRING);
    $stream_embedcode = $_POST["streamembed"];
    $stream_enablechat = isset($_POST["enable_chat"]) ? (int)$_POST["enable_chat"] : 0;
    if($Streams->CreateStream($stream_name, $stream_description, $stream_username, $stream_embedcode, $stream_enablechat, $dbh)) {
        header("Location: " . access_point . admin_panel . "dashboard.php?success=updatedstream");
        die();
    }

}

echo $twig->render('createstream.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'admin_endpoint' => access_point . admin_panel,
    'error' => $error,
));