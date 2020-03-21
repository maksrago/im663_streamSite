<?php
// Shows registration form
// Start session!
session_start();
// Include config
include "config.php";
require_once 'vendor/autoload.php';
include_once "database.php";
// Declare classes and variables
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);
// Load twig
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
// If logged in, redirect to dashboard
if ($_SESSION["logged_in"]) {
    header("Location: " . access_point . "dashboard.php");
    die();
}

echo $twig->render('register.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'access_point' => access_point,
    'error' => $error,
));