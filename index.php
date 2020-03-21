<?php
// Index for DolphinStream

// Start session
session_start();
// Include classes
include "config.php";
require_once 'vendor/autoload.php';
include_once "database.php";
include "Classes/Streams.php";
// Declare classes and variables
$loader = new Twig\Loader\FilesystemLoader(templates_folder);
$twig = new Twig\Environment($loader);
$Streams = new Streams();
$logged_in = $_SESSION["logged_in"];



echo $twig->render('index.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'logged_in' => $logged_in, // Needed to hide login item in navbar if user is logged in
    'access_point' => access_point,
    'streams' => $Streams->GetStreams($dbh),
));
