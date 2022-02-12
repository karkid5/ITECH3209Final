<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br /><br />

        <?php
        //check if the id is passed
        if(isset($_GET['id']))
        {
            //echo "get the details";
            $id= $_GET['id'];
            // create sql to populate the form
            $sql= "SELECT * FROM menu_categories WHERE id=$id";

            //execute the query
            $res= mysqli_query($conn,$sql);

            //count the rows to check whether the id is valid
            $count= mysqli_num_rows($res);
            if($count==1)
            {
                //get all the data
                $row= mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

            }
            else
            {
                //redirect to manage category with session message
                $_SESSION['no-category-found']="<div class='error'>Category not found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

            }
        }
        else
        {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        ?>

      
      <form action="" method="POST" enctype="multipart/form-data">
          <table class="tbl-30">
              <tr>
                  <td>Title: </td>
                      <td>
                          <input type="text" name="title" value="<?php echo $title;?>">

                      </td>
                 
              </tr>
              <tr>
                  <td>Current Image: </td>
                      <td>
                          <?php
                          if($current_image !="")
                          {
                              //dispaly the image 
                              ?>
                              <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">

                              <?php
                          }
                          else
                          {
                              //display the error 
                              echo"<div class='error'>Image Not added.</div>";
                          }
                          ?>

                      </td>
                 
              </tr>
              <tr>
                  <td>New Image: </td>
                      <td>
                          <input type="file" name="image">

                      </td>
                 
              </tr>
              <tr>
                  <td>Featured: </td>
                      <td>
                          <input <?php if($active=="Yes"){echo "checked";} ?>  type="radio" name="featured" value="Yes">Yes
                          <input <?php if($active=="No"){echo "checked";} ?>  type="radio" name="featured" value="No">No

                      </td>
                 
              </tr>
              <tr>
                  <td>Active: </td>
                      <td>
                          <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                          <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="active" value="No">No

                      </td>
                 
              </tr>
              <tr>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
              </tr>

            </table>
      </form>
      <?php
        if(isset($_POST['submit']))

        {
           // echo"clicked";
           //1. Get allthe values from the form
           $id= $_POST['id'];
           $title=$_POST['title'];
           $current_image =$_POST['current_image'];
           $featured =$_POST['featured'];
           $active=$_POST['active'];

           //updating new image if selected
           $image_name=$_FILES['image']['name'];
           //check whether the image is available or not
           if($image_name !="")
           {
               //Image available
               //upload the new image 
               //auto rename our image
           //get the extension of our image(jpg, png) eg.food1.png
           $ext = end(explode('.', $image_name));
           //rename the image
           $image_name = "Category".rand(000,999).'.'.$ext;

           $source_path = $_FILES['image']['tmp_name'];

           $destination_path= "../images/category/".$image_name;
           //finally upload the image
           $upload = move_uploaded_file($source_path, $destination_path);
           //check whether the image is uploaded or not
           //and if the image is not uploaded the we will stop the process and redirect with error message
           if($upload==false)
           {
               //set message
               $_SESSION['upload']="<div class='error'> Failed to upload image. </div>";
               //Redirect to add category page
               header('location:'.SITEURL.'admin/manage-category.php');
               //stop the process
               die();
           }

               
               //and remove the current image
               if ($current_image!="")
               {
                $remove_path ="../images/category/".$current_image;
                $remove= unlink($remove_path);
                //chek whether the image is removed or not
 
                //if failed to remove the images disp'lay error and stop the image
                if($remove==false)
                {
                    //failed to remove image
                    $_SESSION['failed-remove']="<div class='error'> Failed to remove current image.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();//stop the process
                }

               }
              


           }
           else
           {
               $image_name= $current_image;
           }


           //update the database
           $sql2="UPDATE menu_categories SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            WHERE id=$id
           ";
           //execute the query
           $res2= mysqli_query($conn, $sql2);




           //redirect with the message
           //check if the query is executed
           if($res2==true)
           {
               //category updated
               $_SESSION['update'] ="<div class='success'>Category updated successfully.</div>";
               header('location:'.SITEURL.'admin/manage-category.php');
           }
           else
           {
            $_SESSION['update'] ="<div class='error'>Category update failed.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
           }

        }
      ?>
        

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>