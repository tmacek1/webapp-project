<?php

include "db.php";
include "login_menu.php";

session_start();
if ($_SESSION['username']) {
  header('location: welcome.php');
}

if (ISSET($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $check = "SELECT * FROM admins WHERE username='$username' AND password='$password' and status = 1";
    $val=$db->query($check);

    if($val->num_rows == 1){

        $result=mysqli_query($db,$check);
        $userinfo = mysqli_fetch_assoc($result);
        $role=$userinfo['role'];

        $_SESSION['username'] = $username;
        $_SESSION['start'] = time(); // session started - storing current timestamp
        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60); // in seconds
        $_SESSION['role'] = $role;

        header('location: welcome.php');

    }else{
        echo "<script language=\"javascript\">alert(\"Invalid username or password, please try again\");document.location.href='login.php';</script>";
    }
}
?>

<script>

function showPassword() {
  var x = document.getElementById("login-password");
  if (x.type === "password") {
      x.type = "text";
  } else {
     x.type = "password";
  }
}

</script>

<!DOCTYPE html>
<div class="container">
    <div style="margin-top: 50px;" class="col-lg-6 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
                <div class="card-title"<><h1>Webapp login page</h1></div>
                <div style="float: right; font-size: 80%; position: relative; top: -10px;"><a href="recover.php">Forgot password?</a></div>
                <div style="padding-top: 30px;" class="card-block"></div>
                <div style="display: none;" id="login-alert" class="alert alert-danger col-md-12"></div>
                <form id="loginform" action="" method="post" role="form">
                    <div class="input-group mb-3" class="input-group-prepend">
                        <span class="input-group-text"id="basic-addon1">Username</span>
                        <input id="login-username" type="text" class="form-control" name="username" value=""/>
                    </div>    
                    <div class="input-group mb-3" class="input-group-prepend">
                        <span class="input-group-text"id="basic-addon1">Password</span>
                        <input id="login-password" type="password" class="form-control" name="password" value=""/>
                    </div>
                    <div><input type="checkbox" onclick="showPassword()">Show password</div>
                    <div style="margin-top: 10px;" class="form-group">
                        <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="login">Sign in</button>
                    </div>
                    <div class="form-group">
                        <div style="padding-top: 15px; font-size: 85%;">Don't have an account! <a href="register.php" onclick="$('#loginbox').hide(); $('#signupbox').show()">Sign Up Here</a>
                    </div>
                </form>   
          </div>
      </div> 
 </div>
</html>
