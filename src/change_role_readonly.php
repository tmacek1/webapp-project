<?php

include 'auth_check.php';
include 'db.php';

$id = $_GET['id'];
$sql = "update admins set role = 'read' where id = '$id'";

$val = $db->query($sql);
if($val){
	            header('location: admin_panel.php');
}
?>
