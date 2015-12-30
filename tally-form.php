<?php
	session_start(); 

	require_once("db_functions.php"); 
	
	
	$familyEntries = db_select("SELECT * FROM `service` WHERE `familyID` = ".$_SESSION['approving_user_id']." ORDER BY `servicedate` DESC");
	 
	$shouldHaveChanged = 0; 
	$changed = 0; 
	for($i = 0; $i < count($familyEntries); $i++){ 
	
		if( strcmp($familyEntries[$i]['approved'], substr(db_quote($_POST['approval'.$i]), 1, -1)) != 0){
			$update = db_query("UPDATE `c9`.`service` SET ".
			" `approved` = ".db_quote($_POST['approval'.$i]).
			", `modified` = NOW()".
				//" `approved` = ".db_quote($_POST['approval'.strval($i)]).
				" WHERE `service`.`id`= ".$familyEntries[$i]['id']);
				$shouldHaveChanged++; 
				$changed += mysqli_affected_rows(db_connect()); 
		}	
	}
	 
	 
		
	if( $update === TRUE){
		
		$_SESSION['message'] = "Success";  
		
		
		if($shouldHaveChanged != $changed)
			$_SESSION['message'] = "Error"; 
			
		//$_SESSION['editName'] = mysqli_real_escape_string($connection,$_POST['firstName']." ".$_POST['lastName']);
	}
	else{
		//echo $update; 
	}
	
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/home/service-tally.php?id='.$_SESSION['approving_user_id']);
?>
