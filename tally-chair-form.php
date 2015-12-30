<?php
	session_start(); 

	require_once("db_functions.php"); 
	
	if( isset($_POST['special']) ){
		$lastSpecial = db_select("SELECT * FROM `tallyTimes` ORDER BY `id` DESC LIMIT 1");
		if($_POST['special'] == "Processing" && $lastSpecial[0]['type'] != "Processing"){
			$_SESSION['message'] = "Processing has been started successfully."; 
			$update = db_query("INSERT INTO `c9`.`tallyTimes` (id, type) VALUES ( NULL, 'Processing')"); 
		}
		elseif($_POST['special'] == "Updated" && $lastSpecial[0]['type'] != "Updated"){
			$_SESSION['message'] = "All changes to service hours have been updated successfully."; 
			$update = db_query("INSERT INTO `c9`.`tallyTimes` (id, type) VALUES ( NULL, 'Updated')"); 
		}
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/home/service-tally-chair.php?id='.$_SESSION['approving_user_id_chair']);
		exit(); 
	}
	
	$familyEntries = db_select("SELECT * FROM `service` WHERE `familyID` = ".$_SESSION['approving_user_id_chair']." ORDER BY `servicedate` DESC");
	 
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
	
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/home/service-tally-chair.php?id='.$_SESSION['approving_user_id_chair']);
?>
