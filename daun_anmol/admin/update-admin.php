<?php include('partials/header.php') ?>
 <!-- main content section goes here -->
 <div class="main-content">
    <div class="wrapper">
        <h1>update admin</h1>
        <br /><br />
        <?php
        //get the id of the admin 
        $id= $_GET['id'];
       //2. create sql query to delete the id
$sql = "SELECT * FROM member WHERE memberID=$id";


//3. executing the query
$res = mysqli_query($conn, $sql);
//check if the qury is executed
if ($res==true)
{
    //check if there is dat 
    $count = mysqli_num_rows($res);
    //check whether there is admin data
    if ($count==1)
    {
        //get the details
        //echo "Admin Available";
        $row=mysqli_fetch_assoc($res);
        $full_name =$row['full_name'];
        $username =$row['username'];

        
    }
    else {
        //redirect to admin page
        header('location:'.SITEURL.'admin/admin.php');
    }
   
}
        ?>
    
        
        <form action="" method ="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value= "<?php echo $full_name; ?>">
</td>
</tr>
                <tr>
                    <td>username:</td>
                    <td>
                        <input type="text" name="username" value= "<?php echo $username; ?>">
</td>
</tr>
<tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value= "Update Admin" class="btn-secondary">
</td>
</tr>
</table>

</form>

</div>
</div>
<?php 
//if the button is clicked
if(isset($_POST['submit']))
{
   // echo "button clicked";
   //get the values from the form to update
   $id =$_POST['id'];
    $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   //create an sql query to update
   $sql= "UPDATE member  SET
   full_name='$full_name',
   username='$username'
   where memberID='$id'
   ";
   //execute the query
   $res =mysqli_query($conn,$sql);

    //check if the query is executed
    if($res==true)
    {
        //query executed and admin updated
        $_SESSION['update'] ="<div class='success'>Admin updated successfully.</div>";
        //Redirect to manage admin
        header('location:'.SITEURL.'admin/admin.php');

    }
    else{
        //failed to update
        $_SESSION['update'] ="<div class='error'>Admin not updated.</div>";
        //Redirect to manage admin
        header('location:'.SITEURL.'admin/admin.php');

    }
}
?>


<?php include('partials/footer.php') ?>