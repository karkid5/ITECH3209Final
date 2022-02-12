<?php include('config/constants.php'); ?>
<?php include('admin/partials/login-check.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <!-- to make the website responsive-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convenience chain</title>

    <!--link our css file-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar section starts here-->
    <section class="navbar">
        <div class="container">
        <div class="logo"> <img src="images/logo.jpg" alt="Convenience Logo" class="img-responsive"></div>
        <div class="menu text-right">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="categories.php">Categories</a>
                </li>
                <li>
                    <a href="item.php">Item</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>admin/logout.php">Logout</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>

   