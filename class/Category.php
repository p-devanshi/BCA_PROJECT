<?php
class Category {	
   
	private $foodItemsTable = 'tbl_category';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function itemsList(){		
		$stmt = $this->conn->prepare("SELECT id, title, image_name, featured, active, R_Id FROM ".$this->foodItemsTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
    public function selRest($id){	
        $id = $id;		
		$stmt = $this->conn->prepare("SELECT id, title, image_name, featured, active, R_Id FROM $this->foodItemsTable WHERE id = " .$id);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	public function selOnRest($Rest_id){	
        $Rest_id = $Rest_id;		
		$stmt = $this->conn->prepare("SELECT id, title  FROM $this->foodItemsTable WHERE R_Id = " .$Rest_id);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	
}
?>