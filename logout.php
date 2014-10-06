<?php
require 'overall.php';
unset($_SESSION['sesh_username']);
unset($_SESSION['loggedIn']);
unset($_SESSION['permissionStaff']);
unset($_SESSION['permissionAdmin']);
header('Location: /index');
?>