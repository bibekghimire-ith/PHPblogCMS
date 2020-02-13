<?php	
require_once("include/db.php");
?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>	
<?php

if(isset($_POST['submit'])) {
	$name=mysqli_real_escape_string($connection,$_POST['name']);
	$email=mysqli_real_escape_string($connection,$_POST['email']);
	$comment=mysqli_real_escape_string($connection,$_POST['comment']);
	date_default_timezone_set("Asia/Kathmandu");
	$currentTime = time();
	$dateTime = strftime("%B-%d-%Y %H:%M:%S", $currentTime);
	
	$postID=$_GET['id'];

	if(empty($name) || empty($email) || empty($comment)) {
		$_SESSION["ErrorMessage"] = "All field should be filled.";
		
	} elseif(strlen($comment)>500) {
	$_SESSION["ErrorMessage"] = "Only 500 characters are allowed in comment.";
	
} else {
	global $connection;
	$query = "INSERT INTO `comments`(`datetime`, `name`, `email`, `comment`, `approvedby`, `status`,`admin_panel_id`) VALUES ('$dateTime','$name','$email','$comment','Pending','OFF','$postID')";
	$execute = mysqli_query($connection,$query);

	if($execute) {
	$_SESSION["SuccessMessage"] = "Comment Submitted Successfully";
	Redirect_to("fullpost.php?id={$postID}");
} else {
	$_SESSION["ErrorMessage"] = "Comment failed to Submit";
	Redirect_to("fullpost.php?id={$postID}");
}

}
}

?>	


<!DOCTYPE html>
<html>
<head>
	<title>Blog Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

<!-- Bootstrap 4 does not supports glyphicons So use 3 else use icons -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



	<!-- Add Custom styles after bootstrap files -->
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">

	<style type="text/css">
		
		.col-sm-3 {
			
		}
			
		.FieldInfo {
			color: rgb(251, 174, 44);
			font-family: Bitter,Georgia,"Times New Roman",Times,Serif;
			font-size: 1.2em;
		}
		.commentBlock {
			background-color: #F6F7F9;
		}
		.commentInfo {
			color: #365899;
			font-family: sans-serif;
			font-size: 1.1em;
			font-weight: bold;
			padding-top: 10px;
		}
		.comment {
			margin-top: -2px;
			padding-bottom: 10px;
			font-size: 1.1em;
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


<div class="container">
	<header class="blog-header">
		<h1>The Complete Responsive CMS Blog</h1>
		<p class="lead">The complete blog using PHP by Bibek Ghimire.</p>
	</header>
<div><?php echo Message(); 
				echo successMessage();
			?></div>


	<div class="row">
		<div class="col-sm-8">
			<?php 
				global $connection;

				if(isset($_GET['SearchButton'])) {
					$search = $_GET['search'];
					$query="SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
				} 

				else {
					$postID = $_GET['id'];

					$query = "SELECT * FROM admin_panel WHERE id='$postID' ORDER BY datetime desc";
				}
				
				$execute = mysqli_query($connection, $query);

				while ($row=mysqli_fetch_array($execute)) {
			?>

			<div class="blogpost thumbnail">
			 	<img class="img-responsive img-rounded" src="Upload/<?php echo $row['image']; ?>" height=400;>

			 	<div class="caption">
			 		<h1 id="heading"><?php echo htmlentities($row['title']); ?></h1>

			 		<p class="description">Category:<?php echo htmlentities($row['category']); ?>  Published on <?php echo htmlentities($row['datetime']); ?></p>
			 		<p class="post"><?php nl2br($post=($row['post']));
			 		// nl2br() is used for paragraph formatting...
			 			
			 			echo $post;
			 		
			 			

			 		 ?></p>
			 	</div>
			 	
			 </div>



		<?php } ?><br><br>

		<span class="FieldInfo">Comments</span><br>

		<?php 
			$connection;
			$postID=$_GET['id'];
			$comment_query="SELECT * FROM comments WHERE admin_panel_id=$postID AND status='ON'";
			$result=mysqli_query($connection,$comment_query);

			while ($row=mysqli_fetch_array($result)) {
				$commentDate=$row['datetime'];
				$commentName=$row['name'];
				$comments=$row['comment'];
			
		 ?>

		 <div class="commentBlock">
		 	<img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="images/comment.png" width="100", height="70";>
		 	<p style="margin-left: 90px;" class="commentInfo"><?php echo $commentName; ?></p>
		 	<p style="margin-left: 90px;" class="description"><?php echo $commentDate; ?></p>
		 	<p style="margin-left: 90px;" class="comment"><?php echo $comments; ?></p>
		 </div>
		 <hr>

		 <?php } ?>

		<span class="FieldInfo">Share your thoughts about this post</span><br>

		
					<br><div>
				<form action="fullpost.php?id=<?php echo $postID; ?>" method="POST" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label for="name"><span class="FieldInfo">Name:</span></label>
							<input class="form-control" type="text" name="name" id="name" placeholder="Name"><br>
							
						</div>
						<div class="form-group">
							<label for="email"><span class="FieldInfo">Email:</span></label>
							<input class="form-control" type="email" name="email" id="email" placeholder="Email"><br>
							
						</div>
						
						<div class="form-group">
							<label for="comment"><span class="FieldInfo">Comment:</span></label>
							<textarea class="form-control" name="comment" id="comment"></textarea><br>
							
						</div>

						<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						
					</fieldset>
				</form><br>
			</div>	<br> 


		</div> <!-- Blog Area -->





		<div class="col-sm-offset-1 col-sm-3">
			<h2>About Me</h2>
			<img class="img-responsive img-circle imageicon" src="images/me1.jpg">
			<p class="text-justify">Self-motivated and hardworking fresher seeking 
      		for an opportunity to work in a challenging 
      		environment to prove my skills and utilize
     		 my knowledge in the growth of the 
     		 organization.
			</p><br>

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Categories</h2>
				</div>
				<div class="panel-body">
					<?php 
						global $connection;
						$catQuery="SELECT * FROM categories ORDER BY datetime desc";
						$catResult=mysqli_query($connection,$catQuery);
						while ($catrow=mysqli_fetch_array($catResult)) {
							$catID=$catrow['id'];
							$category=$catrow['name'];
							?>
						<span id="heading"><a href="blog.php?category=<?php echo $category; ?>"><?php echo $category; ?></a></span><br>
							<?php
						}
					 ?>
				</div>
				<div class="panel-footer">
					
				</div>
			</div>

			<div class="panel panel-primary background">
				<div class="panel-heading">
					<h2 class="panel-title">Recent Posts</h2>
				</div>
				<div class="panel-body">
					<?php 
						global $connection;
						$recentQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
						$recentPost=mysqli_query($connection,$recentQuery);
						while($posts=mysqli_fetch_array($recentPost)){
							$id=$posts['id'];
							$title=$posts['title'];
							$datetime=$posts['datetime'];
							$image=$posts['image'];
							if(strlen($datetime)>11) {
								$datetime=substr($datetime, 0,11);
							}
							?>
							<div>
								<img class="pull-left"style="margin-top: 10px; margin-left: 10px;" src="Upload/<?php echo $image; ?>" width=70; height=70;>
								<a href="fullpost.php?id=<?php echo $id; ?>">
								<p id="heading" style="margin-top: 30px; margin-left: 90px;"><?php echo $title; ?></p>
								</a>
								<p id="description"  style="margin-left: 90px;"><?php echo $datetime; ?></p>
								
							</div><br>
							<hr>
							<?php
						}
					 ?>
				</div>
				<div class="panel-footer">
					
				</div>
			</div>

		</div> <!-- Side Area -->






	</div> <!-- Row -->











</div> <!-- Container -->









<div id="footer">
	<hr><p>Theme by | Bibek Ghimire | &copy;2020 --- All rights reserved.</p>
	<a style="color: white; text-decoration: none; cursor: poointer; font-weight: bold;" href=""></a>
	<hr>
</div>

<div style="height: 10px; background: #27AAE1;"></div>




</body>
</html>