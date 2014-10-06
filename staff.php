<?php require 'overall.php';

if($_SESSION['loggedIn']){
  if($_SESSION['permissionAdmin']){
    include 'staff-page.php';
  } else {
  echo '<br><br><br><br><br><br><br><div class="container">
  <div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Permission denied!</center></h3>
  </div>
  <div class="panel-body">
    <center>You do not have permission to view this page!</center>
  </div>
</div>
<img draggable="false" class="r_450" src="resources/img/swiftlogocasual.png">
  </div>';
  }
} else {
  echo '<br><br><br><br><br><br><br><div class="container">
  <div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><center>You are not signed in!</center></h3>
  </div>
  <div class="panel-body">
    <center>You need to <a href="/login">sign in</a> to SwiftSetups to view this page!</center>
  </div>
</div>
<img draggable="false" class="r_450" src="resources/img/swiftlogocasual.png">
  </div>';
}
?>