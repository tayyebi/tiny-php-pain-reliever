<?php
// Report all errors to internet.
// DEBUG: comment following two lines on production server
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

// Set php timezone
date_default_timezone_set('Asia/Tehran');

// Check Auth
if (!isset($_SERVER['PHP_AUTH_USER'])
    || $conn->connect_error
) {
    // Send login failed error to browser and expire temp login.
    header('WWW-Authenticate: Basic realm="Tayyebi Realm"');
    header('HTTP/1.0 401 Unauthorized');
    // die("Connection failed: " . $conn->connect_error);
    echo 'Access Denied';
    exit;
}

// Header
include ('master/header.php');

// Container
$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : 'welcome';

// includes the page content
include ('pages/' . $_GET['id'] . '.php');

// Footer
include ('master/footer.php');
?>