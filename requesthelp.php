<?php
include 'overall.php';
error_reporting(E_ALL);
include 'resources/database.php';
$assigned = $_SESSION['req_assigned'];
$id = $_SESSION['req_id'];

$assign_user_query = mysqli_query($db, "UPDATE setups SET reqhelpassigned='$assigned' WHERE id=".$id."") or die(mysqli_error($db));
$assign_id_query = mysqli_query($db, "UPDATE setups SET requestinghelp=1 WHERE id=".$id."") or die(mysqli_error($db));
$_SESSION['req_success'] = 1;
$_SESSION['req_success_id'] = $id;
unset($_SESSION['red_assigned']);
unset($_SESSION['red_id']);
header("Location: /index");
 ?>