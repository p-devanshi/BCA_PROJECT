<?php 
include('partials/menu.php');
include_once('../class/Order.php');
include_once '../config/Database.php';
include_once '../class/Customer.php';
$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$customer = new Customer($db); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>                        
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sn=1;
                        $result = $order->getOrder();
                        foreach($result as $row){
                              //get the values from individual columns
                                $id = $row['item_id'];                                                  
                                $food = $row['name'];
                                $price = $row['price'];
                                $qty = $row['quantity'];                               
                                $order_date = $row['order_date'];
                                $order_id = $row['order_id'];
                                $cust_id = $row['cust_id'];
                                $status = $row['status'];
                                $result1 = $customer->getDetails($cust_id);
                                foreach($result1 as $row1){
                                    $customer_contact = $row1['phone'];
                                    $customer_email = $row1['email']; 
                                    $customer_name = $row1['name'];
                                    $customer_address = $row1['address'];
                                }
                                
                            
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>                                        
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?order_id=<?php echo $order_id; ?>" class="btn-secondary">Update Order</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>