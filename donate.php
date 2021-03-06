<?php
// Shows donation page which sends data off to forms/donate.php
// Start session!
session_start();
// Include config
include "config.php";
require_once 'vendor/autoload.php';
include_once "database.php";
// Declare classes and variables
// Load twig
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
$logged_in = $_SESSION["logged_in"];
// If logged in, show username in menu bar (not done by default)
if ($_SESSION["logged_in"]) {
    $username = $_SESSION["username"];
}


echo $twig->render('donate.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'logged_in' => $logged_in, // Needed to show username in menu
    'username' => $username,
    'access_point' => access_point,
));