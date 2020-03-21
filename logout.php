<?php
// Logout user
// Include config.
include "config.php";
session_start();
session_destroy();
header("Location: " . access_point);
die();