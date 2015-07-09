<?php
    require_once("db_functions.php"); 
    $rows = db_select("SELECT * FROM `info` WHERE id= ".
		    $_SESSION['user_id'] ); 
    if($rows ==false) {
        $error = db_error();
    }

    $children = db_select("SELECT * FROM `child_info` WHERE `family_id` =
		    ".$_SESSION['user_id'] ); 

    if($children == false) {
        $error = db_error();
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  
	<!-- Custom style -->
	<link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!--
  <nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/">Home</a>
		  <a class="navbar-brand" href="index.php?logout">Logout</a>
		</div>
	</div>
  </nav>
  -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
            <li><a href="index.php?logout" class="navbar-nav pull-right">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>


<br>
<br>
<br>
<br>
<div class="container container-main" role="main">
<div class="page-header">
	<h1>Parent Settings</h1>
</div>
<!--
<div class="panel-group" id="accordion">
    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
            <h4 class="panel-title">
				<a data-toggle="collapse" data-target="#collapseOne" 
					href="#collapseOne">
					Collapsible Group Item #1
				</a>
			</h4>

        </div>
        <div id="collapseOne" class="panel-collapse collapse ">
            <div class="panel-body">
				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry 
				richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck 
				quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid 
				single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer 
				labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. 
				Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't 
				heard of them accusamus labore sustainable VHS.
			</div>
        </div>
    </div>
    <div class="panel panel-default" id="panel2">
        <div class="panel-heading">
            <h4 class="panel-title">
				<a data-toggle="collapse" data-target="#collapseTwo" 
					href="#collapseTwo" class="collapsed">
					Collapsible Group Item #2
				</a>
			</h4>

        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry 
				richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck 
				quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid 
				single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer 
				labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. 
				Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't 
				heard of them accusamus labore sustainable VHS.
			</div>
        </div>
    </div>
</div>
-->
<div class="row">
<div class="col-md-8 col-md-offset-2 ">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse"  href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		Father Info</a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body"> 
		<h3> Name  </h3>
		<pre> <?php echo $rows[0]['father_name']; ?> </pre>
		<h3> Address </h3>
		<pre> <?php echo $rows[0]['father_address']; ?> </pre>

		<h3> Phone </h3>
		<pre> <?php echo $rows[0]['father_phone']; ?> </pre>
		<!--<button type="button" class="btn btn-lg btn-danger
		pull-right">Edit</button>-->
		<br>
		<form action="parent-update.php" method="post">
		<input type="hidden" name="parent" value="father">
		<button class="btn btn-outline btn-danger btn-lg
		btn-block" type="submit" name="editFamily">Edit</button></form>
	  
      </div>
    </div>
  </div>
<br>

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse"  href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
Mother Info</a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
   
		<h3> Name  </h3>
		<pre> <?php echo $rows[0]['mother_name']; ?> </pre>
		<h3> Address </h3>
		<pre> <?php echo $rows[0]['mother_address']; ?> </pre>

		<h3> Phone </h3>
		<pre> <?php echo $rows[0]['mother_phone']; ?> </pre>
		<!--<button type="button" class="btn btn-lg btn-danger
		pull-right">Edit</button>-->
		<br>
		<form action="parent-update.php" method="post">
		<input type="hidden" name="parent" value="mother">
		<button class="btn btn-outline btn-danger btn-lg
		btn-block" type="submit" name="editFamily">Edit</button></form>
	  
	  </div>
    </div>
  </div>
</div>


</div>
</div>
<!--
<div class ="row">
    <div class="col-md-6">
        <div class="panel panel-default">
			<div class="panel-heading">
				<h2>
				Father Info
				</h2>

			</div>
			<div class="panel-body"> 
				<h3> Name  </h3>
				<pre> <?php echo $rows[0]['father_name']; ?> </pre>
				<h3> Address </h3>
				<pre> <?php echo $rows[0]['father_address']; ?> </pre>

				<h3> Phone </h3>
				<pre> <?php echo $rows[0]['father_phone']; ?> </pre>
				<br>
				<form action="parent-update.php" method="post">
				<input type="hidden" name="parent" value="father">
				<button class="btn btn-outline btn-danger btn-lg
				btn-block" type="submit" name="editFamily">Edit</button></form>

			</div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					Mother Info
				</h2>

			</div>
			<div class="panel-body"> 
				<h3> Name  </h3>
				<pre> <?php echo $rows[0]['mother_name']; ?> </pre>
				<h3> Address </h3>
				<pre> <?php echo $rows[0]['mother_address']; ?> </pre>

				<h3> Phone </h3>
				<pre> <?php echo $rows[0]['mother_phone']; ?> </pre>
				<br>
				<form action="parent-update.php" method="post">
				<input type="hidden" name="parent" value="mother">
				<button class="btn btn-outline btn-danger btn-lg
				btn-block" type="submit" name="editFamily">Edit</button></form>

			</div>
        </div>
    </div>

</div>
-->


<!--
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
               <ul class="list-group">
	       	   <li class="list-group-item active">
		   	<h2> Family Info </h2>
		   </li>
	           <li class="list-group-item">
		       <h2>Family Name:</h2>
		       <p><?php echo $_SESSION['user_name']; ?>
		       </p>
		   </li>
		   <li class="list-group-item">
		       <p>
    		           <h3>
        		       <span class="label label-info">Address</span>
    			   </h3>
	                   <blockquote>
			   	<p>
					<?php echo $_SESSION['user_name']; ?>		       
				</p>
			    </blockquote>
			</p>
		      
		   </li>
		   <li class="list-group-item">
			
			<h3>
				<span class="label label-info">Address</span>
				<small>
					<?php echo $rows[0]['address']; ?>
				</small>
			</h3>	
		    </li>
		</ul>
	</div>
</div>
-->
<!--
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
	    <h3 class="panel-title"> Family Name</h3>
	</div>
	<div class="panel-body">
	    <?php echo $_SESSION['user_name']; ?>
	</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
	    <h3 class="panel-title">Family ID</h3>
	</div>
	<div class="panel-body">
	    <?php echo $_SESSION['user_id']; ?>
	</div>
    </div>
    <h3>
        <span class="label label-info">Address</span>
	<small>
		<?php echo $rows[0]['address']; ?>
	</small>
    </h3>	
</div>
-->

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
<div class="col-md-8 col-md-offset-2">

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
      <div class="panel-body"> 
		<h3> Child ID  </h3>
		<pre> <?php echo $child['child_id']; ?> </pre>
		<h3> Child Name </h3>
		<pre> <?php echo $child['name']; ?> </pre>
		<br>
		<form action="child-update.php" method="post">
		<!--<input type="hidden" name="parent" value="father">-->
		<button class="btn btn-outline btn-danger btn-lg
		btn-block" type="submit" name="childEdit" value="<?php echo
				$child['child_id']; ?>">Edit</button>
		</form>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>





