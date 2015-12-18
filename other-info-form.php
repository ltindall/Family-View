<?php
	session_start(); 

	require_once("db_functions.php"); 
	
	$parishWorship = db_quote($_POST['parishWorship']); 
	$parishResidence = db_quote($_POST['parishResidence']); 
	$schoolDistrict = db_quote($_POST['schoolDistrict']); 
	$nearestSchool = db_quote($_POST['nearestSchool']); 

	$update = db_query("UPDATE `sjvsjo5_registration2015`.`family` SET ".
		"`Parish_Current`=".$parishWorship.
		", `Parish_Geographical`=".$parishResidence.
		", `School_District` = ".$schoolDistrict.
		", `Nearest_PublicSchool` = ".$nearestSchool.
		" WHERE `family`.`familyID`= ".$_SESSION['user_id']);

	if( $update === TRUE){
		$_SESSION['message'] = "other"; 
		$connection = db_connect();
		$updatedRows = mysqli_affected_rows($connection) ;
		if($updatedRows == 0 )
			$_SESSION['message'] = "none";

	}


?>
