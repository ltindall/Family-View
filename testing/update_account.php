<?php

require_once("db_functions.php"); 

$address = db_quote($_POST['address']);

$phone = db_quote($_POST['phone']);

$result = db_query("UPDATE `login`.`info` SET `address` = ".
		$address . " , `phone` = ". $phone . " WHERE 
		`info`.`id`=1");

if($result)
	include("update.php"); 
