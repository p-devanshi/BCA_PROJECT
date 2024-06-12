<?php
class Restaur {	
   
	private $restTable = 'tbl_restaurant';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function restList(){		
		$stmt = $this->conn->prepare("SELECT R_ID, R_name, email, contact, address, R_image, featured, active FROM ".$this->restTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
    public function selRest($id){
        $id = $id;		
		$stmt = $this->conn->prepare("SELECT R_ID, R_name, email, contact, address, R_image, featured, active FROM $this->restTable WHERE R_ID = " .$id);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	
}
?>