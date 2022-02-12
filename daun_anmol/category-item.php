<?php include('partial-front/menu.php'); ?> 

<?php
//check if the id is provided
if(isset($_GET['category_id']))
{
    //Category Id is passed or notGE
    $category_id=$_GET['category_id'];//
    //get the category title based on category ID
    $sql="SELECT title FROM menu_categories WHERE id=$category_id";
    //execute the query
    $res= mysqli_query($conn, $sql);
    
    //get value of the data base
    $row=mysqli_fetch_assoc($res);
//get the title
$category_title= $row['title'];


}
else
{
    //if id is not passed redirect to index.php
    header('location;'.SITEURL);
}

?>
  <!-- item section starts here-->
  <section class="item-search text-center">
        <div class="container">
        <h2> Items on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
        
            
    
    
</div>

    

    <section class="item">
    <div class="container">
        <h2 class="text-center">Items</h2>
        <?php 
        //et the search keyword
       
        //sql query to ger teh results based on the search keyword
        $sql2= "SELECT * FROM items WHERE category_id=$category_id";
        //execute the query
        $res2= mysqli_query($conn, $sql2);
        //check whether food is availabel
        $count2= mysqli_num_rows($res2);
        //check whether food is available or not
        if($count2>0)
        {
            //food available
            while($row2=mysqli_fetch_assoc($res2))
            {
                $id=$row2['id'];
                $title=$row2['title'];
                $price=$row2['price'];
                $description=$row2['description'];
                $image_name=$row2['image_name'];
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
