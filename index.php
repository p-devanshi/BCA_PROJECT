    <?php 
        include('partials-front/menu.php'); 
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

        // if(!$customer->loggedIn()) {	
        //     header("Location: login.php");	
        // }
       
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $res_cat = $category->itemsList();
                foreach($res_cat as $row_cat){
                        //Get the Values like id, title, image_name
                        $id = $row_cat['id'];
                        $title = $row_cat['title'];
                        $image_name = $row_cat['image_name'];
                        $R_id = $row_cat['R_Id'];

                        $rest_rest = $restaur->selRest($R_id);
                        foreach($rest_rest as $row_res){
                            $R_name = $row_res['R_name'];
                        }                        
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display MEssage
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                <h4 class="rest-text text-white"><?php echo $R_name; ?></h4>                                
                            </div>
                        </a>

                        <?php
                    }
            
               
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            $res_food = $food->itemsList();
            foreach($res_food as $row_food){
                $id = $row_food['id'];
                $title = $row_food['title'];
                $price = $row_food['price'];
                $description = $row_food['description'];
                $image_name = $row_food['image_name'];
                $Rest_id = $row_food['R_Id'];
                $r1 = $restaur->selRest($Rest_id);
                foreach($r1 as $ro_res){
                    $R_n = $ro_res['R_name'];
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
                                <h4><?php echo $title . "(" .$R_n. ")"; ?></h4>
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