<?php
	echo "hi"; 
session_start(); 
	require_once(__DIR__.'/../db_functions.php'); 

echo $_SESSION['user_id'];  
	$rows = db_select("SELECT * FROM `info` WHERE id= ".
		    $_SESSION['user_id'] ); 
	
	echo "hello"; 
	
	if($rows ==false) {
		$error = db_error();
		alert("not working"); 
    }
	
	/*
    $children = db_select("SELECT * FROM `child_info` WHERE `family_id` =
		    ".$_SESSION['user_id'] ); 
	*/

	$children = db_select("SELECT * FROM `children` WHERE `familyID` = 
			".$_SESSION['user_id']); 

    if($children == false) {
        $error = db_error();
    }


	$parents_data = db_select("SELECT * FROM `family` WHERE `familyID` = 
		".$_SESSION['user_id'] ); 
	
	$f_address_city = $parents_data[0]['F_Address_City']; 
	$f_address_state = $parents_data[0]['F_Address_State']; 
	$f_address_street = $parents_data[0]['F_Address_Street']; 
	$f_address_zip = $parents_data[0]['F_Address_Zip']; 
	$f_bus_company = $parents_data[0]['F_Bus_Company']; 
	$f_bus_email = $parents_data[0]['F_Bus_Email']; 
	$f_bus_occupation = $parents_data[0]['F_Bus_Occupation']; 
	$f_bus_phone = $parents_data[0]['F_Bus_Phone']; 
	$f_bus_type = $parents_data[0]['F_Bus_Type']; 
	$f_cell = $parents_data[0]['F_Cell']; 
	$f_email_home = $parents_data[0]['F_Email_Home']; 
	$f_first_name = $parents_data[0]['F_First_Name']; 
	$f_graduation_data = $parents_data[0]['F_Graduation_Date']; 
	$f_last_name = $parents_data[0]['F_Last_Name']; 
	$f_middle_name = $parents_data[0]['F_Middle_Name']; 
	$f_phone_home = $parents_data[0]['F_Phone_Home']; 
	$f_relationship = $parents_data[0]['F_Status']; 

	
	$m_address_city = $parents_data[0]['M_Address_City']; 
	$m_address_state = $parents_data[0]['M_Address_State']; 
	$m_address_street = $parents_data[0]['M_Address_Street']; 
	$m_address_zip = $parents_data[0]['M_Address_Zip']; 
	$m_bus_company = $parents_data[0]['M_Bus_Company']; 
	$m_bus_email = $parents_data[0]['M_Bus_Email']; 
	$m_bus_occupation = $parents_data[0]['M_Bus_Occupation']; 
	$m_bus_phone = $parents_data[0]['M_Bus_Phone']; 
	$m_bus_type = $parents_data[0]['M_Bus_Type']; 
	$m_cell = $parents_data[0]['M_Cell']; 
	$m_email_home = $parents_data[0]['M_Email_Home']; 
	$m_first_name = $parents_data[0]['M_First_Name']; 
	$m_graduation_data = $parents_data[0]['M_Graduation_Date']; 
	$m_last_name = $parents_data[0]['M_Last_Name']; 
	$m_middle_name = $parents_data[0]['M_Middle_Name']; 
	$m_phone_home = $parents_data[0]['M_Phone_Home']; 
	$m_relationship = $parents_data[0]['M_Status'];

	if(isset($_SESSION['message'])){
		if($_SESSION['message'] == "father"){
			$success = "Information for ".$f_first_name." ".$f_last_name.
						" (Father/Guardian) has been updated!"; 
		}
		elseif($_SESSION['message']== "mother") {
			$success = "Information for ".$m_first_name." ".$m_last_name.
						" (Mother/Guardian) has been updated!"; 
		}
		elseif($_SESSION['message']=="student"){
			$success = "Information for ".$_SESSION['editName']." (Student) has been updated!"; 
		}
			
	} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SJV Family View</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  
	<!-- Custom style -->
	<link href="http://test.lucastindall.com/css/style.css" rel="stylesheet">
	
<link
href='http://fonts.googleapis.com/css?family=Ubuntu|Montserrat|Oswald|Francois+One|Roboto+Slab'
rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>
  <body>


<br>
<br>
<div id="login">
<h1>
<a href="/" tabindex="-1"> SJV Family View </a>    
</h1>
</div>
<br>
<br>
<div class="container container-main" role="main">
    <div class="navbar navbar-inverse row display-nav" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"
            href="#">SJV Family View</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right" >
            <li><a href="http://test.lucastindall.com/index.php?logout" class="navbar-nav ">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>


<div class="display">

<?php if(isset($_SESSION['message'])): ?>
<br>
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success! </strong> <?php echo $success; ?>
</div>
<?php
	unset($_SESSION['message']); 	
	endif; 
?>

<div class="page-header">
	<h1>Parent Settings</h1>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed"  data-placement="right"  role="button" data-toggle="collapse"  href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		Father Info</a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body info-body " id="father-info"> 
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4">
	  					<h4> First Name  </h4>
						<pre> <?php echo $f_first_name; ?> </pre>
					</div>
					<div class="col-md-4">
						<h4> Middle Name </h4>
						<pre> <?php echo $f_middle_name; ?></pre>
					</div>
					<div class="col-md-4">
						<h4> Last Name </h4>
						<pre> <?php echo $f_last_name; ?></pre>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-6">
						<h4> Home Phone </h4>
						<pre> <?php echo $f_phone_home; ?> </pre>
					</div>
					<div class="col-md-6">
						<h4> Cell Phone </h4>
						<pre> <?php echo $f_cell; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4> Personal Email </h4>
						<pre> <?php echo $f_email_home; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
					<h4> Street Address </h4>
					<pre> <?php echo $f_address_street; ?> </pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">	
						<h4> City </h4>
						<pre> <?php echo $f_address_city; ?> </pre>
					</div>
					<div class="col-md-4">			
						<h4> State </h4>
						<pre> <?php echo $f_address_state; ?> </pre>
					</div>
					<div class="col-md-3">
						<h4> Zip </h4>
						<pre> <?php echo $f_address_zip; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<h4> Occupation </h4>
						<pre> <?php echo $f_bus_occupation; ?></pre>
					</div>
					<div class="col-md-6">
						<h4> Employer </h4>
						<pre><?php echo $f_bus_company; ?></pre>
					</div> 
				</div>	
				<div class="row">
					<div class="col-md-6">
						<h4> Work Email </h4>
						<pre> <?php echo $f_bus_email; ?> </pre>
					</div>
					<div class="col-md-6">
						<h4> Work Phone </h4>
						<pre> <?php echo $f_bus_phone; ?></pre>
					</div>
				</div>
				<hr>
			</div>
		</div>
		<!--<button type="button" class="btn btn-lg btn-danger
		pull-right">Edit</button>-->
		<br>
		<div class="row">
			<!--	
			<form action="parent-update.php" method="post">
			<input type="hidden" name="parent" value="father">
			<div class="col-md-6 ">
			<button class="btn btn-outline btn-danger btn-lg
			btn-block" type="submit" name="editFamily">Edit</button>
	

			</div>
			-->
			<div class="col-md-6">
	  		<button type="button" class="btn btn-outline btn-danger btn-lg btn-block" data-toggle="modal" data-target="#fatherModal" > Edit </button>
			<div class="modal fade" id="fatherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"
									id="myModalLabel">Updating Father
									Information</h4>
								</div>
								<div class="modal-body">
									<form id="fatherForm">
										<input type="hidden" name="parent" value="father">
										<div class="row">
											<div class="form-group col-md-4">
												<label for="firstName"> First Name
												</label>
												<input class="form-control"
												name="firstName" value="<?php echo $f_first_name; ?>" >
											</div>
											<div class="form-group col-md-4">
												<label for="middleName"> Middle Name
												</label>
												<input class="form-control"
												name="middleName" value="<?php echo $f_middle_name; ?>" >
											</div>
											<div class="form-group col-md-4">
												<label for="lastName">
												Last Name
												</label>
												<input class="form-control"
												name="lastName" value="<?php echo $f_last_name; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-6">
												<label for="homePhone"> Home Phone
												</label>
												<input class="form-control"
												name="homePhone" value="<?php echo $f_phone_home; ?>" >
											</div>
											<div class="form-group col-md-6">
												<label for="cellPhone"> Cell Phone
												</label>
												<input class="form-control"
												name="cellPhone" value="<?php echo $f_cell; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-12">
												<label for="personalEmail"> Personal Email </label>
												<input class="form-control" name="personalEmail"
												value="<?php echo $f_email_home; ?>" >
											</div>
										</div>
										
										<hr>

										<div class="row">
											<div class="form-group col-md-12">
												<label for="address"> Street Address </label>
												<input class="form-control" name="address" value="<?php echo $f_address_street; ?>">
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-5">
												<label for="city"> City </label> 
												<input class="form-control" name="city" value="<?php echo $f_address_city; ?>">
											</div>
											<div class="form-group col-md-4">
												<label for="state"> State </label>
												<input class="form-control" name="state" value="<?php echo $f_address_state; ?>">
											</div>
											<div class="form-group col-md-3">
												<label for="zip"> Zip </label> 
												<input class="form-control" name="zip" value="<?php echo $f_address_zip; ?>">
											</div> 
										</div>
				
										<hr> 

										<div class="row"> 
											<div class="form-group col-md-6"> 
												<label for="occupation"> Occupation </label> 
												<input class="form-control" name="occupation" value="<?php echo $f_bus_occupation; ?>" > 
											</div> 
											<div class="form-group col-md-6"> 
												<label for="employer"> Employer </label>
												<input class="form-control" name="employer" value="<?php echo $f_bus_company; ?>"> 
											</div> 
										</div>  
										<div class="row"> 
											<div class="form-group col-md-6">	
												<label for="workEmail"> Work Email </label> 
												<input class="form-control" name="workEmail" value="<?php echo $f_bus_email; ?>" > 

											</div>
											<div class="form-group col-md-6"> 
												<label for="workPhone"> Work Phone </label> 
												<input class="form-control" name="workPhone" value="<?php echo $f_bus_phone; ?>" > 
											</div>  
										</div> 
									</form>
									<br> <br> <br>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" 
onClick="submitForm('fatherForm', 'fatherModal', 'father-info')">Save changes</button>
								</div>
						</div>
				</div>
			</div>	

			</div>
			<div class="col-md-6">	
				<form action="" method="post">
					<input type="hidden" name="parent" value="father">
					<button class="btn btn-outline btn-primary btn-lg
					btn-block" type="submit" name="editFamily">Confirm</button>
				</form>
			</div>
			<!--</form>-->
		</div>
      </div>
    </div>
  </div>
<br>
<br>

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed"  data-placement="right"  role="button" data-toggle="collapse"  href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
		Mother Info</a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body info-body " id="mother-info"> 
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4">
	  					<h4> First Name  </h4>
						<pre> <?php echo $m_first_name; ?> </pre>
					</div>
					<div class="col-md-4">
						<h4> Middle Name </h4>
						<pre> <?php echo $m_middle_name; ?></pre>
					</div>
					<div class="col-md-4">
						<h4> Last Name </h4>
						<pre> <?php echo $m_last_name; ?></pre>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-6">
						<h4> Home Phone </h4>
						<pre> <?php echo $m_phone_home; ?> </pre>
					</div>
					<div class="col-md-6">
						<h4> Cell Phone </h4>
						<pre> <?php echo $m_cell; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4> Personal Email </h4>
						<pre> <?php echo $m_email_home; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
					<h4> Street Address </h4>
					<pre> <?php echo $m_address_street; ?> </pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">	
						<h4> City </h4>
						<pre> <?php echo $m_address_city; ?> </pre>
					</div>
					<div class="col-md-4">			
						<h4> State </h4>
						<pre> <?php echo $m_address_state; ?> </pre>
					</div>
					<div class="col-md-3">
						<h4> Zip </h4>
						<pre> <?php echo $m_address_zip; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<h4> Occupation </h4>
						<pre> <?php echo $m_bus_occupation; ?></pre>
					</div>
					<div class="col-md-6">
						<h4> Employer </h4>
						<pre><?php echo $m_bus_company; ?></pre>
					</div> 
				</div>	
				<div class="row">
					<div class="col-md-6">
						<h4> Work Email </h4>
						<pre> <?php echo $m_bus_email; ?> </pre>
					</div>
					<div class="col-md-6">
						<h4> Work Phone </h4>
						<pre> <?php echo $m_bus_phone; ?></pre>
					</div>
				</div>
				<hr>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
	  		<button type="button" class="btn btn-outline btn-danger btn-lg btn-block" data-toggle="modal" data-target="#motherModal" > Edit </button>
			<div class="modal fade" id="motherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"
									id="myModalLabel2">Updating Mother
									Information</h4>
								</div>
								<div class="modal-body">
									<form id="motherForm">
										<input type="hidden" name="parent" value="mother">
										<div class="row">
											<div class="form-group col-md-4">
												<label for="firstName"> First Name
												</label>
												<input class="form-control"
												name="firstName" value="<?php echo $m_first_name; ?>" >
											</div>
											<div class="form-group col-md-4">
												<label for="middleName"> Middle Name
												</label>
												<input class="form-control"
												name="middleName" value="<?php echo $m_middle_name; ?>" >
											</div>
											<div class="form-group col-md-4">
												<label for="lastName">
												Last Name
												</label>
												<input class="form-control"
												name="lastName" value="<?php echo $m_last_name; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-6">
												<label for="homePhone"> Home Phone
												</label>
												<input class="form-control"
												name="homePhone" value="<?php echo $m_phone_home; ?>" >
											</div>
											<div class="form-group col-md-6">
												<label for="cellPhone"> Cell Phone
												</label>
												<input class="form-control"
												name="cellPhone" value="<?php echo $m_cell; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-12">
												<label for="personalEmail"> Personal Email </label>
												<input class="form-control" name="personalEmail"
												value="<?php echo $m_email_home; ?>" >
											</div>
										</div>
										
										<hr>

										<div class="row">
											<div class="form-group col-md-12">
												<label for="address"> Street Address </label>
												<input class="form-control" name="address" value="<?php echo $m_address_street; ?>">
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-5">
												<label for="city"> City </label> 
												<input class="form-control" name="city" value="<?php echo $m_address_city; ?>">
											</div>
											<div class="form-group col-md-4">
												<label for="state"> State </label>
												<input class="form-control" name="state" value="<?php echo $m_address_state; ?>">
											</div>
											<div class="form-group col-md-3">
												<label for="zip"> Zip </label> 
												<input class="form-control" name="zip" value="<?php echo $m_address_zip; ?>">
											</div> 
										</div>
				
										<hr> 

										<div class="row"> 
											<div class="form-group col-md-6"> 
												<label for="occupation"> Occupation </label> 
												<input class="form-control" name="occupation" value="<?php echo $m_bus_occupation; ?>" > 
											</div> 
											<div class="form-group col-md-6"> 
												<label for="employer"> Employer </label>
												<input class="form-control" name="employer" value="<?php echo $m_bus_company; ?>"> 
											</div> 
										</div>  
										<div class="row"> 
											<div class="form-group col-md-6">	
												<label for="workEmail"> Work Email </label> 
												<input class="form-control" name="workEmail" value="<?php echo $m_bus_email; ?>" > 

											</div>
											<div class="form-group col-md-6"> 
												<label for="workPhone"> Work Phone </label> 
												<input class="form-control" name="workPhone" value="<?php echo $m_bus_phone; ?>" > 
											</div>  
										</div> 
									</form>
									<br> <br> <br>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" 
onClick="submitForm('motherForm', 'motherModal', 'mother-info')">Save changes</button>
								</div>
						</div>
				</div>
			</div>	

			</div>
			<div class="col-md-6">	
				<form action="" method="post">
					<input type="hidden" name="parent" value="mother">
					<button class="btn btn-outline btn-primary btn-lg
					btn-block" type="submit" name="editFamily">Confirm</button>
				</form>
			</div>
	
		</div>
      </div>
    </div>
  </div>
</div>


</div>
</div>

<br>

<div class="page-header">
	<h1>Children Settings</h1>
</div>
<!--
<pre>
<?php 
	print_r($children);
	echo "count is: ".strval(count($children)); 
?>
</pre>
-->

<div class="row">
<div class="col-md-12">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  
	<?php
		$iteration = 1; 
		foreach($children as $child): 
	?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="childHeading<?php echo $iteration;
	?>">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse"
		href="#childCollapse<?php echo $iteration; ?>" aria-expanded="true" aria-controls="collapseOne">
			Child <?php echo $iteration; ?> Info
		</a>
      </h4>
    </div>
    <div id="childCollapse<?php echo $iteration; ?>" class="panel-collapse collapse" role="tabpanel"
	aria-labelledby="childHeading<?php echo $iteration; ?>">
	  <div class="panel-body info-body">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
	  					<h4> First Name  </h4>
						<pre> <?php echo $child['nameF']; ?> </pre>
					</div>
					<div class="col-md-3">
						<h4> Middle Name </h4>
						<pre> <?php echo $child['nameM']; ?></pre>
					</div>
					<div class="col-md-3">
						<h4> Last Name </h4>
						<pre> <?php echo $child['nameL']; ?></pre>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-2">
						<h4> Birthday </h4>
						<pre> <?php echo $child['birthdate']; ?> </pre>
					</div>
					<div class="col-md-2">
						<h4> Grade </h4>
						<pre> <?php echo $child['grade']; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h4> Allergies </h4>
						<pre> <?php echo $child['allergiesComments']; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<h4> Medications </h4>
						<pre> <?php echo $child['medication']; ?> </pre>
					</div>
					<div class="col-md-5">
						<h4> Comments regarding medications </h4>
						<pre> <?php echo $child['medicationComments']; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">	
						<h5>1. Emergency Contact</h5>
						<pre> <?php echo $child['contact1']; ?> </pre>
					</div>
					<div class="col-md-3">			
						<h5> Relationship</h5>
						<pre> <?php echo $child['contactRel1']; ?> </pre>
					</div>
					<div class="col-md-2">
						<h5> Home Phone </h5>
						<pre> <?php echo $child['contactPhone1']; ?></pre>
					</div>
					<div class="col-md-2">
						<h5> Work Phone </h5>
						<pre> <?php echo $child['contactWkPh1']; ?></pre>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4">	
						<h5>2. Emergency Contact</h5>
						<pre> <?php echo $child['contact2']; ?> </pre>
					</div>
					<div class="col-md-3">			
						<h5> Relationship</h5>
						<pre> <?php echo $child['contactRel2']; ?> </pre>
					</div>
					<div class="col-md-2">
						<h5> Home Phone </h5>
						<pre> <?php echo $child['contactPhone2']; ?></pre>
					</div>
					<div class="col-md-2">
						<h5> Work Phone </h5>
						<pre> <?php echo $child['contactWkPh2']; ?></pre>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4">	
						<h5>3. Emergency Contact</h5>
						<pre> <?php echo $child['contact3']; ?> </pre>
					</div>
					<div class="col-md-3">			
						<h5> Relationship</h5>
						<pre> <?php echo $child['contactRel3']; ?> </pre>
					</div>
					<div class="col-md-2">
						<h5> Home Phone </h5>
						<pre> <?php echo $child['contactPhone3']; ?></pre>
					</div>
					<div class="col-md-2">
						<h5> Work Phone </h5>
						<pre> <?php echo $child['contactWkPh3']; ?></pre>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">	
						<h5>4. Emergency Contact</h5>
						<pre> <?php echo $child['contact4']; ?> </pre>
					</div>
					<div class="col-md-3">			
						<h5> Relationship</h5>
						<pre> <?php echo $child['contactRel4']; ?> </pre>
					</div>
					<div class="col-md-2">
						<h5> Home Phone </h5>
						<pre> <?php echo $child['contactPhone4']; ?></pre>
					</div>
					<div class="col-md-2">
						<h5> Work Phone </h5>
						<pre> <?php echo $child['contactWkPh4']; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-3">
						<h5> Family Doctor </h5>
						<pre> <?php echo $child['familyDr']; ?></pre>
					</div>
					<div class="col-md-3">
						<h5> Phone </h5>
						<pre> <?php echo $child['familyDrPhone']; ?></pre>
					</div>
					<div class="col-md-3">
						<h5> Family Dentist </h5>
						<pre> <?php echo $child['familyDDS']; ?></pre>
					</div>
					<div class="col-md-3">
						<h5> Phone </h5>
						<pre> <?php echo $child['familyDDSPhone']; ?></pre>
					</div> 
				</div>
				<!--	
				<div class="row">
					<div class="col-md-4">
						<h4> Family Dentist </h4>
						<pre> <?php echo $child['familyDDS']; ?> </pre>
					</div>
					<div class="col-md-3">
						<h4> Phone </h4>
						<pre> <?php echo $child['familyDDSPhone']; ?></pre>
					</div>
				</div>
				-->
				<hr>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6">
			<button type="button" class="btn btn-outline btn-danger btn-lg btn-block" 
				data-toggle="modal" data-target="#childModal<?php echo $iteration; ?>" > Edit </button>
			<div class="modal fade" id="childModal<?php echo $iteration; ?>" 
				tabindex="-1" role="dialog" aria-labelledby="childModalLabel<?php echo $iteration; ?>">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"
									id="childModalLabel<?php echo $iteration; ?>">
									Updated Information for <?php echo $child['nameF']." ".$child['nameL']; ?></h4>
								</div>
								<div class="modal-body">
									<form id="childForm<?php echo $iteration; ?>">
									<input type="hidden" name="studentID" value="<?php echo $child['studentID']; ?>">
										<div class="row">
											<div class="form-group col-md-4">
												<label for="firstName"> First Name
												</label>
												<input class="form-control"
												name="firstName" value="<?php echo $child['nameF']; ?>" >
											</div>
											<div class="form-group col-md-4">
												<label for="middleName"> Middle Name
												</label>
												<input class="form-control"
												name="middleName" value="<?php echo $child['nameM']; ?>" >
											</div>
											<div class="form-group col-md-4">
												<label for="lastName">
												Last Name
												</label>
												<input class="form-control"
												name="lastName" value="<?php echo $child['nameL']; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-6">
												<label for="birthday"> Birthday
												</label>
												<input class="form-control"
												name="birthday" value="<?php echo $child['birthdate']; ?>" >
											</div>
											<div class="form-group col-md-6">
												<label for="grade"> Grade
												</label>
												<input class="form-control"
												name="grade" value="<?php echo $child['grade']; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-md-12">
												<label for="allergies"> Allergies </label>
												<input class="form-control" name="allergies"
												value="<?php echo $child['allergiesComments']; ?>" >
											</div>
										</div>
										
										<div class="row">
											<div class="form-group col-md-6">
												<label for="medications"> Medications 
												</label>
												<input class="form-control"
												name="medications" value="<?php echo $child['medication']; ?>" >
											</div>
											<div class="form-group col-md-6">
												<label for="medicationComments"> Comments regarding medications
												</label>
												<input class="form-control"
												name="medicationComments" value="<?php echo $child['medicationComments']; ?>" >
											</div>
										</div>
										<!--
										<hr>
												
										<div class="row">
											<div class="form-group col-md-3">
												<label for="emergencyContact1"> 1. Emergency Contact Name </label> 
												<input class="form-control" name="emergencyContact1" value="<?php echo $child['contact1']; ?>">
											</div>
											<div class="form-group col-md-3">
												<label for="contactHomePhone1"> Home Phone </label>
												<input class="form-control" name="contactHomePhone1" value="<?php echo $child['contactPhone1']; ?>">
											</div>
											<div class="form-group col-md-3">
												<label for="contactWorkPhone1"> Work Phone </label> 
												<input class="form-control" name="contactWorkPhone1" value="<?php echo $child['contactWkPh1']; ?>">
											</div>
 
											<div class="form-group col-md-3">
												<label for="contactRel1"> Relationship </label> 
												<input class="form-control" name="contactRel1" value="<?php echo $child['contactRel1']; ?>">
											</div> 
										</div>
										-->
										<hr> 

										<div class="row">
											<div class="form-group col-md-6">
												<label for="emergencyContact1"> 1. Emergency Contact Name </label> 
												<input class="form-control" name="emergencyContact1" value="<?php echo $child['contact1']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactRel1"> Relationship </label> 
												<input class="form-control" name="contactRel1" value="<?php echo $child['contactRel1']; ?>">
											</div> 
										</div>
										<div class="row">
 
											<div class="form-group col-md-6">
												<label for="contactHomePhone1"> Home Phone </label>
												<input class="form-control" name="contactHomePhone1" value="<?php echo $child['contactPhone1']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactWorkPhone1"> Work Phone </label> 
												<input class="form-control" name="contactWorkPhone1" value="<?php echo $child['contactWkPh1']; ?>">
											</div>
										</div>

			
										<div class="row">
											<div class="form-group col-md-6">
												<label for="emergencyContact2"> 2. Emergency Contact Name </label> 
												<input class="form-control" name="emergencyContact2" value="<?php echo $child['contact2']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactRel2"> Relationship </label> 
												<input class="form-control" name="contactRel2" value="<?php echo $child['contactRel2']; ?>">
											</div> 
										</div>
										<div class="row">
 
											<div class="form-group col-md-6">
												<label for="contactHomePhone2"> Home Phone </label>
												<input class="form-control" name="contactHomePhone2" value="<?php echo $child['contactPhone2']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactWorkPhone2"> Work Phone </label> 
												<input class="form-control" name="contactWorkPhone2" value="<?php echo $child['contactWkPh2']; ?>">
											</div>
										</div>

		
										<div class="row">
											<div class="form-group col-md-6">
												<label for="emergencyContact3"> 3. Emergency Contact Name </label> 
												<input class="form-control" name="emergencyContact3" value="<?php echo $child['contact3']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactRel3"> Relationship </label> 
												<input class="form-control" name="contactRel3" value="<?php echo $child['contactRel3']; ?>">
											</div> 
										</div>
										<div class="row">
 
											<div class="form-group col-md-6">
												<label for="contactHomePhone3"> Home Phone </label>
												<input class="form-control" name="contactHomePhone3" value="<?php echo $child['contactPhone3']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactWorkPhone3"> Work Phone </label> 
												<input class="form-control" name="contactWorkPhone3" value="<?php echo $child['contactWkPh3']; ?>">
											</div>
										</div>
	
										<div class="row">
											<div class="form-group col-md-6">
												<label for="emergencyContact4"> 4. Emergency Contact Name </label> 
												<input class="form-control" name="emergencyContact4" value="<?php echo $child['contact4']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactRel4"> Relationship </label> 
												<input class="form-control" name="contactRel4" value="<?php echo $child['contactRel4']; ?>">
											</div> 
										</div>
										<div class="row">
 
											<div class="form-group col-md-6">
												<label for="contactHomePhone4"> Home Phone </label>
												<input class="form-control" name="contactHomePhone4" value="<?php echo $child['contactPhone4']; ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="contactWorkPhone4"> Work Phone </label> 
												<input class="form-control" name="contactWorkPhone4" value="<?php echo $child['contactWkPh4']; ?>">
											</div>
										</div>

									
										<hr>
										<div class="row"> 
											<div class="form-group col-md-6"> 
												<label for="familyDr"> Family Doctor Name </label> 
												<input class="form-control" name="familyDr" value="<?php echo $child['familyDr']; ?>" > 
											</div> 
											<div class="form-group col-md-6"> 
												<label for="familyDrPhone"> Phone Number </label>
												<input class="form-control" name="familyDrPhone" value="<?php echo $child['familyDrPhone']; ?>"> 
											</div> 
										</div>  
										<div class="row"> 
											<div class="form-group col-md-6">	
												<label for="familyDDS"> Family Dentist Name </label> 
												<input class="form-control" name="familyDDS" value="<?php echo $child['familyDDS']; ?>" > 

											</div>
											<div class="form-group col-md-6"> 
												<label for="familyDDSPhone"> Phone Number </label> 
												<input class="form-control" name="familyDDSPhone" value="<?php echo $child['familyDDSPhone']; ?>" > 
											</div>  
										</div> 
									</form>
									<br> <br> <br>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" 
onClick="submitStudentForm('childForm<?php echo $iteration; ?>')">Save changes</button>
								</div>
						</div>
				</div>
			</div>	

			</div>
			<div class="col-md-6">	
				<form action="" method="post">
					<input type="hidden" name="parent" value="mother">
					<button class="btn btn-outline btn-primary btn-lg
					btn-block" type="submit" name="editFamily">Confirm</button>
				</form>
			</div>
	
		</div>




		<!-- 
		<h3> Child ID  </h3>
		<pre> <?php echo $child['child_id']; ?> </pre>
		<h3> Child Name </h3>
		<pre> <?php echo $child['name']; ?> </pre>
		<br>
		<form action="child-update.php" method="post">
		<button class="btn btn-outline btn-danger btn-lg
		btn-block" type="submit" name="childEdit" value="<?php echo
				$child['child_id']; ?>">Edit</button>
		</form>
		-->
      </div>
    </div>
  </div>
<br>

<?php 
$iteration++; 
endforeach; 
?>

</div>
</div>
</div>

<!--
<div class ="row">
	<?php
		$iteration = 1; 
		foreach($children as $child): 
	?>
    <div class="col-md-6">
        <div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					Child <?php echo $iteration; ?> Info
				</h2>
			</div>
			<div class="panel-body"> 
				<h3> Child ID  </h3>
				<pre> <?php echo $child['child_id']; ?> </pre>
				<h3> Child Name </h3>
				<pre> <?php echo $child['name']; ?> </pre>
				<br>
				<form action="child-update.php" method="post">

				<button class="btn btn-outline btn-danger btn-lg
				btn-block" type="submit" name="childEdit" value="<?php echo
					$child['child_id']; ?>">Edit</button>
				</form>

			</div>
        </div>
    </div>
	<?php 
		$iteration++; 
		endforeach; 
	?>

</div>
-->



<?php
    //echo '<h1>Family Info:</h1>'; 
    //echo '<p> Family Name: '.$_SESSION['user_name']. '</p>'; 
    //echo '<p> Family ID: '.$_SESSION['user_id'].'</p>';
    //echo '<p> Address: '.$rows[0]['address'].'</p>';
    //echo '<p> Phone #: '.$rows[0]['phone'].'</p>';
	/*
    $children = db_select("SELECT * FROM `child_info` WHERE `family_id` =
		    ".$_SESSION['user_id'] ); 

    if($children == false) {
        $error = db_error();
    }
    echo '<h1> Children Info:</h1>';
    foreach($children as $child) {
    	echo '<p> Child id: '.$child['child_id'].'<br>';
	echo 'Child name: '.$child['name'].'</p>'; 
    
    }
	*/
?>
</div>
</div>
<div class="container">
	<div class="row">
      <div class=" footer">
       4601 Hyland Ave., San Jose, CA 95127 408-258-7677 Fax: 408-258-5997
		© St. John Vianney School
      </div>
	</div>
</div>
<div class="modal  wait" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
		$("[data-toggle='tooltip']").tooltip();
		 $('.resetPrice').tooltip();
    });
</script>
		<script type="text/javascript">
			$( document ).ready(function() {
				


				$(document).ajaxStart(function () {
					//$("#motherModal").modal('hide');
					//$("#motherModal").hide(); 
					//$('#wait').modal('show');  // show loading indicator
				});

				$(document).ajaxStop(function() 
				{
					//$('#wait').hide();  // hide loading indicator
				});	
			});
			

			function submitStudentForm( formID)
			{
				//alert("working"); 
				$.ajax({
					type: "POST",
					url: "http://test.lucastindall.com/students-form.php", //
					data: $("#"+formID).serialize(),
					success: function(msg){
						//alert(msg); 	
						location.reload(); 	
					},
					error: function(error){
						alert("failure"+error);
					}
				});
			}


			function submitForm( formID, modalID, reloadID )
			{
				alert("working"); 
				$.ajax({
					type: "POST",
					url: "http://test.lucastindall.com/parents-form.php", //

					//beforeSend: function() { pleaseWaitDiv.modal('show'); },
					//complete: function() { pleaseWaitDiv.modal('hide'); },
					data: $("#"+formID).serialize(),
					success: function(msg){
					
						location.reload(); 	
						//$("#collapseOne").addClass("in");
			
						//$("#"+modalID).modal('hide'); //hide popup 
					},
					error: function(error){
						alert("failure"+error);
					}
				});
					
				//location.reload(); 





			}

		</script>
	</body>
</html>





