<?php	
require_once("include/db.php");
?>
<?php require_once("include/session.php"); ?>
<?php 

function Redirect_to($New_Location) {
	header("location:".$New_Location);
		exit;
}

function login_Attempt($username,$password) {
	global $connection;
	$Query = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
	$result=mysqli_query($connection,$Query);
	if($admin=mysqli_fetch_assoc($result)) {
		return $admin;
	} else {
		return null;
	}
}

function login() {
	if (isset($_SESSION["User_Id"])) {
		return true;
	}
}

function confirm_login() {
	if(!login()) {
		$_SESSION["ErrorMessage"]="Login Required !";
		Redirect_to("login.php");
	}
}

 ?>