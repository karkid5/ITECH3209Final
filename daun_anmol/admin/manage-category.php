<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>manage Category</h1>
        <br /><br />

        <?php
       
       if(isset($_SESSION['add']))
       {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
       }
       if(isset($_SESSION['remove']))
       {
           echo $_SESSION['remove'];
           unset($_SESSION['remove']);
       }
       if(isset($_SESSION['delete']))
       {
           echo $_SESSION['delete'];
           unset($_SESSION['delete']);
       }
       if(isset($_SESSION['no-category-found']))
       {
           echo $_SESSION['no-category-found'];
           unset($_SESSION['no-category-found']);
       }
       if(isset($_SESSION['update']))
       {
           echo $_SESSION['update'];
           unset($_SESSION['update']);
       }
       if(isset($_SESSION['upload']))
       {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
       }
       if(isset($_SESSION['failed-upload']))
       {
           echo $_SESSION['failed-upload'];
           unset($_SESSION['failed-upload']);
       }



       ?>
       <br><br>
        <!--add category button-->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
</tr>
       <?php
       //query to get all categories from database
       $sql="SELECT * FROM menu_categories";

       //execute query
       $res= mysqli_query($conn, $sql);

       //count rows
       $count= mysqli_num_rows($res);

       $sn=1;//assin sn and it's value

       //check if there is data in table
       if($count>0)
       {
           //data is present
           //display the message inside table
           while($row=mysqli_fetch_assoc($res))
           {
               $id=$row['id'];
               $title=$row['title'];
               $image_name=$row['image_name'];
               $featured=$row['featured'];
               $active=$row['active'];
           
           ?>
                <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title ?></td>
                        <td><?php 
                            //check if the image name is provided
                            if($image_name!=="")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width="100px">
                                <?php
                            }
                            else
                            {
                                //display error message
                                echo "<div class='error'>Image not Added.</div>";
                            }
                        ?></td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary"> update category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">delete category</a>
                        </td>
                    
                </tr>
                <?php
           }
    


           
        }
       else
       {
           //no data
           ?> 
           
               <td colspan="6"><div class="error">No category to display.</div></td>
       </tr>
       <?php
           
           
       }
       ?>

      

            

</table>
    

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>