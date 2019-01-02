<?php
include 'db.php';

if (ISSET($_POST['register-user'])){

    $username = $_POST['username'];
    $email = $_POST['email'];

    //Validates whether the value is a valid e-mail address.
    //In general, this validates e-mail addresses against the syntax in RFC 822,
    //with the exceptions that comments and whitespace folding and dotless domain names are not supported.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script language=\"javascript\">alert(\"Invalid email format, working example username@domain.xy\");document.location.href='register.php';</script>";
    }

    //md5 hash user_password
    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    //check if username exists
    $check = "SELECT username FROM admins WHERE username = '$username'";
    $result = $db->query($check);

    if($result->num_rows >= 1) {
        echo "<script language=\"javascript\">alert(\"Username already exists, please use different one.\");document.location.href='register.php';</script>";

    } else {

        //check if passwords match
        if ($password === $confirmpassword) {

            $insert = "INSERT INTO admins (username,email,password) VALUES ('$username','$email','$password')";
            $execute = mysqli_query($db,$insert);

            //check insert query
            if($execute) {
                echo "<script language=\"javascript\">alert(\"Registration successful\");document.location.href='login.php';</script>";
            }else{
                echo "<script language=\"javascript\">alert(\"Something went wrong, please contact page administrator\");document.location.href='login.php';</script>";
            }
        }else {
            echo "<script language=\"javascript\">alert(\"Passwords dont match.\");document.location.href='register.php';</script>";
        }

        }
    }
?>


<script>

function myFunction() {
  var x = document.getElementById("login-password");
  var y = document.getElementById("confirmpassword");
  if (x.type === "password" || y.type === "password") {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }
}

</script>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>webapp project registration</title>

</head>

<body>

    <div class="container">
        <div id="loginbox" style="margin-top: 50px;" class="mainbox col-lg-7 offset-md-3 col-md-8 offset-sm-2">
            <div class="card card-inverse card-info">
                <div class="card-header">
                    <div class="card-title" <>
                        <h1>Player DB registration page</h1>
                    </div>
                </div>
            </div>
            <div style="padding-top: 30px;" class="card-block">
                <div style="display: none;" id="login-alert" class="alert alert-danger col-md-12"></div>

                <form id="loginform" class="" method="post" action="">

                    <div class="input-group mb-3" class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Username</span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" required />
                    </div>

                    <div class="input-group mb-3" class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                        <input id="login-email" type="email" class="form-control" name="email" value="" required/>
                    </div>

                    <div class="input-group mb-3" class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input id="login-password" type="password" class="form-control" name="password" value="" required />
                    </div>

                    <div class="input-group mb-3" class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Confirm Password</span>
                        <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" value="" required/>
                    </div>

                     <div >
                        <input type="checkbox" onclick="myFunction()">Show password
                    </div>

                    </div>
                    <div style="margin-top: 10px;" class="form-group">
                        <!-- Button -->
                        <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="register-user">Submit</button>
                    <div>
                        <div style= "margin-top: 10px" style="font-size: 85%">
                            <p>
                                Already a member? <a href="login.php">Sign in</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
</body>
</html>
