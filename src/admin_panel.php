<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include 'auth_check.php';
include 'db.php';
include 'login_menu.php';

$sql = "select * from admins limit 10";
$rows = $db->query($sql);

?>

<!DOCTYPE html>
<html>
   <body>
      <div class="conatiner">
         <div class="row">
            <div class="col-md-5"></div>
            <h1 class="text-success">User database</h1>
         </div>
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