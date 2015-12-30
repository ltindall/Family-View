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
	<link rel="stylesheet" href="../css/bootstrap-datepicker3.css">
	<!--
    <link rel="stylesheet" href="../css/bootstrap.css">
	-->
	<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  	
  	
  	
  	<!-- Datepicker
  	<link rel="stylesheet" href="../css/bootstrap-datepicker3.css">
  	<script src="../js/bootstrap-datepicker.js"></script>
  	 -->
  	 
  	 
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
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/home/display.php">Family Student Info</a></li>
          </ul>
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/home/service-submit.php">Submit Service Hours</a></li>
          </ul>
          <ul class="nav navbar-nav">
            <li ><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/home/service-viewer.php">View Service Hours</a></li>
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
    	
    	<!-- MESSAGE -->
    	<?php if(isset($_SESSION['message'])):
			if($_SESSION['message']=="Success"): ?>
				<br>
				<div class="alert alert-info alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong><?php echo $_SESSION['message']; ?>! Your submission has been received.</strong>
				</div>
		<?php else: ?>
			<br>
			<div class="alert alert-warning alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <?php echo $_SESSION['message']; ?>
			</div>
		<?php
				endif;
			unset($_SESSION['message']); 	
			endif; 
		?>
		<!-- END MESSAGE --> 
		
        <div class="page-header" id="service-header">  
        	<h1>Service Hours Submittal Form <br> May 2015 to April 30, 2016</h1>
         	<p> Please remember:  1 Service hour = $50 toward the 2015-16 service goal. <br> Credit will only be given for hours recorded within a week of service.</p>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
    			<form data-toggle="validator" role="form" method="post" action="../service-form.php">
					<div class="form-group">
					    <label for="name">Name</label>
					    <input width="400" style="width: 400px" type="text" class="form-control" id="name" name="name" placeholder="Name of volunteer performing service" required>
					    <div class="help-block with-errors"></div>
				  	</div>
				  	<div class="form-group">
				    	<label for="email">Email</label>
				    	<input width="400" style="width: 400px" type="email" class="form-control" id="email" name="email" placeholder="Your current email address." required>
				    	<div class="help-block with-errors"></div>
				  	</div>
	
				  
				  	<div class="form-group datepick" width="300" style="width: 300px" >
				  		<label for="servicedate">Service Date</label>
					  	<div class="input-group date">
						    <input type="text" class="form-control" id="servicedate" name="servicedate"  placeholder="Date service was performed." required>
						    <div class="input-group-addon">
						        <span class="glyphicon glyphicon-calendar"></span>
						    </div>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					
				  	<div class="form-group">
					    <label for="hours">Hours</label>
					    <p>If you worked two shifts on the same day for the same activity, enter only the total for the day.</p>
					    <select width="70" style="width: 70px" class="form-control" id="hours" name="hours" placeholder="Enter a number between 0 and 12 for hours worked." required>
					    	<option></option>
				  			<option value="0">0</option>
				  			<option value="1">1</option>
	  						<option value="2">2</option>
	  						<option value="3">3</option>
	 						<option value="4">4</option>
	 						<option value="5">5</option>
	 						<option value="6">6</option>
	 						<option value="7">7</option>
	 						<option value="8">8</option>
	 						<option value="9">9</option>
	 						<option value="10">10</option>
	 						<option value="11">11</option>
	 						<option value="12">12</option>
	 					</select>
	 					<div class="help-block with-errors"></div>
	 				</div>
				  	<div class="form-group">
					  	<label for="minutes">Minutes</label>
					  	<br>
					  	<p>Example: for 3 1/2 hours of service, enter "3" above, and choose "30 minutes" below.</p>
					  	<div class="radio-inline">
					  		<label>
							<input type="radio" name="minutes" id="optionsRadios1" value="" required>
	   						 0 minutes
	  						</label>
						</div>
						
						<div class="radio-inline">
	  						<label>
	    					<input type="radio" name="minutes" id="optionsRadios2" value=".25" required>
	    					15 minutes
	  						</label>
						</div>
						
						<div class="radio-inline">
	  						<label>
	   						<input type="radio" name="minutes" id="optionsRadios3" value=".5" required>
	    					30 minutes
	  						</label>
	  					</div>
	  					<div class="radio-inline">
	  						<label>
	   						<input type="radio" name="minutes" id="optionsRadios4" value=".75" required>
	    					45 minutes
	  						</label>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					
					<div class="form-group">
						<label for="ServiceActivityType">Service Activity Type</label>
						<select width="400" style="width: 400px" class="form-control" id="ServiceActivityType" name="activityType" required>
							<option ></option>
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
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
					    <label for="servicecoordinator">Service Coordinator</label>
					    <input width="450" style="width: 450px" type="text" class="form-control" id="servicecoordinator" name="servicecoordinator" placeholder="Name of Person who Coordinated/Can Authorize Service Hours" required>
				  		<div class="help-block with-errors"></div>
				  	</div>
				  	
				  	<div class="form-group">
					    <label for="activityperformed">Specific Activity Performed</label>
					    <textarea class="form-control" rows="5" id="actvityperformed" name="activityperformed" placeholder="" data-minlength="20" required></textarea>
				  		<div class="help-block with-errors"></div>
				  	</div>
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
	<script src="../js/jquery-1.9.1.min.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/moment.min.js"></script>
	<script src="../js/validator.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
   	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
	<script type="text/javascript">
		 $(document).ready(function () {
		 		
		 		// startdate of datepicker, starts at one month ago from current time
		 		var startdate = moment().subtract(1, 'months').format('MM-DD-YYYY');
		 		
		 		// create the datepicker 
                $('.datepick .input-group.date').datepicker({
              		format: "mm-dd-yyyy",
              		startDate: startdate,
                    orientation: "bottom left"
                });  
            
            });
		</script>
	</body>
</html>



