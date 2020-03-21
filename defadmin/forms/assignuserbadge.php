<?php

// Start session!
session_start();
// Include config, database, and twig...
include "../../config.php";
include "../../database.php";
// Include streams class for getting the streams for the dashboard
include "../../Classes/UserAccount.php";
// Require twig
require_once "../vendor/autoload.php";
// Declare twig and classes
$loader = new Twig\Loader\FilesystemLoader("../" . templates_folder);
$twig = new Twig\Environment($loader);
$UserAccount = new UserAccount();
// Get variables
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$badge_name = filter_input(INPUT_POST, "badgename", FILTER_SANITIZE_STRING);
$stream_id = filter_input(INPUT_POST, "streamid", FILTER_SANITIZE_NUMBER_INT);
$filename = filter_input(INPUT_POST, "filename", FILTER_SANITIZE_STRING);

if (!$_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "index.php");
    die();
}

// Update if update_btn was clicked
if (isset($_POST["add_badge"])) {

    if ($UserAccount->AddUserBadge($username, $badge_name, $stream_id, $filename, $dbh)) {
    header("Location: " . access_point . admin_panel . "dashboard.php");
    die();
    } else {
        header("Location: " . access_point . admin_panel . "forms/assignuserbadge.php?error=badge");
        die();
    }

}

echo $twig->render('assignuserbadge.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'admin_endpoint' => access_point . admin_panel,
    'error' => $error,
));