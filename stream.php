<?php
// This file shows the stream page
// Start session!
session_start();
// Include config
include "config.php";
require_once 'vendor/autoload.php';
include_once "database.php";
include "Classes/Streams.php";

// Declare classes and variables
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
// Load twig
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
$Streams = new Streams();

// If logged in, redirect to dashboard
if ($_SESSION["logged_in"]) {
    header("Location: " . access_point . "dashboard.php");
    die();
}

echo $twig->render('stream.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'access_point' => access_point,
    'error' => $error,
    'stream' => $Streams->GetStreamInfo($id, $dbh),
));