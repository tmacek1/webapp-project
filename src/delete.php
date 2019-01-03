<?php

include 'auth_check.php';
include 'db.php';

$id = $_GET['id'];
$sql = "update users set activated = false where id = '$id'";

$val = $db->query($sql);
if($val){
    header('location: players.php');
}
?>
