<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/db.php"); ?>

<?php 

if(isset($_GET['id'])) {
	$idFromURL=$_GET['id'];
	$connection;
	$query="DELETE FROM registration WHERE id='$idFromURL'";
	$results=mysqli_query($connection,$query);
	if($results) {
		$_SESSION['SuccessMessage']="Admin Deleted Successfully.";
		Redirect_to("Admins.php");
	} else {
		$_SESSION['ErrorMessage']="Admin failed to Delete.";
		Redirect_to("Admins.php");
	}
}

 ?>