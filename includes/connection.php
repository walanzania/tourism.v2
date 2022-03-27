<?php 
	
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "tourism_app";

	$connect2db = new PDO("mysql:dbname=$dbname; host=$host", $username, $password);
	if($connect2db){
			//echo 'connected';
		
	}


?>