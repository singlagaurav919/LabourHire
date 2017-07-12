<?php
session_start();


include_once("connectDB.php");
$uid = $_POST["uidText"];
$type = $_POST["typeText"];
$name = $_POST["nameText"];
$mobile = $_POST["mobileText"];
$resdaddr = htmlentities($_POST["resdaddr"]);
$pincode = $_POST["pinText"];
$city = $_POST["cityText"];
$state = $_POST["stateText"];
$country = "India";
$email = $_POST["emailText"];
$pwd = $_POST["passwordText"];

/////////*****setting session variables*****/////////
$_SESSION["uid"] = $uid;
$_SESSION["type"] = $type;
$_SESSION["name"] = $name;
$_SESSION["mobile"] = $mobile;

$qry = "insert into alluids values('$uid','$type','$pwd')";
$result = mysql_query($qry) or die(mysql_error());

if($type=='citizen')
$qry = "insert into citizenprofile(uid,name,mobile,resdaddr,pin,city,state,country,email,dos) values('$uid','$name','$mobile','$resdaddr','$pincode','$city','$state','$country','$email',CURRENT_DATE())";
else if($type=='business')
$qry = "insert into businessprofile(uid,name,mobile,resdaddr,pin,city,state,country,email,dos) values('$uid','$name','$mobile','$resdaddr','$pincode','$city','$state','$country','$email',CURRENT_DATE())";
else if($type=='worker')
{
	$via = $_POST["viaText"];
$qry = "insert into workerprofile(uid,name,mobile,resdaddr,pin,city,state,country,email,dos,businessId,count) values('$uid','$name','$mobile','$resdaddr','$pincode','$city','$state','$country','$email',CURRENT_DATE(),'$via',0)";
}
$result = mysql_query($qry) or die(mysql_error());
$rows = mysql_affected_rows();

if($rows==1)
	{
		header("Location:index.php");
	}
else
	echo "There was an error";

?>