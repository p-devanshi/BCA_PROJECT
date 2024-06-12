<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Restaurant</h1>

        <br><br>


        <?php 
        
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_restaurant WHERE 	R_ID=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $R_ID = $row['R_ID'];
                    $R_name = $row['R_name'];
                    $email = $row['email'];
                    $contact = $row['contact'];
                    $address = $row['address'];
                    $R_image = $row['R_image'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                //redirect to Manage CAtegory
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
                <tr>
                    <td>Name of the Restaurant: </td>
                    <td>
                        <input type="text" name="R_name" value="<?php echo $R_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email of the Restaurant: </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Contact of the Restaurant: </td>
                    <td>
                        <input type="text" name="contact" value="<?php echo $contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Address of the Restaurant: </td>
                    <td>
                        <input type="text" name="address" value="<?php echo $address; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($R_image != "")
                            {
                                //Display the Image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/restaurant/<?php echo $R_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display Message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $R_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $R_ID; ?>">
                        
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Restaurant" class="btn-secondary">
                    </td>
                </tr>
                

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                
                //echo "Clicked";
                //1. Get all the values from our form
                $id = $_POST['id'];
                $R_name = $_POST['R_name'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];
                $address = $_POST['address'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];                

                //2. Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        //Image Available

                        //A. UPload the New Image

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "restaurant_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/restaurant/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'admin/manage-restaurant.php');
                            //STop the Process
                            die();
                        }

                        //B. Remove the Current Image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/restaurant/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-restaurant.php');
                                die();//Stop the Process
                            }
                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
                

                //3. Update the Database
                $sql2 = "UPDATE tbl_restaurant SET 
                    R_name ='$R_name',
                    email ='$email',
                    contact ='$contact',
                    address ='$address',
                    R_image='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE R_ID=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. REdirect to Manage Category with MEssage
                //CHeck whether executed or not
                if($res2==true)
                {
                    //Category Updated
                    header('location:'.SITEURL.'admin/manage-restaurant.php');
                }
                else
                {
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update restaurant.</div>";
                    header('location:'.SITEURL.'admin/manage-restaurant.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>