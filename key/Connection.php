<?php


function Connection(){
	$host   = "localhost";
	$db     = "chat";
	$user   = "chat";
	$pass   = "chat";

	try {
		$db = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAMES UTF8');
		return $db;
	  } catch (PDOException $e) {
		return new PDOException("Error  : " .$e->getMessage());
	  }

	
}



?>
