<?php
include 'overall.php';
error_reporting(E_ALL);
include 'resources/database.php';
$assigned = $_POST['assignstaff'];
$id = $_POST['assignid'];

$assign_user_query = mysqli_query($db, "UPDATE setups SET assigned='$assigned' WHERE id=".$id."") or die(mysqli_error($db));
$assign_id_query = mysqli_query($db, "UPDATE setups SET status=1 WHERE id=".$id."") or die(mysqli_error($db));
$_SESSION['assign_success'] = 1;
$_SESSION['assign_success_user'] = $assigned;
$_SESSION['assign_success_id'] = $id;
header("Location: /index");
 ?>