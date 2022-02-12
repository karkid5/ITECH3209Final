<?php 

//Authorisation -access control
//check if the user is loged in
if(!isset($_SESSION['user']))//if the user session is not set
{
    //user not logged in
   
    $_SESSION['no-login-message']="<div class='error text_center'>Please login to access pages.</div>";
     //redirect to login page
     header('location:'.SITEURL.'admin/login.php');

}
    
    
?>