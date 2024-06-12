<?php 
include 'partials-front/menu.php';
include_once 'config/constants.php';
include_once 'config/Database.php';
include_once 'class/Customer.php';

 $database = new Database();
 $db = $database->getConnection();

$customer = new Customer($db);

if($customer->loggedIn()) {	
	header("Location: index.php");	
}

$loginMessage = '';
if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {	
	$customer->email = $_POST["email"];
	$customer->password = $_POST["password"];	
	//$customer->loginType = $_POST["loginType"];
	if($customer->login()) {
		header("Location: index.php");	
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}
} 
else {
	$loginMessage = 'Please Fill all fields.';
}
//include('inc/header.php');
?>

<?php //include('inc/container.php');?>

    <div class="container"> 
		            
            <h2 class="text-center">Customer Log In</h2>         	

			<form id="loginform" class="login" role="form" method="POST" action=""> 
				
				<fieldset>  
					<label><?php 
					if(isset($_GET['regMessage'])){
						echo $_GET['regMessage'];
					}else {echo $loginMessage;} ?></label>                                 
					
					<div class="order-label">E-Mail</div>					
					
						<input type="text" class="order-input" id="email" name="email" value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" placeholder="email" style="background:white;" required>                                        
					
					<div class="order-label">Password</div>		
									
						<input type="password" class="order-input" id="password" name="password" value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="password" required>
								
						
								
					<div class="order-label">	
						<input type="submit" name="login" value="Login" class=" btn btn-success">	
						<button class=" btn btn-danger"> <a href="registerN.php">Register</a></button>
						<button class=" btn btn-danger"> <a href="forgot_pass.php">Forgot Password</a></button>
					</div>					  
				</fieldset>
			</form>  
		
			                    
	</div>  
