<?php
include 'overall.php';
error_reporting(E_ALL);
include 'resources/database.php';
$email = $_POST['email'];
$check = mysqli_query($db, "SELECT * FROM sponsorships WHERE email = '". $email ."'");
var_dump($check);

if(mysqli_num_rows($check) > 0){
  $_SESSION['submit_error'] = 1;
  header('Location: /sponsorships');
} else {
  $name = $_POST['name'];
  $name = mysqli_real_escape_string($db, $name);
  $status = 0;
  $ign = $_POST['ign'];
  $ign = mysqli_real_escape_string($db, $ign);
  $age = $_POST['age'];
  $country = $_POST['country'];
  $country = mysqli_real_escape_string($db, $country);
  $size = $_POST['size'];
  $size = mysqli_real_escape_string($db, $size);
  $serverlocation = $_POST['serverlocation'];
  $serverlocation = mysqli_real_escape_string($db, $serverlocation);
  $why_requesting = $_POST['why-requesting'];
  $why_requesting = mysqli_real_escape_string($db, $why_requesting);
  $why_shouldwe = $_POST['why-shouldwe'];
  $why_shouldwe = mysqli_real_escape_string($db, $why_shouldwe);
  $how_promote = $_POST['how-promote'];
  $how_promote = mysqli_real_escape_string($db, $how_promote);
  $social_links = $_POST['social-links'];
  $social_links = mysqli_real_escape_string($db, $social_links);
  $applyquery = mysqli_query($db, "INSERT INTO `sponsorships` (status, name, email, ign, age, country, size, serverlocation, why_requesting, why_shouldwe, how_promote, social_links) VALUES ('".$status."','".$name."','".$email."','".$ign."','".$age."','".$country."','".$size."','".$serverlocation."','".$why_requesting."','".$why_shouldwe."','".$how_promote."','".$social_links."')") or die(mysqli_error($db));
  $_SESSION['submit_success'] = 1;
  header("Location: /sponsorships");
} ?>