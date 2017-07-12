<?php
include_once("connectDB.php");
$state = $_GET["state"];
$city = $_GET["city"];
$uid = $_GET["uid"];

$qry = "select fieldofwork from workerprofile where uid='$uid'";
$records = mysql_query($qry) or die(mysql_error());
$record = mysql_fetch_array($records);
$type = $record["fieldofwork"];

$qry="select * from requirements where state='$state' and city='$city' and typeofwork='$type'";
$records=mysql_query($qry);

$all = array();

while($record = mysql_fetch_array($records))
{
	$all[] = $record;
}

echo json_encode($all);