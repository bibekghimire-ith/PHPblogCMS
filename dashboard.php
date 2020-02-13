<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/db.php"); ?>
<?php confirm_login(); ?>
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
      <a class="nav-link active" href="blog.php" target="_blank">Blog</a>
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
				<li class="nav-item"><a class="nav-link active" href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
				<li class="nav-item"><a class="nav-link" href="NewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
				<li class="nav-item"><a class="nav-link" href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
				
				<li class="nav-item"><a class="nav-link" href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
				<li class="nav-item block"><a class="nav-link" href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php 

									$connection;
									$queryUnApproved="SELECT COUNT(*) FROM comments WHERE status='OFF'";
									$resultUnApproved=mysqli_query($connection,$queryUnApproved);
									$rowsUnApproved=mysqli_fetch_array($resultUnApproved);
									$notApproved=array_shift($rowsUnApproved);
									if($notApproved>0) {


									 ?>
									 <span class="label label-warning pull-right">
									 	<?php echo $notApproved; ?>
									 </span>
									<?php } ?>
				</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
				<li class="nav-item"><a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
			</ul>
		</div> <!-- Ending of side area -->

		<!-- Main Area -->
		<div class="col-sm-10">
			
			<h1>Admin Dashboard</h1>
			<div><?php echo Message(); 
				echo successMessage();
			?></div>
			<br>
			
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>SN</th>
						<th>Post Title</th>
						<th>Date</th>
						<th>Author</th>
						<th>Category</th>
						<th>Banner</th>
						<th>Comments</th>
						<th>Action</th>
						<th>Details</th>
					</tr>

					<?php 
						global $connection;
						$query = "SELECT * FROM admin_panel ORDER BY datetime desc";
						$result = mysqli_query($connection, $query);
						$SN=0;
						while($row=mysqli_fetch_array($result)) {
							$id= $row['id'];
							$datetime= $row['datetime'];
							$title= $row['title'];
							$category= $row['category'];
							$author= $row['author'];
							$image= $row['image'];
							$post= $row['post'];
							$SN++;

							if(strlen($title)>20) {
								$title=substr($title,0,20).'..';
							}

							if(strlen($datetime)>11) {
								$datetime=substr($datetime,0,11).'..';
							}

							if(strlen($author)>6) {
								$author=substr($author,0,6).'..';
							}

							?>

							<tr>
								<td><?php echo $SN; ?></td>
								<td style="color: #5e5eff;"><?php echo $title; ?></td>
								<td><?php echo $datetime; ?></td>
								<td><?php echo $author; ?></td>
								<td><?php echo $category; ?></td>
								<td><img width="170"; height="50"; src="Upload/<?php echo $image; ?>"></td>
								<td>
									<?php 

									$connection;
									$queryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id' AND status='ON'";
									$resultApproved=mysqli_query($connection,$queryApproved);
									$rowsApproved=mysqli_fetch_array($resultApproved);
									$totalApproved=array_shift($rowsApproved);
									if($totalApproved>0) {


									 ?>
									 <span class="label label-success pull-right">
									 	<?php echo $totalApproved; ?>
									 </span>
									<?php } ?>

									<?php 

									$connection;
									$queryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id' AND status='OFF'";
									$resultUnApproved=mysqli_query($connection,$queryUnApproved);
									$rowsUnApproved=mysqli_fetch_array($resultUnApproved);
									$notApproved=array_shift($rowsUnApproved);
									if($notApproved>0) {


									 ?>
									 <span class="label label-danger">
									 	<?php echo $notApproved; ?>
									 </span>
									<?php } ?>
								</td>
								<td>
									<a class="btn btn-warning" href="editPost.php?edit=<?php echo $id; ?>">Edit</a>
									<a class="btn btn-danger" href="deletePost.php?delete=<?php echo $id; ?>">Delete</a>
								</td>
								<td><a class="btn btn-primary" target="_blank" href="fullPost.php?id=<?php echo $id; ?>">Live Preveiw</a></td>
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