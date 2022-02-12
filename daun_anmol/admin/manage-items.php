<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>manage items</h1>
        <br /><br />

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);

            }
            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);

            }

            if(isset($_SESSION['item-not-found']))
            {
                echo $_SESSION['item-not-found'];
                unset($_SESSION['item-not-found']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['imagechange']))
            {
                echo $_SESSION['imagechange'];
                unset($_SESSION['imagechange']);
            }

        ?>
        <br><br><br><br>
        <!--add admin button-->
        <a href="<?php echo SITEURL;?>admin/add-item.php" class="btn-primary">Add items</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>featured</th>
                <th>Active</th>
                <th>Action</th>
</tr>
            <?php 
                //creeate sql query to get all the food 
                $sql="SELECT * FROM items";
                //execute
                $res=mysqli_query($conn, $sql);

                //count rows to chek whether we have foods or not
                $count=mysqli_num_rows($res);

                //create a num variable and set a value
                $sn=1;
                if($count>0)
                {
                    //we have food in database
                    //get the values
                   while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values from individual column
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active']
                        ?>
                                    <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php 
                                //check if the image is blank or not
                                if($image_name=="")
                                {
                                    //we don't have image, Display error message
                                    echo "<div class='error'>Image not added.</div>";

                                }
                                else
                                {
                                    //we've image, display image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name;?>" width="100px">
                                    <?php
                                }
                            
                            ?></td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-item.php?id=<?php echo $id;?>&image_name=<?php echo$image_name; ?>" class="btn-secondary"> update item</a>
                                <a href="<?php echo SITEURL;?>admin/delete-item.php?id=<?php echo $id;?>&image_name=<?php echo$image_name; ?>" class="btn-danger">delete item</a>
                            </td>
                        
            </tr>


                        <?php
                    }
                
                }
                else
                {
                    //food not added in database
                    echo"<tr> <td colspan='7' class='error'> item not added yet.</td> </tr>";

                }
            ?>
            

</table>

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>