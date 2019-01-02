<?php

$db = new Mysqli;
$db->connect('localhost','mica','dSHmiA0X','crud_db');

if(!$db) {
die('Could not connect to DB:' .mysql_error());
}
?>
