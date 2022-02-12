<?php
//include constants.php
include('../config/constants.php');
//check whether the ida and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
   //echo "Get the value and delete";
   //1. get the ID of the category
$id = $_GET['id'];
$image_name= $_GET['image_name'];
//remove the physical image file
if($image_name != "")
{
    //image is available and can be removed
    $path="../images/category/".$image_name;
    //remove the image
    $remove= unlink($path);

    //if failed to remove image then add an error message and stop theprocess
    if($remove==false)
    {
        //set the session message
        $_SESSION['remove']="<div class='remove'> Failed to remove categoryimage.</div>";
        //redirect to manage category
        header('location;'.SITEURL.'admin/manage-category.php');
        //stop the process
        die();
    }
}


//2. create sql query to delete the id
$sql = "DELETE FROM menu_categories WHERE id=$id";


//3. executing the query
$res = mysqli_query($conn, $sql);

//check if the query is executed
if ($res==true)
{
    //echo "admin deleted";
    //create a session variable to display message 
    $_SESSION['delete'] = " <div class ='success'>category Deleted successfully.</div>";
    // redirect to manage manage-category page
    header ('location:'.SITEURL.'admin/manage-category.php');

}
else 
{
   // echo "Failed to Delete admin";
   $_SESSION['delete'] = "<div class ='error'> failed to delete category. Try again later.</div>";
    // redirect to manage category page
    header ('location:'.SITEURL.'admin/manage-category.php');
}
//redirecting to the admin page
}
else
{
    //redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');
}



?>