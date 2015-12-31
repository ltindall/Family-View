<?php

 
	session_start(); 
  if( !isset($_SESSION['user_id']) || $_SESSION['user_id'] != '9541')
	  header('Location: http://'.$_SERVER['HTTP_HOST']);	
		///header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/');	
	require_once(__DIR__.'/../db_functions.php'); 
	
	
	$lastProcess = db_select("SELECT * FROM `tallyTimes` WHERE `type` = 'Processing' ORDER BY `id` DESC LIMIT 2");
	//SELECT * FROM `service` WHERE (`created` > '2015-12-29 06:21:00') AND (`approved` = 'no' OR `approved` = 'late' OR `approved` = 'details' OR `approved` = 'duplicate')
	if( isset($_GET['noID'])){
	  
	  $noApprovals = db_select("SELECT `familyID` FROM `service` WHERE (`created` > '".$lastProcess[1]['timestamp']."') AND (`approved` = 'no' OR `approved` = 'late' OR `approved` = 'details' OR `approved` = 'duplicate') ORDER BY `familyID`"); 
    
    $noIDS = array(); 
    foreach($noApprovals as $noApproval){
      $noIDS[] = $noApproval['familyID']; 
      //var_dump($noApproval['familyID']); 
    }
    $uniqueNoIDSarray = array_unique($noIDS); 
    $uniqueNoIDS = array_values($uniqueNoIDSarray); 
    //var_dump($uniqueNoIDS); 
    //var_dump(count($uniqueNoIDS)); 
    //var_dump($uniqueNoIDS[4]); 
    
    if(count($uniqueNoIDS) == 0){
      $_SESSION['message'] = 'There were 0 "No ..." approvals found'; 
      header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
      exit(); 
    }

	  for($i = 0; $i < count($uniqueNoIDS); $i++){

      //var_dump("zero"); 
	    if(intval($uniqueNoIDS[$i]) == intval(substr(db_quote($_GET['noID']), 1, -1)) ){
	      //var_dump("first"); 
	      $prevNo = $uniqueNoIDS[$i - 1]; 
	      $nextNo = $uniqueNoIDS[$i+1]; 
	      break; 
	    }
	    else if(intval($uniqueNoIDS[$i]) > intval(substr(db_quote($_GET['noID']), 1, -1)) ){
	      //var_dump("second"); 
	      header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?noID='.$uniqueNoIDS[$i]);
	      break; 
	    }
	    
	  }
	  
	}
	
	
	if( isset($_GET['id'])){
	  $families = db_select("SELECT `user_id` FROM `users`");
	  //echo count($families); 

	  for($i = 0; $i < count($families); $i++){
	  //foreach($families as $family){
	    if(intval($families[$i]['user_id']) == intval(substr(db_quote($_GET['id']), 1, -1)) ){
	      $prev = $families[$i - 1]['user_id']; 
	      $next = $families[$i+1]['user_id']; 
	      break; 
	    }
	    else if(intval($families[$i]['user_id']) > intval(substr(db_quote($_GET['id']), 1, -1)) ){
	      header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id='.$families[$i]['user_id']);
	      break; 
	    }
	    
	  }
	}
	
	
	
	
	// only display entries before last time processed was pressed
	if( isset($_GET['noID'])) {
	  $familyID = substr(db_quote($_GET['noID']), 1, -1); 
	  $_SESSION['approving_user_id_chair'] = $familyID; 
	  $_SESSION['approvingNos'] = 1; 
	  $serviceEntries = db_select("SELECT * FROM `service` WHERE `familyID` = ".db_quote($_GET['noID'])." AND `created` <  '".$lastProcess[0]['timestamp']."' ORDER BY `servicedate` DESC");
	}
	else if( isset($_GET['id'])) {
	  $familyID = substr(db_quote($_GET['id']), 1, -1); 
	  $_SESSION['approving_user_id_chair'] = $familyID; 
	  $_SESSION['approvingNos'] = 0; 
	  $serviceEntries = db_select("SELECT * FROM `service` WHERE `familyID` = ".db_quote($_GET['id'])." AND `created` <  '".$lastProcess[0]['timestamp']."' ORDER BY `servicedate` DESC");
	}
	else{
	  $familyID = "N/A"; 
	  unset($_SESSION['approvingNos']);
	  unset($_SESSION['approving_user_id_chair']); 
	}

  $lastSpecial = db_select("SELECT * FROM `tallyTimes` ORDER BY `id` DESC LIMIT 1");

  function approvalRowColor($approvalStatus){
    //echo "class='info'"; 
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
	<link rel="stylesheet" href="https://sjv-parent-portal-ltindall.c9users.io/css/bootstrap-datepicker3.css">
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
	<link href="https://sjv-parent-portal-ltindall.c9users.io/css/style.css" rel="stylesheet">
	
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
    <h1><a href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>" tabindex="-1"> SJV Family View </a></h1>
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
            <li class="active"><a href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>">Tally Chair Home</a></li>
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
      				  <strong><?php echo $_SESSION['message']; ?>! The entries were updated.</strong>
      				</div>
      		<?php elseif($_SESSION['message'] == "Error"): ?>
      			<br>
      			<div class="alert alert-warning alert-dismissible" role="alert">
      			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      			  <?php echo $_SESSION['message']; ?>
      			</div>
      		<?php else: ?>
      		  <br>
      				<div class="alert alert-info alert-dismissible" role="alert">
      				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      				  <strong><?php echo $_SESSION['message']; ?></strong>
      				</div>
      		<?php
      				endif;
      			unset($_SESSION['message']); 	
      			endif; 
      		?>
      <!-- END MESSAGE --> 
		
      
      <form role="form" method="post" action="../tally-chair-form.php">
    	<div class="page-header" id="service-header">  
        	<h1>Family Service Hours Tally Chair</h1>
        	<div class="row">
        	  <div class="col-md-9">
            	<span class="label label-default pull-left" id="familyID">Current Family ID: <?php echo $familyID; ?></span>
            </div>
            <div class="col-md-3" >
              	
              <input type="number" name="familyIDNum" id="familyIDNum" value=<?php echo db_quote($_GET['id']); ?> />
              <button type="button" class="btn btn-primary" onClick="updateURL()" id="goButton" >Go</button>
              	
            	
            	<a role="button" class="btn btn-primary" href="?id=<?php echo $prev; ?>">Prev</a>
              <a role="button" id="nextButton" class="btn btn-primary" href="?id=<?php echo $next; ?>">Next</a>
            	
            	
        	  </div>
        	</div>
        	<hr>
        	<div class="row">
        	  <div class="col-md-5">
        	    <span class="label label-default pull-left" id="tallyChairStatus" >Current Status: <?php echo $lastSpecial[0]['type']; ?></span>
        	  </div>
        	  <div class="col-md-4">
        	    <button type="submit" class="btn btn-info" name="special" value="Processing">Process Hours to Date</button>
        	    <button type="submit" class="btn btn-info" name="special" value="Updated">Update Family Hours</button>
        	  </div>
        	  <div class="col-md-3" >
              	
              <input type="number" name="familyIDNumNo" id="familyIDNumNo" value=<?php echo db_quote($_GET['noID']); ?> />
              <button type="button" class="btn btn-warning" onClick="updateURLNo()" id="goButtonNo" >Go</button>
              	
            	
            	<a role="button" class="btn btn-warning" href="?noID=<?php echo $prevNo; ?>">Prev</a>
              <a role="button" id="nextButtonNo" class="btn btn-warning" href="?noID=<?php echo $nextNo; ?>">Next</a>
            	
        	  </div>
        	 
          </div>
          <hr>
        	<div class="row">
        	  <div class="col-md-2 col-md-offset-10">
        	    <button type="submit" class="btn btn-lg btn-danger" id="tallySaveChair">Save</button>
        	  </div>
        	</div>
        	
        	<!--
        	<span class="label label-default pull-left" id="familyID">Current Family ID: <?php echo $familyID; ?></span>
        	<div class="pull-right">
          	
          	<input type="number" name="familyIDNum" id="familyIDNum" value=<?php echo db_quote($_GET['id']); ?> />
          	<button type="button" class="btn btn-primary" onClick="updateURL()" id="goButton" >Go</button>
          	
        	</div>
        	<div id="overflow"></div>
        	<div class="pull-left">
        	<button type="submit" class="btn btn-lg btn-danger" id="tallySave">Save</button>
        	</div>
        	<div class="pull-right">
        	<a role="button" class="btn btn-primary" href="?id=<?php echo $prev; ?>">Prev</a>
          <a role="button" class="btn btn-primary" href="?id=<?php echo $next; ?>">Next</a>
        	</div>
        	-->
        	
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
          <?php 
            if( isset($serviceEntries)):
              $iteration = 0; 
              foreach($serviceEntries as $serviceEntry): 
          ?>
                <tr <?php approvalRowColor($serviceEntry['approved']); ?> >
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
                  <td>
                    <select  class="form-control" id="approved" name="approval<?php echo $iteration; ?>" required>
      					    	<option value="pending" <?php if($serviceEntry['approved'] == "pending") echo "selected"; ?> >Pending</option>
      				  			<option value="yes" <?php if($serviceEntry['approved'] == "yes") echo "selected"; ?> >Yes</option>
      				  			<option value="no" <?php if($serviceEntry['approved'] == "no") echo "selected"; ?> >No</option>
      				  			<option value="duplicate" <?php if($serviceEntry['approved'] == "duplicate") echo "selected"; ?> >No, duplicate.</option>
      	  						<option value="late" <?php if($serviceEntry['approved'] == "late") echo "selected"; ?> >No, submitted too late.</option>
      	  						<option value="details" <?php if($serviceEntry['approved'] == "details") echo "selected"; ?> >No, need more details.</option>
        	 					</select>
                  </td>
                </tr>
          <?php 
                $iteration++; 
              endforeach; 
            endif; 
          ?>
          <!-- End of foreach for service entries --> 
        </tbody>
      </table>
      </form>
      
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
      
      function updateURL(){
          var familyIDNum = document.getElementById('familyIDNum').value; 
          window.location = "http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];	?>"+ "?id="+familyIDNum;
      }
      
      function updateURLNo(){
          var familyIDNumNo = document.getElementById('familyIDNumNo').value; 
          window.location = "http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];	?>"+ "?noID="+familyIDNumNo;
      }
                  
		</script>
	</body>
</html>



