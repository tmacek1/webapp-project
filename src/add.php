<?php

include 'auth_check.php';
include 'db.php';

if(isset($_POST['Submit'])) {

    $user_name = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $birth_place = $_POST['birth_place'];

    $duplicate = "select * from users where user_name = '$user_name'";
    $dupval = $db->query($duplicate);

    if ($dupval->num_rows>0) {
        echo "Username already exists!"; 
    }

    $sql = "insert into users (user_name, first_name, last_name, birth_place, birth_date) values ('$user_name','$first_name','$last_name','$birth_place', '$birth_date')";
    $val = $db->query($sql);

    if($val == true){
        header('location: players.php');
    }
}

?>