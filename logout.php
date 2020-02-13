<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>

<?php 

$_SESSION["User_id"]=null;
session_destroy();
Redirect_to("login.php");

 ?>
 