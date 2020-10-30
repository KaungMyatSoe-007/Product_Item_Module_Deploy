<?php 

	//include headers
	//it allow all origins like localhost, any domain or any subdomain
	header('Access-Control-Allow-Origin: *');
	//data which we are getting inside request
	header('Content-Type: application/json; charset: UTF-8');
	//method type
	header('Access-Control-Allow-Methods: POST');
	//it allow header
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
	
	//initializing our API
	//include_once('../../core/initialize.php');
	
	include_once('../../includes/config.php');
	
	include_once('../../core/product.php');

	//instantiate product
	$product = new Product($db);

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		
		//get raw data from request body
		$data = json_decode(file_get_contents("php://input"));

		if(	!empty($data->id) && 
			!empty($data->warehouse_id) &&
			!empty($data->name) &&
			!empty($data->photo) &&
			!empty($data->stock_balance) &&
			!empty($data->price) &&
			!empty($data->description))
		{
			//submit data
			$product->id 			= $data->id;
			$product->warehouse_id 	= $data->warehouse_id;
			$product->name 			= $data->name;
			$product->photo 		= $data->photo;
			$product->stock_balance = $data->stock_balance;
			$product->price 		= $data->price;
			$product->description 	= $data->description;

			//create product
			if($product->create_data()){

				http_response_code(200); // OK status
				echo json_encode(array(
					"status"  => 1,
					"message" => "Successfully Created"
				));

			}
			else{
				http_response_code(500); // Intenal server error
				echo json_encode(array(
					"status"  => 0,
					"message" => "Failed to create"
				));
			}
		}
		else{
			http_response_code(404); // Page not found
			echo json_encode(array(
				"status"  => 0,
				"message" => "All values neededs"
			));
		}	
	}
	else{
		http_response_code(503); //Service unavailable
		echo json_encode(array(
			"status"  => 0,
			"message" => "Access Denied"
		));
	}


 ?>