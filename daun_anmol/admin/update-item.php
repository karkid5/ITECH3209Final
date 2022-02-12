<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>Update item</h1>
        <br /><br />

        <?php
        //check if the id is passed
        if(isset($_GET['id']))
        {
            //echo "get the details";
            $id= $_GET['id'];
            // create sql to populate the form
            $sql2= "SELECT * FROM items WHERE id=$id";

            //execute the query
            $res2= mysqli_query($conn,$sql2);

            //count the rows to check whether the id is valid
            $count2= mysqli_num_rows($res2);
            if($count2==1)
            {
                //get all the data
                $row2= mysqli_fetch_assoc($res2);
                $title=$row2['title'];
                $description=$row2['description'];
                $price=$row2['price'];
                $current_image=$row2['image_name'];
                $current_category=$row2['category_id'];
                $featured=$row2['featured'];
                $active=$row2['active'];

            }
            else
            {
                //redirect to manage items with session message
                $_SESSION['no-item-found']="<div class='error'>Item not found.</div>";
                header('location:'.SITEURL.'admin/manage-items.php');

            }
        }
        else
        {
            //redirect to manage item
            header('location:'.SITEURL.'admin/manage-items.php');
        }

        ?>

      
<form action="" method="POST" enctype="multipart/form-data">
           <table class="tbl-30">
               <tr>
                   <td>Title: </td>
                   <td>
                       <input type="text" name="title" placeholder="item name" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                <tr>
                   <td>Description: </td>
                   <td>
                       <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                   <td>Price: </td>
                   <td>
                       <input type="number" name="price"value="<?php echo $price; ?>">
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
                              <img src="<?php echo SITEURL;?>images/item/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="150px">

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
                <tr>
                    <td>Select new Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                                //create PHP code to display categories from database
                                // 1.create sql to get all active categories from database
                                $sql="SELECT * FROM menu_categories WHERE active='Yes'";

                                //execute the query
                                $res= mysqli_query($conn, $sql);

                                //count rows to check if there is data in the menu_categories
                                $count=mysqli_num_rows($res);

                                //if count is greater than zero, we have categories else we don't have categories
                                if($count>0)
                                {
                                    //we have the data
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $category_id=$row['id'];
                                        $category_title=$row['title'];
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        
                                        <?php
                                    }
                                }
                                else
                                {
                                    //we don't have data
                                    ?>
                                    <option value="0">No Category found</option>
                                    <?php
                                }


                                //2. display on dropdown

                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                   <td>Featured: </td>
                   <td>
                       <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                       <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No

                    </td>
                </tr>
               
                <tr>
                   <td>Active: </td>
                   <td>
                       <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                       <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $category_id; ?>">
                        <input type="submit" name="submit" value="Update item" class="btn-secondary">
                    </td>
                </tr>
</table>
    </form>
 <!-- Add item form ends-->
      <?php
        if(isset($_POST['submit']))

        {
           // echo"clicked";
           //1. Get allthe values from the form
           $id= $_POST['id'];
           $title=$_POST['title'];
           $description=$_POST['description'];
           $price=$_POST['price'];

           $current_image =$_POST['current_image'];
           $category =$_POST['category'];
           $featured =$_POST['featured'];
           $active=$_POST['active'];

           if(isset($_FILES['image']['name']))
           {

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
                    $image_name = "item".rand(0000,9999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path= "../images/item/".$image_name;
                    //finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    //check whether the image is uploaded or not
                    //and if the image is not uploaded the we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['imagechange']="<div class='error'> Failed to upload image. </div>";
                            //Redirect to manage items page
                            header('location:'.SITEURL.'admin/manage-items.php');
                            //stop the process
                            die();
                        }

                            
                            //and remove the current image
                        if ($current_image!="")
                            {
                                $remove_path ="../images/item/".$current_image;
                                $remove= unlink($remove_path);
                                //chek whether the image is removed or not
                
                                //if failed to remove the images disp'lay error and stop the image
                                if($remove==false)
                                {
                                    //failed to remove image
                                    $_SESSION['failed-remove']="<div class='error'> Failed to remove current image.</div>";
                                    header('location:'.SITEURL.'admin/manage-items.php');
                                    die();//stop the process
                                }

                            }
                    


                }
           }
                else
                {
                    $image_name= $current_image;
                }


           //update the database
           $sql3= "UPDATE items SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            WHERE id=$id
           ";
           //execute the query
           $res3= mysqli_query($conn, $sql3);




           //redirect with the message
           //check if the query is executed
           if($res3==true)
           {
               //item updated
               $_SESSION['update'] ="<div class='success'>item updated successfully.</div>";
               header('location:'.SITEURL.'admin/manage-items.php');
           }
           else
           {
            $_SESSION['update'] ="<div class='error'>item update failed.</div>";
            header('location:'.SITEURL.'admin/manage-items.php');
           }

        }
      ?>
        

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>