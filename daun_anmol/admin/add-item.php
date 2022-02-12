<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>Add Item</h1>
       <br><br><br>
       <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

      
      

       <!-- Add category form starts-->
       <form action="" method="POST" enctype="multipart/form-data">
           <table class="tbl-30">
               <tr>
                   <td>Title: </td>
                   <td>
                       <input type="text" name="title" placeholder="item name">
                    </td>
                </tr>
                <tr>
                <tr>
                   <td>Description: </td>
                   <td>
                       <textarea name="description" cols="30" placeholder="items desciption"></textarea>
                    </td>
                </tr>
                <tr>
                   <td>Price: </td>
                   <td>
                       <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Select Image: </td>
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
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        
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
                       <input type="radio" name="featured" value="Yes"> Yes
                       <input type="radio" name="featured" value="No"> No

                    </td>
                </tr>
               
                <tr>
                   <td>Active: </td>
                   <td>
                       <input type="radio" name="active" value="Yes"> Yes
                       <input type="radio" name="active" value="No"> No

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add item" class="btn-secondary">
                    </td>
                </tr>
</table>
    </form>
 <!-- Add category form ends-->

    <?php 
    //check if the submit button is pressed
    if(isset($_POST['submit']))
    {
        //echo "clicked";
        //1. get the value form the form
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];
        //for radio input type we need to check whether the button is selected or not. 
        if(isset($_POST['featured']))
        {
            //Get the value form the form value
            $featured=$_POST['featured'];

        }
        else 
        {
            //set the default value
            $featured="No";

        }
        if(isset($_POST['active']))
        {
            $active=$_POST['active'];

        }
        else
        {
            $active="No";
        }
        //check if the image is selected or not

       // print_r($_FILES['image']);
        //die(); //break the code here
       if(isset($_FILES['image']['name']))
       {
           //upload the image
           //To upload the image we'll need the file name and location
           $image_name=$_FILES['image']['name'];

           //upload image only if the name is given
           if($image_name !=="")
           {
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
               $_SESSION['upload']="<div class='error'> Failed to upload image. </div>";
               //Redirect to add category page
               header('location:'.SITEURL.'admin/add-item.php');
               //stop the process
               die();
           }

           }
           else
       {
           //don't upload the image and set it's value as blank
           $image_name="";
       }

         

       }
       

        //2. create sql query to insert data into database
        $sql2="INSERT INTO items SET
        title='$title',
        description='$description',
        price='$price',
        image_name='$image_name',
        category_id=$category,
        featured='$featured',
        active='$active'
        ";

        //3. execute query
        $res2= mysqli_query($conn, $sql2);

        // check if the query is executed

        if($res2==true)
        {
            //query executed and items added
            $_SESSION['add']="<div class='success'>items added successfully</div>";
            //redirect to manage items
            header('location:'.SITEURL.'admin/manage-items.php');
            
        }
        else
        {
            //failed to add item
            $_SESSION['add']="<div class='error'>failed to add item</div>";
            //redirect to add category
            header('location:'.SITEURL.'admin/add-item.php');

        }
    }
    
    ?>

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>