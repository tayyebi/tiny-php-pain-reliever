<?php

// Configuration
$servername = "localhost";
$dbname = "sariab-v2";

// This web app, uses MySQL server users
// If it can connect to MySQL, then user pass
// is valid else not.
// Create connection
$conn = @new mysqli($servername
    , $_SERVER['PHP_AUTH_USER'] // Username
    , $_SERVER['PHP_AUTH_PW'] // Password
    , $dbname);

// Set database charset to support persian.
mysqli_set_charset($conn,"utf8");

?>