<?php

// Configuration
$servername = "localhost";
$dbname = "tint";

// This web app, uses MySQL server users
// If it can connect to MySQL, then user pass
// is valid else not.
// Create connection
$conn = @new mysqli($servername
    , $_SERVER['PHP_AUTH_USER'] // Username
    , $_SERVER['PHP_AUTH_PW'] // Password
    , $dbname);

// Set database charset to support persian.
// mysqli_set_charset($conn,"utf8");

// Define download path
define('_DownloadsPath', $_SERVER['DOCUMENT_ROOT'] .'/tiny-php-pain-reliever/download');

// Define the root
$_Root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$_Root .= "127.0.0.1/";
define('_Root', $_Root);
?>