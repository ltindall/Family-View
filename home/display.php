<?php

 
	session_start(); 
	if( !isset($_SESSION['user_id']))
		header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/');	
	require_once(__DIR__.'/../db_functions.php'); 

	$children = db_select("SELECT * FROM `students` WHERE `familyID` = 
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
	$f_grad_year = $parents_data[0]['F_Graduation_Date']; 	

	
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
	$m_grad_year = $parents_data[0]['M_Graduation_Date']; 

	$parishWorship = $parents_data[0]['Parish_Current']; 
	$parishResidence = $parents_data[0]['Parish_Geographical']; 
	$schoolDistrict = $parents_data[0]['School_District']; 
	$nearestSchool = $parents_data[0]['Nearest_PublicSchool']; 
 
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
			$successChild = db_select("SELECT `nameF`,`nameL` FROM `students` WHERE `studentID` =".$_SESSION['editID']); 
			//$success = "Information for ".$_SESSION['editName']." (Student) has been updated!"; 
			$success = "Information for ".$successChild[0]['nameF']." ".$successChild[0]['nameL']." (Student) has been updated!";
		}
		elseif($_SESSION['message']=="other"){
			$success = "Other Information was successfully updated!"; 
		}
		elseif($_SESSION['message'] =="none"){
			$success = "No changes made.";
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
	<link rel="shortcut icon" href="https://parents.sjvsj.org/media/favicon.png" type="image/x-icon" />
	
	<!-- Site Designed by Lucas Tindall -->	


	<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  
	<!-- Custom style -->
	<link href="https://parents.sjvsj.org/css/style.css" rel="stylesheet">
	
	<link
	href='https://fonts.googleapis.com/css?family=Ubuntu|Montserrat|Oswald|Francois+One|Roboto+Slab'
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
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/">Home</a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right" >
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php?logout" class="navbar-nav ">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>


<div class="display">

<?php 
	if( $parents_data[0]['releaseAndConsent'] > 0 ): 
	$signDate = date('M j Y g:i A', strtotime($parents_data[0]['releaseAndConsent']));
	$signer = $parents_data[0]['signature']; 
?>
	<br>
	<div class="alert alert-success" role="alert">
		<strong> Success! </strong> All forms complete. The release and consent 
		statement was signed by <?php echo $signer; ?> on <?php echo $signDate; ?>.

	</div>
<?php endif; ?>
<?php if(isset($_SESSION['message'])):
		if($_SESSION['message']!="none"): ?>
<br>
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success! </strong> <?php echo $success; ?>
</div>
<?php else: ?>
<br>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?php echo $success; ?>
</div>
<?php
		endif;
	unset($_SESSION['message']); 	
	endif; 
?>
<?php if( $parents_data[0]['releaseAndConsent'] == 0 ): ?>
	
<br>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Please remember to submit the release and consent statement at the bottom. 
</div>
<?php endif; ?>
<div class="page-header">
	<h1>Parent/Guardian Information</h1>
</div>
<div class="row">
<div class="col-sm-12">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed"  data-placement="right"  role="button" data-toggle="collapse"  href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<?php echo $f_first_name." ".$f_last_name; ?> (Father)</a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body info-body " id="father-info"> 
		<div class="row">
			<div class="col-sm-12">
				<div class="row">

					<blockquote><strong> Please review the information in each of the fields below for accuracy.  If any updates are required, press the red "Edit" button to enter and submit changes.
					</strong></blockquote>

					
				</div>
				<div class="row">

					<div class="col-sm-3">
	  					<h5> First Name  </h5>
						<pre> <?php echo $f_first_name; ?> </pre>
					</div>
					<div class="col-sm-2">
						<h5> Middle Name </h5>
						<pre> <?php echo $f_middle_name; ?></pre>
					</div>
					<div class="col-sm-3">
						<h5> Last Name </h5>
						<pre> <?php echo $f_last_name; ?></pre>
					</div>

					<div class="col-sm-4">
						<h5> Relationship to Student(s)</h5>

						<pre style="width:70%;" > <?php echo $f_relationship; ?> </pre>
					</div>	
				</div>	
				<div class="row">
					
					<div class="col-sm-3">
						<h5> Home Phone </h5>
						<pre> <?php echo $f_phone_home; ?> </pre>
					</div>
					<div class="col-sm-3">
						<h5> Cell Phone </h5>
						<pre> <?php echo $f_cell; ?></pre>
					</div>

					<div class="col-sm-4">
						<h5> Personal Email </h5>
						<pre> <?php echo $f_email_home; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<h5> Graduate of SJV? Year </h5>

						<pre style="width:70%;" > <?php echo $f_grad_year; ?> </pre>
					</div>	
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-7">
					<h5> Street Address </h5>
					<pre> <?php echo $f_address_street; ?> </pre>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">	
						<h5> City </h5>
						<pre> <?php echo $f_address_city; ?> </pre>
					</div>
					<div class="col-sm-3">			
						<h5> State </h5>
						<pre> <?php echo $f_address_state; ?> </pre>
					</div>
					<div class="col-sm-2">
						<h5> Zip </h5>
						<pre> <?php echo $f_address_zip; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-4">
						<h5> Occupation </h5>
						<pre> <?php echo $f_bus_occupation; ?></pre>
					</div>
					<div class="col-sm-4">
						<h5> Employer </h5>
						<pre> <?php echo $f_bus_company; ?></pre>
					</div>
					<div class="col-sm-4">
						<h5> Industry </h5>
						<pre> <?php echo $f_bus_type; ?></pre>
					</div> 
				</div>	
				<div class="row">
					<div class="col-sm-4">
						<h5> Work Email </h5>
						<pre> <?php echo $f_bus_email; ?> </pre>
					</div>
					<div class="col-sm-4">
						<h5> Work Phone </h5>
						<pre> <?php echo $f_bus_phone; ?></pre>
					</div>
				</div>
				<hr>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
	  		<button type="button" class="btn btn-outline btn-danger btn-lg btn-block" data-toggle="modal" data-target="#fatherModal" > Edit </button>
			<div class="modal fade" id="fatherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"
									id="myModalLabel">Updating Information for <?php echo $f_first_name." ".$f_last_name; ?> (Father)</h4>
								</div>
								<div class="modal-body">
									<form id="fatherForm">
										<input type="hidden" name="parent" value="father">	
										<div class="row">
											<div class="col-sm-12">
												<blockquote><h5><strong> 
													Once you have made all of the necessary updates, please press the "Save changes" button at the bottom.
												</strong></h5></blockquote>
											</div>
										</div>	
										<div class="form-inline">
					
											<div class="form-group">
												<label for="relationship"> Relationship to Student(s) </label>
												<select class="form-control" name="relationship">
													<option value="Father" <?php if($f_relationship == "Father") echo "selected"; ?>> Father </option>
													<option value="Stepfather" <?php if($f_relationship=="Stepfather") echo "selected"; ?>> Stepfather </option>
													<option value="Grandfather" <?php if($f_relationship=="Grandfather") echo "selected"; ?>> Grandfather </option>
													<option value="Great Grandfather" <?php if($f_relationship=="Great Grandfather") echo "selected"; ?>> Great Grandfather </option>
													<option value="Guardian" <?php if($f_relationship=="Guardian") echo "selected"; ?>> Guardian </option> 
													<option value="Uncle" <?php if($f_relationship=="Uncle") echo "selected"; ?>> Uncle </option>
												<!--<input class="form-control" name="relationship"
													value="<?php echo $f_relationship; ?>">-->
												</select>
											</div>
				
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<label for="firstName"> First Name
												</label>
												<input class="form-control"
												name="firstName" disabled value="<?php echo $f_first_name; ?>" >
											</div>
											<div class="form-group col-sm-4">
												<label for="middleName"> Middle Name
												</label>
												<input class="form-control"
												name="middleName" disabled  value="<?php echo $f_middle_name; ?>" >
											</div>
											<div class="form-group col-sm-4">
												<label for="lastName">
												Last Name
												</label>
												<input class="form-control"
												name="lastName" disabled value="<?php echo $f_last_name; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-6">
												<label for="homePhone"> Home Phone
												</label>
												<input class="form-control"
												name="homePhone" value="<?php echo $f_phone_home; ?>" >
											</div>
											<div class="form-group col-sm-6">
												<label for="cellPhone"> Cell Phone
												</label>
												<input class="form-control"
												name="cellPhone" value="<?php echo $f_cell; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-6">
												<label for="personalEmail"> Personal Email </label>
												<input class="form-control" name="personalEmail"
												value="<?php echo $f_email_home; ?>" >
											</div>
											<div class="form-group col-sm-6">
												<label for="gradYear"> Graduate of SJV? Year </label>
												<input class="form-control" style="width:25%; " name="gradYear"
												value="<?php echo $f_grad_year; ?>" >
											</div>
										</div>
										
										<hr>

										<div class="row">
											<div class="form-group col-sm-12">
												<label for="address"> Street Address </label>
												<input class="form-control" name="address" value="<?php echo $f_address_street; ?>">
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-5">
												<label for="city"> City </label> 
												<input class="form-control" name="city" value="<?php echo $f_address_city; ?>">
											</div>
											<div class="form-group col-sm-4">
												<label for="state"> State </label>
												<input class="form-control" name="state" value="<?php echo $f_address_state; ?>">
											</div>
											<div class="form-group col-sm-3">
												<label for="zip"> Zip </label> 
												<input class="form-control" name="zip" value="<?php echo $f_address_zip; ?>">
											</div> 
										</div>
				
										<hr> 

										<div class="row"> 
											<div class="form-group col-sm-6"> 
												<label for="occupation"> Occupation </label> 
												<input class="form-control" name="occupation" value="<?php echo $f_bus_occupation; ?>" > 
											</div> 
											<div class="form-group col-sm-6"> 
												<label for="employer"> Employer </label>
												<input class="form-control" name="employer" value="<?php echo $f_bus_company; ?>"> 
											</div> 
										</div>  
										<div class="row"> 

											<div class="form-group col-sm-6">	
												<label for="industry"> Industry (e.g. medical, financial) </label> 
												<input class="form-control" name="industry" value="<?php echo $f_bus_type; ?>" > 

											</div>

											<div class="form-group col-sm-4"> 
												<label for="workPhone"> Work Phone </label> 
												<input class="form-control" name="workPhone" value="<?php echo $f_bus_phone; ?>" > 
											</div>  
										</div>
										<div class="row">

											<div class="form-group col-sm-6">	
												<label for="workEmail"> Work Email<sup>&#10013</sup> </label> 
												<input class="form-control" name="workEmail" value="<?php echo $f_bus_email; ?>" > 

											</div>

											<div class="col-sm-6">

											<h5><small><sup>&#10013</sup>The email that you provide will be used to send out communications.  If you do not wish to receive emails at your workplace, please leave blank.</small></h5>
											</div>
										</div> 
									</form>
							
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

			<div class="col-sm-4 col-sm-offset-2">		
					<button class="btn btn-outline btn-primary btn-lg
					btn-block" onClick="closePanel('collapseOne')">Close</button>
		
			</div>
		</div>
      </div>
    </div>
  </div>



  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed"  data-placement="right"  role="button" data-toggle="collapse"  href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
		<?php echo $m_first_name." ".$m_last_name; ?> (Mother)</a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body info-body " id="mother-info"> 
		<div class="row">
			<div class="col-sm-12">	
				<div class="row">

					<blockquote><strong> Please review the information in each of the fields below for accuracy.  If any updates are required, press the red "Edit" button to enter and submit changes.
					</strong></blockquote>

					
				</div>
				<div class="row">
					<div class="col-sm-3">
	  					<h5> First Name  </h5>
						<pre> <?php echo $m_first_name; ?> </pre>
					</div>
					<div class="col-sm-2">
						<h5> Middle Name </h5>
						<pre> <?php echo $m_middle_name; ?></pre>
					</div>
					<div class="col-sm-3">
						<h5> Last Name </h5>
						<pre> <?php echo $m_last_name; ?></pre>
					</div>

					<div class="col-sm-4">
						<h5> Relationship to Student(s)</h5>

						<pre style="width:70%;" > <?php echo $m_relationship; ?> </pre>
					</div>	
				</div>	
				<div class="row">
					<div class="col-sm-3">
						<h5> Home Phone </h5>
						<pre> <?php echo $m_phone_home; ?> </pre>
					</div>
					<div class="col-sm-3">
						<h5> Cell Phone </h5>
						<pre> <?php echo $m_cell; ?></pre>
					</div>
					<div class="col-sm-4">
						<h5> Personal Email </h5>
						<pre> <?php echo $m_email_home; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<h5> Graduate of SJV? Year </h5>

						<pre style="width:70%;" > <?php echo $m_grad_year; ?> </pre>
					</div>	
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-7">
					<h5> Street Address </h5>
					<pre> <?php echo $m_address_street; ?> </pre>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">	
						<h5> City </h5>
						<pre> <?php echo $m_address_city; ?> </pre>
					</div>
					<div class="col-sm-3">			
						<h5> State </h5>
						<pre> <?php echo $m_address_state; ?> </pre>
					</div>
					<div class="col-sm-2">
						<h5> Zip </h5>
						<pre> <?php echo $m_address_zip; ?></pre>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-4">
						<h5> Occupation </h5>
						<pre> <?php echo $m_bus_occupation; ?></pre>
					</div>
					<div class="col-sm-4">
						<h5> Employer </h5>
						<pre> <?php echo $m_bus_company; ?></pre>
					</div>
					<div class="col-sm-4">
						<h5> Industry </h5>
						<pre> <?php echo $m_bus_type; ?></pre>
					</div> 
				</div>	
				<div class="row">
					<div class="col-sm-4">
						<h5> Work Email </h5>
						<pre> <?php echo $m_bus_email; ?> </pre>
					</div>
					<div class="col-sm-4">
						<h5> Work Phone </h5>
						<pre> <?php echo $m_bus_phone; ?></pre>
					</div>
				</div>
				<hr>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
	  		<button type="button" class="btn btn-outline btn-danger btn-lg btn-block" data-toggle="modal" data-target="#motherModal" > Edit </button>
			<div class="modal fade" id="motherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
				<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"
									id="myModalLabel2">Updating Information for <?php echo $m_first_name." ".$m_last_name; ?> (Mother)</h4>
								</div>
								<div class="modal-body">
									<form id="motherForm">
										<input type="hidden" name="parent" value="mother">	
										<div class="row">
											<div class="col-sm-12">
												<blockquote><h5><strong> 
													Once you have made all of the necessary updates, please press the "Save changes" button at the bottom.
												</strong></h5></blockquote>
											</div>
										</div>	
										<div class="form-inline">
					
											<div class="form-group">
												<label for="relationship"> Relationship to Student(s) </label>
												<select class="form-control" name="relationship">
													<option value="Mother" <?php if($m_relationship == "Mother") echo "selected"; ?> > Mother </option>
													<option value="Stepmother" <?php if($m_relationship == "Stepmother") echo "selected"; ?>> Stepmother </option>
													<option value="Grandmother" <?php if($m_relationship == "Grandmother") echo "selected"; ?>> Grandmother </option>
													<option value="Great Grandmother" <?php if($m_relationship == "Great Grandmother") echo "selected"; ?> > Great Grandmother </option>
													<option value="Guardian" <?php if($m_relationship == "Guardian") echo "selected"; ?>> Guardian </option> 
													<option value="Aunt" <?php if($m_relationship == "Aunt") echo "selected"; ?>> Aunt </option>
												<!--<input class="form-control" name="relationship"
													value="<?php echo $f_relationship; ?>">-->
												</select>
											</div>
				
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<label for="firstName"> First Name
												</label>
												<input class="form-control"
												name="firstName" disabled value="<?php echo $m_first_name; ?>" >
											</div>
											<div class="form-group col-sm-4">
												<label for="middleName"> Middle Name
												</label>
												<input class="form-control"
												name="middleName" disabled value="<?php echo $m_middle_name; ?>" >
											</div>
											<div class="form-group col-sm-4">
												<label for="lastName">
												Last Name
												</label>
												<input class="form-control"
												name="lastName" disabled value="<?php echo $m_last_name; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-6">
												<label for="homePhone"> Home Phone
												</label>
												<input class="form-control"
												name="homePhone" value="<?php echo $m_phone_home; ?>" >
											</div>
											<div class="form-group col-sm-6">
												<label for="cellPhone"> Cell Phone
												</label>
												<input class="form-control"
												name="cellPhone" value="<?php echo $m_cell; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-6">
												<label for="personalEmail"> Personal Email </label>
												<input class="form-control" name="personalEmail"
												value="<?php echo $m_email_home; ?>" >
											</div>
											<div class="form-group col-sm-6">
												<label for="gradYear"> Graduate of SJV? Year </label>
												<input class="form-control" style="width:25%; " name="gradYear"
												value="<?php echo $m_grad_year; ?>" >
											</div>
										</div>
										
										<hr>

										<div class="row">
											<div class="form-group col-sm-12">
												<label for="address"> Street Address </label>
												<input class="form-control" name="address" value="<?php echo $m_address_street; ?>">
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-5">
												<label for="city"> City </label> 
												<input class="form-control" name="city" value="<?php echo $m_address_city; ?>">
											</div>
											<div class="form-group col-sm-4">
												<label for="state"> State </label>
												<input class="form-control" name="state" value="<?php echo $m_address_state; ?>">
											</div>
											<div class="form-group col-sm-3">
												<label for="zip"> Zip </label> 
												<input class="form-control" name="zip" value="<?php echo $m_address_zip; ?>">
											</div> 
										</div>
				
										<hr> 

										<div class="row"> 
											<div class="form-group col-sm-6"> 
												<label for="occupation"> Occupation </label> 
												<input class="form-control" name="occupation" value="<?php echo $m_bus_occupation; ?>" > 
											</div> 
											<div class="form-group col-sm-6"> 
												<label for="employer"> Employer </label>
												<input class="form-control" name="employer" value="<?php echo $m_bus_company; ?>"> 
											</div> 
										</div>  
										<div class="row"> 

											<div class="form-group col-sm-6">	
												<label for="industry"> Industry (e.g. medical, financial) </label> 
												<input class="form-control" name="industry" value="<?php echo $m_bus_type; ?>" > 
											</div>
											<div class="form-group col-sm-4"> 
												<label for="workPhone"> Work Phone </label> 
												<input class="form-control" name="workPhone" value="<?php echo $m_bus_phone; ?>" > 
											</div> 
										</div>
										<div class="row">	

											<div class="form-group col-sm-6">	
												<label for="workEmail"> Work Email<sup>&#10013</sup></label> 
												<input class="form-control" name="workEmail" value="<?php echo $m_bus_email; ?>" > 

											</div>
											<div class="col-sm-6">

											<h5><small><sup>&#10013</sup>The email that you provide will be used to send out communications.  If you do not wish to receive emails at your workplace, please leave blank.</small></h5>
											</div>
										</div>
									</form>
								
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
		
			<div class="col-sm-4 col-sm-offset-2">		
					<button class="btn btn-outline btn-primary btn-lg
					btn-block" onClick="closePanel('collapseTwo')">Close</button>
		
			</div>
		</div>
      </div>
    </div>
  </div>

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="otherInfo">
				
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse"
						href="#otherInfoCollapse" aria-expanded="true" aria-controls="collapseOne">
							Other Information	
						</a>
					</h4>
				</div>
				
				<div id="otherInfoCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="otherInfo">
				<div class="panel-body info-body " id="other-info"> 
					<div class="row">
						<div class="col-sm-12">

							<div class="row">
								<div class="col-sm-4">
									<h5> Parish of Worship </h5>
									<pre> <?php echo $parishWorship; ?> </pre>
								</div>
								<div class="col-sm-4">
									<h5> Parish of Residence </h5>
									<pre> <?php echo $parishResidence; ?></pre>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4">
									<h5> Nearest Public School  </h5>
									<pre> <?php echo $nearestSchool; ?></pre>
								</div>
								<div class="col-sm-4">
									<h5> Public School District of Residence </h5>
									<pre> <?php echo $schoolDistrict; ?> </pre>
								</div>
							</div>	
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4 col-sm-offset-1">
						<button type="button" class="btn btn-outline btn-danger btn-lg btn-block" data-toggle="modal" data-target="#otherModal" > Edit </button>
						<div class="modal fade" id="otherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
									<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title"
												id="myModalLabel">Updating Other
												Information</h4>
											</div>
											<div class="modal-body">
												<form id="otherForm">
													<div class="row">
														<div class="form-group col-sm-4">
															<label for="parishWorship"> Parish of Worship
															</label>
															<input class="form-control"
															name="parishWorship" value="<?php echo $parishWorship; ?>" >
														</div>
														<div class="form-group col-sm-4">
															<label for="parishResidence"> Parish of Residence
															</label>
															<input class="form-control"
															name="parishResidence" value="<?php echo $parishResidence; ?>" >
														</div>
													</div>

													<div class="row">	
														<div class="form-group col-sm-4">
															<label for="nearestSchool"> Nearest Public School
															</label>
															<input class="form-control"
															name="nearestSchool" value="<?php echo $nearestSchool; ?>" >
														</div>
														<div class="form-group col-sm-7">
															<label for="schoolDistrict"> Public School District of Residence
															</label>
															<input class="form-control"
															name="schoolDistrict" style="width:70%;" value="<?php echo $schoolDistrict; ?>" >
														</div>
													</div>
												</form>
												<br> <br> <br>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary" 
			onClick="submitOtherForm()">Save changes</button>
											</div>
									</div>
							</div>
						</div>	

						</div>

						<div class="col-sm-4 col-sm-offset-2">		
								<button class="btn btn-outline btn-primary btn-lg
								btn-block" onClick="closePanel('otherInfoCollapse')">Close</button>
					
						</div>
					</div>
				</div>
				</div>
			</div>
</div>


</div>
</div>



<div class="page-header">
	<h1>Student Emergency Information</h1>
</div>

<div class="row">
<div class="col-sm-12">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  
	<?php
		$iteration = 1; 
		$updatesNeeded = 0; 
		foreach($children as $child): 
	?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="childHeading<?php echo $iteration;
	?>">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse"
		href="#childCollapse<?php echo $iteration; ?>" aria-expanded="true" aria-controls="collapseOne">
			<?php echo $child['nameF']." ".$child['nameL']; 
				if((empty($child['contact1']) && strlen($child['contact1']) == 0 )
				|| (empty($child['contactRel1']) && strlen($child['contactRel1']) == 0 )
				|| (empty($child['contactPhone1']) && strlen($child['contactPhone1']) == 0 )
				|| (empty($child['contactWkPh1']) && strlen($child['contactWkPh1']) == 0 )){ 
					$updatesNeeded++; 				
					echo "<em> (Updates required) </em>"; 
				}
			?>
		</a>
      </h4>
    </div>
    <div id="childCollapse<?php echo $iteration; ?>" class="panel-collapse collapse" role="tabpanel"
	aria-labelledby="childHeading<?php echo $iteration; ?>">
	  <div class="panel-body info-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12">
						<h5> <strong> Personal Information </strong> </h5>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
	  					<h5> First Name  </h5>
						<pre> <?php echo $child['nameF']; ?> </pre>
					</div>
					<div class="col-sm-3">
						<h5> Middle Name </h5>
						<pre> <?php echo $child['nameM']; ?></pre>
					</div>
					<div class="col-sm-3">
						<h5> Last Name </h5>
						<pre> <?php echo $child['nameL']; ?></pre>
					</div>
				</div>	
				<div class="row">
					<div class="col-sm-2">
						<h5> Birthday </h5>
						<pre> <?php echo $child['birthdate']; ?> </pre>
					</div>
					<div class="col-sm-2">
						<h5> Grade </h5>
						<pre> <?php echo $child['grade']; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h5> Medical conditions and allergies</h5>
						<pre> <?php echo $child['allergiesComments']; ?></pre>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<h5> Does she/he take daily medications? </h5>
						<pre style="width:30%;"> <?php echo $child['medication']; ?> </pre>
					</div>
					<div class="col-sm-8">
						<h5> List of medications </h5>
						<pre> <?php echo $child['medicationComments']; ?></pre>
					</div>
				</div>
				<hr>

				<div class="row">
					<div class="col-sm-12">
					<h5><strong> Emergency Contact Information </strong>(must have at least one)</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">	
					<h5>1. Name</h5>
					<pre> <?php echo $child['contact1']; ?> </pre>
				</div>
				<div class="col-sm-3">			
					<h5> Relationship</h5>
					<pre> <?php echo $child['contactRel1']; ?> </pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 1 </h5>
					<pre> <?php echo $child['contactPhone1']; ?></pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 2 </h5>
					<pre> <?php echo $child['contactWkPh1']; ?></pre>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-4">	
					<h5>2. Name </h5>
					<pre> <?php echo $child['contact2']; ?> </pre>
				</div>
				<div class="col-sm-3">			
					<h5> Relationship</h5>
					<pre> <?php echo $child['contactRel2']; ?> </pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 1 </h5>
					<pre> <?php echo $child['contactPhone2']; ?></pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 2 </h5>
					<pre> <?php echo $child['contactWkPh2']; ?></pre>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-4">	
					<h5>3. Name </h5>
					<pre> <?php echo $child['contact3']; ?> </pre>
				</div>
				<div class="col-sm-3">			
					<h5> Relationship</h5>
					<pre> <?php echo $child['contactRel3']; ?> </pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 1 </h5>
					<pre> <?php echo $child['contactPhone3']; ?></pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 2 </h5>
					<pre> <?php echo $child['contactWkPh3']; ?></pre>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4">	
					<h5>4. Name</h5>
					<pre> <?php echo $child['contact4']; ?> </pre>
				</div>
				<div class="col-sm-3">			
					<h5> Relationship</h5>
					<pre> <?php echo $child['contactRel4']; ?> </pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 1 </h5>
					<pre> <?php echo $child['contactPhone4']; ?></pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone 2 </h5>
					<pre> <?php echo $child['contactWkPh4']; ?></pre>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<h5><strong> Student Physician Information </strong> </h5>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<h5> Primary Physician </h5>
					<pre> <?php echo $child['familyDr']; ?></pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone </h5>
					<pre> <?php echo $child['familyDrPhone']; ?></pre>
				</div>
				<div class="col-sm-4">
					<h5> Family Dentist </h5>
					<pre> <?php echo $child['familyDDS']; ?></pre>
				</div>
				<div class="col-sm-2">
					<h5> Phone </h5>
					<pre> <?php echo $child['familyDDSPhone']; ?></pre>
				</div> 
			</div>
			<hr>
		</div>
	</div>
	<br>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
			<button type="button" class="btn btn-outline btn-danger btn-lg btn-block" 
				data-toggle="modal" data-target="#childModal<?php echo $iteration; ?>" > Edit </button>
			<div class="modal fade" id="childModal<?php echo $iteration; ?>" 
				tabindex="-1" role="dialog" aria-labelledby="childModalLabel<?php echo $iteration; ?>">
				<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"
									id="childModalLabel<?php echo $iteration; ?>">
									Updating Information for <?php echo $child['nameF']." ".$child['nameL']; ?> (Student)
									<br> <small>* Indicates required field </small></h4>
								</div>
								<div class="modal-body">
									<form id="childForm<?php echo $iteration; ?>">
									<input type="hidden" name="studentID" value="<?php echo $child['studentID']; ?>">
										<div class="row">
											<div class="form-group col-sm-3">
												<label for="firstName"> First Name
												</label>
												<input class="form-control"
												name="firstName" disabled value="<?php echo $child['nameF']; ?>" >
											</div>
											<div class="form-group col-sm-3">
												<label for="middleName"> Middle Name
												</label>
												<input class="form-control"
												name="middleName" disabled value="<?php echo $child['nameM']; ?>" >
											</div>
											<div class="form-group col-sm-3">
												<label for="lastName">
												Last Name
												</label>
												<input class="form-control"
												name="lastName" disabled value="<?php echo $child['nameL']; ?>" >
											</div>

											<div class="form-group col-sm-2">
												<label for="birthday"> Birthday
												</label>
												<input class="form-control"
												name="birthday" disabled  value="<?php echo $child['birthdate']; ?>" >
											</div>
											<div class="form-group col-sm-1">
												<label for="grade"> Grade
												</label>
												<input class="form-control"
												name="grade" disabled value="<?php echo $child['grade']; ?>" >
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-12">
												<label for="allergies"> Please indicate any existing medical conditions/allergies(e.g. asthma, diabetes, epilepsy, heart condition, ADHD, hay fever, peanuts, etc.) that your child may have </label>
												<input class="form-control" style="width:60%;" name="allergies"
												value="<?php echo $child['allergiesComments']; ?>" >
											</div>
										</div>
										
										<div class="row">
											<div class="form-group col-sm-5">
												<label for="medications"> Does she/he take daily medications?
												</label>
												<select class="form-control" style="width:50%;" name="medications">
													<option value="No" <?php if(stripos($child['medication'],"no") !== FALSE) echo "selected"; ?>> No </option>

													<option value="Yes" <?php if(stripos($child['medication'],"yes") !== FALSE) echo "selected"; ?>> Yes </option>
												</select>
											</div>
											<div class="form-group col-sm-6">
												<label for="medicationComments"> If yes, please list medications
												</label>
												<input class="form-control"
												 name="medicationComments" value="<?php echo $child['medicationComments']; ?>" >
											</div>
										</div>
										<hr> 
										<div class="row">
											<div class="col-sm-12">
												<h5><strong> Emergency Contact Information: <small> In the event of illness or accident, when I cannot be reached, I wish one of the following to be notified by telephone. They are authorized to act in my absence, and will be informed that their names have been used on this card. Please DO NOT LIST MOTHER OR FATHER OF STUDENT in spaces below. Emergency contacts must be SOMEONE NEARBY who can be reached quickly. </small></strong> </h5>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<label for="emergencyContact1"> 1. Name* </label> 
												<input class="form-control" required name="emergencyContact1" value="<?php echo $child['contact1']; ?>">
											</div>
											<div class="form-group col-sm-3">
												<label for="contactRel1"> Relationship* </label> 
												<input class="form-control" required name="contactRel1" value="<?php echo $child['contactRel1']; ?>">
											</div>

											<div class="form-group col-sm-2">
												<label for="contactHomePhone1"> Phone 1* </label>
												<input class="form-control" required name="contactHomePhone1" value="<?php echo $child['contactPhone1']; ?>">
											</div>

											<div class="form-group col-sm-2">
												<label for="contactWorkPhone1"> Phone 2* </label> 
												<input class="form-control" required name="contactWorkPhone1" value="<?php echo $child['contactWkPh1']; ?>">
											</div>
										</div>

			
										<div class="row">
											<div class="form-group col-sm-4">
												<label for="emergencyContact2"> 2. Name </label> 
												<input class="form-control" name="emergencyContact2" value="<?php echo $child['contact2']; ?>">
											</div>
											<div class="form-group col-sm-3">
												<label for="contactRel2"> Relationship </label> 
												<input class="form-control" name="contactRel2" value="<?php echo $child['contactRel2']; ?>">
											</div> 
 
											<div class="form-group col-sm-2">
												<label for="contactHomePhone2"> Phone 1 </label>
												<input class="form-control" name="contactHomePhone2" value="<?php echo $child['contactPhone2']; ?>">
											</div>
											<div class="form-group col-sm-2">
												<label for="contactWorkPhone2"> Phone 2 </label> 
												<input class="form-control" name="contactWorkPhone2" value="<?php echo $child['contactWkPh2']; ?>">
											</div>
										</div>

		
										<div class="row">
											<div class="form-group col-sm-4">
												<label for="emergencyContact3"> 3. Name </label> 
												<input class="form-control" name="emergencyContact3" value="<?php echo $child['contact3']; ?>">
											</div>
											<div class="form-group col-sm-3">
												<label for="contactRel3"> Relationship </label> 
												<input class="form-control" name="contactRel3" value="<?php echo $child['contactRel3']; ?>">
											</div> 
 
											<div class="form-group col-sm-2">
												<label for="contactHomePhone3"> Phone 1 </label>
												<input class="form-control" name="contactHomePhone3" value="<?php echo $child['contactPhone3']; ?>">
											</div>
											<div class="form-group col-sm-2">
												<label for="contactWorkPhone3"> Phone 2 </label> 
												<input class="form-control" name="contactWorkPhone3" value="<?php echo $child['contactWkPh3']; ?>">
											</div>
										</div>
	
										<div class="row">
											<div class="form-group col-sm-4">
												<label for="emergencyContact4"> 4. Name </label> 
												<input class="form-control" name="emergencyContact4" value="<?php echo $child['contact4']; ?>">
											</div>
											<div class="form-group col-sm-3">
												<label for="contactRel4"> Relationship </label> 
												<input class="form-control" name="contactRel4" value="<?php echo $child['contactRel4']; ?>">
											</div> 
 
											<div class="form-group col-sm-2">
												<label for="contactHomePhone4"> Phone 1 </label>
												<input class="form-control" name="contactHomePhone4" value="<?php echo $child['contactPhone4']; ?>">
											</div>
											<div class="form-group col-sm-2">
												<label for="contactWorkPhone4"> Phone 2 </label> 
												<input class="form-control" name="contactWorkPhone4" value="<?php echo $child['contactWkPh4']; ?>">
											</div>
										</div>

									
										<hr>
		
										<div class="row">
											<div class="col-sm-12">
												<h4><strong> Student Physician Information</strong> </h4>
											</div>
										</div>
										<div class="row"> 
											<div class="form-group col-sm-4"> 
												<label for="familyDr"> Family Doctor Name </label> 
												<input class="form-control" name="familyDr" value="<?php echo $child['familyDr']; ?>" > 
											</div> 
											<div class="form-group col-sm-2"> 
												<label for="familyDrPhone"> Phone Number </label>
												<input class="form-control" name="familyDrPhone" value="<?php echo $child['familyDrPhone']; ?>"> 
											</div>

											<div class="form-group col-sm-4">	
												<label for="familyDDS"> Family Dentist Name </label> 
												<input class="form-control" name="familyDDS" value="<?php echo $child['familyDDS']; ?>" > 

											</div>
											<div class="form-group col-sm-2"> 
												<label for="familyDDSPhone"> Phone Number </label> 
												<input class="form-control" name="familyDDSPhone" value="<?php echo $child['familyDDSPhone']; ?>" > 
											</div>  
										</div>  
									</form>
								
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

			<div class="col-sm-4 col-sm-offset-2">		
					<button class="btn btn-outline btn-primary btn-lg
					btn-block" onClick="closePanel('childCollapse<?php echo $iteration; ?>')">Close</button>
		
			</div>
		</div>
      </div>
    </div>
  </div>


<?php 
$iteration++; 
endforeach; 
?>

</div>
</div>
</div>

<div class="page-header">
	<h1> Release and Consent </h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="releaseAndConsent">
				
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse"
						href="#releaseAndConsentCollapse" aria-expanded="true" aria-controls="collapseOne">
						<?php if( $parents_data[0]['releaseAndConsent'] == 0 ): ?>
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							Medical Release and Consent Form <em> (Action Required) </em>
							<?php else: ?>
						<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
							Medical Release and Consent Form
							<?php endif; ?>
						</a>
					</h4>
				</div>
				
				<div id="releaseAndConsentCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="releaseAndConsent">
				<div class="panel-body info-body " id="release-consent">
					<?php if( $parents_data[0]['releaseAndConsent'] > 0 ): ?>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<p> Thank you for signing the release and consent statement. All forms are now complete. If you would like 
								to view a copy of the release and consent statement please click on the button below. </p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<button type="button" onClick="window.open('../documents/SJVReleaseConsent15-16.pdf','_blank')" class="btn btn-outline btn-success btn-lg btn-block"> View Release and Consent Form </button>
						</div>
					</div>
					<?php else: ?>
					<?php if($updatesNeeded > 0): ?>
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							
							<div class="alert alert-danger" role="alert">
								Updates required above. Please complete all sections before signing the release and consent form. 

							</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<p>
								Once you have read through, updated, and verified that the information in each of the sections above is correct, please press the button below to electronically sign the St. John Vianney Catholic School release and consent agreement.
							</p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
						<button type="button" <?php if($updatesNeeded >0) echo "disabled"; ?> 
						class="btn btn-outline btn-info btn-lg btn-block" 
						data-toggle="modal" data-target="#releaseConsentModal" > E-Sign and Final Submit </button>
						<div class="modal fade" id="releaseConsentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title"
												id="myModalLabel">Medical Release and Consent Agreement <br><h5>	
												<small>Please read each section and check the boxes below. When you are done sign the form below with your name and press the Submit button. </small></h5>

													</h4>
											</div>
											<form id="releaseConsentForm">
											<div class="modal-body">
												<form id="releaseConsentForm">
													<input type="hidden" name="parent" value="">
													<div class="row">

														<div class="form-group col-sm-12">
															<label> Parent/Guardian Information </label>
															<div class="checkbox">
																<label>
																	<input 
																	name="familyInfoRelease" type="checkbox" required id="familyCheck">
																	I agree that I have updated and confirmed the validity of the Parent/Guardian Information. 
																</label>
															</div>
														</div>
													</div>

													<div class="row">

														<div class="form-group col-sm-12">
															<label> Student Emergency Information </label>
															<div class="checkbox">
																<label>
																	<input 
																	name="studentInfoRelease" type="checkbox" required id="studentCheck">
																	I agree that I have updated and confirmed the validity of the Student Emergency Information. 
																</label>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group col-sm-12">
															<label> First-Aid/Emergency Treatment Consent </label>
															<div class="checkbox">
																<label>
																	<input 
																	name="medicalRelease" type="checkbox" required id="releaseCheck">
																	Without limiting other emergency powers that may be provided by law, I authorize school personnel to administer first-aid to my child if the school administration deems it necessary and appropriate to preserve the life, limb or well-being of my child. If the school administration believes, in its sole discretion, that a medical necessity exists beyond that which can reasonably be dealt with on school grounds by school personnel, I authorize the school to contact and engage qualified medical personnel and arrange for emergency treatment of my child, including transportation either by school staff or by professional transport for medical, dental, surgical or hospital care or diagnosis, and I consent to that treatment for my child. Arrangements for treatment will be made in the following order of priority: 1) The "primary physician" indicated for the student(s); 2) another physician or health-care professional licensed by the State of California. I understand and agree that I will be financially responsible for any such medical treatment. 

In consideration of the arrangement indicated in this paragraph, I hereby release and discharge the Diocese of San Jose, its constituent organizations, including but not limited to The Roman Catholic Welfare Corporation, the Department of Education and St. John Vianney Catholic School, and their officers, agents and employees (the "Diocese") for any and all claims for personal injuries or property damage that I or my child may suffer as a result of this arrangement whether or not such injuries or damages be caused by the negligence (whether active or passive) of any of the entities or individuals named or described above, excepting only injuries or damage resulting from Diocese's willful misconduct.
																</label>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group col-sm-12">
															<label> Release of Student to Qualified Emergency/Medical Personal and Third Parties  </label>
															<div class="checkbox">
																<label>
																	<input 
																	name="consentRelease" type="checkbox" required id="consentCheck">
																	Without limiting other emergency powers as may be allowed by law, in the event of disaster or medical necessity involving the life, limb or well-being of my child in which it is necessary in the opinion of the school administration to transport my child from school property, or if it is necessary to evacuate the school grounds, the school will make a reasonable effort (in view of the nature of the necessity) to first contact a parent or legal guardian. If no parent/legal guardian is available, I authorize the school to release my child into the custody of third parties for the purpose of transporting my child from school grounds and arranging for such care as my child may need, in the following order of priority: 1) the persons listed as emergency contacts; 2) qualified medical/emergency professionals; 3) another responsible adult.
																</label>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="form-group col-sm-12">
															<label>  Gathering, Use and Release of Medical Information </label>
															<div class="checkbox">
																<label>
																	<input 
																	name="consentRelease2" type="checkbox" required id="consentCheck2">
																	Without limiting other emergency powers that may be provided by law, in the event of disaster or medical emergency, I specifically authorize the gathering, use and release to, from, and among the school personnel and to, from and among any medical professionals, of any medical information reasonably necessary to provide emergency medical care and otherwise ensure the life, limb and well-being of my child, including without limitation, the information contained in this form, until I can reasonably be notified and take custody of my child. I understand that this information will be requested, gathered and/or released only for the purpose of providing first-aid or emergency medical care necessary in the absence of a parent or legal guardian, or as otherwise allowed by law.
																</label>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group col-sm-12">
															<label> General Terms of Parental Consent  </label>
															<div class="checkbox">
																<label>
																	<input 
																	name="consentRelease3" type="checkbox" required id="consentCheck3">
																	Confidential medical or educational information as set forth in this form will be gathered, used and disseminated only by the persons and only for the purposes set forth herein, or as otherwise allowed by law.  This authorization is effective only for the 2015-16 school year.  It may be revoked at any time in writing signed by either party.  If revoked, the school reserves the right to suspend or terminate the attendance of the child at the school.

I agree and consent to the actions set forth herein and hereby grant authorization o the school to obtain and used medical information and records by the persons, for the purposes, and during the time set forth above.  
																</label>
															</div>
														</div>
													</div>
														<hr>
													<div class="row">
														<div class="form-group col-sm-10 col-sm-offset-1">
															<label for="signature">  Signature  </label>
																<input class="form-control" name="signature" type="text" required  id="signature" placeholder="Please enter your name. ">
																
														</div>
													</div>

												</form>
												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary" 
			onClick="submitReleaseForm()">Submit</button>
											</div>
											</form>
									</div>
							</div>
						</div>	

						</div>
					</div>
				<?php endif ?>
				<!-- end  -->
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> 
	<script type="text/javascript">
		function closePanel(panelID)
		{
			$("#"+panelID).collapse('hide'); 

		}
		function submitReleaseForm()
		{
			var signature = document.getElementById('signature'); 
			if(!$('#releaseCheck').is(':checked') || 
				!$('#consentCheck').is(':checked') ||	
				!$('#consentCheck2').is(':checked') ||
				!$('#consentCheck3').is(':checked') ||
				!$('#familyCheck').is(':checked') ||
				!$('#studentCheck').is(':checked'))
				alert("Error: One or more of the fields were left unchecked.");
			else if(!signature.checkValidity())
				alert("Error: Signature field missing. "); 
				
			else{
			
				
				$.ajax({
					type: "POST", 
					url: "https://parents.sjvsj.org/consent-form.php",
					data: $("#releaseConsentForm").serialize(), 
					success: function(msg){
						//alert(msg); 
						location.reload(); 
					},
					error: function(error){
						alert("Failure: "+error); 
					}
				}); 
			
			}
				
		}

		function submitOtherForm()
		{
			$.ajax({
				type: "POST", 
				url: "https://parents.sjvsj.org/other-info-form.php",
				data: $("#otherForm").serialize(),
				success: function(msg){
					location.reload(); 
				},
				error: function(error){
					alert("Error: "+error); 
				}

			}); 


		}
		function submitStudentForm( formID)
		{
			var ref = $("#"+formID).find("[required]");

			$(ref).each(function(){
				if ( $(this).val() == '' )
				{
					alert("Please fill out all required fields.");

					$(this).focus();

					e.preventDefault();
					return false;
				}
			});  
			//alert("working"); 
			$.ajax({
				type: "POST",
				url: "https://parents.sjvsj.org/students-form.php", //
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
			
			$.ajax({
				type: "POST",
				url: "https://parents.sjvsj.org/parents-form.php", //

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



