<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>manage admin</h1>
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
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if(isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if(isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        

        ?>
        <br><br>

        <!--add admin button-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Acrtions</th>
</tr>
            <?php
            $sql = "SELECT * FROM member";
            $res = mysqli_query($conn, $sql);

             // check if the query is executed
             if ($res==TRUE)
             {
                // count if the database has data
                $count= mysqli_num_rows($res);
                
                $sn=1; // create a variable and assign the value


                //check the num of rows
                if ($count>0)
                {
                    //data is there then
                    while ($rows=mysqli_fetch_assoc($res))
                {
                    //while loop will extract data as long as there is data
                    //getting individual data
                    $id=$rows['memberID'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];
                    //Display the values in our table
                    ?>
                     <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary"> update admin</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">delete admin</a>
                        </td>
            
</tr>


                    <?php 


                }                }
             }


            ?>
                        
</table>
</div>
</div>

                

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>