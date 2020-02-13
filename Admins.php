<?php	
require_once("include/db.php");
?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php confirm_login(); ?>
<?php

if(isset($_POST['submit'])) {
	$username=mysqli_real_escape_string($connection,$_POST['username']);
	$password=mysqli_real_escape_string($connection,$_POST['password']);
	$confirmPassword=mysqli_real_escape_string($connection,$_POST['confirmPassword']);
	date_default_timezone_set("Asia/Kathmandu");
	$currentTime = time();
	$dateTime = strftime("%B-%d-%Y %H:%M:%S", $currentTime);
	$Admin = $_SESSION['username'];
	if(empty($username) || empty($password) || empty($confirmPassword)) {
		$_SESSION["ErrorMessage"] = "All Fields must be filled out";
		
		Redirect_to("Admins.php");
		
	} elseif(strlen($password)<4) {
	$_SESSION["ErrorMessage"] = "At least 4 characters are required for Password.";
	Redirect_to("Admins.php");
} elseif ($password!==$confirmPassword) {
	$_SESSION['ErrorMessage']="Password / ConfirmPassword does not match.";
	Redirect_to("Admins.php");
}

else {
	global $connection;
	$query = "INSERT INTO registration(datetime,username,password,addedby) VALUES('$dateTime','$username','$password','$Admin')";
	$execute = mysqli_query($connection,$query);

	if($execute) {
	$_SESSION["SuccessMessage"] = "Admin Added Successfully";
	Redirect_to("Admins.php");
} else {
	$_SESSION["ErrorMessage"] = "Admin failed to Add";
	Redirect_to("Admins.php");
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
  
  <div class="collapse navbar-collapse" id="collapse">
  	<!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="blog.php">Blog</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Services</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Contact</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Feature</a>
    </li>
  </ul>

  <form action="blog.php" class="navbar-form float-right">
  	<div class="form-group">
  		<input type="text" name="search" class="form-control" placeholder="Search">
  	</div>
  	<button class="btn btn-default" name="SearchButton">Go</button>
  </form>	
  </div>
  

</div>
</nav>
<div style="height:10px; background: #27aae1;" class="line"></div>



<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<br><br><br>

			<ul id="side_menu" class="nav nav-pills nav-stacked">
				<li class="nav-item"><a class="nav-link" href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
				<li class="nav-item"><a class="nav-link" href="NewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
				<li class="nav-item"><a class="nav-link" href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
				
				<li class="nav-item active"><a class="nav-link" href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admin Access</a></li>
				<li class="nav-item"><a class="nav-link" href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
				<li class="nav-item"><a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
			</ul>
		</div> <!-- Ending of side area -->

		<!-- Main Area -->
		<div class="col-sm-10">
			<h1>Manage Admins</h1>
			<div><?php echo Message(); 
				echo successMessage();
			?></div>
			<div>
				<form action="Admins.php" method="POST">
					<fieldset>
						<div class="form-group">
							<label for="username"><span class="FieldInfo">Username:</span></label>
							<input class="form-control" type="text" name="username" id="username" placeholder="Username">
							
						</div>
						<div class="form-group">
							<label for="password"><span class="FieldInfo">Password:</span></label>
							<input class="form-control" type="password" name="password" id="password" placeholder="Password">
							
						</div>
						<div class="form-group">
							<label for="confirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
							<input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
							
						</div>
						<input type="submit" name="submit" value="Add New Admin" class="btn btn-success btn-block">
					</fieldset><br>
				</form>
			</div>


			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>SN</th>
						<th>Date & Time</th>
						<th>Admin Name</th>
						<th>Added By</th>
						<th>Action</th>
					</tr>
					<?php 
						global $connection;
						$viewQuery="SELECT * FROM registration ORDER BY datetime desc";
						$execute=mysqli_query($connection, $viewQuery);

						$SN=0;

						while($rows=mysqli_fetch_array($execute)) {
						$id = $rows['id'];
						$dateTime=$rows['datetime'];
						$AdminName=$rows['username'];
						$addedby=$rows['addedby'];
						$SN++;
						?>	

						<tr>
							<td><?php echo $SN; ?></td>
							<td><?php echo $dateTime; ?></td>
							<td><?php echo $AdminName; ?></td>
							<td><?php echo $addedby; ?></td>
							<td><a class="btn btn-danger" href="deleteAdmin.php?id=<?php echo $id; ?>">Delete</a></td>
						</tr>

						<?php
					}
					 ?>
				</table>
			</div>

		</div> <!-- Ending of main area -->
	</div>
</div>


<div id="footer">
	<hr><p>Theme by | Bibek Ghimire | &copy;2020 --- All rights reserved.</p>
	<a style="color: white; text-decoration: none; cursor: poointer; font-weight: bold;" href=""></a>
	<hr>
</div>

<div style="height: 10px; background: #27AAE1;"></div>


</body>
</html>