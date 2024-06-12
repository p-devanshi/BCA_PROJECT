<?php include('partials-front/menu.php'); 
include_once 'class/Customer.php';
include_once 'config/Database.php';
$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}

?>
<html>
<head>
    <title><h1>Contact us form using php mysql</h1></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form action="form-process.php" method="POST" class="login">
            <fieldset>
        <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;">Contact Us or Submit feedback</h3>
        
            <div class="order-label">
                <label for="firstname" class="order-label">Firstname</label>
                <input type="text" name="firstname" id="firstname" class="order-input" required>
            </div>
            <div class="order-label">
                <label for="lastname" class="order-label">Lastname</label>
                <input type="text" name="lastname" id="lastname" class="order-input" required>
            </div>
            <div class="order-label">
                <label for="phone" class="order-label">Phone</label>
                <input type="tel" name="phone" id="phone" class="order-input" required>
            </div>
            <div class="order-label">
                <label for="email" class="order-label">Email</label>
                <input type="email" name="email" id="email" class="order-input" required>
            </div>
            <div class="order-label">
                <label for="message" class="order-label">Suggestion/Feedback</label>
               <!-- <input type="" name="message" id="message" class="order-input" required>-->
                <textarea id="w3review" class="order-label" rows="4" cols="50" name="message" id="message" class="order-input" required>

</textarea>
            </div>
            <div class="form-group">
        <button class="btn btn-success" type="submit">Submit</button>
        <button class="btn btn-danger" type="reset">Reset</button>
      
        </form>
    </div>
</fieldset>
        
    
    
</body>

</html>
<?php include('partials-front/footer.php'); ?>