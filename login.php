<?php require 'overall.php';
if($_SESSION['loggedIn']){
	header("Location: /index");
}
?>

<br>
<div class="container">
<?php if($_SESSION['loginError']){
echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Invalid email or password!</strong> Please check your email and password, you seem to have entered invalid credentials.
</div>';
} elseif($_SESSION['loginErrorPermlevel']) {
echo '<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>Permission denied! </strong>You are not a staff member! Please access the client setups panel <a href="#" class="alert-link">here</a>!
</div>';
  } else {
  echo "<br><br><br>";
  }?>
<div class="well bs-component">
<form class="form-horizontal" autocomplete="off" method="post" action="loginaction.php">
  <fieldset>
    <legend>SwiftSetups Login</legend>
    <div <?php if($_SESSION['loginError']){
  echo 'class="form-group has-error"';
} else {
  echo 'class="form-group"';
} ?>>
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" required>
      </div>
    </div>
    <div <?php if($_SESSION['loginError']){
  echo 'class="form-group has-error"';
} else {
  echo 'class="form-group"';
} ?>>
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
      </div>
    </div>
    <br>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="submit" class="btn btn-primary" value="Sign in">
      </div>
    </div>
  </fieldset>
</form>
</div>
</div>
<?php

$_SESSION['loginError'] = 0;
unset($_SESSION['loginError']);
$_SESSION['loginErrorPermlevel'] = 0;
unset($_SESSION['loginErrorPermlevel']);

?>

