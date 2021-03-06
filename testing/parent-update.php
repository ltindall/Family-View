<?php
	session_start(); 

	require_once("db_functions.php"); 
	

	if( isset($_POST['updateParent']))
	{	
		$name = db_quote($_POST['name']); 
		$address = db_quote($_POST['address']); 
		$phone = db_quote($_POST['phone']); 
		
		echo "parent type: "; 
		echo "<br>"; 
		echo $_POST['parent']; 
		if( $_POST['parent'] == "mother" )
		{
			$update = db_query("UPDATE `login`.`info` SET `mother_name` = 
						".$name.",`mother_address`=".$address."
						, `mother_phone` = ".$phone." WHERE `info`.`id` 
						= ".$_SESSION['user_id']); 
		}
		else
		{
			$update = db_query("UPDATE `login`.`info` SET `father_name` = 
						".$name.",`father_address`=".$address."
						, `father_phone` = ".$phone." WHERE `info`.`id` 
						= ".$_SESSION['user_id']); 
		}
	}
	//if family edit is set get family id and fill form
	//family id and parent gender should come from hidden input
	//if( isset($_POST['parentEdit']))
	//	require_once("parent-query.php")


	if($_POST['parent'] == "mother")
	{
		$parent_data = db_select("SELECT `mother_name`,`mother_address`,`mother_phone` FROM `info` WHERE id= ".$_SESSION['user_id'] );
		$parent_header = "Mother Info";
		
		$parent_name = $parent_data[0]['mother_name']; 
		$parent_address = $parent_data[0]['mother_address']; 
		$parent_phone = $parent_data[0]['mother_phone']; 
	}
	else
	{


		$parent_data = db_select("SELECT `father_name`,`father_address`,`father_phone` FROM `info` WHERE id= ".$_SESSION['user_id'] );
		$parent_header = "Father Info";

		
		$parent_name = $parent_data[0]['father_name']; 
		$parent_address = $parent_data[0]['father_address']; 
		$parent_phone = $parent_data[0]['father_phone']; 
	}
	
	if($parent_data == false) 
	{

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
		<title>Parent Info</title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet"
		href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">


		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
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
				</div>
		</div>
	</nav>
	
 	<br>
	<br>
	<div class="container" role="main">
		<div class="page-header">
				<h1>Parent Info</h1>
		</div>
		<div class ="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
				    <div class="panel-heading">
					    <h2>
							<?php echo $parent_header; ?>
					    </h2>
					    <!--<h2 class="panel-title">Family Info</h2>-->
				    </div>
					<div class="panel-body"> 
						<form action="parent-update.php" method="post">
							<div class="form-group">
								<label for="name">Name</label>
								<input class="form-control" name="name"
								value="<?php echo $parent_name; ?>">
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input class="form-control" name="address"
								value="<?php echo $parent_address; ?>">
							</div>
							<div class="form-group">
								<label for="phone">Phone</label>
								<input class="form-control" name="phone"
								value="<?php echo $parent_phone; ?>">
							</div>
							<input type="hidden" name="parent" value="<?php echo
							$_POST['parent'] ?>">
							<button class="btn btn-outline btn-primary btn-lg
							btn-block" type="submit" name="updateParent">Update</button>
						</form>
						<br>
						<?php 
							if(isset($_POST['updateParent']))
								echo '<div class="alert alert-success" role="alert">
										Info updated successfully!
									</div>'; 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>





