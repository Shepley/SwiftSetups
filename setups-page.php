<?php if($_SESSION['loggedIn']){
	include 'setups-page-admin.php';
} elseif($_GET['id']){
	include 'setups-page-user.php';
} else {
	include 'setups-page-error.php';
}
?>