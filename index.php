<?php require 'overall.php';
unset($_SESSION['username']);
if($_SESSION['activateInvalidURL']){
  echo '<div class="container"><br><div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Activation error! </strong>That is an invalid activation URL.
</div></div>';
  unset($_SESSION['activateInvalidURL']);
} elseif($_SESSION['activateSuccess']){
  echo '<div class="container"><br><div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Account activated! </strong>Welcome to SwiftSetups. You can now sign in.
</div></div>';
  unset($_SESSION['activateSuccess']);
}
if($_SESSION['loginErrorActivated']){
  echo '<div class="container"><br><div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Login error! </strong>Your account is not activated, please check your email!
</div></div>';
  unset($_SESSION['loginErrorActivated']);
}
if($_SESSION['loggedIn']){
	include 'dashboard.php';
  unset($_SESSION['acivatePermlevel']);
  unset($_SESSION['activateEmail']);
  unset($_SESSION['editid']);
  unset($_SESSION['cur_username']);
} else {
	echo '<br><br><br><br><br><br><br><div class="container">
	<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><center>You are not signed in!</center></h3>
  </div>
  <div class="panel-body">
    <center>You need to <a href="/login">sign in</a> to SwiftSetups to view the dashboard!<br><br>Are you a guest? Applying for a sponsorship? <a href="/sponsorships">Click here!</a></center>
  </div>
</div>
<img draggable="false" class="r_450" src="resources/img/swiftlogocasual.png">
	</div>';
}
?>