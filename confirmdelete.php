<?php

include 'overall.php';
include 'resources/database.php';

?>

<br>
<div class="container">
	<div class="well well-sm">
		<center><legend>Please confirm the deletion of this account</legend></center>
		<br><br>
		<h4><center>Are you sure you want to delete account <abbr <?php echo 'title="ID: '.$_POST['id'].'"' ?>>"<?php echo $_POST['username'] ?>"</abbr>?</center></h4>
		<br>
		<form class="form-horizontal" method="post" action="delstaffaction.php" autocomplete="off">
		<input type="hidden" name="username" <?php echo 'value="'.$_POST['username'].'"' ?>>
      	<input type="hidden" name="email" <?php echo 'value="'.$_POST['email'].'"' ?>>
      	<input type="hidden" name="id" <?php echo 'value="'.$_POST['id'].'"' ?>>
		<div class="form-group">
		<div class="col-lg-11 r_50">
			<input autocomplete="off" class="form-control" name="delete" placeholder="Type 'DELETE' here to confirm account deletion">
		</div>
		</div>
		<div class="form-group">
		<div class="col-lg-3">
		<input type="submit" class="btn btn-primary r_500" value="Delete Account">
		</div>
		</div>
		</form>
		<button onclick="location.href = '/staff';" class="btn btn-default">Cancel</button>
	</div>
</div>