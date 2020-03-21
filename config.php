<?php
// Config file that sets certain options

// This sets the admin panel URL, e.g. /admin/
define("admin_panel", "defadmin/");
// Site access point - set it!
define("access_point", "/DefStream/");
// Templates folder
define("templates_folder", "templates");
// Site name
define("site_name", "DefStream");
// Register endpoint
define("register_endpoint", "register.php");

// Default user role
define("user_role", "user");

// Secret API key
define("secret_api_key", "myapikey");

// PayPal config
// Not added yet. Hey future dev, put it here.

// User config
$user_roles = array(
    "admin",
    "user",
);

define("enable_captcha_for_chat", false);

define("badge_dir", "badges/");

// Max badge size in bytes; default is 256KB
define("max_badge_size", 262144);

// Database configuration
// MySQL server. Usually localhost/127.0.0.1
define("mysql_host", "127.0.0.1");
// MySQL database
define("mysql_database", "defstream");
// MySQL username
define("mysql_username", "");
// MySQL user password
define("mysql_user_password", "ddd");
