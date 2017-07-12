<?php

include_once("connectDB.php");

$data = "";
if($_GET["type"]=='states')
{
	$qry = "select distinct state from statelist";	
	$res = mysql_query($qry) or die(mysql_error());
	$count = mysql_num_rows($res);
	while($record=mysql_fetch_array($res))
		{
			$data = $data.$record["state"].";";
		}
}

else if($_GET["type"]=='cities')
{
	$state = $_GET["state"];
	$qry = "select city_name from statelist where state='$state'";
	$res = mysql_query($qry) or die(mysql_error());
	$count = mysql_num_rows($res);
	while($record=mysql_fetch_array($res))
		{
			$data = $data.$record["city_name"].";";
		}
}
else if($_GET["type"]=='fieldofwork')
{
	$qry = "select type from workertypes";
	$res = mysql_query($qry) or die(mysql_error());
	$count = mysql_num_rows($res);
	while($record=mysql_fetch_array($res))
		{
			$data = $data.$record["type"].";";
		}
}
else if($_GET["type"]=='exp')
{
	$qry = "select exp from exp";
	$res = mysql_query($qry) or die(mysql_error());
	$count = mysql_num_rows($res);
	while($record=mysql_fetch_array($res))
		{
			$data = $data.$record["exp"].";";
		}
}
echo $data;
?>