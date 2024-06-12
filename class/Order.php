<?php
class Order {	
   
	private $ordersTable = 'food_orders';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function insert(){		
		if($this->item_name) {
			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->ordersTable."(`item_id`, `name`, `price`, `quantity`, `Total`, `order_date`, `order_id`,`cust_id`,`status`)
			VALUES(?,?,?,?,?,?,?,?,?)");		
			$this->item_id = htmlspecialchars(strip_tags($this->item_id));
			$this->item_name = htmlspecialchars(strip_tags($this->item_name));
			$this->item_price = htmlspecialchars(strip_tags($this->item_price));
			$this->quantity = htmlspecialchars(strip_tags($this->quantity));
			$this->order_total = htmlspecialchars(strip_tags($this->order_total));
			$this->order_date = htmlspecialchars(strip_tags($this->order_date));
			$this->order_id = htmlspecialchars(strip_tags($this->order_id));
			$this->status = htmlspecialchars(strip_tags($this->status));
			$this->custid = htmlspecialchars(strip_tags($this->custid));			
			$stmt->bind_param("ssiiissss", $this->item_id, $this->item_name, $this->item_price, $this->quantity, $this->order_total, $this->order_date, $this->order_id, $this->custid, $this->status);			
			if($stmt->execute()){
				return true;
			}		
		}
	}	
	public function getOrder(){
		$stmt = $this->conn->prepare("SELECT item_id, name, price, quantity, Total, order_date, order_id, cust_id,status FROM ".$this->ordersTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;
	}
	public function getDetails($id){
		$id = $id;
		$stmt = $this->conn->prepare("SELECT item_id, name, price, quantity, Total, order_date, order_id, cust_id,status FROM $this->ordersTable WHERE order_id = " .$id);			
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;
	}
	public function getOrderdwise($date){
		$stmt = $this->conn->prepare("SELECT item_id, name, price, quantity, Total, order_date, order_id, cust_id,status FROM $this->ordersTable WHERE order_date = " .$date);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;
	}
}
?>