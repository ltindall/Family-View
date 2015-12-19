<?php

 
	session_start(); 
	if( !isset($_SESSION['user_id']))
		header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/');	
	require_once(__DIR__.'/../db_functions.php'); 


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
  
	<!-- Custom style 
	<link href="https://parents.sjvsj.org/css/style.css" rel="stylesheet">-->
	<link href="../css/style.css" rel="stylesheet">
	
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


<br><br>

<!-- SJV Logo Header-->
<div id="login">
    <h1><a href="/" tabindex="-1"> SJV Family View </a></h1>
</div>

<br><br>

<!-- MAIN CONTAINER -->
<div class="container container-main" role="main">

    <!-- NAVBAR -->
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
    <!-- END NAVBAR -->

    <!-- MAIN WINDOW -->
    <div class="display">
        <div class="page-header" id="service-header">  
        	<h1>Service Hours Submittal Form <br> May 2015 to April 30, 2016</h1>
         	<p> Please remember:  1 Service hour = $50 toward the 2015-16 service goal. <br> Credit will only be given for hours recorded within a week of service.</p>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
    			<form>
					<div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control" id="name" name="name" placeholder="Name of volunteer performing service">
				  	</div>
				  	<div class="form-group">
				    	<label for="email">Email</label>
				    	<input type="email" class="form-control" id="email" name="email" placeholder="Your current email address.">
				  	</div>
	
				  	<div class="form-group">
					    <label for="servicedate">Service Date</label>
					    <input type="text" class="form-control" id="servicedate" name="servicedate" placeholder="Date service was performed.">
				  	</div>
				  	<!--
				  	<br>
				  	<h2>Service Hours</h2>
				  	-->
				  	<div class="form-group">
					    <label for="hours">Hours</label>
					    <p>If you worked two shifts on the same day for the same activity, enter only the total for the day.</p>
					    <input type="text" class="form-control" id="hours" name="hours" placeholder="Enter a number between 0 and 12 for hours worked.">
				  	</div>
				  	
				  	<label for="minutes">Minutes</label>
				  	<br>
				  	<p>Example: for 3 1/2 hours of service, enter "3" above, and choose "30 minutes" below.</p>
				  	<div class="radio-inline">
				  		<label>
						<input type="radio" name="minutes" id="optionsRadios1" value="0minutes" checked>
   						 0 minutes
  						</label>
					</div>
				
					<div class="radio-inline">
  						<label>
    					<input type="radio" name="minutes" id="optionsRadios2" value="15 minutes">
    					15 minutes
  						</label>
					</div>
					
					<div class="radio-inline">
  						<label>
   						<input type="radio" name="minutes" id="optionsRadios3" value="30 minutes">
    					30 minutes
  						</label>
  					</div>
  					<div class="radio-inline">
  						<label>
   						<input type="radio" name="minutes" id="optionsRadios4" value="45 minutes">
    					45 minutes
  						</label>
					</div>
					<br><br>
					<label for="ServiceActivityType">Service Activity Type</label>
					<select class="form-control" id="ServiceActivityType" name="activityType">
  						<option>Athletics</option>
  						<option>Book Fair</option>
  						<option>Classroom Help</option>
 						<option>Crab Feed</option>
 						<option>Development Office</option>
 						<option>Field Trip</option>
 						<option>Fiesta</option>
 						<option>Fundraising (i.e. Magazine, Gift Wrap, See's)</option>
 						<option>Golf Tournament</option>
 						<option>Health & Safety Committee</option>
 						<option>Holiday Faire</option>
 						<option>Maintenance</option>
 						<option>PSG (Parent Support Group)</option>
 						<option>SAC (School Advisory Council)</option>
 						<option>School Office</option>
 						<option>Scouts (Leaders Only)</option>
 						<option>Scrip</option>
 						<option>SJV Parish Help</option>
 						<option>Tally Committtee</option>
 						<option>Technology Committee</option>
 						<option>Walk-A-Thon</option>
 						<option>Yearbook</option>
 						<option>Other</option>
					</select>
					<br>
				  	<button type="submit" class="btn btn-default">Submit</button>
				</form>
            </div>
        </div>
        
    </div>
    <!-- END MAIN WINDOW -->
</div>
<!-- END MAIN CONTAINER --> 

<!-- FOOTER -->
<div class="container">
	<div class="row">
      <div class=" footer">
       4601 Hyland Ave., San Jose, CA 95127 408-258-7677 Fax: 408-258-5997
		© St. John Vianney School
      </div>
	</div>
</div>
<!-- END FOOTER --> 


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



