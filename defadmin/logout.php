<?php
// Logout user
session_start();
session_destroy();
die("You have been logged out. Please close your browser window/tab now. :)");