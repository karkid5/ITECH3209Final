<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
       <br><br><br>

       <?php
       
       if(isset($_SESSION['add']))
       {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
       }
       if(isset($_SESSION['upload']))
       {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
       }
       ?>
       <br><br>

       <!-- Add category form starts-->
       <form action="" method="POST" enctype="multipart/form-data">
           <table class="tbl-30">
               <tr>
                   <td>Title: </td>
                   <td>
                       <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
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
               header('location:'.SITEURL.'admin/add-category.php');
               //stop the process
               die();
           }

           }

         

       }
       else
       {
           //don't upload the image and set it's value as blank
           $image_name="";
       }

        //2. create sql query to insert data into database
        $sql="INSERT INTO menu_categories SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        //3. execute query
        $res= mysqli_query($conn, $sql);

        // check if the query is executed

        if($res==true)
        {
            //query executed and category added
            $_SESSION['add']="<div class='success'>category added successfully</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
            
        }
        else
        {
            //failed to add category
            $_SESSION['add']="<div class='error'>failed to add category</div>";
            //redirect to add category
            header('location:'.SITEURL.'admin/add-category.php');

        }
    }
    
    ?>

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>