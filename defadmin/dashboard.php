<?php
// Admin dashboard
// Start session!
session_start();
// Include config, database, and twig...
include "../config.php";
include "../database.php";
// Include streams class for getting the streams for the dashboard
include "../Classes/Streams.php";
// Require twig
require_once "../vendor/autoload.php";
// Declare twig
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
// Declare streams
$Streams = new Streams();
// Get error input
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);
$success = filter_input(INPUT_GET, "success", FILTER_SANITIZE_STRING);

// Check if user is logged in.
if(!$_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "index.php");
    die();
}

echo $twig->render('dashboard.twig', array(
    'streams' => $Streams->GetStreams($dbh),
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'admin_endpoint' => access_point . admin_panel,
    'error' => $error,
    'success' => $success,
));