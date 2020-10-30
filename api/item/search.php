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
		
		$product->name = isset($_GET['name']) ? $_GET['name'] : die();

		$result = $product->search_data();

		$num = $result->rowCount();

		if($num > 0){
			$product_arr = array();
			$product_arr['data'] = array();
			
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$product_item = array(
					'id'   			=> $id,
					'name' 			=> $name,
					'photo'			=> $photo,
					'stock_balance' => $stock_balance,
					'price'  		=> $price,
					'description'   => html_entity_decode($description),
					'warehouse_id' 	=> $warehouse_id,
					'warehouse_name'=> $warehouse_name 	
				);

				array_push($product_arr['data'], $product_item);
			}
			http_response_code(200); // OK status
			echo json_encode(array(
				"status"  => 1,
				"data" 	  => $product_arr['data'] 
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