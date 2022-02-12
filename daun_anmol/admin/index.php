<?php include('partials/header.php') ?>
   <!-- main content section goes here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Bulk Ordering program</h1>
        <br><br>

        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>

            <div class="col-4 text-center">
               <?php
               //create sql
               $sql="SELECT * FROM menu_categories";
               //Execute query
               $res=mysqli_query($conn, $sql);
               //count rows
               $count=mysqli_num_rows($res);

               ?>

                <h1><?php echo $count; ?></h1>
                <br />
                    Categories
            </div>
            <div class="col-4 text-center">
            <?php
               //create sql
               $sql2="SELECT * FROM items";
               //Execute query
               $res2=mysqli_query($conn, $sql2);
               //count rows
               $count2=mysqli_num_rows($res2);

               ?>
                <h1><?php echo $count2; ?></h1>
                <br />
                    Items
            </div>
            <div class="col-4 text-center">
            <?php
               //create sql
               $sql3="SELECT * FROM tbl_order";
               //Execute query
               $res3=mysqli_query($conn, $sql3);
               //count rows
               $count3=mysqli_num_rows($res3);

               ?>

                <h1><?php echo $count3; ?></h1>
                <br />
                    Orders
            </div>
            <div class="col-4 text-center">
            <?php
               //create sql
               $sql4="SELECT SUM(total) AS Total FROM tbl_order Where status='Delivered'";
               //Execute query
               $res4=mysqli_query($conn, $sql4);
               //count rows
               $row4=mysqli_fetch_assoc($res4);

               //Get the total revenue
               $total_revenue=$row4['Total'];


               ?>
                <h1><?php echo $total_revenue; ?></h1>
                <br />
                    Orders total
            </div>
            
            <div class="clearfix"></div>

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>

