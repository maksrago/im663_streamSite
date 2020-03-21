<?php
// Displays login page.
// Start session
session_start();
// Include config
include "../config.php";
// Require twig
require_once "../vendor/autoload.php";
// Declare twig
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
// Get error input
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);

// If user is logged in, then redirect to dashboard.
if($_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "dashboard.php");
    die();
}

echo $twig->render('login.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'admin_endpoint' => access_point . admin_panel,
    'error' => $error,
));