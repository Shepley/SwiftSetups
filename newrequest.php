<?php

include 'resources/database.php';
session_start();
$id = $_POST['req_id'];
$setupdetails = $_POST['featureinfo'];

if(empty($setupdetails)){
	$_SESSION['req_empty'] = 1;
    header("Location: /setups?id=".$id."");
} else {

	$setupdetails = mysqli_escape_string($db, $setupdetails);
	$serviceid = $_POST['serviceid'];
	$assigned = $_POST['assigned'];
	$newreq = mysqli_query($db, "INSERT INTO requests (setup_id, serviceid, details, assigned) VALUES ('". $id ."', '". $serviceid ."', '". $setupdetails ."', '". $assigned ."')") or die(mysqli_error($db));
	$_SESSION['setups_req_success'] = 1;
	header("Location: /setups?id=".$id."");

}

?>