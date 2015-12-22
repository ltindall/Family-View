<?php
	session_start(); 

	require_once("db_functions.php"); 
	
	$name = db_quote($_POST['name']); 
	$email = db_quote($_POST['email']); 
	$servicedate = db_quote($_POST['servicedate']); 
	$hours = db_quote($_POST['hours'].$_POST['minutes']); 
	$activityType = db_quote($_POST['activityType']); 
	$servicecoordinator = db_quote($_POST['servicecoordinator']); 
	$activityperformed = db_quote($_POST['activityperformed']); 
	
 


	$update = db_query("INSERT INTO `c9`.`service` (id, familyID, name, email, servicedate, hours, activitytype, activitycoordinator, activityperformed, approved) VALUES ( NULL, ".
			$_SESSION['user_id'].", ".$name.", ".$email.", STR_TO_DATE(".$servicedate.",'%m-%d-%Y'), ".
			$hours.", ".$activityType.", ".$servicecoordinator.", ".$activityperformed.", 'pending')");
		
	if( $update === TRUE){
		$_SESSION['message'] = "Success";  
		
		
		$connection = db_connect();
		$updatedRows = mysqli_affected_rows($connection) ; 
		if($updatedRows == 0 )
			$_SESSION['message'] = "Error"; 
			
		//$_SESSION['editName'] = mysqli_real_escape_string($connection,$_POST['firstName']." ".$_POST['lastName']);
	}
	else{
		//echo $update; 
	}
	
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/home/service-submit.php');
?>
