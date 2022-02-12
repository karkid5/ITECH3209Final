<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>Update order</h1>
        <br /><br />

        <?php
        //check whether id is set or not
        if(isset($_GET['id']))
        {
            //get the other details
            $id=$_GET['id'];
            //Sql query to get all the details
            $sql= "SELECT * FROM tbl_order WHERE id=$id";
            //execute  the query
            $res= mysqli_query($conn, $sql);

            //count row
            $count=mysqli_num_rows($res);
            
            if($count==1)
            {
                //detail available
                $row=mysqli_fetch_assoc($res);
                $item=$row['item'];
                $price=$row['price'];
                $qty=$row['qty'];
                $status=$row['status'];
                $store_name=$row['store_name'];
                $store_contact=$row['store_contact'];
                $store_email=$row['store_email'];
                $store_address=$row['store_address'];

            }
            else
            {
                //detail not available 
                //redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');

            }

        }
        else{
            //redirect to manage order page
            header('location:'.SITEURL.'admin/manage-order.php');
        }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Item Name</td>
                    <td><?php echo $item; ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>$<?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="ordered"){echo "selected";} ?> value="ordered">Ordered</option>
                            <option <?php if($status=="on delivery"){echo "selected";} ?> value="on delivery">On Delivery</option>
                            <option <?php if($status=="delivered"){echo "selected";} ?> value="delivered">Delivered</option>
                            <option <?php if($status=="cancelled"){echo "selected";} ?>value="cancelled">Cancelled</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Store Name:</td>
                    <td>
                        <input type="text" name="store_name" value="<?php echo $store_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Store contact:</td>
                    <td>
                        <input type="text" name="store_contact" value="<?php echo $store_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Store Address:</td>
                    <td>
                        <input type="text" name="store_address" value="<?php echo $store_address; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Store Email:</td>
                    <td>
                        <input type="text" name="store_email" value="<?php echo $store_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">


                    </td>
                </tr>

            </table>
        </form>

        <?php
        //check if the updat button is clicked
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            $id=$_POST['id'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];

            $total=$price*$qty;
            
            $status=$_POST['status'];
            $store_name=$_POST['store_name'];
            $store_contact=$_POST['store_contact'];
            $store_email=$_POST['store_email'];
            $store_address=$_POST['store_address'];

            //update the table
            $sql2="UPDATE tbl_order SET
                qty=$qty,
                total=$total,
                status='$status',
                store_name='$store_name',
                store_contact='$store_contact',
                store_email='$store_email',
                store_address='$store_address'
                WHERE id=$id
            ";
            //execute
            $res2=mysqli_query($conn, $sql2);

            //check whether update or not
            // and redirect to manage order
            if($res2==true)
            {
                //updated
                $_SESSION['update']="<div class='success'>Order updated successfully.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');

            }
            else
            {
                //not updated
                $_SESSION['update']="<div class='error'>update failed.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        }

        ?>

        
        

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>