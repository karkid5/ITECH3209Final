
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
            $path="../images/item/".$image_name;
            //remove the image
            $remove= unlink($path);

            //if failed to remove image then add an error message and stop theprocess
            if($remove==false)
            {
                //set the session message
                $_SESSION['upload']="<div class='error'> Failed to remove itemimage.</div>";
                //redirect to manage category
                header('location;'.SITEURL.'admin/manage-items.php');
                //stop the process
                die();
            }
        }


        //2. create sql query to delete the id
        $sql = "DELETE FROM items WHERE id=$id";


        //3. executing the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed
        if ($res==true)
        {
            //echo "item deleted";
            //create a session variable to display message 
            $_SESSION['delete'] = " <div class ='success'>item Deleted successfully.</div>";
            // redirect to manage manage-item page
            header ('location:'.SITEURL.'admin/manage-items.php');

        }
        else 
        {
        // echo "Failed to Delete item";
        $_SESSION['delete'] = "<div class ='error'> failed to delete item. Try again later.</div>";
            // redirect to manage item page
            header('location:'.SITEURL.'admin/manage-items.php');
        }
        //redirecting to the admin page
        }
else
{
    // echo "Failed to Delete item";
     // echo "Failed to Delete item";
     $_SESSION['unauthorize'] = "<div class ='error'> failed to delete item. Try again later.</div>";
    
        // redirect to manage item page
        header('location:'.SITEURL.'admin/manage-items.php');
    }
    //


?>
