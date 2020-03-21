<?php
// Update user
// Start session!
session_start();
// Include config, database, and twig...
include "../../config.php";
include "../../database.php";
// Include users class
include "../Classes/UserAccount.php";
// Require twig
require_once "../vendor/autoload.php";
// Declare twig and classes
$loader = new Twig\Loader\FilesystemLoader("../" . templates_folder);
$twig = new Twig\Environment($loader);
$UserAccount = new UserAccount_AdminPanel();
// Get variables
$error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);
if(!$_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "index.php");
    die();
}

// Update if update_btn was clicked
if(isset($_GET["update_btn"])) {
    $userrole = filter_input(INPUT_GET, "userrole", FILTER_SANITIZE_STRING);
    // Check if user actually exists
    if(!$UserAccount->UserExists($username, $dbh)) {
        header("Location: " . access_point . admin_panel . "dashboard.php?error=updateuserrole");
        die();
    }


    if($UserAccount->UpdateUserRole($username, $userrole, $dbh)) {
        header("Location: " . access_point . admin_panel . "dashboard.php?success=updateduserrole");
        die();
    } else {
        header("Location: " . access_point . admin_panel . "dashboard.php?error=updateuserrole");
        die();
    }

}

echo $twig->render('updateuserrole.twig', array(
    'site_name' => site_name,
    'templates_folder' => templates_folder,
    'year' => date("Y"),
    'admin_endpoint' => access_point . admin_panel,
    'error' => $error,
    'user_roles' => $user_roles,
));