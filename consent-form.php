<?php
	session_start(); 

	require_once("db_functions.php"); 
	
	$signature = db_quote($_POST['signature']); 

	$update = db_query("UPDATE `sjvsjo5_registration2015`.`family` SET `signature`="
		.$signature.
		",`releaseAndConsent`= NULL WHERE `family`.`familyID`= ".$_SESSION['user_id']);
	if( $update === TRUE){
		
		//$_SESSION['message'] = "student";  
		//echo $signature; 	
		//$connection = db_connect();
	
		//$_SESSION['editName'] = mysqli_real_escape_string($connection,$_POST['firstName']." ".$_POST['lastName']);
	}


?>
