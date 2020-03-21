<?php
// Update user
// Start session!
session_start();
// Include config, database, and twig...
include "../../config.php";
include "../../database.php";
// Require twig
require_once "../vendor/autoload.php";
// Declare twig and classes
$loader = new Twig\Loader\FilesystemLoader("../" . templates_folder);
$twig = new Twig\Environment($loader);
// Get variables
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);

if(!$_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "index.php");
    die();
}


echo $twig->render('uploadbadge.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'admin_endpoint' => access_point . admin_panel,
    'error' => $error,
));