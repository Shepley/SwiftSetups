<?php 
error_reporting(0);
session_start();
include 'nav.php';
include 'resources/database.php';
$delcheck = mysqli_query($db,"SELECT * FROM users WHERE username='".$_SESSION['sesh_username']."'");
while($row = mysqli_fetch_array($delcheck)){
	if($row['deleted'] == 1){
		$_SESSION['accdeleted'] = 1;
		header("Location: /deleted");
	}
}

$permcheck = mysqli_query($db,"SELECT * FROM users WHERE username='".$_SESSION['sesh_username']."'");
while($row = mysqli_fetch_array($permcheck)){
	if($row['permissionlevel'] == 1){
		$_SESSION['permissionStaff'] = 1;
		unset($_SESSION['permissionAdmin']);
	} elseif($row['permissionlevel'] == 2){
		$_SESSION['permissionAdmin'] = 1;
		unset($_SESSION['permissionStaff']);
	}
}

if(!$_SESSION['loggedIn']){
	unset($_SESSION['permissionStaff']);
	unset($_SESSION['permissionAdmin']);
}

?>

<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="resources/css/main.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<title>SwiftSetups</title>