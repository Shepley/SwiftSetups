<?php
session_start();
include 'resources/database.php';
if($_SESSION['sponsoraction']){
  $email = $_SESSION['sponsoremail'];
  $denied = mysqli_query($db, "UPDATE sponsorships SET status='2' WHERE email='".$email."';");
  unset($_SESSION['sponsoremail']);
  unset($_SESSION['sponsoraction']);
  include 'classes/phpmailer/class.PHPMailer.php';

  $mail = new PHPMailer();

  $mail->IsSMTP();                                      // set mailer to use SMTP
  $mail->Host = "smtp.zoho.com:465";  // specify main and backup server
  $mail->SMTPAuth = true;     // turn on SMTP authentication
  $mail->Username = "sponsorships@swiftmchosting.com";  // SMTP username
  $mail->Password = "georgeisafegit"; // SMTP password
  $mail->SMTPSecure = 'ssl';

  $mail->From = "sponsorships@swiftmchosting.com";
  $mail->FromName = "SwiftSponsorships";
  $mail->AddAddress($email);

  $mail->WordWrap = 50;                                 // set word wrap to 50 characters
  $mail->IsHTML(true);                                  // set email format to HTML

  $mail->Subject = "Your SwiftMCHosting Sponsorship Application";
  $mail->Body    = "<img src=\"http://swiftmchosting.com/wp-content/uploads/2014/02/newweblogo.png\"><br>Hi there,<br><br>Thanks for getting in touch with SwiftMCHosting regarding sponsorship.<br><br>After reviewing your application, we have come to the conclusion that we are unable to offer you a sponsored server. This may be due to a number of reasons being that we don't have enough space, or that we simply feel your request is not what we are looking for.<br><br>However, we would like to offer you a discount of 5% off the first month of hosting. Use the code SPONSORSHIP5 to claim it.<br><br>Thanks for contacting us,<br><br>The SwiftMCHosting Team<br><a href=\"http://swiftmchosting.com\">http://swiftmchosting.com</a>";

  $mail->AltBody = "Hi there,

Thanks for getting in touch with SwiftMCHosting regarding sponsorship.

After reviewing your application, we have come to the conclusion that we are unable to offer you a sponsored server. This may be due to a number of reasons being that we don't have enough space, or that we simply feel your request is not what we are looking for.

However, we would like to offer you a discount of 5% off the first month of hosting. Use the code SPONSORSHIP5 to claim it.

Thanks for contacting us,

The SwiftMCHosting Team
http://swiftmchosting.com
";

  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    $_SESSION['sponsoraction_success_denied'] = 1;
    header("Location: /sponsorships");
  }


} else {
  header("Location: /sponsorships");
}

?>