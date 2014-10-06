<?php

$db = mysqli_connect("localhost","root","","swiftsetups");

// Check connection //

if (mysqli_connect_errno())
  {
  echo "MySQL Connection Error: " . mysqli_connect_error();
  }

?>