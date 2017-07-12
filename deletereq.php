<?php
	include_once("connectDB.php");
	$rid = $_GET["rid"];
	$qry = "delete from requirements where rid ='$rid'";
	mysql_query($qry) or die(mysql_error());
	echo "deleted";
?>
