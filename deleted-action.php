<?php

include 'resources/database.php';
session_start();
$username = $_SESSION['sesh_username'];
$deluser = mysqli_query($db, "DELETE FROM users WHERE username='".$username."'") or die(mysqli_error($db));
unset($_SESSION['accdeleted']);
unset($_SESSION['loggedIn']);
unset($_SESSION['permissionAdmin']);
unset($_SESSION['permissionStaff']);
unset($_SESSION['username']);
header("Location: /index");

?>