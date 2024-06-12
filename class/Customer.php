<?php
class Customer {	
   
	private $customerTable = 'food_customer';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->email && $this->password) {
			$sqlQuery = "
				SELECT * FROM ".$this->customerTable." 
				WHERE email = ? AND password = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$password = $this->password;
			$stmt->bind_param("ss", $this->email, $password);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['id'];				
				$_SESSION["name"] = $user['name'];					
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}
	
	public function loggedIn (){
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function getAddress(){
		if($_SESSION["userid"]) {
			$stmt = $this->conn->prepare("
				SELECT email, phone, address 
				FROM ".$this->customerTable." 
				WHERE id = '".$_SESSION["userid"]."'");				
			$stmt->execute();			
			$result = $stmt->get_result();		
			return $result;	
		}
	}
	function getDetails($id){
		$id = $id;
		$stmt = $this->conn->prepare("
			SELECT name, email, phone, address 
			FROM $this->customerTable 
			WHERE id = ".$id);
			//$stmt = $this->conn->prepare("SELECT R_ID, R_name, email, contact, address, R_image, featured, active FROM $this->restTable WHERE R_ID = " .$id);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;			
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
		
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
			$stmt->bind_param("isiiissss", $this->item_id, $this->item_name, $this->item_price, $this->quantity, $this->order_total, $this->order_date, $this->order_id, $this->custid, $this->status);			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	
	public function regcheck(){
		if($this->email) {
			$sqlQuery = "
				SELECT * FROM ".$this->customerTable." 
				WHERE email = ?";			
			$stmt = $this->conn->prepare($sqlQuery);			
			$stmt->bind_param("s", $this->email);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();								
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}
}
?>