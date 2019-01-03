<?php

include 'auth_check.php';
include 'xml_functions.php';
include 'db.php';

$sql = "select * from users where activated = 1";
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
            <h1 class="text-success">Player database</h1>
         </div>


         <div class="col-12 col-sm-6 col-md-6">
         <div data-toggle="modal" data-target="#myModal">
          <form>
          <label class="btn btn-primary">Add new user</label>
         </form>
         </div>



         <!-- Modal -->
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Add new user</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="add.php">
                      <div class="form-group">
                        <label>User</label>
                        <input type="text" required name="user_name" class="form-control">
                        <label>First name</label>
                        <input type="text" required name="first_name" class="form-control">
                        <label>Last name</label>
                        <input type="text" required name="last_name" class="form-control">
                        <label>Date of birth</label>
                        <input type="date" required name="birth_date" class="form-control">
                        <label>Place of birth</label>
                        <input type="text" required name="birth_place" class="form-control">
                      </div>
                      <input type="Submit" name="Submit" value="Submit" class="btn btn-success">
                    </form>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <table class="table text-center">
        <thead>
          <tr>
            <th>UserID</th>
            <th>User</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Date of birth</th>
            <th>Place of birth</th>
            <th>Registration time</th>
          </tr>
         </thead>
         <tbody>
            <tr>
            <?php while($row = $rows->fetch_assoc()): ?>
               <th><?php echo $row['id'] ?></th>
               <td class="col-md-0"><?php echo $row['user_name']?>
               <td class="col-md-0"><?php echo $row['first_name']?>
               <td class="col-md-0"><?php echo $row['last_name']?>
               <td class="col-md-0"><?php echo $row['birth_date']?>
               <td class="col-md-0"><?php echo $row['birth_place']?>
               <td class="col-md-0"><?php echo $row['registration_time']?>

               <?php

               if ($_SESSION['role'] == 'admin') {
                 echo '<td><a href="update.php?id='.$row["id"].'" class="btn btn-success">Edit</a></td>
                       <td><a href="delete.php?id='.$row["id"].'" class="btn btn-danger">Delete</a></td>';
               }

               ?>


            </tr>
            <?php endwhile; ?>
         </tbody>
      </table>

	      <div class="col-12 col-sm-6 col-md-6">
               <form method="post" action="players.php" enctype="multipart/form-data">

                <input type="file" name="chooseFile" id="chooseFile">

	        <label class="btn btn-success"><input id="submit" type="submit" style="display:none;">Submit XML</label>
              </form>
	     </div>
<?php
if ((strtolower($_SERVER['REQUEST_METHOD'])=='post') && (!empty($_FILES['chooseFile']['tmp_name']))){

    $file = $_FILES['chooseFile']['tmp_name'];
    $schema = '/home/mica/html/xml_schema.xsd';
    $ab = new DOMDocument;

    libxml_use_internal_errors(true);
    $ab->load($file);

    if ($ab->schemaValidate($schema)) {
	    print "Imported XML is valid.\n";
    } else {
	print "Imported XML is invalid.\n";
	return;
    }

    $catArray = xml2array($_FILES['chooseFile']['tmp_name']);

    foreach ($catArray as $x){
      foreach ($x as $y){

        $user_name = $y['user_name'][0];
        $first_name = $y['first_name'][0];
        $last_name = $y['last_name'][0];
        $birth_date = $y['birth_date'][0];
        $birth_place = $y['birth_place'][0];
        $userAray = array();

        $duplicate = "select * from users where user_name = '$user_name'";
        $dupval = $db->query($duplicate);

	if ($dupval->num_rows>0) {
		echo "<script type='text/javascript'>alert('User already exists, please try again');document.location.href='players.php';</script>";
		return;
        }
        else{
          $sql = "insert into users (user_name, first_name, last_name, birth_place, birth_date) values ('$user_name','$first_name','$last_name','$birth_place', '$birth_date')";
          $val = $db->query($sql);
          array_push($userAray,$user_name);
        }
      }
    }
    $arrayP = implode(" ",$userAray);
    $message = "XML import finished successfully, new users added: ".$arrayP;
    echo "<script type='text/javascript'>alert('$message');document.location.href='players.php';</script>";
}
?>


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
