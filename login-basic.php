<?php

// Load Configuration
include_once 'config.php';

// If logout
if (isset($_GET['logout']) and $_GET['logout'] == "true") {
    header('WWW-Authenticate: Basic realm="Tayyebi Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<a href="login.html">Proceed to login</a>';
}
// If invalid credintials
else if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
    || $conn->connect_error
    )
{
    header('WWW-Authenticate: Basic realm="Tayyebi Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<a href="login.html">Proceed to login</a>';
}
// If login was ok
else {
    header('Location: index.php');
}
?>