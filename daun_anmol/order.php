<?php include('partial-front/menu.php'); ?> 
<?php
//check whether food id is set or not
if(isset($_GET['item_id']))
{
    $item_id= $_GET['item_id'];
        $sql="SELECT * FROM items WHERE id=$item_id";
        //execute the query
        $res=mysqli_query($conn, $sql);
        //count the rows
        $count=mysqli_num_rows($res); 
        
        //check whether the data is available or not
        if($count==1)
        {
            //we have the data
            //get the data from database
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $description=$row['description'];
            $image_name=$row['image_name'];
        
        }
        else
        {
            //food not avaialable
            //redirect to home page
            header('location:'.SITEURL);
        
        }
    }
    else{
        //redirect to home page
        header('location:'.SITEURL);
    }

?>
<section class="item-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to complet your order.</h2>
        <form action="" method="POST"  >
            <fieldset>
                <legend>Selected Item</legend>
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
                    <h3><?php echo $title;?></h3>
                    <input type="hidden" name="item" value="<?php echo $title; ?>">

                    <p class="item-price"><?php echo "$price";?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <p class="item-detail">
                    <?php echo "$description";?>
                    </p>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    

                </div>
                
            </div>
                   
                
            </fieldset>
            <fieldset>
                <table class="tbl-30">
                <legend>Order details</legend>
                <div class="item-box">

                <div class="order-label">Store Name</div>
                <input type="text" name="store_name" placeholder="e.g. dee why convinience" class="input-responsive" required><br><br>
                
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="e.g 0416341802" class="input-responsive" required><br><br>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="e.g dinesh@gmail.com" class="input-responsive" required><br><br>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="e.g. Street, city, postcode" class="input-responsive" required></textarea><br><br>
                </table>

                <input type="submit" name="submit" value="confirm order" class="btn btn-primary">
            </div>
            </fieldset>


        </form>
        <?php
        //check whether submit button is clicked or not

                if(isset($_POST['submit']))
                {
                    $item=$_POST['item'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price*$qty;//total = price* qty
                    $order_date=date("Y-m-d h:i:sa");//order date
                    $status="ordered";//ordered, on delivery, delivered
                    $store_name=$_POST['store_name'];
                    $store_contact=$_POST['contact'];
                    $store_email=$_POST['email'];
                    $store_address=$_POST['address'];

                    echo $status;

                    //save the data
                    //create sql to save the data 
                    $sql2="INSERT INTO tbl_order SET
                        item='$item',
                        price='$price',
                        qty='$qty',
                        total='$total',
                        status='$status',
                        store_name='$store_name',
                        store_contact='$store_contact',
                        store_email='$store_email',
                        store_address='$store_address',
                        order_date='$order_date'
                        ";
                        //execute the query
                        $res2=mysqli_query($conn, $sql2);

                        //chcek if the query is executed
                        if($res2==true)
                        {
                            //query is executed
                            $_SESSION['order']="<div class='success text-center'>Food ordered successfully.</div>";
                            header('location:'.SITEURL);
                        }
                        else
                        {
                            //query failed
                              //query is executed
                              $_SESSION['order']="<div class='error text-center'>Food order failed.</div>";
                              header('location:'.SITEURL);

                        }
                    
                }

        ?>

    </div>

</section>
