<?php
include_once("connectDB.php");

$uid = $_GET["uid"];
$qry = "select * from citizenprofile where uid='$uid'";
$result = mysql_query($qry) or die(mysql_error());
$count=mysql_num_rows($result);

if($count==0)
		echo "not found any uid";
	else
	{
		while($record=mysql_fetch_array($result))
		{
			
			$data=$record["name"].";".$record["mobile"].";".$record["resdaddr"].";".$record["email"].";".$record["city"].";".$record["state"].";".$record["pin"].";".$record["occ"];//."$idorg"."$profileorg";
		}
		echo $data;
	}



?>