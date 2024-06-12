"";
<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center" style="background-color:#CCCCFF;">

                    <?php 
                        //Sql Query 
                        $sql = "SELECT * FROM tbl_restaurant";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Restaurants
                </div>

                <div class="col-4 text-center" style="background-color:#A7C7E7;">

                    <?php 
                        //Sql Query 
                        $sql2 = "SELECT * FROM tbl_category";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center" style="background-color:#6F8FAF;">
                    
                    <?php 
                        //Sql Query 
                        $sql3 = "SELECT * FROM  tbl_food";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Foods
                </div>

                <div class="col-4 text-center" style="background-color:#6495ED;">

                    <?php 
                        //Sql Query 
                        $sql4 = "SELECT * FROM food_orders";
                        //Execute Query
                        $res4 = mysqli_query($conn, $sql4);
                        //Count Rows
                        $count4 = mysqli_num_rows($res4);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Total Orders
                    </div>

                    <div class="col-4 text-center" style="background-color:#0047AB;">
                                        
                    <?php 
                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql5 = "SELECT SUM(Total) AS Total_O FROM  food_orders WHERE status='Delivered'";

                        //Execute the Query
                        $res5 = mysqli_query($conn, $sql5);

                        //Get the VAlue
                        $row5 = mysqli_fetch_assoc($res5);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row5['Total_O'];

                    ?>

                    <h1>Rs. <?php echo $total_revenue; ?></h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>