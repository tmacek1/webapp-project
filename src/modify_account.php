<?php
include 'db.php';
include 'login_menu.php';

if (ISSET($_POST['change'])){

    $tempPwd = md5($_POST['temppassword']);
    $newPwd = md5($_POST['password']);

    // pair new password with username
    $check = "SELECT username FROM admins WHERE password = '$tempPwd'";
    $val = $db->query($check);

    if ($val->num_rows == 0) {
        echo "<script language=\"javascript\">alert(\"You have entered wrong temporary password! Please try again.\");document.location.href='modify_account.php';</script>";
    }else{
        $update = "UPDATE admins SET password = '$newPwd' WHERE password = '$tempPwd'";
        $execute = mysqli_query($db,$update);
        if ($execute) {
            echo "<script language=\"javascript\">alert(\"Password changed successfully!\");document.location.href='login.php';</script>";
        }else{
            echo "<script language=\"javascript\">alert(\"Something went wrong, please contact page administrator\");document.location.href='login.php';</script>";
        }
    }
}
?>


<script>

function showPassword() {
  var x = document.getElementById("login-npwd");
  var y = document.getElementById("login-cpwd");
  var z = document.getElementById("temp-pwd");

  if (x.type === "password" || y.type === "password" || z.type === "password") {
    x.type = "text";
    y.type = "text";
    z.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
    z.type = "password";
  }
}

</script>


<!DOCTYPE html>
<div class="container">
    <div id="loginbox" style="margin-top: 50px;" class="mainbox col-lg-8 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
                <div class="card-title"<><h1>Player DB change password</h1></div>
                   <div style="padding-top: 30px;" class="card-block"></div>
                   <div style="display: none;" id="login-alert" class="alert alert-danger col-md-12"></div>
                   <form id="loginform" class="" role="form" method="post" action="">
                        <div class="input-group mb-3" class="input-group-prepend">
                            <span class="input-group-text"id="basic-addon1">Temporary Password</span>
                            <input id="temp-pwd" type="password" class="form-control" name="temppassword" value="" required/>
                        </div>
                        <div class="input-group mb-3" class="input-group-prepend">
                            <span class="input-group-text"id="basic-addon1">New Password</span>
                            <input id="login-npwd" type="password" class="form-control" name="password" value="" required/>
                        </div>
                        <div class="input-group mb-3" class="input-group-prepend">
                            <span class="input-group-text"id="basic-addon1">Confirm New Password</span>
                            <input id="login-cpwd" type="password" class="form-control" name="confirmpassword" value="" required/>
                        </div>
                        <div>
                            <input type="checkbox" onclick="showPassword()">Show password
                        </div>
                        <div style="margin-top: 10px;" class="form-group">
                            <!-- Button -->
                            <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="change">Change</button>
                        </div>
                        <div class="form-group">
                            <div style="padding-top: 15px; font-size: 85%;"><a href="login.php" onclick="$('#loginbox').hide(); $('#signupbox').show()">Back To Login Page</a></div>
                        </div>
                    </form>
            </div>
        </div>  
    </div>     
</div>
</html>