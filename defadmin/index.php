<?php
// Admin panel index - redirects user to dashboard if logged in otherwise to login page
// Start session!
session_start();
// Include config
include "../config.php";
// Check if user is logged in, then redirect to dashboard.
if($_SESSION["logged_in_admin"]) {
    header("Location: " . access_point . admin_panel . "dashboard.php");
    die();
} else {
    header("Location: " . access_point . admin_panel . "login.php");
    die();
}