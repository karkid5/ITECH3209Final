<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br/><br/><br/>
        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }  ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
</tr>
<tr>
                    <td>username: </td>
                    <td><input type="text" name="username" placeholder="Enter the email"></td>
</tr>
<tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter the password"></td>
</tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn-secondary">
</td>
</tr>
</table>
</form>

            

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php') ?>
<?php  
    // process the value from form and save it in database
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "button clicked";
        //1. getting data from the form
        $full_name = $_POST['full_name'];
        $username= $_POST['username'];
        $password= md5($_POST['password']);

        //insert into database
        $sql= "INSERT INTO member SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
        //executing query and saving in database
      $res= mysqli_query($conn, $sql) or die(mysqli_error());
    
            //check whether the data is saved in the database or not.
    if ($res==TRUE)
    {
        //echo "data inserted";
        // create a session variable to display message
        $_SESSION['add']="<div class='success'>Admin added successfully.</div>";
       // redirect page to admin.php
        header("location:".SITEURL.'admin/admin.php');
    }
       
    else{
        //echo "failed to insert d $_SESSION['add']="Admin added successfully";
        // create a session variable to display message
        $_SESSION['add']="failed to add admin";
       // redirect page to admin.php
        header("location:".SITEURL.'admin/add-admin.php');
    }
    }

    
   
?>