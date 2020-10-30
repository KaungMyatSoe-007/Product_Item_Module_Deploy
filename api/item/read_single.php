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
	
	include_once('../../core/product.php');
	//instantiate product
	$product = new Product($db);

	if ($_SERVER['REQUEST_METHOD'] === "GET") {
		
		$product->id = isset($_GET['id']) ? $_GET['id'] : die();

		$result = $product->get_single_data();

		$num = $result->rowCount();

		if ($num == 1) {
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$product_item = array(
				'name' 		 	 => $row['name'],
				'photo' 		 => $row['photo'],
				'stock_balance'  => $row['stock_balance'],
				'price' 		 => $row['price'],
				'description'    => $row['description'],
				'warehouse_id'	 => $row['warehouse_id'],
				'warehouse_name' => $row['warehouse_name']	
			);
			http_response_code(200); // OK status
			echo json_encode(array(
				"status"  => 1,
				"data" 	  => $product_item
			));
		}
		else{
			http_response_code(404); // Page Not Found
			echo json_encode(array(
				"status"  => 0,
				"data" 	  => "Product Not Found"
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