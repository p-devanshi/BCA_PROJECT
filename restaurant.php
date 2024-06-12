
<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
        <div class="container">
            
           <!-- <form action="<?php echo SITEURL; ?>restaurant-serach.php" method="POST">
                <input type="search" name="search" placeholder="Search for restaurants.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>-->

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Restaurant</h2>

        <?php 

            //Display all the cateories that are active
            //Sql Query
            $sql = "SELECT * FROM  tbl_restaurant WHERE active='Yes'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //CHeck whether categories available or not
            if($count>0)
            {
                //CAtegories Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $id = $row['R_ID'];
                    $title = $row['R_name']; 
                    $image_name = $row['R_image'];  
                    $add = $row['address'];                  
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>categories.php?rest_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not found.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/restaurant/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            <h3 class="rest-text text-white"><?php echo $add; ?>
                        </div>
                    </a>

                    <?php
                }
            }
            else
            {
                //CAtegories Not Available
                echo "<div class='error'>Restaurant not found.</div>";
            }
        
        ?>
        

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>