<?php

include 'resources/database.php';
include 'overall.php';
if($_SESSION['sponsoraction']){
  $email = $_SESSION['sponsoremail'];
  unset($_SESSION['sponsoremail']);
} else {
  header("Location: /sponsorships");
}

?>

<br>
<div class="container">
  <div class="well">
    <legend><center>How many gigabytes do you want to give <?php echo $email ?>?</center></legend>
    <br>
    <form class="form-horizontal" method="post" action="acceptaction.php">
      <div class="form-group">
        <div class="col-lg-10">
          <input class="form-control r_80" name="ram" placeholder="Enter the amount of ram here (in gigabytes)">
          <input name="sponsoremail" type="hidden" <?php echo 'value="'.$email.'"' ?>>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-success r_500" value="Accept Application">
      </div>
    </form>
  </div>
</div>