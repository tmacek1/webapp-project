<?php

include 'db.php';
include 'login_menu.php';

$id = $_GET['id'];
$sql = "select * from users where id='$id'";
$rows = $db->query($sql);
$row = $rows->fetch_assoc();

if (isset($_POST['Submit'])) {

    $user_name = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $birth_place = $_POST['birth_place'];

    $sql2 = "update users set user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', birth_date = '$birth_date', birth_place = '$birth_place' where id = '$id'";
    $db->query($sql2);
    header('location: players.php');

}
?>

<!DOCTYPE html>
<html>
   <body>
      <div class="justify-content-center align-items-center container ">
         <div class="row">
            <div class="col-sm-10 offset-sm-1 text-center">
               <h1>Update player info</h1>
            </div>
            <div class="modal-body">
               <form method="post">
                  <div class="form-group">
                     <label>User</label>
                     <input type="text" required name="user_name" value="<?php echo $row['user_name'];?>" class="form-control">
                     <label>First name</label>
                     <input type="text" required name="first_name" value="<?php echo $row['first_name'];?>" class="form-control">
                     <label>Last name</label>
                     <input type="text" required name="last_name" value="<?php echo $row['last_name'];?>" class="form-control">
                     <label>Date of birth</label>
                     <input type="date" required name="birth_date" value="<?php echo $row['birth_date'];?>" class="form-control">
                     <label>Place of birth</label>
                     <input type="text" required name="birth_place" value="<?php echo $row['birth_place'];?>" class="form-control">
                  </div>
                  <div>  
                    <input type="Submit" name="Submit" value="Submit" class="btn btn-success">
                  </div>  
               </form>
            </div>
         </div>
      </div>      
   </body>
</html>