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
	
 
	$serviceEntries = db_select("SELECT * FROM `service` WHERE `familyID` = 
	".$_SESSION['user_id']." ORDER BY `servicedate` DESC");
	
	
	

	foreach($serviceEntries as $serviceEntry){
		$date = date_create($serviceEntry['servicedate']); 
        $servicedate2 = date_format($date, 'm-d-Y');	
       
		if( (strcasecmp(substr($name, 1, -1),$serviceEntry['name']) == 0) && 
			(strcasecmp(substr($servicedate, 1, -1),$servicedate2) == 0) && 
			(strcasecmp(substr($hours, 1, -1), $serviceEntry['hours']) == 0) && 
			(strcasecmp(substr($activityType, 1, -1), $serviceEntry['activitytype']) == 0)){
			$duplicate = True; 	
			
			$_SESSION['message'] = 'Submission not successful, duplicate entry was found. <table class="table table-condensed" id="messageTable">
			<thead><tr><th>Name</th><th>Date</th><th>Hours</th><th>Activity Type</th></tr></thead><tbody><tr><td>'.
			$serviceEntry['name'].'</td><td>'.$servicedate2.'</td><td>'.
			$serviceEntry['hours'].'</td><td>'.$serviceEntry['activitytype'].'</td></tr></tbody></table>';
			

		}
		
	}
	
	if($duplicate != True){
		$update = db_query("INSERT INTO `c9`.`service` (id, familyID, name, email, servicedate, hours, activitytype, activitycoordinator, activityperformed, approved, modified) VALUES ( NULL, ".
			$_SESSION['user_id'].", ".$name.", ".$email.", STR_TO_DATE(".$servicedate.",'%m-%d-%Y'), ".
			$hours.", ".$activityType.", ".$servicecoordinator.", ".$activityperformed.", 'pending', NOW())");
		
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
		
	}
	
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/home/service-submit.php');
?>
