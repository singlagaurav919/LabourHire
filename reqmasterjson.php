<?php
include_once("connectDB.php");
$uid = $_GET["uid"];
$qry="select * from requirements where uid='$uid'";
$records=mysql_query($qry);

$all = array();

while($record = mysql_fetch_array($records))
{
	$all[] = $record;
}

echo json_encode($all);
?>