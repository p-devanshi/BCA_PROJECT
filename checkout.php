<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';
include('partials-front/menu.php'); 

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}
//include('inc/header.php');
?>
<title>Food Delight</title>
  
<?php //include('inc/container.php');?>
<div class="content">
	<div class="container">		
		
		<div class='row'>		
        
		</div>
		<?php
		$orderTotal = 0;
		$itemtotal = 0;
		$orderTotal = 0;
		foreach($_SESSION["cart"] as $keys => $values){
			$itemtotal = $itemtotal + ($values["item_quantity"] * $values["item_price"]);
			$delivery = 15;			
		}
		$orderTotal = $orderTotal + $itemtotal +$delivery;
		?>
		<div class='row'>
			<div class="col-md-6">
				<h3>Delivery Address</h3>
				<?php 
				$addressResult = $customer->getAddress();
				$count=0;
				while ($address = $addressResult->fetch_assoc()) { 
				?>
				<p><?php echo $address["address"]; ?></p>
				<p><strong>Phone</strong>:<?php echo $address["phone"]; ?></p>
				<p><strong>Email</strong>:<?php echo $address["email"]; ?></p>
				<?php
				}
				?>				
			</div>
			<?php 
			$randNumber1 = rand(1000,9999); 
			$randNumber2 = rand(1000,9999); 
			$randNumber3 = rand(1000,9999);
			$orderNumber = $randNumber1.$randNumber2.$randNumber3;
			?>
			<div class="col-md-6">
				<h3>Order Summery</h3>
				<p><strong>Items</strong>: Rs.<?php echo $itemtotal; ?></p>
				<p><strong>Delivery</strong>: Rs.<?php echo $delivery; ?></p>
				<p><strong>Total</strong>: Rs.<?php echo $orderTotal; ?></p>
				<p><strong>Order Total</strong>: Rs.<?php echo $orderTotal; ?></p>
				<?php $_SESSION["delivery"]=$delivery;?>
				<p><a href="onlinepay.php?order=<?php echo $orderNumber;?>"><button class="btn btn-warning">Place Order</button></a></p>
			</div>
		</div>
		   
    </div>        
		
<?php //include('inc/footer.php');?>
