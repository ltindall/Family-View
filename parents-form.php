<?php
	session_start(); 

	require_once("db_functions.php"); 

	if( true )
	{
		//sleep(3);
		$firstName = db_quote($_POST['firstName']); 
		$middleName = db_quote($_POST['middleName']); 
		$lastName = db_quote($_POST['lastName']); 
		$homePhone = db_quote($_POST['homePhone']); 
		$cellPhone = db_quote($_POST['cellPhone']); 
		$personalEmail = db_quote($_POST['personalEmail']); 
		$address = db_quote($_POST['address']); 
		$city = db_quote($_POST['city']); 
		$state = db_quote($_POST['state']); 
		$zip = db_quote($_POST['zip']); 
		$occupation = db_quote($_POST['occupation']); 
		$employer = db_quote($_POST['employer']); 
		$workEmail = db_quote($_POST['workEmail']); 
		$workPhone = db_quote($_POST['workPhone']); 
		$relationship = db_quote($_POST['relationship']); 
		$gradYear = db_quote($_POST['gradYear']); 
		$industry = db_quote($_POST['industry']); 

		if( $_POST['parent'] == "father" )
		{

			$update = db_query("UPDATE `sjvsjo5_registration2015`.`family` SET ".
				//"`F_First_Name`=".$firstName.
				//",`F_Middle_Name`=".$middleName.
				//", `F_Last_Name` = ".$lastName.
				" `F_Phone_Home` = ".$homePhone.
				", `F_Cell` = ".$cellPhone.
				", `F_Email_Home`=".$personalEmail.
				",`F_Address_Street` =".$address.
				", `F_Address_City`= ".$city.
				", `F_Address_State`=".$state.
				", `F_Address_Zip`=".$zip.
				", `F_Bus_Occupation`=".$occupation.
				", `F_Bus_Company`= ".$employer.
				", `F_Bus_Email`=".$workEmail.
				", `F_Bus_Phone`=".$workPhone.
				", `F_Status` =".$relationship.
				", `F_Graduation_Date` =".$gradYear.
				", `F_Bus_Type` =".$industry.
				" WHERE `family`.`familyID`= ".$_SESSION['user_id']);
			if( $update === TRUE)
				$_SESSION['message'] = "father";  

									
		}
		else
		{

			$update = db_query("UPDATE `sjvsjo5_registration2015`.`family` SET ".
				//" `M_First_Name`=".$firstName.
				//", `M_Middle_Name`=".$middleName.
				//", `M_Last_Name` = ".$lastName.
				" `M_Phone_Home` = ".$homePhone.
				", `M_Cell` = ".$cellPhone.
				", `M_Email_Home`=".$personalEmail.
				", `M_Address_Street` =".$address.
				", `M_Address_City`= ".$city.
				", `M_Address_State`=".$state.
				", `M_Address_Zip`=".$zip.
				", `M_Bus_Occupation`=".$occupation.
				", `M_Bus_Company`= ".$employer.
				", `M_Bus_Email`=".$workEmail.
				", `M_Bus_Phone`=".$workPhone.
				", `M_Status` = ".$relationship. 
				", `M_Graduation_Date` = ".$gradYear.
				", `M_Bus_Type` = ".$industry.
				" WHERE `family`.`familyID`= ".$_SESSION['user_id']);	
			
			if( $update === TRUE)
				$_SESSION['message'] = "mother"; 
									
		}

		$connection = db_connect();
		$updatedRows = mysqli_affected_rows($connection) ;
		if($updatedRows == 0 )
			$_SESSION['message'] = "none";
	}

?>
