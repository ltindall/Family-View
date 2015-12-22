<?php
// show potential errors / feedback (from login object)
/*
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }

	
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
	
}
*/
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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  
	<!-- Custom style -->
	<link href="css/style.css" rel="stylesheet">
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

<div class="container" role="main">
<br>
<br>
<br>
<div id="login">
<h1>
<a href="/" tabindex="-1"> SJV Family View</a>    
</h1>
</div>

<br>
<br>
	<div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">

			<?php
			// show potential errors / feedback (from login object)
			if (isset($login)) {
			    if ($login->errors) {
				foreach ($login->errors as $error) {
				    ?>
					<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
				
				<?php
				}
			    }
			}
			?>
						<form role="form" method="post" action="index.php" name="loginform">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Family ID" name="user_name" type="username" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="user_password" type="password" value="" required>
                                </div>
								<input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login" />
                            </fieldset>
						</form>

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

