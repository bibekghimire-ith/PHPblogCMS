<?php	
require_once("include/db.php");
?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

if(isset($_POST['submit'])) {
	$username=mysqli_real_escape_string($connection,$_POST['username']);
	$password=mysqli_real_escape_string($connection,$_POST['password']);
	
	if(empty($username) || empty($password)) {
		$_SESSION["ErrorMessage"] = "All Fields must be filled out";
		
		Redirect_to("login.php");
		
}

else {
	$found_account=login_Attempt($username,$password);
	$_SESSION['User_Id']=$found_account['id'];
	$_SESSION['username']=$found_account['username'];
	if($found_account) {
		$_SESSION['SuccessMessage']="Welcome {$_SESSION['username']}";
		Redirect_to("dashboard.php");
	} else {
		$_SESSION['ErrorMessage']="Invalid Username or Password";
		Redirect_to("login.php");
	}
}
}
?>	

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

<!-- Bootstrap 4 does not supports glyphicons So use 3 else use icons -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



	<!-- Add Custom styles after bootstrap files -->
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">

	<style type="text/css">
		.FieldInfo {
			color: rgb(251, 174, 44);
			font-family: Bitter,Georgia,"Times New Roman",Times,Serif;
			font-size: 1.2em;
		}
		body {
			background-color: white;
		}
	</style>

</head>
<body>

<div style="height:10px; background: #27aae1;"></div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<div class="container">
	<div class="navbar-header">
		<button class="navbar-toggle collasped" data-toggle="collapse" data-target="#collaspe">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<!-- Brand/logo -->
  <a class="navbar-brand" href="blog.php">
    <img src="images/bg1.png" alt="logo" style="width:200px; height: 30px;">
  </a>
	</div>
  
  

</div>
</nav>
<div style="height:10px; background: #27aae1;" class="line"></div>



<div class="container-fluid">
	<div class="row">
		


		<!-- Main Area -->
		<div class="col-sm-4 col-sm-offset-4">
			<br><br><br><br><br>
			<div><?php echo Message(); 
				echo successMessage();
			?></div>
			<h2>Welcome Back!</h2>
			
			<div>
				<form action="login.php" method="POST">
					<fieldset>
						<div class="form-group">
							<label for="username"><span class="FieldInfo">
								Username:</span></label>
							<div class="input-group input-group-md">
							
							<span class="input-group-addon">
									<span class="glyphicon glyphicon-envelope text-primary"></span>
								</span>
							<input class="form-control" type="text" name="username" id="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label for="password"><span class="FieldInfo">Password:</span></label>
							<div class="input-group">
							
							<span class="input-group-addon">
									<span class="glyphicon glyphicon-lock text-primary"></span>
								</span>
							<input class="form-control" type="password" name="password" id="password" placeholder="Password">
							</div>
						</div>
						
						<input type="submit" name="submit" value="Login" class="btn btn-info btn-block">
					</fieldset><br>
				</form>
			</div>



		</div> <!-- Ending of main area -->
	</div>
</div>




</body>
</html>