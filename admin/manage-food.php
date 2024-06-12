<?php include('partials/menu.php'); 
include_once '../config/Database.php';
include_once '../class/Restaur.php';
include_once '../class/Food.php';
include_once '../class/Category.php';
$database = new Database();
$db = $database->getConnection();
$restaur = new Restaur($db);
$food = new Food($db);
$category = new Category($db);?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br />

                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Restaurant</th>                        
                        <th>Price</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        $sn = 1;
                        $result = $food->itemsList();
                        foreach($result as $row){
                              //get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $cat_id = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                $R_Id = $row['R_Id'];
                            
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php 
                                        $result1 = $restaur->selRest($R_Id);
                                        foreach($result1 as $rest_row){
                                            echo $rest_row["R_name"];
                                        }	
                                        ?>
                                    </td>

                                    <td>Rs.<?php echo $price; ?></td>
                                    <td><?php
                                        $res_cat = $category->selRest($cat_id);
                                        foreach($res_cat as $row_cat){
                                            echo $row_cat["title"];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active;  ?></td>
                                    
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>

                                                 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>