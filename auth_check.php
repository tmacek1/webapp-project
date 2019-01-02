<?php

// Display error if hepend
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// Authorization part of code
session_start();
if (!isset($_SESSION["username"])) {
	header('Location: login.php');
}

// Checking the time now when home page starts.
date_default_timezone_set('Europe/Zagreb');
$now = time();

// Check the validity of the session
if ($now > $_SESSION['expire']) {
	session_destroy();
	header('Location: login.php');
}

?>
