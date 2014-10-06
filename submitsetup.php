<?php
include 'overall.php';
error_reporting(E_ALL);
include 'resources/database.php';
$orderid = $_POST['orderid'];
$check = mysqli_query($db, "SELECT * FROM setups WHERE orderid = '". $orderid ."'");
var_dump($check);

if(mysqli_num_rows($check) > 0){
  $_SESSION['sucess_error'] = 1;
  header('Location: /setups');
} else {
  function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
  }
  $uniquecode = generateRandomString();
  $code = mysqli_real_escape_string($db, $uniquecode);

  $pincode = $_POST['pincode'];

  $clientid = $_POST['userid'];

  $status = 0;

  $name = $_POST['name'];
  $name = mysqli_real_escape_string($db, $name);

  $email = $_POST['email'];

  $mc_version = $_POST['mc_version'];
  $mc_version = mysqli_real_escape_string($db, $mc_version);

  $perm1 = $_POST['perm1'];
  $perm2 = $_POST['perm2'];
  $perm3 = $_POST['perm3'];
  $perm4 = $_POST['perm4'];
  $perm5 = $_POST['perm5'];
  $perm6 = $_POST['perm6'];

  $perm1 = mysqli_real_escape_string($db, $perm1);
  $perm2 = mysqli_real_escape_string($db, $perm2);
  $perm3 = mysqli_real_escape_string($db, $perm3);
  $perm4 = mysqli_real_escape_string($db, $perm4);
  $perm5 = mysqli_real_escape_string($db, $perm5);
  $perm6 = mysqli_real_escape_string($db, $perm6);

  $mod_list = $_POST['mod_list'];
  $mod_list = mysqli_real_escape_string($db, $mod_list);

  $additional = $_POST['additional'];
  $additional = mysqli_real_escape_string($db, $additional);

  $applyquery = mysqli_query($db, "INSERT INTO `setups` (status, clientid, serviceid, uniquecode, pincode, name, email, mc_version, perm1, perm2, perm3, perm4, perm5, perm6, mod_list, additional) VALUES ('".$status."','".$clientid."','".$orderid."','".$code."', '".$pincode."', ".$name."','".$email."','".$mc_version."','".$perm1."','".$perm2."','".$perm3."','".$perm4."','".$perm5."','".$perm6."','".$mod_list."','".$additional."')") or die(mysqli_error($db));
  $_SESSION['setups_success'] = 1;
  $_SESSION['setups_string'] = $uniquecode;
  header("Location: /setups");
} ?>