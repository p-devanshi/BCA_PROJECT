<?php
class Food {	
   
	private $foodItemsTable = 'tbl_food';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function itemsList(){		
		$stmt = $this->conn->prepare("SELECT id, title, description, price, image_name, category_id, featured, active, R_Id FROM ".$this->foodItemsTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	public function getItemsList($category_id){	
		$category_id = $category_id;
		$stmt = $this->conn->prepare("SELECT * FROM tbl_food WHERE category_id= $category_id AND active='Yes' AND featured='Yes' " );				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
}
?>