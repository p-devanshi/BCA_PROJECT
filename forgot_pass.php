<?php 
include 'partials-front/menu.php';
include_once 'config/constants.php';
include_once 'config/Database.php';
include_once 'class/Customer.php';

 $database = new Database();
 $db = $database->getConnection();

$customer = new Customer($db);
?>
<title>Forgot Password</title>

<div class="container"> 
		            
            <h2 class="text-center">Forgot Password</h2>         	

			<form id="loginform" class="login" role="form" method="GET" action="newpass.php"> 
				
				<fieldset>  
                <h4 class="text-left">Please enter your email id..</h4></br></br>

					<div class="order-label">E-Mail</div>					
					    <input type="text" class="order-input" id="email" name="email" value="" placeholder="email" style="background:white;" required>                                        
					                   
								
					<div class="order-label">	
						<input type="submit" name="next" value="Next" class=" btn btn-success">	
					</div>
									  
				</fieldset>
			</form>  
               	

			                    
	</div>  

<?php

     if( isset($_GET["next"]))
     {
        $email = $_GET["email"];
        print("HI");
        $stmt = $conn->prepare("SELECT email FROM food_customer where email=?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            print_r($row);
         } 
     }
       
?>