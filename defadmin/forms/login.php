<?php
// Processes POST from login.php, then sends it to the UserAccount Class.
// Start session
session_start();
// Include files
include "../../config.php";
// REQUIRED for most classes to work!
include_once "../../database.php";
include "../Classes/UserAccount.php";
// Get variables
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = $_POST["password"]; // No need to sanitize because we will be using prepared statements and password_verify
// Declare classes
$UserAccount = new UserAccount_AdminPanel();
// Ensure that some user hasn't attempted to bypass the already logged in check
if ($_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "dashboard.php");
    die();
}

if($UserAccount->LoginUser($username, $password, $dbh)) {
    $_SESSION["logged_in_admin"] = true;
    $_SESSION["username"] = $username;
    header("Location: " . access_point . admin_panel . "dashboard.php");
    die();
} else {
    header("Location: " . access_point . admin_panel . "login.php?error=invalid_login");
    die();
}
