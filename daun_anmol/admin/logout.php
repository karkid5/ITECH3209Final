<?php
//include constants.php
include('../config/constants.php');
//destroy the session and redirect to login page
session_destroy();// unsets $_SESSION['username']

//2. redirect to login page
header('location:'.SITEURL.'admin/login.php');

?>
