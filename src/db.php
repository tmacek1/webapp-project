<?php

include 'config.php';

$db = new Mysqli;
$db->connect("$host","$username","$db_pass","$db_name");

if (!$db) {
    die('Could not connect to DB:' .mysql_error());
}
?>
