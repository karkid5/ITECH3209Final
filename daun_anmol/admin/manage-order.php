<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>manage order</h1>
        <br /><br />

        <?php
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>
        
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>store_name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
</tr>
                <?php
                //get all the orders from database
                $sql="SELECT * FROM tbl_order  ORDER BY id DESC ";
                //execute the query
                $res= mysqli_query($conn, $sql);
                //count the rows
                $count=mysqli_num_rows($res);
                $sn=1; //creat a variable 1 and set its value as one
                 if($count>0)

                 {
                     while($row=mysqli_fetch_assoc($res))
                     {
                     //order available
                     $id= $row['id'];
                     $item= $row['item'];
                     $price= $row['price'];
                     $qty= $row['qty'];
                     $total= $row['total'];
                     $order_date= $row['order_date'];
                     $status= $row['status'];
                     $store_name= $row['store_name'];
                     $store_contact= $row['store_contact'];
                    
                     $store_email= $row['store_email'];
                     $store_address= $row['store_address'];
                     ?>
                     <tr>
                <td><?php echo $sn++; ?>.</td>
                <td><?php echo $item; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo $order_date; ?></td>
                <td>
                    <?php 
                //ordered, on delivery, delivered, cancelled
                    if($status=="ordered")
                    {
                     echo "<label style='color: black;'>Ordered</label>"; 
                    }
                    elseif($status=="on delivery")
                    {
                        echo "<label style='color: orange;'>On Delivery</label>"; 
                    }
                    elseif($status=="delivered")
                    {
                        echo "<label style='color: green;'>Delivered</label>"; 
                    }
                    elseif($status=="cancelled")
                    {
                        echo "<label style='color: red;'>Cancelled</label>"; 
                    }

                    
                    ?>
                </td>
                <td><?php echo $store_name; ?></td>
                <td><?php echo $store_contact; ?></td>
                <td><?php echo $store_email; ?></td>
                <td><?php echo $store_address; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                    
                </td>
            
</tr>


                     <?php

                 }
                }
                 else{
                     //order nto available
                     echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                 }
               


                ?>

            

</table>

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>