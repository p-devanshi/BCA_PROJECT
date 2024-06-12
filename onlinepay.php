<?php
session_start();

if(!isset($_SESSION['userid']) || !isset($_SESSION['cart'])){
header("location: login.php"); 
}
include_once 'class/Customer.php';

include_once 'config/Database.php';
$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
include ('partials-front/menu.php');

if(isset($_GET["order"])){
    $order = $_GET["order"];    
}
if(isset($_SESSION["delivery"]))
{
    $deli = $_SESSION["delivery"];
}
?>  
  <div class="container">		
		<div class='row'>  
          <h3>Your Cart is : </h3>    
          <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th width="40%">Food Name</th>
                <th width="20%">Quantity</th>
                <th width="10%">Price Details</th>
                <th width="15%">Food Id</th>
                <th width="5%">Order Total</th>                   
            </tr>
            </thead>

			<?php
              $total = 0; 
              
              foreach($_SESSION["cart"] as $keys => $values){				
              ?>
                <tr>
                <td class="box" id="f_name"><?php echo $values["item_name"]; ?></td>
                <td class="box" id="f_qty"><?php echo $values["item_quantity"]; ?></td>
                <td class="box" id="f_price"><?php echo $values["item_price"]; ?></td>
                <td class="box" id="f_id"><?php echo $values["item_id"]; ?></td>				
                <td class="box">Rs. <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?>
                <?php 
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);?>
                  </td>
                </tr>
                
                <?php
              }
              ?>
			
                <tr>
                <td colspan="4" align="right">Total</td>
                <td align="center">Rs. <?php echo number_format($total, 2); ?></td>               
                </tr>
                <tr>
                <td colspan="4" align="right">Delivery</td>
                <td align="center">Rs. <?php echo number_format($deli, 2); ?></td>               
                </tr>
                <td colspan="4" align="right" class="thead-dark">Grand Total</td>
                <td align="center" class="thead-dark">Rs.<?php echo number_format($deli+$total, 2); ?></td>               
                </tr>
            </table>
        </div>    
    </div>
 
<div class="container">
    <div class="row">   
        <div class="panel-title" >     
          <h2 class="text-center">Online Payment</h2>
          <p class="text-center">Enter your payment details below.</p>
        </div>
    </div>
    <form id="loginform" class="login" method="POST" action="process_order.php">
    <div class="row" style="width:96%;">
        <div class="panel" >
        <table cellpadding="10" cellspacing="10"> 
                <tr>
                    <td>Credit Card Number</td>
                    <td><input type="text" class="form-control" required pattern="[0-9\]" minlength="4" maxlength="4"  placeholder="####" title="Only 4 digits" onkeypress="return onlyNumberKey(event)" /></td>
                    <td><input type="text" class="form-control" required pattern="[0-9\]" minlength="4" maxlength="4"  placeholder="####" title="Only 4 digits" onkeypress="return onlyNumberKey(event)"  /></td>
                    <td><input type="text" class="form-control" required pattern="[0-9\]" minlength="4" maxlength="4"  placeholder="####" title="Only 4 digits" onkeypress="return onlyNumberKey(event)"  /></td>
                    <td><input type="text" class="form-control" required pattern="[0-9\]" minlength="4" maxlength="4"  placeholder="####" title="Only 4 digits" onkeypress="return onlyNumberKey(event)"  /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Expiry Month</td>
                    <td><input type="month" class="form-control" placeholder="MM" required max="12"  min="1" minlength="2" maxlength="2" onkeypress="return onlyNumberKey(event)" /></td>

               
                    <td>Expiry Year</td>
                    <td><input type="number" class="form-control" placeholder="YY" required min="2023" max="2099" step="1" value="2023" /></td>

                </tr>
                <tr><td></td></tr>
                
                <tr>
                    <td></td>
                    <td>CVV</td>
                    <td><input type="text" class="form-control"  inputmode="numeric" minlength="3" required pattern="[0-9\]" autocomplete="cc-number" maxlength="3"  placeholder="###" onkeypress="return onlyNumberKey(event)" placeholder="CVV"  /></td>

                </tr>
                <tr><td></td></tr>
                <tr>
                <td></td>
                
                    <td>Name on the Card </td>
                    <td><input type="text" class="form-control" placeholder="Name On The Card" required="" /></td>

                </tr>
                <tr><td></td></tr>
                <tr><td><input type="hidden" id="order" name="order" value="<?php echo $order;?>"/></td>
                
                    <td colspan="2"><label><input type="checkbox" checked class="text-muted" required=""> Save details for fast payments. <a href="#">Learn More</a></label></td>
              
                    <td><input type="submit" class="btn btn-danger btn-block" value="CANCEL" required="" /></td>
                
                    <td colspan="2"><input type="submit" class="btn btn-success btn-block" value="PAY NOW" /></a>
                    </td>
                </tr>
            </table>
        </div>
            </form>
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
        
</body>
</html>