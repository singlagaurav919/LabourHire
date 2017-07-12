<?php
include_once("connectDB.php");

$uid = htmlentities($_POST["uidText"]);
$fieldofwork = $_POST["fieldofwork"];
$spec = htmlentities($_POST["spec"]);
$workaddr = htmlentities($_POST["workaddr"]);
$pincode = $_POST["pinText"];
$city = $_POST["cityText"];
$state = $_POST["stateText"];
$reqdate = $_POST["lastdate"];

if($_POST["post"]=="Post")
	{
		$qry = "insert into requirements(uid,typeofwork,spec,reqdate,city,state,pincode,workaddr,count,dop) values('$uid','$fieldofwork','$spec','$reqdate','$city','$state','$pincode','$workaddr','0',CURRENT_DATE())";
	
		$result = mysql_query($qry) or die(mysql_error());
		//echo "Your requirements have been posted succesfully";	
		header("Location:CitizenConsole.php#addreqDiv");
		
	}
$count = mysql_affected_rows();
//echo $count;


?>