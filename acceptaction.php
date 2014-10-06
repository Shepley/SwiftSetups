<?php

include 'resources/database.php';
  $email = $_POST['sponsoremail'];
  $accepted = mysqli_query($db, "UPDATE sponsorships SET status='1' WHERE email='".$email."';");
  unset($_SESSION['sponsoremail']);
  unset($_SESSION['sponsoraction']);
  $ram = $_POST['ram'];
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

  $mail->Subject = "Congratulations! Your sponsorship has been accepted.";
  $mail->Body    = "<img src=\"http://swiftmchosting.com/wp-content/uploads/2014/02/newweblogo.png\"><br><br>Hi there,<br><br>Thanks for getting in touch with SwiftMCHosting regarding sponsorship.<br><br>After reviewing your application, we have decided that we would like to offer you a sponsored server.<br><br>We would like to offer you the following:<br><br>-".$ram."GB Minecraft Server<br><br>Please reply to this email in order to claim the sponsored server.<br><br>Thanks for contacting us,<br><br>George<br>SwiftMCHosting Founder<br><a href=\"http://swiftmchosting.com\">http://swiftmchosting.com</a>";

  $mail->AltBody = "Hi there,

Thanks for getting in touch with SwiftMCHosting regarding sponsorship.

After reviewing your application, we have decided that we would like to offer you a sponsored server.

We would like to offer you the following:

- ".$ram."GB Minecraft Server

Please reply to this email in order to claim the sponsored server.

Thanks for contacting us,

George
SwiftMCHosting Founder
http://swiftmchosting.com
";

  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    $_SESSION['sponsoraction_success_accepted'] = 1;
    header("Location: /sponsorships");
  }

?>