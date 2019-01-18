<?php

include 'auth_check.php';
include 'db.php';

if(isset($_REQUEST["term"])){
    // Prepare a select statement
	  $sql = "SELECT * FROM users WHERE activated = 1";

    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters
        // mysqli_stmt_bind_param($stmt, "sss", $param_term, $param_term, $param_term);

        // Set parameters
        // $param_term = $_REQUEST["term"] . '%';

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
             <tr>
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
            <?php
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// close connection
mysqli_close($db);
?>
