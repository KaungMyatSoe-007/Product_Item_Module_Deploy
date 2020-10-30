<?php 

	//include headers
	//it allow all origins like localhost, any domain or any subdomain
	header('Access-Control-Allow-Origin: *');
	//data which we are getting inside request
	header('Content-Type: application/json');
	//method type
	header('Access-Control-Allow-Methods: GET');
	
	//initializing our API
	//include_once('../../core/initialize.php');
	include_once('../../includes/config.php');
	
	include_once('../../core/warehouse.php');

	//instantiate warehouse
	$warehouse = new Warehouse($db);

	if ($_SERVER['REQUEST_METHOD'] === "GET") {
		
		$result = $warehouse->get_all_data();

		//get the row count
		$num = $result->rowCount();

		if($num > 0){
			$warehouse_arr = array();
			$warehouse_arr['data'] = array();
			
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$warehouse_item = array(
					'id'   			=> $id,
					'name' 			=> $name	
				);

				array_push($warehouse_arr['data'], $warehouse_item);
			}
			http_response_code(200); // OK status
			echo json_encode(array(
				"status"  => 1,
				"data" 	  => $warehouse_arr['data'] 
			));

		}else{
			http_response_code(404); // page not found
			echo json_encode(array(
				"status"    => 0,
				"message" 	=> "No warehouse found"
			));
		}

	}
	else{
		http_response_code(503); //service unavailable
		echo json_encode(array(
			"status"  => 0,
			"message" => "Access Denied"
		));
	}


 ?>