<?php

include 'db.php';
include 'login_menu.php';

if (ISSET($_POST['register-user'])){

    $username = $_POST['username'];
    $email = $_POST['email'];

    //Validates whether the value is a valid e-mail address.
    //In general, this validates e-mail addresses against the syntax in RFC 822,
    //with the exceptions that comments and whitespace folding and dotless domain names are not supported.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script language=\"javascript\">alert(\"Invalid email format, working example username@domain.xy\");document.location.href='register.php';</script>";
    }

    //md5 hash of user password
    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    //check if username/email exists
    $checkUser = "SELECT username FROM admins WHERE username = '$username'";
    $checkEmail = "SELECT email FROM admins where email = '$email'";
    $result = $db->query($checkUser);
    $result2 = $db->query($checkEmail);

    if ($result->num_rows >= 1) {
        echo "<script language=\"javascript\">alert(\"Username already exists, please use different one.\");document.location.href='register.php';</script>"; 
    }
   
    if ($result2->num_rows >=1) {
        echo "<script language=\"javascript\">alert(\"Email address already exists, please use different one.\");document.location.href='register.php';</script>";	    
    } else {
        //check if passwords match
        if ($password === $confirmpassword) {

            $insert = "INSERT INTO admins (username,email,password) VALUES ('$username','$email','$password')";
            $execute = mysqli_query($db,$insert);

            //check insert query and send welcome mail
            if($execute) {
    
                $subject = 'Webapp mailer - welcome mail';
                $message = "Hi $email thank You for registration. Please free to login at any time -> https://tomislavm.ddns.net/ ";
                $headers = 'From: Tomislav Maček <tomislav.macek@noreply.com>' . PHP_EOL .
                        'Reply-To: noreply@mydomain.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                mail($email, $subject, $message, $headers);
	            echo "<script language=\"javascript\">alert(\"Registration successful\");document.location.href='login.php';</script>";
	        }else{
                echo "<script language=\"javascript\">alert(\"Something went wrong, please contact page administrator\");document.location.href='login.php';</script>";
            }
        }else{
            echo "<script language=\"javascript\">alert(\"Passwords dont match.\");document.location.href='register.php';</script>";
        }
    }
}
?>


<script>

function showPassword() {
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
<body>

    <div class="container">
        <div id="loginbox" style="margin-top: 50px;" class="mainbox col-lg-7 offset-md-3 col-md-8 offset-sm-2">
            <div class="card card-inverse card-info">
                <div class="card-header">
                    <div class="card-title">
                        <h1>Webapp registration page</h1>
                    </div>
                   <div style="padding-top: 30px;" class="card-block"></div>
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
                            <input type="checkbox" onclick="showPassword()">Show password
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>