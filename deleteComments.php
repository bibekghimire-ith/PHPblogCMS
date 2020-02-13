<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/db.php"); ?>

<?php 

if(isset($_GET['id'])) {
	$idFromURL=$_GET['id'];
	$connection;
	$query="DELETE FROM comments WHERE id='$idFromURL'";
	$results=mysqli_query($connection,$query);
	if($results) {
		$_SESSION['SuccessMessage']="Comment Deleted Successfully.";
		Redirect_to("comments.php");
	} else {
		$_SESSION['ErrorMessage']="Comment failed to Delete.";
		Redirect_to("comments.php");
	}
}

 ?>