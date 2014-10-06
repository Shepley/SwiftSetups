<?php require 'overall.php';

if($_SESSION['loggedIn'] && $_SESSION['permissionAdmin']){
  include 'sponsorships-admin.php';
} elseif($_SESSION['permissionStaff']) {
  echo '<br><br><br><br><br><br><br><div class="container">
  <div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Permission denied!</center></h3>
  </div>
  <div class="panel-body">
    <center>Staff can not apply for a sponsorship.</center>
  </div>
</div>
<img draggable="false" class="r_450" src="resources/img/swiftlogocasual.png">
  </div>';
} else {
  include 'sponsorships-page.php';
}
?>