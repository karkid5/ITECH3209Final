<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br/><br/><br/>
        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }  ?>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
            ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>current password: </td>
                    <td><input type="password" name="current_password" placeholder="Enter your old password"></td>
</tr>
<tr>
                    <td>New password: </td>
                    <td><input type="password" name="new_password" placeholder="Enter the new password"></td>
</tr>
<tr>
                    <td>Confirm password: </td>
                    <td><input type="password" name="confirm_password" placeholder="confirm the password"></td>
</tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
</td>
</tr>
</table>
</form>

            

    </div>
</div>

<?php 
        // check whether the submit button is clicked
    if(isset($_POST['submit']))
    {
        //echo "clicked";
        //1. get the data from form
        $id=$_POST['id'];
        $current_password= md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        //2. check if the user with current ID and current password existor not
        $sql ="SELECT *FROM member where memberID=$id and password='$current_password'";
        //3. execute the query
        $res= mysqli_query($conn,$sql);
        if ($res==true)
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //user exist and password cna be changed
            //echo "user found";
            //check whether the new password and confirm password match or not.
            if ($new_password==$confirm_password)
            {
                //update the password
                $sql2= "UPDATE member SET
                password='$new_password'
                where memberID=$id
                ";
                //execute the query
                $res2=mysqli_query($conn, $sql2);

                //check if the query is executed
                if($res2==true){
                    //success message;
                    //echo "success";
                   $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully. </div>";
                    //redirect
                   header('location:'.SITEURL.'admin/admin.php');
         

                }
                else{
                    //display error message
                    $_SESSION['change-pwd'] = "<div class='error'>password update failed. </div>";
           //redirect
           header('location:'.SITEURL.'admin/admin.php');

                }
            }
            else
            {
                $_SESSION['pwd-not-match'] = "<div class='error'>Password didn't match. </div>";
                //redirect
                header('location:'.SITEURL.'admin/admin.php');  
            }
        }
        else
        {
           //echo "user not found";
           //user not found message and redirect
           $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
           //redirect
           header('location:'.SITEURL.'admin/admin.php');
        }
    }
?>


<?php include('partials/footer.php') ?>