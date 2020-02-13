<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/db.php"); ?>

<?php 

if(isset($_GET['id'])) {
	$idFromURL=$_GET['id'];
	$connection;
	$query="UPDATE comments SET status='OFF',approvedby='Dis-Approved' WHERE id='$idFromURL'";
	$results=mysqli_query($connection,$query);
	if($results) {
		$_SESSION['SuccessMessage']="Comment Dis-Approved Successfully.";
		Redirect_to("comments.php");
	} else {
		$_SESSION['ErrorMessage']="Comment failed to Dis-Approve.";
		Redirect_to("comments.php");
	}
}

 ?>