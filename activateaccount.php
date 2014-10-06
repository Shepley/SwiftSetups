<?php

include 'overall.php';
include 'resources/database.php';
error_reporting(E_ALL);
$email = $_SESSION['activateEmail'];
$password = md5($_POST['activatePassword']);
$conf_password = md5($_POST['activateConfPassword']);
unset($_SESSION['loggedIn']);
unset($_SESSION['sesh_username']);
unset($_SESSION['permissionStaff']);
unset($_SESSION['permissionAdmin']);

if($password == $conf_password){
  mysqli_query($db, "UPDATE users SET password='".$password."' WHERE email='".$email."';");
  mysqli_query($db, "UPDATE users SET activated='1' WHERE email='".$email."';");
  unset($_SESSION['activateEmail']);
  unset($_SESSION['activatePermlevel']);
  $_SESSION['activateSuccess'] = 1;
  header("Location: /index");
  die();
}

?>