<?php
// Change password
// Start session!
session_start();
// Include config, database, and twig...
include "../config.php";
include "../database.php";
include "../Classes/UserAccount.php";
// Declare classes
$UserAccount = new UserAccount();

$current_password = $_POST["currentpassword"];
$new_password = $_POST["newpassword"];

if (!$_SESSION["logged_in"]) {
    header("Location: " . access_point . "login.php");
    die();
}

if($UserAccount->LoginUser($_SESSION["username"], $current_password, $dbh)) {
$UserAccount->ChangeUserPassword($_SESSION["username"], $new_password, $dbh);
header("Location: " . access_point . "logout.php");
die();
} else {
    header("Location: " . access_point . "dashboard.php?error=password_change");
    die();
}