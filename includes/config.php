<?php 

	define('HOST', '127.0.0.1');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'productitem');

	$db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASS);

	if(!isset($db))
		die('Connection Fail');

	//set some db attribute
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	define('APP_NAME','PRODUCT ITEM MODULE API');

 ?>