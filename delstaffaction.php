<?php

include 'overall.php';
include 'resources/database.php';

$confirmdel = $_POST['delete'];
$username = $_POST['username'];
$id = $_POST['id'];
$email = $_POST['email'];

unset($_SESSION['delConfError']);
if($confirmdel == "DELETE"){
	$_SESSION['delSuccess'] = 1;
	$setdel = mysqli_query($db, "UPDATE users SET deleted=1 WHERE email='".$email."'");
	header("Location: /staff");
}