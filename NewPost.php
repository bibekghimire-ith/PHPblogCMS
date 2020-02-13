<?php	
require_once("include/db.php");
?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php confirm_login(); ?>
<?php

if(isset($_POST['submit'])) {
	$title=mysqli_real_escape_string($connection,$_POST['title']);
	$category=mysqli_real_escape_string($connection,$_POST['category']);
	$post=mysqli_real_escape_string($connection,$_POST['post']);
	date_default_timezone_set("Asia/Kathmandu");
	$currentTime = time();
	$dateTime = strftime("%B-%d-%Y %H:%M:%S", $currentTime);
	$Admin = $_SESSION['username'];
	$image = $_FILES["image"]["name"];
	$target = "Upload/".basename($_FILES["image"]["name"]);

	if(empty($title)) {
		$_SESSION["ErrorMessage"] = "Title should not be empty.";
		
		Redirect_to("dashboard.php");
		
	} elseif(strlen($title)<2) {
	$_SESSION["ErrorMessage"] = "Title should be at-least 2 characters.";
	Redirect_to("categories.php");
} else {
	global $connection;
	$query = "INSERT INTO `admin_panel`(`datetime`, `title`, `category`, `author`, `image`, `post`) VALUES ('$dateTime','$title','$category','$Admin','$image','$post')";
	$execute = mysqli_query($connection,$query);

move_uploaded_file($_FILES["image"]["tmp_name"],$target);

	if($execute) {
	$_SESSION["SuccessMessage"] = "Post Added Successfully";
	Redirect_to("NewPost.php");
} else {
	$_SESSION["ErrorMessage"] = "Post failed to Add";
	Redirect_to("NewPost.php");
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

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<br><br><br>

			<ul id="side_menu" class="nav nav-pills nav-stacked">
				<li class="nav-item"><a class="nav-link" href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
				<li class="nav-item active"><a class="nav-link" href="NewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
				<li class="nav-item"><a class="nav-link" href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
				
				<li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
				<li class="nav-item"><a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
			</ul>
		</div> <!-- Ending of side area -->

		<!-- Main Area -->
		<div class="col-sm-10">
			<h1>Add New Post</h1>
			<div><?php echo Message(); 
				echo successMessage();
			?></div>
			<div>
				<form action="NewPost.php" method="POST" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label for="title"><span class="FieldInfo">Title:</span></label>
							<input class="form-control" type="text" name="title" id="categoryname" placeholder="Title"><br>
							
						</div>
						<div class="form-group">
							<label for="selectcategory"><span class="FieldInfo">Category:</span></label>
							<select class="form-control" name="category" id="selectcategory">
								<?php 
						global $connection;
						$viewQuery="SELECT * FROM categories ORDER BY datetime desc";
						$execute=mysqli_query($connection, $viewQuery);

						while($rows=mysqli_fetch_array($execute)) {
						$id = $rows['id'];
						$categoryName=$rows['name'];
		
					 ?>
								<option><?php echo $categoryName; ?></option>

							<?php } ?>
							</select>
							<br>
							
						</div>

						<div class="form-group">
							<label for="image"><span class="FieldInfo">Image:</span></label>
							<input class="form-control" type="file" name="image" id="image" placeholder="Image"><br>
							
						</div>
						<div class="form-group">
							<label for="postarea"><span class="FieldInfo">Post:</span></label>
							<textarea class="form-control" name="post" id="postarea"></textarea><br>
							
						</div>





						<input type="submit" name="submit" value="Add New Post" class="btn btn-success btn-block">
						
					</fieldset>
				</form>
			</div>


			<div class="table-responsive">
				
					
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