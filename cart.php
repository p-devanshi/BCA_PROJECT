<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}


if(isset($_POST["add"])){	
	if(isset($_SESSION["cart"])){		
		$item_array_id = array_column($_SESSION["cart"], "food_id");
		if(!in_array($_GET["id"], $item_array_id)){
			$count = count($_SESSION["cart"]);
			$item_array = array(
				'food_id' => "h".$_GET["id"],
				'item_name' => $_POST["item_name"],
				'item_price' => $_POST["item_price"],
				'item_id' => "h".$_GET["id"],
				'item_quantity' => $_POST["quantity"]
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="cart.php"</script>';
		} else {					
			echo '<script>window.location="cart.php"</script>';
		}
	} else {
		$item_array = array(
			'food_id' => "h".$_GET["id"],
			'item_name' => $_POST["item_name"],
			'item_price' => $_POST["item_price"],
			'item_id' => "h".$_GET["id"],
			'item_quantity' => $_POST["quantity"]
		);
		$_SESSION["cart"][0] = $item_array;
	}
}

if(isset($_POST["edit"])){
	
	$chek_id = $_POST['f_id'];
		foreach($_SESSION["cart"] as $keys => $values){		
		if($values["food_id"] == $chek_id){
		$item_array1 = array(
			'food_id' => $_POST['f_id'],
			'item_name' => $_POST['i_name'],
			'item_price' => $_POST['i_price'],
			'item_id' => $_POST['f_id'],
			'item_quantity' => $_POST['i_qty']
		);
		$_SESSION["cart"][$keys] = $item_array1;
		//echo '<script>window.location="cart.php"</script>';		
	}
}
}
	



if(isset($_GET["action"])){
	if($_GET["action"] == "delete"){
		foreach($_SESSION["cart"] as $keys => $values){
			if($values["food_id"] == $_GET["id"]){
				unset($_SESSION["cart"][$keys]);						
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}


if(isset($_GET["action"])){
	if($_GET["action"] == "empty"){
		foreach($_SESSION["cart"] as $keys => $values){
			unset($_SESSION["cart"]);					
			echo '<script>window.location="cart.php"</script>';
		}
	}
}
		

?>

<title>Food Delight</title>

<div class="content" style="height:100%">
	<div class="container">		
		<div class='row'>		
		<?php include ('partials-front/menu.php'); ?> 
		</div>
		<div class='row' id="ed_ca">		
		<?php
		if(!empty($_SESSION["cart"])){
		?>      
			<h3>Your Cart</h3>    
			<table class="table table-striped">
			<thead class="thead-dark">
			<tr>
			<th width="40%">Food Name</th>
			<th width="10%">Quantity</th>
			<th width="15%">Price Details</th>
			<th width="15%">Food Id</th>
			<th width="15%">Order Total</th>
			<th width="5%" colspan="2">Action</th>
			
			</tr>
			</thead>

			<script>const i=0;</script>
			<?php
			$total = 0; 
			
			foreach($_SESSION["cart"] as $keys => $values){				
			?>
				<tr>
				<td class="box" id="f_name"><?php echo $values["item_name"]; ?></td>
				<td class="box" id="f_qty"><?php echo $values["item_quantity"]; ?></td>
				<td class="box" id="f_price"><?php echo $values["item_price"]; ?></td>
				<td class="box" id="f_id"><?php echo $values["food_id"]; ?></td>				
				<td>Rs.<?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
				<td><a href="cart.php?action=delete&id=<?php echo $values["food_id"]; ?>"><span class="text-danger">Remove</span></a></td>
				<td><a href = "javascript:;" onclick = "edit_c('<?php echo $values['item_name'];?>',
																'<?php echo $values['item_quantity'];?>',
																'<?php echo $values['item_price'];?>',
																'<?php echo $values['item_id'];?>');">
																<span class="text-danger">Edit</span></a></td>
				</tr>
				<tr>
					<td>
						<?php 
						$total = $total + ($values["item_quantity"] * $values["item_price"]);?>
					</td>
				</tr>
				
				<?php
			}
			?>
			
			<tr>
			<td colspan="4" align="right">Total</td>
			<td align="center">Rs.<?php echo number_format($total, 2); ?></td>
			<td></td>
			</tr>
					
			</table>
			<hr width="100%" size="2" color="#ff4757" noshade>
			<?php
			echo '<a href="cart.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Empty Cart</button></a>&nbsp;
			<a href="foods.php"><button class="btn btn-warning">Add more items</button></a>&nbsp;
			<a href="checkout.php"><button class="btn btn-success pull-right">
			<span class="glyphicon glyphicon-share-alt"></span> Check Out</button></a>';
			?>
		<?php
		} elseif(empty($_SESSION["cart"])){
		?>
			<div class="container">
			<div class="jumbotron">
			<h3>Your cart is empty. Enjoy <a href="index.php">food list</a> here.</h3>        
			</div>      
			</div>    
		<?php
		}
		?>		
		</div>		   
	</div> 	
</div>


<!-- The Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="" method="POST" style="border:1px solid #ccc">
        <div class="container">
            <label><b>Food Name</b></label>
            <input type="text" name="i_name" id="fname" data-toggle="modal" data-target="#myModal" readonly="">
  
            <label><b>Quantity</b></label>
            <input type="number" name="i_qty" id="fqty"   />
  
            <label><b>Price</b></label>
            <input type="number" name="i_price" id="fprice" readonly="" />

			<input type="hidden" id="fo_id" name="f_id" >
                        
                <button type="button" class="btn-danger">Cancel</button>
                <button type="submit" class="btn-success" name="edit">Update Cart</button>
           
        </div>
    </form>
  </div>

</div>

<script type="text/javascript">
            let modal = document.getElementById("myModal");
			var span = document.getElementsByClassName("close")[0];
			var fn =  document.getElementById("fname");
			var fq =  document.getElementById("fqty");
			var fp =  document.getElementById("fprice");
			var fide =  document.getElementById("fo_id");

        function edit_c(item,qty,price,fid){
            modal.style.display = "block";	
            fn.value=item;
			fq.value=qty;
			fp.value=price;
			fide.value=fid;
        }
        span.onclick = function() {
                modal.style.display = "none";
            }

        // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                }
            }

    </script>

<?php



?>


<?php include('partials-front/footer.php');?>