<?php include('partial-front/menu.php'); ?>


    <!-- Navbar section starts here-->
    <section class="item-search text-center">
        <div class="container">
            <form action="item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for item..">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
    </div>

    </section>
    <!-- search  section ends here-->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

    ?>

   <!-- catiegories section starts here-->
   <section class="categories">
        <div class="container">
        <h2 class="text-center">Categories</h2>

        <?php  
        //create sql to display categories from database
        $sql= "SELECT * from menu_categories WHERE active='Yes' AND featured='Yes' LIMIT 3";
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
    <!-- item section starts here-->
    <section class="item">
        <div class="container">
        <h2 class="text-center">Explore items</h2>
        <?php  
        //getting food from databases
        //sql query
        $sql2= "SELECT * FROM items WHERE active='Yes' AND featured='Yes' LIMIT 4";
        //execute the query
        $res2= mysqli_query($conn, $sql2);
        //check if the table has data
        $count2= mysqli_num_rows($res2);
        //check if the item is available
        if($count2>0)
        {
            //food is available
            while($row2=mysqli_fetch_assoc($res2))
            {
                //get all the values
                $id=$row2['id'];
                $title=$row2['title'];
                $price=$row2['price'];
                $description=$row2['description'];
                $image_name=$row2['image_name'];
                ?>
                <div class="item-box">
                <div class="item-img">
                    <?php
                    //check whether the image is available or not
                    if($image_name=="")
                    {
                        echo "<div class='error'>Image not available.</div>";
                    
                    }
                    else{
                        //image available
                        ?>

                        <img src="<?php echo SITEURL;?>images/item/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                    
                </div>
                <div class="item-desc">
                    <h4><?php echo "$title";?></h4>
                    <p class="item-price"><?php echo "$price";?></p>
                    <p class="item-detail">
                    <?php echo "$description";?>
                    </p>
                    <br>
                    <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>

                </div>
                
            </div>


                <?php

                
            }
           
        }
        else
        {
            echo "<div class='error'>Food not available.</div>";

        }
        ?>
        
            
            
        </div>
    
    <div class="clearfix"></div>
</div>

    </section>
    <?php include('partial-front/footer.php'); ?> 
   