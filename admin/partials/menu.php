<?php 
    include('../config/constants.php'); 
    include('login-check.php');    
?>


<html>
    <head>
        <title>Food Order Website - Home Page</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-restaurant.php">Restaurant</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>   
                    <li><label for="Select Date">Select Date:</label><input type="date" id="myCheck" name="sdate"></li>
                    <button onclick="myFunction()">Check me!</button>                                          
                </ul>
                
            </div>
        </div>
        

<script>
    function myFunction() {
    var x = document.getElementById("myCheck").value;  
    window.location.assign("manage-today-order.php?a="+x);    
    }
</script>

      
        <!-- Menu Section Ends -->