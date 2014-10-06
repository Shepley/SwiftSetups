<?php
error_reporting(0);
if($_SESSION['accdeleted']){
	unset($_SESSION['accdeleted']);
} else {
	header("Location /index");
}
include 'nav.php';
?>
<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="resources/css/main.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<title>SwiftSetups</title>
<br>
<div class="container">
	<div class="well">
		<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Your account has been deleted.</center></h3>
  </div>
  <div class="panel-body">
    <center>Your account has been deleted; if you think this is an error, please contact an administrator.</center>
  </div>
</div>

<button onclick="location.href = '/deleted-action';" type="button" class="btn btn-default btn-lg btn-block">I understand</button>
	</div>
</div>