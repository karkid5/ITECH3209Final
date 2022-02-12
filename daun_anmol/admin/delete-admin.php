<?php
//include constants.php
include('../config/constants.php');

//1. get the ID of the admin
$id = $_GET['id'];


//2. create sql query to delete the id
$sql = "DELETE FROM member WHERE memberID=$id";


//3. executing the query
$res = mysqli_query($conn, $sql);

//check if the query is executed
if ($res==true)
{
    //echo "admin deleted";
    //create a session variable to display message 
    $_SESSION['delete'] = " <div class ='success'>Admin Deleted successfully.</div>";
    // redirect to manage admin page
    header ('location:'.SITEURL.'admin/admin.php');

}
else 
{
   // echo "Failed to Delete admin";
   $_SESSION['delete'] = "<div class ='error'> failed to delete admin. Try again later.</div>";
    // redirect to manage admin page
    header ('location:'.SITEURL.'admin/admin.php');
}
//redirecting to the admin page

?>
