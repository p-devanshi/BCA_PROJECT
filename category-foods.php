    
    <?php include('partials-front/menu.php'); 
        include_once 'config/Database.php';
        include_once 'class/Customer.php';
        include_once 'class/Food.php';
        include_once 'class/Category.php';
        include_once 'class/Restaur.php';

        $database = new Database();
        $db = $database->getConnection();

        $customer = new Customer($db);
        $food = new Food($db);
        $category = new Category($db);
        $restaur = new Restaur($db); 
   
        //CHeck whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];

            // Get the CAtegory Title Based on Category ID
            $result_cat = $category->selRest($category_id);
            foreach($result_cat as $cat_row){  
                 //Get the TItle                      
                $category_title = $cat_row['title'];  
            }
            
        }
        else if(isset($_GET['rest_id']))
        {
            //Category id is set and get the id
            $rest_id = $_GET['rest_id'];
            // Get the CAtegory Title Based on Category ID
            $result_rest = $restaur->selRest($rest_id); 
            foreach ($result_rest as $rest_row){
                $category_id = $rest_row['id'];
                $category_title = $rest_row['title'];
            } 
        }
        else
        {
            //CAtegory not passed
            //Redirect to Home page
            header('location:'.SITEURL);
        }
    ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            //Getting Foods from Database that are active and featured
            //SQL Query
            
            $result = $food->getItemsList($category_id);
            foreach($result as $food_row){                        
          
                    //Get all the values
                    $id = $food_row['id'];
                    $title = $food_row['title'];
                    $price = $food_row['price'];
                    $description = $food_row['description'];
                    $image_name = $food_row['image_name'];
                    $R_id = $food_row['R_Id'];

                   
                    // Get the CAtegory Title Based on Category ID
                    $result_rest1 = $restaur->selRest($R_id); 
                    foreach ($result_rest1 as $rest_row1){
                        $R_name = $rest_row1['R_name'];
                    } 
                    
                  
                    
                    ?>
                    
                    <div class="food-menu-box">
                        <form method="post" action="cart.php?action=add&id=<?php echo $id;?>">
                            <div class="food-menu-img">
                                <?php 
                                    //Check whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title . "(" . $R_name . ")"; ?></h4>
                                <p class="food-price">Rs.<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                <h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> 
                                <input type="hidden" name="item_name" value="<?php echo $title; ?>">
							    <input type="hidden" name="item_price" value="<?php echo $price; ?>">
							    <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                                <input type="submit"  name="add" value= "Order Now" class="btn btn-primary"></h5>
                            </div>
                        </form>
                    </div>
                                

                    <?php
                }
                        
            ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    
    <?php include('partials-front/footer.php'); ?>