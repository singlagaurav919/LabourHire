<?php
include_once("connectDB.php");

$uid = $_GET["uid"];
$qry = "select * from workerprofile where uid='$uid'";
$result = mysql_query($qry) or die(mysql_error());
$count=mysql_num_rows($result);

if($count==0)
		echo "not found any uid";
	else
	{
		while($record=mysql_fetch_array($result))
		{
			$idorg = $record["idpic"];
			//$idorg = ltrim($idorg,$uid."__");
			$profileorg = $record["profilepic"];
			//$profileorg = ltrim($profileorg,$uid."__");
			
			$data=$record["fieldofwork"].";".$record["exp"].";".$record["ofcaddr"].";".$record["spec"].";".$record["prevwork"].";".$record["name"].";".$record["mobile"].";".$record["resdaddr"].";".$record["city"].";".$record["state"].";".$record["pin"].";".$record["website"].";".$record["email"].";"."$idorg".";"."$profileorg".";";
		}
		echo $data;
	}



?>