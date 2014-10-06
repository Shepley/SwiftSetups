<?php
include 'resources/database.php';
$id = $_POST['notes_id'];
$notes = $_POST['notes'];
$save = mysqli_query($db,"UPDATE setups SET notes='".$notes."' WHERE uniquecode='".$id."';") or die(mysqli_error($db));
session_start();
$_SESSION['notes_saved'] = 1;
header("Location: /setups?id=".$id."");
?>