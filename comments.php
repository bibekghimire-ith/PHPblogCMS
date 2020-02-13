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
				<li class="nav-item"><a class="nav-link" href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
				<li class="nav-item"><a class="nav-link" href="NewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
				<li class="nav-item"><a class="nav-link" href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
				
				<li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
				<li class="nav-item active"><a class="nav-link" href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
				<li class="nav-item"><a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
			</ul>
		</div> <!-- Ending of side area -->

		<!-- Main Area -->
		<div class="col-sm-10">
			
			<h1>Un-Approved Comments</h1>
			<div><?php echo Message(); 
				echo successMessage();
			?></div>
			<br>
			
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>SN</th>
						<th>Name</th>
						<th>Date</th>
						<th>Comment</th>
						
						<th>Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>	

					<?php 
						$connection;
						
						$query="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
						$results=mysqli_query($connection,$query);
						$SN=0;
						while ($row=mysqli_fetch_array($results)) {
							$ID=$row['id'];
							$dateTime=$row['datetime'];
							$name=$row['name'];
							$comment=$row['comment'];
							$postID=$row['admin_panel_id'];
							$SN++;

						
						if(strlen($name)>6) {$name=substr($name,0,6).'...';}
						if(strlen($dateTime)>11) {$dateTime=substr($dateTime,0,11).'...';}	
						
					 ?>

					 <tr>
					 	<td><?php echo $SN; ?></td>
					 	<td><?php echo $name; ?></td>

						<td><?php echo $dateTime; ?></td>
						<td><?php echo $comment; ?></td>

						<td><a class="btn btn-success" href="approveComments.php?id=<?php echo $ID; ?>">Approve</a></td>
						<td><a href="deleteComments.php?id=<?php echo $ID; ?>" class="btn btn-danger">Delete</a></td>
						<td><a target="_blank" href="fullpost.php?id=<?php echo $postID; ?>" class="btn btn-primary">Live Preveiw</a></td>


					 </tr>
					<?php } ?>
				</table>
			</div>

<!-- Approved Comments... -->
<h1>Approved Comments</h1>
			
			<br>
			
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>SN</th>
						<th>Name</th>
						<th>Date</th>
						<th>Comment</th>
						<th>Approved By</th>
						<th>Dis-Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>	

					<?php 
						$connection;
						$query="SELECT * FROM comments WHERE status='ON' ORDER BY datetime desc";
						$results=mysqli_query($connection,$query);
						$SN=0;
						while ($row=mysqli_fetch_array($results)) {
							$ID=$row['id'];
							$dateTime=$row['datetime'];
							$name=$row['name'];
							$comment=$row['comment'];
							$postID=$row['admin_panel_id'];
							$SN++;
							$Admin=$row['approvedby'];
						
						if(strlen($name)>6) {$name=substr($name,0,6).'...';}
						if(strlen($dateTime)>11) {$dateTime=substr($dateTime,0,11).'...';}		 		
					 ?>

					 <tr>
					 	<td><?php echo $SN; ?></td>
					 	<td><?php echo $name; ?></td>

						<td><?php echo $dateTime; ?></td>
						<td><?php echo $comment; ?></td>
						<td><?php echo $Admin; ?></td>
						<td><a class="btn btn-warning" href="disapproveComment.php?id=<?php echo $ID; ?>">Dis-Approve</a></td>
						<td><a href="deleteComments.php?id=<?php echo $ID; ?>" class="btn btn-danger">Delete</a></td>
						<td><a target="_blank" href="fullpost.php?id=<?php echo $postID; ?>" class="btn btn-primary">Live Preveiw</a></td>


					 </tr>
					<?php } ?>
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