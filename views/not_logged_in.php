<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
	/*
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
	*/
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
	<link href="css/style.css" rel="stylesheet">

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
<a href="/" tabindex="-1"> SJV Family View </a>    
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
<!--
                        <form id="loginForm" name="loginform">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Family ID" name="user_name" type="username" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="user_password" type="password" value="" required>
                                </div>
								<input class="btn btn-lg btn-primary btn-block" type="submit"
onClick="submitLogin()" name="login" value="Login" />
                            </fieldset>
						</form>
-->
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
<!-- login form box -->
<!--
<form method="post" action="index.php" name="loginform">

    <label for="login_input_username">Username</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required />

    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

    <input type="submit"  name="login" value="Log in" />

</form>

<a href="register.php">Register new account</a>
-->



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function submitLogin()
		{
			alert("working"); 
			$.ajax({
				type: "POST", 
				url: "http://test.lucastindall.com/index.php", 
				data: $("#loginForm").serialize(), 
				success: function(msg){
					location.reload(); 


				}



			}); 


		}
	</script>
	</body>
</html>

