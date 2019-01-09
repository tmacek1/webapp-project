<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include 'db.php';
include 'login_menu.php';

if (ISSET($_POST['recover'])){

    // email validation
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script language=\"javascript\">alert(\"Please enter a valid email address.\");document.location.href='recover.php';</script>";
    }

    // check if the email exists
    $check = "SELECT email FROM admins WHERE email = '$email'";
    $val = $db->query($check);

    if ($val->num_rows == 0) {
        echo "<script language=\"javascript\">alert(\"Email doesnt exists! Please try again.\");document.location.href='recover.php';</script>";
    }else{
        $password = substr(rand(),3,10);
        $pass = md5($password);

        $sql = "UPDATE admins SET password = '$pass' WHERE email = '$email'";
        $update_pwd = $db->query($sql);

        $subject = 'Webapp mailer - recover mail';
        $message = "Hi $email this is your temporary password: $password";
        $headers = 'From: Tomislav Maček <tomislav.macek@noreply.com>' . PHP_EOL .
            'Reply-To: noreply@mydomain.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    	mail($email, $subject, $message, $headers);
        echo "<script language=\"javascript\">alert(\"Recovery email sent to destination email address.\");document.location.href='modify_account.php';</script>";
    }
} 
?>

<!DOCTYPE html>

<div class="container">
    <div id="loginbox" style="margin-top: 50px;" class="mainbox col-lg-8 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
            <div class="card-title"<><h1>Webapp account recovery page</h1></div>
                <div style="padding-top: 30px;" class="card-block"></div>
                <div style="display: none;" id="login-alert" class="alert alert-danger col-md-12"></div>
                <form id="loginform" class="" role="form" method="post" action="">
                    <div class="input-group mb-3" class="input-group-prepend">
                        <span class="input-group-text"id="basic-addon1">Email</span>
                        <input id="login-email" type="email" class="form-control" name="email" value="" required/>
                    </div>
                    <div style="margin-top: 10px;" class="form-group">
                        <!-- Button -->
                        <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="recover">Recover</button></a>
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