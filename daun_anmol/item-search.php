<?php include('partial-front/menu.php'); ?> 
<section>
    <!-- search section starts here-->
    <section class="item-search text-center">
        <div class="container">
            <?php 
            $search= mysqli_real_escape_string($conn, $_POST['search']); ?>
            <h2>Item on your search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
    </div>
</section>

    <section class="item">
    <div class="container">
        <h2 class="text-center">Items</h2>
        <?php 
        //et the search keyword
       
        //sql query to ger teh results based on the search keyword
        $sql= "SELECT * FROM items WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        //execute the query
        $res= mysqli_query($conn, $sql);
        //check whether food is availabel
        $count= mysqli_num_rows($res);
        //check whether food is available or not
        if($count>0)
        {
            //food available
            while($row=mysqli_fetch_assoc($res))
            {
                $id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
                $description=$row['description'];
                $image_name=$row['image_name'];
                ?>
                <div class="item-box">
                    <div class="item-img">
                        <?php
                        //check whether the image name is available or note
                        if($image_name== "")
                        {
                            //image unavailable
                            echo "<div class='error'> Image not available.</div>";

                        }
                        else{
                            //image availavel
                            ?>
                            <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curve">

                            <?php
                        }
                        ?>
                        
                    </div>
                    <div class="item-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="item-price">$<?php echo $price; ?></p>
                        <p class="item-detail">
                             <?php echo $description; ?>
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
            //food not available
            echo "<div class='error'>Item not found</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>
    
    </section>
   



<?php include('partial-front/footer.php'); ?> 




    
