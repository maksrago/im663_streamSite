<?php
// Start session
session_start();
// Include classes
include "config.php";
require_once 'vendor/autoload.php';
include_once "database.php";
include "Classes/Streams.php";
include "Classes/UserAccount.php";
// Declare classes
$UserAccount = new UserAccount();
$Streams = new Streams();
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
$api_key = $_GET["api_key"];
// Declare variables
$username = $_SESSION["username"];

// Check secret API key
if(!isset($api_key) || $api_key !== secret_api_key) {
    die("INVALID_API_KEY");
}

if(!isset($action)) {
    echo "NO_ACTION_SPECIFIED";
}


if($action == "is_user_logged_in") {
    // If user is not logged in, return 0 (false).
    echo $_SESSION["logged_in"] ? (int)$_SESSION["logged_in"] : 0;
}
// Get username from session
if($action == "get_username") {
echo $username;
}
// Get user role
if($action == "get_user_role") {
echo $UserAccount->GetUserRole($username, $dbh);
}

// Get user subscription
if($action == "get_user_subscription") {
    //echo $UserAccount->GetUserSubscription($username, $dbh);
    echo "NOT_ADDED_YET";
}