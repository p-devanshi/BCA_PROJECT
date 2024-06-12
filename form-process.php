<?php
include("config.php");
extract($_POST);
$sql = "INSERT INTO `contactdata`(`firstname`, `lastname`, `phone`, `email`, `message`) VALUES ('".$firstname."','".$lastname."',".$phone.",'".$email."','".$message."')";
$result = $mysqli->query($sql);
if(!$result){
    die("Couldn't enter data: ".$mysqli->error);
}
//echo "Thank You For Contacting Us ";
$mysqli->close();
?>
<html>
    <div class="container">
					<div class="jumbotron">
						<h1 class="text-center" style="color: green;">Thank you for conacting us!!</h1><!--<span class="glyphicon glyphicon-ok-circle" ></span>--> 
				</div>
				<br>
				
				
				
				<h3 class="text-center">Enjoy our <a href="index.php">Food Delight!</a></h3>
		</div>	  
    	
</html>
