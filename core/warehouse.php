<?php 
 /**
  * 
  */
 class Warehouse
 {
 	
 	//db stuff
 	private $conn;
 	private $table;

 	//warehouse properties
 	public $id;
 	public $name;

 	//constructor with db connection
 	public function __construct($db){
 		$this->conn = $db;
 		$this->table= 'warehouses';
 	}

 	//getting warehouses from database
 	public function get_all_data(){
 		//create query
 		$query = 'SELECT id, name
 				 FROM '. $this->table;

 		//prepare statement
 		$stmt = $this->conn->prepare($query);
 		//execute query
 		$stmt->execute();
 		return $stmt;
 	}
 }