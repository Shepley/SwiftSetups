<?php

include 'resources/database.php';
$countquery = mysqli_query($db, "SELECT * FROM setups WHERE status=0 OR status=1");
$countsetups = mysqli_num_rows($countquery);

$countreqquery = mysqli_query($db, "SELECT * FROM setups WHERE requestinghelp=1 AND status=1");
$countreqsetups = mysqli_num_rows($countreqquery);