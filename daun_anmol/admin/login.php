<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title> Convenience chain ordering system - login Page </title>

        <link rel="stylesheet" href="../css/admin.css">
</head>
    <body>
    <div class="login">
        <h1 class="login">Login</h1><br><br>
        <!-- login form starts here -->
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>

        <form action="" method="POST" class="text_center">
        Username:<br><br>

    <input type="text" name="username" placeholder="Enter the username"><br><br>
    Password:<br><br>
    <input type="password" name="password" placeholder="Enter the password"><br><br>
    
    <input type="submit" name="submit" value="login" class="btn-primary"><br><br>

</form>
         <!-- login form ends here -->


        <p class="text_center">Created by -<a href="www.dinesh.com">Project2team</a></p>

    
     
    
</div>

</body>


</html>
<?php 
//check if the submit button is cliked.
if(isset($_POST['submit']))
{
    //process for login
    //1. get dat formthe login form
   $username=mysqli_real_escape_string($conn,$_POST['username']);
     $raw_password=md5($_POST['password']);
     $password=mysqli_real_escape_string($conn, $raw_password);

    //Sql to check if the details match or not.
    $sql="SELECT * from member where username='$username' AND password='$password'";

    //execute the query
    $res = mysqli_query($conn, $sql);
    //count rows to check if the use exists
    $count = mysqli_num_rows($res);
    $row=mysqli_fetch_assoc($res);

    if($count==1){
        //user available and login success
        $_SESSION['login']="<div class='success'>Login Successful.</div>";
        $_SESSION['user']=$username;//checks whether the session is loggedin
        //Redirect to homepage or Dashboard
        if($row['role']=='admin'){
            header('location:'.SITEURL.'admin/');
        }
        else{
            header('location:'.SITEURL);
        }
    }
    else
    {
        //user not available
         //user  not available and login failed
         $_SESSION['login']="<div class='error text_center'>username password didn't match.</div>";
         //Redirect to login page
         header('location:'.SITEURL.'admin/login.php');
    }


}

?>
