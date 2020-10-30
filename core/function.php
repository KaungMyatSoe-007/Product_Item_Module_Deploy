<?php 

	function clean_input($input){

		$input = trim($input);
		$input = htmlspecialchars(strip_tags($input));

		return $input;
	}
 ?>