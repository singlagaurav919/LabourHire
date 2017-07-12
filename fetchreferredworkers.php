<?php
include_once("connectDB.php");
$businessId = $_GET["businessId"];
$qry="select * from workerprofile where businessId='$businessId'";
$records=mysql_query($qry);

$all = array();

while($record = mysql_fetch_array($records))
{
	$all[] = $record;
}

echo json_encode($all);
?>