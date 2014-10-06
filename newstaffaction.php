<?php

include 'overall.php';
include 'resources/database.php';
$username = $_POST['username'];
$email = $_POST['email'];
$email_conf = $_POST['email_conf'];
$permlevel = $_POST['permlevel'];
$_SESSION['username'] = $username;
if($permlevel == "perm_staff"){
  $permlevel = 1;
  $perm_md5 = "c04d26dd31d4e3941b8582e33ce69b17";
} elseif($permlevel == "perm_admin"){
  $permlevel = 2;
  $perm_md5 = "200ceb26807d6bf99fd6f4f0d1ca54d4";
}
$_SESSION['createError'] = 0;
unset($_SESSION['createError']);
$_SESSION['createErrorEmail'] = 0;
unset($_SESSION['createErrorEmail']);
$_SESSION['createErrorEmailUsed'] = 0;
unset($_SESSION['createErrorEmailUsed']);
$_SESSION['createErrorEmailDismatch'] = 0;
unset($_SESSION['createErrorEmailDismatch']);
$_SESSION['createErrorUsername'] = 0;
unset($_SESSION['createErrorUsername']);

$user_check = mysqli_query($db, "SELECT * FROM users WHERE username = '". $username ."'") or die ('Unable to run userquery:'.mysql_error());
$email_check = mysqli_query($db, "SELECT * FROM users WHERE email = '". $email ."'") or die ('Unable to run userquery:'.mysql_error());
var_dump($user_check);

  if(mysqli_num_rows($user_check) > 0){
    $_SESSION['createError'] = 1;
    $_SESSION['createErrorUsername'] = 1;
    header('Location: /staff');
  } elseif(mysqli_num_rows($email_check) > 0){
    $_SESSION['createError'] = 1;
    $_SESSION['createErrorEmail'] = 1;
    $_SESSION['createErrorEmailUsed'] = 1;
    header('Location: /staff');
  } else {
    if ($email == $email_conf){

     mysqli_query($db, "INSERT INTO users (username, email, permissionlevel) VALUES ('". $username ."', '". $email ."', '". $permlevel ."')");

$activateurl = "http://localhost/activate?email=".$email."&permlevel=".$perm_md5;

include 'classes/phpmailer/class.PHPMailer.php';

$mail = new PHPMailer();

$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "smtp.zoho.com:465";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "setup@swiftmchosting.com";  // SMTP username
$mail->Password = "WTqUqwvK"; // SMTP password
$mail->SMTPSecure = 'ssl';

$mail->From = "setup@swiftmchosting.com";
$mail->FromName = "SwiftSetups";
$mail->AddAddress($email, $username);

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "Activate your SwiftSetups account!";
$mail->Body    = "Hello, <b>".$username."</b>,<br><br>An administrator has created an account for you on SwiftSetups; please activate it by following this link:<br><br><a href=\"".$activateurl."\">".$activateurl."</a><br><br>Enjoy!<br><br>Sincerely,<br><b>SwiftMCHosting</b>";
$mail->AltBody = "Hello, ".$username.",

An administrator has created an account for you on SwiftSetups; please activate it by following this link:
".$activateurl."

Enjoy!

Sincerely,
SwiftMCHosting";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

      $_SESSION['createSuccess'] = 1;
      header( 'Location: /staff');
    } else {
    $_SESSION['createError'] = 1;
    $_SESSION['createErrorEmail'] = 1;
    $_SESSION['createErrorEmailDismatch'] = 1;
      header( 'Location: /staff' );
    }
  }

?>