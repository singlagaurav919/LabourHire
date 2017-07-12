<?php
include_once("connectDB.php");

$uid = $_GET["uid"];
$qry = "select * from businessprofile where uid='$uid'";
$result = mysql_query($qry) or die(mysql_error());
$count=mysql_num_rows($result);

if($count==0)
		echo "no id uid";
	else
	{
		while($record=mysql_fetch_array($result))
		{
			$idorg = $record["idpic"];
				
			$data=$record["name"].";".$record["mobile"].";".$record["resdaddr"].";".$record["email"].";".$record["city"].";".$record["state"].";".$record["pin"].";".$record["occ"].";".$record["shopaddr"].";".$record["idpic"];//."$idorg"."$profileorg";
		}
		echo $data;
	}



?>