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

<div class="container"> 
		            
          <h2 class="text-center">Customer Log In</h2>         	
    
          <form id="loginform" class="login" role="form" method="POST" action="">

            <br style="clear: both">
              <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Contact Form</h3>

              <fieldset> 

                <div class="order-label">Name</div>
                  <input type="text" class="order-input" id="name" name="name" placeholder="Name" required autofocus="">
                

                <div class="order-label">E-Mail</div>
                  <input type="email" class="order-input" id="email" name="email" placeholder="Email" required>

                <div class="order-label">Password</div>
                  <input type="text" class="order-input" id="password" name="password" placeholder="Password" required>
                    

                <div class="order-label">Mobile No</div>
                  <input type="Number" class="order-input" id="mobile" name="mobile" placeholder="Mobile Number" required pattern="[0-9\]" autocomplete="cc-number" maxlength="10"  placeholder="contact no" title="Only 10 digits" onkeypress="return onlyNumberKey(event)" />                                    


                <div class="order-label">Address</div>
                  <input type="Number" class="order-input" id="address" name="address" placeholder="Address" required>
                
                
                  <div class="order-label">	
						<input type="submit" name="login" value="Register" class=" btn btn-success">	
						<button class=" btn btn-danger"> <a href="contactus.php">Cancel</a></button>
					</div>		

          <script>
        function onlyNumberKey(evt) {
              
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>   
    `
              </fieldset>
        </form>

        
      
    
      
    </div>

    <?php
if (isset($_POST['submit'])){
require 'connection.php';
$conn = Connect();

$Name = $conn->real_escape_string($_POST['name']);
$Email_Id = $conn->real_escape_string($_POST['email']);
$Mobile_No = $conn->real_escape_string($_POST['mobile']);
$Subject = $conn->real_escape_string($_POST['subject']);
$Message = $conn->real_escape_string($_POST['message']);

$query = "INSERT into contact(Name,Email,Mobile,Subject,Message) VALUES('$Name','$Email_Id','$Mobile_No','$Subject','$Message')";
$success = $conn->query($query);

if (!$success){
  die("Couldnt enter data: ".$conn->error);
}

$conn->close();
}
?>

<?php include('partials-front/footer.php'); ?>