<?php

// Display all errors
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// Check username for current session
session_start();
if (!isset($_SESSION["username"])) {
	header('Location: login.php');
}

// Store current time
date_default_timezone_set('Europe/Zagreb');
$now = time();

// Check the validity of the session
if ($now > $_SESSION['expire']) {
	session_destroy();
	header('Location: login.php');
}

?>
