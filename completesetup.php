<?php
include 'overall.php';
error_reporting(E_ALL);
include 'resources/database.php';
var_dump($_SESSION);
$id = $_SESSION['complete_id'];
unset($_SESSION['complete_id']);

$complete = mysqli_query($db, "UPDATE setups SET status=2 WHERE id=".$id."") or die(mysqli_error($db));
$complete_req = mysqli_query($db, "UPDATE setups SET requestinghelp=0 WHERE id=".$id."") or die(mysqli_error($db));
$complete_req_assigned = mysqli_query($db, "UPDATE setups SET reqhelpassigned='' WHERE id=".$id."") or die(mysqli_error($db));
$_SESSION['setup_complete'] = 1;
header("Location: /index");
 ?>