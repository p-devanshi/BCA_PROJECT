
<?php include('partials-front/menu.php'); 
       include_once 'config/Database.php';
       include_once 'class/Customer.php';
       include_once 'class/Food.php';
       include_once 'class/Category.php';
       include_once 'class/Restaur.php';
?>

     <!-- fOOD sEARCH Section Starts Here -->
     <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>category-serach.php" method="POST">
                <input type="search" name="search" placeholder="Search for categories.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php 
                if(isset($_GET['rest_id']))
                {
                    //Category id is set and get the id
                    $rest_id = $_GET['rest_id'];
                    $sql1="SELECT * FROM  tbl_restaurant WHERE R_ID=$rest_id";
                    $res1 = mysqli_query($conn, $sql1);
                    while($row1=mysqli_fetch_assoc($res1)){
                        $rest_title = $row1['R_name'];
                    }
                    // Get the CAtegory Title Based on Category ID
                    $sql = "SELECT * FROM tbl_category WHERE R_Id=$rest_id";  
                                           
                }
                //Display all the cateories that are active
                //Sql Query
                else {$sql = "SELECT * FROM tbl_category WHERE active='Yes'";}

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
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $rest_id = $row['R_Id'];
                        $sql1="SELECT * FROM  tbl_restaurant WHERE R_ID=$rest_id";
                        $res1 = mysqli_query($conn, $sql1);
                        while($row1=mysqli_fetch_assoc($res1)){
                            $rest_title = $row1['R_name'];
                        }
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
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
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></br></h3>
                                <h4 class="rest-text text-white"><?php echo $rest_title; ?></br></h4>                                
                            
                                </h3>
                                
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //CAtegories Not Available
                    echo "<div class='error'>Category not found.</div>";
                }
            
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>