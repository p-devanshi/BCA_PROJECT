<?php 
include 'partials-front/menu.php';
include_once 'config/constants.php';
include_once 'config/Database.php';
include_once 'class/Customer.php';

 $database = new Database();
 $db = $database->getConnection();

$customer = new Customer($db);
$regMessage = 'Please Fill The All Details...!';?>
<title>Industrial Training Center - Food Delight App</title>


    <div class="container"> 
		            
            <h2 class="text-center">Create Customer </h2>         	

			<form id="loginform" class="login" role="form" method="POST" action=""> 
				
				<fieldset>  
                    <label><? echo $regMessage?></label> 

                    <div class="order-label">Name</div>	
						<input type="text" class="order-input" id="name" name="name" placeholder="name" style="background:white;" required>                                        
                    
                    <div class="order-label">Contact</div>	
						<input type="text" class="order-input" id="phone" name="phone" placeholder="phone" style="background:white;" required>                                        
                        
                    <div class="order-label">Address</div>	
						<input type="text"  class="order-input" id="address" name="address" placeholder="address" style="background:white;" required>                                        
					                
					<div class="order-label">E-Mail</div>
						<input type="text" class="order-input" id="email" name="email" placeholder="email" style="background:white;" required>                                        
					
					<div class="order-label">Password</div>	
						<input type="password" class="order-input" id="password" name="password" placeholder="password" required>
								
					<div class="order-label">	
						<input type="submit" name="Save" value="Save" class=" btn btn-success">	
						<input type="submit" name="Reset" value="Reset" class=" btn btn-danger">
					</div>					  
				</fieldset>
			</form>  
		
			                    
	</div>  

<?php

    if(isset($_POST["Save"])){
        $name = $conn->real_escape_string($_POST['name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        $query = "INSERT into food_customer(name,email,password,phone,address) VALUES
        ('" . $name . "','" . $email . "','" . $password . "','" . $phone . "','" . $address ."')";
        $success = $conn->query($query);
        if($success){            
            $regMessage = "Customer Created"; 
            //header("Location: login.php?regMessage=".$regMessage);       
            echo '<script>window.location="login.php"</script>';
        }
        else{
            $regMessage = die("Couldnt enter data: ".$conn->error);
        }
        $conn->close();
    }
    if(isset($_POST["Reset"])){       
            $_POST["name"] = "";
            $_POST["email"] = "";
            $_POST["password"] = "";
            $_POST["phone"] = "";
            $_POST["address"] = "";
            $regMessage = "Please Enter Customer Details...!!";        
        
        $conn->close();
    }

?>
