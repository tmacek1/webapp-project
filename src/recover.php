<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;

include 'db.php';

if (ISSET($_POST['recover'])){

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    // email address validation
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script language=\"javascript\">alert(\"Please enter a valid email address.\");document.location.href='recover.php';</script>";
    }

    // checks if the email exists
    $check = "SELECT email FROM admins WHERE email = '$email'";
    $val = $db->query($check);

    if ($val->num_rows == 0) {

        echo "<script language=\"javascript\">alert(\"Email doesnt exists! Please try again.\");document.location.href='recover.php';</script>";

    }else{

        $password = substr(rand(),3,10);
        $pass = md5($password);

        $sql = "UPDATE admins SET password = '$pass' WHERE email = '$email'";
        $update_pwd = $db->query($sql);

        //new PHPmailer instance
        $mail = new PHPMailer(TRUE);

        try {

            $mail->setFrom('vipit0404@gmail.com', 'webapp mailer');
            $mail->addAddress($email);
            $mail->Subject = 'Password recovery mail';
            $mail->Body = "Hi $email, Your temporary random generated password: \"$password\"";

            /* SMTP parameters. */

            /* Tells PHPMailer to use SMTP. */
            $mail->isSMTP();

            /* SMTP server address. */
            $mail->Host = 'in-v3.mailjet.com';

            /* Use SMTP authentication. */
            $mail->SMTPAuth = TRUE;

            /* Set the encryption system. */
            //$mail->SMTPSecure = 'tls';

            /* SMTP authentication username. */
            $mail->Username = '921135ba749b4d1c343bb17022a7bab2';

            /* SMTP authentication password. */
            $mail->Password = '7a78d773c88bec00e032772a687d5bac';

            /* Set the SMTP port. */
            $mail->Port = 25;

            /* Send the mail. */
            $mail->send();
                }catch (Exception $e) {
                    echo $e->errorMessage();
                }catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
    echo "<script language=\"javascript\">alert(\"Recovery email sent to destination email address.\");document.location.href='modify_account.php';</script>";
    }
?>

<!DOCTYPE html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container">
    <div id="loginbox" style="margin-top: 50px;" class="mainbox col-lg-8 offset-md-3 col-md-8 offset-sm-2">
        <div class="card card-inverse card-info">
            <div class="card-header">
                <div class="card-title"<><h1>Webapp account recovery page</h1></div>
                </div>
            </div>
            <div style="padding-top: 30px;" class="card-block">
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
                            <div style="padding-top: 15px; font-size: 85%;"><a href="login.php" onclick="$('#loginbox').hide(); $('#signupbox').show()">Back To Login Page</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</html>
