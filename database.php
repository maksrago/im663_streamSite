<?php
try {
    $dbh = new PDO("mysql:host=" . mysql_host . ";dbname=" . mysql_database, mysql_username, mysql_user_password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    echo "A system error has occurred.";
}