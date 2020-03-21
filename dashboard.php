<?php
// Account dashboard
// Start session!
session_start();
// Include files
include "config.php";
require_once 'vendor/autoload.php';
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
// Check if user is logged in
if (!$_SESSION["logged_in"]) {
    header("Location: " . access_point . "login.php");
    die();
}
// Get error input
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);
$success = filter_input(INPUT_GET, "success", FILTER_SANITIZE_STRING);


echo $twig->render('dashboard.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'logged_in' => $_SESSION["logged_in"], // Needed to hide login item in navbar if user is logged in
    'access_point' => access_point,
    'username' => $_SESSION["username"],
    'error' => $error,
    'success' => $success,
));