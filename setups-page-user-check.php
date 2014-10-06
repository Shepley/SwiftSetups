<?php

include 'resources/database.php';
$check_id_exist = mysqli_query($db,"SELECT * FROM setups WHERE uniquecode='".$_GET['id']."'") or die(mysqli_error($db));
while($row = mysqli_fetch_array($check_id_exist)){
	if($row['status'] == 2){
		include 'setups-page-user-completed_error.php';
	} else {
		if(mysqli_num_rows($check_id_exist) < 0){
		  	include 'setups-page-error-unknown_id.php';
		} elseif(isset($_COOKIE["".$_GET['id'].""])){
			include 'setups-page-user.php';
		} else {
		  	include 'setups-page-user-pass.php';
		}
	}
}

?>