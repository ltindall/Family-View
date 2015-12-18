<?php
	session_start(); 

	require_once("db_functions.php"); 
	
	$firstName = db_quote($_POST['firstName']); 
	$middleName = db_quote($_POST['middleName']); 
	$lastName = db_quote($_POST['lastName']); 
	$grade = db_quote($_POST['grade']); 
	$birthdate = db_quote($_POST['birthday']); 
	$allergies = db_quote($_POST['allergies']); 
	$medications = db_quote($_POST['medications']); 
	$medicationComments = db_quote($_POST['medicationComments']); 
	$emergencyContact1 = db_quote($_POST['emergencyContact1']); 
	$contactHomePhone1 = db_quote($_POST['contactHomePhone1']); 
	$contactWorkPhone1 = db_quote($_POST['contactWorkPhone1']); 
	$contactRel1 = db_quote($_POST['contactRel1']); 
	$emergencyContact2 = db_quote($_POST['emergencyContact2']); 
	$contactHomePhone2 = db_quote($_POST['contactHomePhone2']); 
	$contactWorkPhone2 = db_quote($_POST['contactWorkPhone2']); 
	$contactRel2 = db_quote($_POST['contactRel2']); 
	$emergencyContact3 = db_quote($_POST['emergencyContact3']); 
	$contactHomePhone3 = db_quote($_POST['contactHomePhone3']); 
	$contactWorkPhone3 = db_quote($_POST['contactWorkPhone3']); 
	$contactRel3 = db_quote($_POST['contactRel3']); 
	$emergencyContact4 = db_quote($_POST['emergencyContact4']); 
	$contactHomePhone4 = db_quote($_POST['contactHomePhone4']); 
	$contactWorkPhone4 = db_quote($_POST['contactWorkPhone4']); 
	$contactRel4 = db_quote($_POST['contactRel4']); 
	$familyDr = db_quote($_POST['familyDr']); 
	$familyDrPhone = db_quote($_POST['familyDrPhone']); 		
	$familyDDS = db_quote($_POST['familyDDS']); 
	$familyDDSPhone = db_quote($_POST['familyDDSPhone']); 
	$studentID = db_quote($_POST['studentID']); 

	$_SESSION['message'] = $studentID;  


	$update = db_query("UPDATE `sjvsjo5_registration2015`.`students` SET". 
		//"`nameF`=".$firstName.
		//",`nameM`=".$middleName.
		//", `nameL` = ".$lastName.
		//", `grade` = ".$grade.
		//", `birthdate` = ".$birthdate.
		" `allergiesComments`=".$allergies.
		",`medication` =".$medications.
		", `medicationComments`= ".$medicationComments.
		", `contact1`=".$emergencyContact1.
		", `contactPhone1`=".$contactHomePhone1.
		", `contactWkPh1`=".$contactWorkPhone1.
		", `contactRel1`= ".$contactRel1.	
		", `contact2`=".$emergencyContact2.
		", `contactPhone2`=".$contactHomePhone2.
		", `contactWkPh2`=".$contactWorkPhone2.
		", `contactRel2`= ".$contactRel2.
		", `contact3`=".$emergencyContact3.
		", `contactPhone3`=".$contactHomePhone3.
		", `contactWkPh3`=".$contactWorkPhone3.
		", `contactRel3`= ".$contactRel3.
		", `contact4`=".$emergencyContact4.
		", `contactPhone4`=".$contactHomePhone4.
		", `contactWkPh4`=".$contactWorkPhone4.
		", `contactRel4`= ".$contactRel4.
		", `familyDr`=".$familyDr.
		", `familyDrPhone`=".$familyDrPhone.
		", `familyDDS`=".$familyDDS.
		", `familyDDSPhone`=".$familyDDSPhone.
		" WHERE `students`.`familyID`= ".$_SESSION['user_id'].
		" AND `students`.`studentID` = ".$studentID);
	if( $update === TRUE){
		$_SESSION['message'] = "student";  
		
		$_SESSION['editID'] = $studentID; 
		
		$connection = db_connect();
		$updatedRows = mysqli_affected_rows($connection) ; 
		if($updatedRows == 0 )
			$_SESSION['message'] = "none"; 
		//$_SESSION['editName'] = mysqli_real_escape_string($connection,$_POST['firstName']." ".$_POST['lastName']);
	}
	else{
		//echo $update; 
	}
?>
