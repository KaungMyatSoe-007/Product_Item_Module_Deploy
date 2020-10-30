<?php 

	//include headers
	//it allow all origins like localhost, any domain or any subdomain
	header('Access-Control-Allow-Origin: *');
	//data which we are getting inside request
	header('Content-Type: application/json; charset: UTF-8');
	//method type
	header('Access-Control-Allow-Methods: DELETE');
	//it allow header
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
	
	//initializing our API
	//include_once('../../core/initialize.php');
	
	include_once('../../includes/config.php');
	
	include_once('../../core/product.php');

	//instantiate product
	$product = new Product($db);

	if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
		
		//get raw data from request body
		$data = json_decode(file_get_contents("php://input"));

		if(	!empty($data->id))
		{
			//submit data
			$product->id = $data->id;

			//create product
			if($product->delete_data()){

				http_response_code(200); // OK status
				echo json_encode(array(
					"status"  => 1,
					"message" => "Successfully Deleted"
				));

			}
			else{
				http_response_code(500); // Intenal server error
				echo json_encode(array(
					"status"  => 0,
					"message" => "Failed to delete"
				));
			}
		}
		else{
			http_response_code(404); // Page not found
			echo json_encode(array(
				"status"  => 0,
				"message" => "Product ID code needed"
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