<?php
include 'resources/database.php';
session_start();
$id = $_SESSION['act_req_id'];
$unicode = $_SESSION['req_code'];
unset($_SESSION['act_req_id']);
unset($_SESSION['req_code']);
$save = mysqli_query($db,"UPDATE requests SET status=2 WHERE id='".$id."'") or die(mysqli_error($db));
session_start();
$_SESSION['req_saved'] = 1;
header("Location: /setups?id=".$unicode."");
?>