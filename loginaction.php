<?php

include 'overall.php';
include 'resources/database.php';
$email = $_POST['email'];
$password = md5($_POST['password']);
$ref = $_SERVER['HTTP_REFERER'];
$_SESSION['loginError'] = 0;
unset($_SESSION['loginError']);
$_SESSION['loginErrorPermlevel'] = 0;
unset($_SESSION['loginErrorPermlevel']);

$query = mysqli_query($db, "SELECT * FROM users WHERE email='".$email."'");

if($query->num_rows) {

  while ($row = mysqli_fetch_array($query)){

      if ($email == $row['email'] && $password == $row['password']){
        if($row['permissionlevel'] == 0){
          $_SESSION['loginErrorPermlevel'] = 1;
          header('Location: /login');
        } elseif($row['activated'] == 0){
          $_SESSION['loginErrorActivated'] = 1;
          header('Location: /index');
        }elseif($row['permissionlevel'] == 1){
          $_SESSION['permissionStaff'] = 1;
        $_SESSION['loggedIn'] = 1;
        $_SESSION['sesh_username'] = $row['username'];
        header('Location: /index');
        } elseif($row['permissionlevel'] == 2){
          $_SESSION['permissionAdmin'] = 1;
        $_SESSION['loggedIn'] = 1;
        $_SESSION['sesh_username'] = $row['username'];
        header('Location: /index');
        }
      } else {
        $_SESSION['loginError'] = 1;
        header('Location: /login');
      }
    }
  } else {
    $_SESSION['loginError'] = 1;
    header('Location: /login');
  }

?>