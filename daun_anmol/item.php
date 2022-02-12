<?php include('partial-front/menu.php'); ?> 

</section>
    <!-- Navbar section starts here-->
    <section class="item-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for item..">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
    </div>

    </section>
  <!-- item section starts here-->
  
  </section>
    <!-- item section starts here-->
    <section class="item">
        <div class="container">
        <h2 class="text-center">Explore items</h2>
        <?php  
        //getting food from databases
        //sql query
        $sql2= "SELECT * FROM items WHERE active='Yes'";
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

                        <img src="<?php echo SITEURL;?>images/item/<?php echo $image_name;?>" alt="hawai" class="img-responsive img-curve">
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
