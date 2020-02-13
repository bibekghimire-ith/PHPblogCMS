<?php 

date_default_timezone_set("Asia/Kathmandu");

$currentTime=time();   // In seconds...

// $dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
$dateTime=strftime("%B-%m-%d %H:%M:%S", $currentTime);
echo $dateTime;   // Gives time of xammp server

 ?>