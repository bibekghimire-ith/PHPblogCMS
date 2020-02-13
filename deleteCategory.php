<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/db.php"); ?>

<?php 

if(isset($_GET['id'])) {
	$idFromURL=$_GET['id'];
	$connection;
	$query="DELETE FROM categories WHERE id='$idFromURL'";
	$results=mysqli_query($connection,$query);
	if($results) {
		$_SESSION['SuccessMessage']="Category Deleted Successfully.";
		Redirect_to("categories.php");
	} else {
		$_SESSION['ErrorMessage']="Category failed to Delete.";
		Redirect_to("categories.php");
	}
}

 ?>