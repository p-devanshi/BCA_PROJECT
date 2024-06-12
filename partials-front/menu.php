<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity=
"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
    </script>
      
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity=
"sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous">
    </script>
    
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>index.php" title="Logo">
                    <img src="images/logo2.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <?php
                if(isset($_SESSION["name"])){
                    $name_login = $_SESSION["name"];
                    $lg="Log Out";
                }
                else{
                    $name_login = "Guest";
                    $lg="Log In";
                }
            ?>
            <div class="menu text-right">
                <ul>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $name_login; ?> </a></li></br>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>restaurant.php">Restaurant</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>aboutus.php">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>my_order.php">My Order</a>
                    </li>
                         
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact Us</a>
                    </li>
                                              
                    <li>
                        <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
                    if(isset($_SESSION["cart"])){
                    $count = count($_SESSION["cart"]); 
                    echo "$count"; 
                        }
                    else
                        echo "0";
                    ?>) </a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <?php echo $lg; ?> </a></li>
                
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->