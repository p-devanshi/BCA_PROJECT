<?php
include('partials-front/menu.php');
include_once 'class/Customer.php';
include_once 'config/Database.php';
$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
        color: #333;
    }
    
    th, td {
        border: 1px solid #ddd;
        text-align: left;
        padding: 12px;
    }
    
    th {
        background-color: #4CAF50;
        color: white;
    }
    
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    tr:hover {
        background-color: #ddd;
    }
    h3{
        color:black;
        font-size:xx-large;
    }
</style>

</head>
<body>
    <?php
    /*$username=$_SESSION['username'];
    $get_user="SELECT * FROM food_customer WHERE name='$username'";
    $res=mysqli_query($conn,$get_user);
    $row_fetch=mysqli_fetch_assoc($res);
    $user_id=$row_fetch['id'];
    echo $user_id;*/
    ?>
    <h3 style="text-align:center;">Your orders</h3>
    <table >
        <!--<thead>
            <tr>
                <th>Sl No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qauntity</th>
                <th>Total Price</th>
                <th>Order date</th>
                <th>Status</th>
            </tr>
        </thead>-->
        <tbody>
            <?php
            
            $user_id=$_SESSION['userid'];
            $get_order_detail="SELECT * FROM food_orders Where cust_id=$user_id";
            $result_orders=mysqli_query($conn,$get_order_detail);
            if(mysqli_num_rows($result_orders)>0)
            {?>
                <thead>
            <tr>
                <th>Order No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qauntity</th>
                <th>Total Price</th>
                <th>Order date</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php
            while($row_orders=mysqli_fetch_assoc($result_orders))
            {
                $oid=$row_orders['order_id'];
                $name=$row_orders['name'];
                $price=$row_orders['price'];
                $quantity=$row_orders['quantity'];
                $total=$row_orders['Total'];
                $order_date=$row_orders['order_date'];
                $status=$row_orders['status'];
                $num=1;
                echo "  <tr>
                <th>$oid</th>
                <th>$name</th>
                <th>$price</th>
                <th>$quantity</th>
                <th>$total</th>
                <th>$order_date</th>
                <th>$status</th>
            </tr>";
            $num+=1;

            }
        }
        else
        {?>
            <tr>
                <td style="text-align:center;"><h1><?php echo "OOps, you haven't placed an order yet"; ?></h1></td>
            </tr>
        <?php    
        }
            ?>
        </tbody>
    </table>
</body>
</html>
