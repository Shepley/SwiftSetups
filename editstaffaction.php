<?php

include 'overall.php';
include 'resources/database.php';
error_reporting(E_ALL);
$_SESSION['editError'] = 0;
unset($_SESSION['editError']);
$_SESSION['editSuccess'] = 0;
unset($_SESSION['editSuccess']);

$cur_username = $_SESSION['cur_username'];
$new_username = $_POST['edituser'];
$id = $_SESSION['editid'];
if($cur_username !== $new_username){
  if(empty($new_username)){
    // empty
  } else {
    $user_check = mysqli_query($db, "SELECT * FROM users WHERE username = '". $new_username ."'");
    if(mysqli_num_rows($user_check) > 0){
      $_SESSION['editError'] = 1;
      header('Location: /staff');
    } else {
    mysqli_query($db, "UPDATE users SET username='".$new_username."' where id='".$id."';");
    $_SESSION['editSuccess'] = 1;
    header('Location: /staff');
    }
  }
}

$permlevel = $_POST['editpermlevel'];

if($permlevel == "perm_staff"){
  $permlevel = 1;
  mysqli_query($db, "UPDATE users SET permissionlevel='".$permlevel."' where id='".$id."';");
  $_SESSION['editSuccess'] = 1;
  header('Location: /staff');
} elseif($permlevel == "perm_admin"){
  $permlevel = 2;
  mysqli_query($db, "UPDATE users SET permissionlevel='".$permlevel."' where id='".$id."';");
  $_SESSION['editSuccess'] = 1;
  header('Location: /staff');
}

?>