<?php include('partial-front/menu.php'); ?> 
   <!-- catiegories section starts here-->
   <section class="categories">
        <div class="container">
        <h2 class="text-center">Categories</h2>

        <?php  
        //create sql to display categories from database
        $sql= "SELECT * from menu_categories WHERE active='Yes'";
        //execute the query
        $res= mysqli_query($conn, $sql);
        //check if there is data in the category
        $count =mysqli_num_rows($res);
        if($count>0)
        {
            //categories available
            while($row=mysqli_fetch_assoc($res))
            {
                //get the values like id, title, imag_name
                $id=$row['id'];
                $title=$row['title'];
                $image_name=$row['image_name'];
                ?>
                 <a href="<?php echo SITEURL; ?>category-item.php?category_id=<?php echo $id; ?>">
        <div class="box-3 float-container">
            <?php 
                //check if the image is available
                if($image_name=="")
                {
                    //display message
                    echo "<div class='error'>Image not available</div>";

                }else{
                    //image avalable
                    ?> 
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="coffee" class="img-responsive img-curve">

                    <?php
                }
                
            ?>
            
            <h3 class="float-text text-white"><?php echo "$title"; ?></h3>
        </div>
    </a>


                <?php
            }
        }
        else{
            //categori not available
            echo "<div class='error'>Category not found</div>";
        }

        ?>
       
        
        <div class="clearfix"></div>
    </div>

    </section>



<?php include('partial-front/footer.php'); ?> 
