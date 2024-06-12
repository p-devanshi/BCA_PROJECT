<?php 
include 'partials-front/menu.php';
include_once 'config/constants.php';
include_once 'config/Database.php';
include_once 'class/Customer.php';

 $database = new Database();
 $db = $database->getConnection();

$customer = new Customer($db);



?>
<title>New Password</title>

<div class="container"> 
		            
            <h2 class="text-center">New Password</h2>         	

			<form id="loginform" class="login" role="form" method="POST" action=""> 				
				<fieldset>  					
                    <input type="hidden" value='<?php echo $_GET["email"] ?>' name="c-email"> 
                    
                    
					<div class="order-label">Create a new Password</div>					
					    <input type="password" class="order-input" id="password" name="password" value="" placeholder="Enter a new password" style="background:white;" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">                                        
					
                                                          
					
                     <div class="order-label">Confirm Password</div>					
					    <input type="password" class="order-input" id="c_pass" name="c_pass" value="" placeholder="Re-enter a password" style="background:white;" required>   
								
					<div class="order-label">	
						<input type="submit" name="confirm" value="confirm" class=" btn btn-success">	
                        <button class=" btn btn-danger"> <a href="login.php">Login</a></button>
										  
					</div>									  
					</div>									  
				</fieldset>
			</form>                      
	</div>  

<?php

if(isset($_POST["confirm"]))
    {
       
        
        $email = $_POST["c-email"];
        $password = $_POST["password"];
        $c_password = $_POST["c_pass"];

            if($password == $c_password)
            {
                $stmt = $conn->prepare("UPDATE food_customer SET password=? where email=?");
                $stmt->bind_param('ss',$c_password,$email);
                $stmt->execute();

                echo "<div><h3 style='color:green;text-align:center' >Password changed successfully </h3></div>";

            }
            else{
                echo "<div><h3 style='color:red;text-align:center' >Password is not same </h3></div>";
            }

        
     
    }

?>