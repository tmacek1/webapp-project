<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include 'auth_check.php';
include 'db.php';

$sql = "select * from admins limit 10";
$rows = $db->query($sql);

?>

<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   </head>

   <body>

      <div class="conatiner">
         <div class="row">
            <div class="col-md-5"></div>
            <h1 class="text-success">User database</h1>
         </div>

      <table class="table text-center">
        <thead>
          <tr>
            <th>UserID</th>
            <th>Username</th>
            <th>Email</th>
	    <th>Role</th>
            <th>Active</th>		
          </tr>
         </thead>
         <tbody>
            <tr>
            <?php while($row = $rows->fetch_assoc()): ?>
               <th><?php echo $row['id'] ?></th>
               <td class="col-md-0"><?php echo $row['username']?>
               <td class="col-md-0"><?php echo $row['email']?>
               <td class="col-md-0"><?php echo $row['role']?>
	       <td class="col-md-0"><?php echo $row['status']?>	
    <?php

               if ($_SESSION['role'] == 'admin') {
		       echo '<td><a href="change_role_admin.php?id='.$row["id"].'" class="btn btn-success">Admin</a></td>
			     <td><a href="change_role_readonly.php?id='.$row["id"].'" class="btn btn-secondary">Read-only</a></td>
			     <td><a href="deactivate.php?id='.$row["id"].'" class="btn btn-danger">Deactivate account</a></td>
                             <td><a href="reactivate.php?id='.$row["id"].'" class="btn btn-primary">Reactivate account</a></td>';
					               }

               ?>

               </tr>
            <?php endwhile; ?>
         </tbody>
      </table>


   <div>
    <p align="center">
    <button type="button" class="btn btn-info" role="button" onClick="document.location.href='welcome.php'" style="margin-left:auto;margin-right:auto;display:block;margin-top:22%;margin-bottom:0%">Homepage</button>
    </p>
   </div>
</div>

<div id="footer">
 <div class="container text-center">
 &copy;2018
  <script>
    new Date().getFullYear()>2018&&document.write("- " + new Date().getFullYear());
  </script>
 VVG/Tomislav Macek
</div>
</div>

   </body>
</html>

