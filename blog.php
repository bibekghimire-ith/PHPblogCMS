<?php	
require_once("include/db.php");
?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>	

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
		.imageicon {
	max-width: 150px;
	margin: 0px;
	display: block;
	max-height: 200px;
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


	<div class="row">
		<div class="col-sm-8">

<!-- Count Pages -->
	<?php 
		global $connection;
		$queryPagination="SELECT COUNT(*) FROM admin_panel";
		$resultPages=mysqli_query($connection,$queryPagination);
		$rowPagination=mysqli_fetch_array($resultPages);
		$totalPosts=array_shift($rowPagination);
// echo $totalPosts;
		$totalPage=$totalPosts/5;
		$totalPage=ceil($totalPage);

		
?>









			<?php 
				global $connection;

				if(isset($_GET['SearchButton'])) {
					$search = $_GET['search'];
					$query="SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
				} elseif(isset($_GET['category'])) { // Query when category is active in URL tab...
					$category=$_GET['category'];
					$query="SELECT * FROM admin_panel WHERE category='$category' ORDER BY datetime desc";
				} 
				elseif(isset($_GET['page'])) {
					$page=$_GET['page'];
					if($page>$totalPage) {$page=$totalPage;}
					if($page==0 || $page<1) {
						$showPostFrom=0;
					} else {
						$showPostFrom=($page*5)-5;
					}
					//Since 5 posts per page...
					// Query when pagination is active...
					$query = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $showPostFrom,5";
				}
				else {
					$page=1;
				$query = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
				}

				$execute = mysqli_query($connection, $query);

				

				while ($row=mysqli_fetch_array($execute)) {
			?>

			<div class="blogpost thumbnail">
			 	<img width="600"; height="400"; class="img-responsive img-rounded" src="Upload/<?php echo $row['image']; ?>">

			 	<div class="caption">
			 		<h1 id="heading"><?php echo htmlentities($row['title']); ?></h1>

			 		<p class="description">Category:<?php echo htmlentities($row['category']); ?>  Published on <?php echo htmlentities($row['datetime']); ?></p>
			 		<p class="post"><?php $post=htmlentities($row['post']);
			 			if(strlen($post)>150) {$post=substr($post,0,150);}
			 			echo $post;
			 			if(strlen($post)<150) {

			 			} else {
			 				echo "...";
			 			}
			 			

			 		 ?></p>
			 	</div>
			 	<a href="fullPost.php?id=<?php echo $row['id']; ?>"><span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>
			 </div>



		<?php } ?>
		<nav>
		 	<ul class="pagination pull-left pagination-lg">

		 		<?php 
		 		if(isset($page)) {
		 			if($page>1) {
		 				?>
		 				<li><a href="blog.php?page=<?php echo $page-1; ?>">&laquo;&laquo;</a></li>
		 				<?php
		 			}
		 		}
		 		 ?>
	<!-- Add Here Count Pages -->
<?php
		for($i=1;$i<=$totalPage;$i++) {
			if(isset($page)) {
			if($i==$page) {
		 ?> 
		 
		 		<li class="active"><a href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
				</li>
			<?php }
			else {
			 ?>
			 <li class=""><a href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
				</li>
			
		<?php }}} ?>

		<?php 
		 		if(isset($page)) {
		 			if($page<$totalPage) {
		 				?>
		 				<li><a href="blog.php?page=<?php echo $page+1; ?>">&raquo;&raquo;</a></li>
		 				<?php
		 			}
		 		}
		 		 ?>
		 	</ul>
		 </nav>
		 


		</div> <!-- Ending of Blog Area -->

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

			<div class="panel panel-primary">
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
								<p id="description" style="margin-left: 90px;"><?php echo $datetime; ?></p>
								
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