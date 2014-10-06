<?php require 'overall.php';
echo "<br>";
  if($_SESSION['setups_success']){
    echo '<div class="container"><div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert"></button>
  <strong>There you go! </strong>It may take up to seven days to complete your request. Your unique code is: <strong><a class="text-danger" href="/setups?id='.$_SESSION['setups_string'].'">'.$_SESSION['setups_string'].'</a></strong><div class="pull-right"><small>(Make sure to save this code)</small></div>
</div></div>';
}

if($_GET['form'] == 1){
  include 'setups-form.php';
} elseif($_SESSION['loggedIn'] && $_GET['id']){
  include 'setups-page-admin-view_details.php';
} elseif($_SESSION['loggedIn']){
  include 'setups-page-admin.php';
} elseif($_GET['id']){
  include 'setups-page-user-check.php';
} else {
	include 'setups-page-error.php';
}

unset($_SESSION['setups_string']);
unset($_SESSION['setups_success']);
?>