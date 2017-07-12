<?php
include_once("connectDB.php");
$city = $_GET["city"];
$state = $_GET["state"];
$fieldofwork = $_GET["fieldofwork"];
$exp = $_GET["exp"];

$qry="select * from workerprofile where city='$city' and fieldofwork='$fieldofwork' and exp>='$exp'";

$records=mysql_query($qry);

$all = array();

while($record = mysql_fetch_array($records))
{
	$all[] = $record;
}

echo json_encode($all);