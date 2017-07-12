<?php
include_once("connectDB.php");

$uid = htmlentities($_POST["uidText"]);
$name = $_POST["nameText"];
$mobile = $_POST["mobileText"];
$resdaddr = htmlentities($_POST["resdaddr"]);
$pincode = $_POST["pinText"];
$city = $_POST["cityText"];
$state = $_POST["stateText"];
$country = "India";
$email = $_POST["emailText"];
if(isset($_POST["occ"]))
$occ = $_POST["occ"];
else $occ = "";


/*if($_POST["submit"]=="Save")
	{		
		$qry = "insert into citizenprofile values('$uid','$name','$mobile','$resdaddr','$pincode','$city','$state','$country','$email','$occ',CURRENT_DATE())";
	
		echo "Your details have been saved succesfully";
	
	}
else */ 
	{
				
		$qry = "update citizenprofile set uid='$uid',name='$name',mobile='$mobile',resdaddr='$resdaddr',pin='$pincode',city='$city',state='$state',country='$country',email='$email',occ='$occ' where uid='$uid'";
		
			
	}
	

$result = mysql_query($qry) or die(mysql_error());
$count = mysql_affected_rows();
header("Location:CitizenConsole.php");

?>