<?php

//start session
    session_start();


//create constantss
define('SITEURL','http://localhost/daun_anmol/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD','');
define('DB_NAME', 'test');


$conn = mysqli_connect('localhost', 'root','') or die(mysqli_error()); //database connection
$db_select= mysqli_select_db($conn, 'test') or die(mysqli_error()); //selecting database



?>
