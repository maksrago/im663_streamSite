<?php
// Processes POST from register.php, then sends it to the  Class.
// Start session
session_start();
// Include files
include "../config.php";
// REQUIRED for most classes to work!
include_once "../database.php";
include_once '../captcha/securimage.php';
include "../Classes/UserAccount.php";
// Get variables
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$realname = filter_input(INPUT_POST, "realname", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = $_POST["password"]; // No need to sanitize because we will be using prepared statements and password_verify
// Declare classes
$securimage = new Securimage();
$UserAccount = new UserAccount();
// Ensure that some user hasn't attempted to bypass the already logged_in check
if ($_SESSION["logged_in"]) {
    header("Location: " . access_point . "dashboard.php");
    die();
}
// Check if captcha is correct
if ($securimage->check($_POST['captcha_code']) == false) {
    $login_error = true;
    header("Location: " . access_point . "register.php?error=captcha");
    die();
}
// Check if email is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: " . access_point . "register.php?error=bad_email");
    die();
}
// Okay, time to check if the user checked the TOS checkbox
if(!isset($_POST["tos_checkbox"])) {
    header("Location: " . access_point . "register.php?error=tos_not_checked");
    die();
}
// Check if user inputted data before registering user
if(!empty($realname) && !empty($username) && !empty($password) && !empty($email)) {
    if ($UserAccount->RegisterUser($username, $email, $password, $realname, user_role, $dbh)) {
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;
        header("Location: " . access_point . "login.php");
        die();
    } else {
        header("Location: " . access_point . "register.php?error=system_error");
        die();
    }
} else {
    header("Location: " . access_point . "register.php?error=invalid_input");
    die();
}