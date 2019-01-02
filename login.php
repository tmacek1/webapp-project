<?php

include "db.php";

session_start();
if ($_SESSION['username']) {
  header('location: welcome.php');
}

if (ISSET($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $check = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $val=$db->query($check);

    if($val->num_rows == 1){

        $result=mysqli_query($db,$check);
        $userinfo = mysqli_fetch_assoc($result);
        $role=$userinfo['role'];

        $_SESSION['username'] = $username;
        $_SESSION['start'] = time(); // Taking now logged in time.
        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
        $_SESSION['role'] = $role;

        header('location: welcome.php');
    }else{
        echo "<script language=\"javascript\">alert(\"Invalid username or password, please try again\");document.location.href='login.php';</script>";
    }
}
?>

<script>

function myFunction() {
  var x = document.getElementById("login-password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>

<!DOCTYPE html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container">
    <div id="loginbox" style="margin-top: 50px;" class="col-lg-6 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
                <div class="card-title"<><h1>Player DB login page</h1></div>
                <div style="float: right; font-size: 80%; position: relative; top: -10px;"><a href="recover.php">Forgot password?</a>
                </div>
            </div>
            <div style="padding-top: 30px;" class="card-block">
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
                    </div>

                    <div >
                        <input type="checkbox" onclick="myFunction()">Show password
                    </div>

                    <div style="margin-top: 10px;" class="form-group">
                        <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="login">Sign in</button>
                    </div>
                    <div class="form-group">
                            <div style="padding-top: 15px; font-size: 85%;">Don't have an account! <a href="register.php" onclick="$('#loginbox').hide(); $('#signupbox').show()">Sign Up Here</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</html>
