<?php

include 'resources/database.php';
$id = $_POST['id'];
$pincode = $_POST['pincode'];
error_reporting(E_ALL);

$checkpin = mysqli_query($db,"SELECT * FROM setups WHERE uniquecode='".$id."'") or die(mysqli_error($db));
var_dump($checkpin);
while($row = mysqli_fetch_array($checkpin)){
  if($row['pincode'] == $pincode){
    $expire = time()+60*60;
    setcookie("".$id."", "pass_unlocked", $expire);
    header("Location: /setups?id=".$id."");
  } else {
    header("Location: /setups?id=".$id."&e=1");
  }
}

?>