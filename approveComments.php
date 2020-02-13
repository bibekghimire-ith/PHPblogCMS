<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/db.php"); ?>

<?php 

if(isset($_GET['id'])) {
	$idFromURL=$_GET['id'];
	
	$connection;
	$admin=$_SESSION['username'];
	$query="UPDATE comments SET status='ON',approvedby='$admin' WHERE id='$idFromURL'";
	$results=mysqli_query($connection,$query);
	if($results) {
		$_SESSION['SuccessMessage']="Comment Approved Successfully.";
		Redirect_to("comments.php");
	} else {
		$_SESSION['ErrorMessage']="Comment failed to Approve.";
		Redirect_to("comments.php");
	}
}

 ?>