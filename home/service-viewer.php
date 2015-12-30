<?php

 
	session_start(); 
	if( !isset($_SESSION['user_id']))
		header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/');	
	require_once(__DIR__.'/../db_functions.php'); 
	
	$serviceEntries = db_select("SELECT * FROM `service` WHERE `familyID` = 
		".$_SESSION['user_id']." ORDER BY `servicedate` DESC");
		
		
  $lastSpecial = db_select("SELECT * FROM `tallyTimes` ORDER BY `id` DESC LIMIT 3");
  if($lastSpecial[0]['type'] == "Updated")
    $lastTime = $lastSpecial[1]['timestamp']; 
  else
    $lastTime = $lastSpecial[2]['timestamp']; 
    
  
  $hoursCount = 0; 
  $hoursPercent = 0; 
  foreach($serviceEntries as $serviceEntry){
    if(strcmp($serviceEntry['approved'],"yes") == 0 && $serviceEntry['created'] <= $lastTime  )
      $hoursCount += floatval($serviceEntry['hours']); 
  }
  $hoursPercent = intval(($hoursCount/45) * 100); 

  
  function approvalRowColor($approvalStatus, $timestamp){
    //echo "class='info'"; 
    global $lastTime; 
    if($timestamp > $lastTime){
      echo 'class="info"'; 
      return; 
    }
    
    switch($approvalStatus) {
      case "pending": 
        echo 'class="info"'; 
        break; 
      case "yes": 
        echo 'class="success"'; 
        break; 
      case "no": 
        echo 'class="danger"'; 
        break; 
      case "duplicate": 
        echo 'class="danger"'; 
        break; 
      case "late": 
        echo 'class="danger"'; 
        break; 
      case "details": 
        echo 'class="warning"'; 
        break; 
      
    }
    
  }
  
  

    
  function approvalRowMessage($approvalStatus, $timestamp){
    //echo "class='info'"; 
    
    global $lastTime; 
    if($timestamp > $lastTime){
      echo 'Pending'; 
      return; 
    }
    
    switch($approvalStatus) {
      case "pending": 
        echo 'Pending'; 
        break; 
      case "yes": 
        echo 'Yes'; 
        break; 
      case "no": 
        echo 'No'; 
        break; 
      case "duplicate": 
        echo 'No, duplicate entry.'; 
        break; 
      case "late": 
        echo 'No, entry submitted too late.'; 
        break; 
      case "details": 
        echo 'No, need more details.'; 
        break; 
      
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
<div class="container container-main container-wide" role="main">

    <!-- NAVBAR -->
    <div class="navbar navbar-inverse row display-nav" role="navigation">
      <div class="container container-wide">
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
            <li ><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/home/service-submit.php">Submit Service Hours</a></li>
          </ul>
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/home/service-viewer.php">View Service Hours</a></li>
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
        	<h1>Family Service Hours</h1>
        	<div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $hoursPercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hoursPercent; ?>%;">
              <?php echo $hoursCount; ?> hours = <?php echo $hoursPercent; ?>%
            </div>
          </div>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Service Date</th>
            <th>Service Hours</th>
            <th>Service Activity Type</th>
            <th>Service Coordinator</th>
            <th>Activity Performed</th>
            <th>Approval Status</th>
          </tr>
        </thead>
        <tbody>
          <!-- Start of foreach for service entries -->
          <?php foreach($serviceEntries as $serviceEntry): ?>
          <tr <?php approvalRowColor($serviceEntry['approved'], $serviceEntry['created']); ?> >
            <td><?php echo $serviceEntry['name']; ?></td>
            <td>
              <?php 
                $serviceDate = date_create($serviceEntry['servicedate']); 
                echo date_format($serviceDate, 'm-d-Y');
              ?>
            </td>
            <td><?php echo $serviceEntry['hours']; ?></td>
            <td><?php echo $serviceEntry['activitytype']; ?></td>
            <td><?php echo $serviceEntry['activitycoordinator']; ?></td>
            <td><?php echo $serviceEntry['activityperformed']; ?></td>
            <td><?php approvalRowMessage($serviceEntry['approved'], $serviceEntry['created']); ?></td>
          </tr>
          <?php endforeach; ?>
          <!-- End of foreach for service entries --> 
        </tbody>
      </table>
      
    </div>
    <!-- END MAIN WINDOW -->
</div>
<!-- END MAIN CONTAINER --> 

<!-- FOOTER -->
<div class="container container-wide">
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



