<?php

include_once("connectDB.php");

$uid = $_GET["uid"];
/*
if($_GET["type"]=="citizen")
$qry = "select * from citizenprofile where uid='$uid'";
else if($_GET["type"]=="worker")
$qry = "select * from workerprofile where uid='$uid'";
else if($_GET["type"]=="business")
$qry = "select * from businessprofile where uid='$uid'";
*/
$qry = "select * from alluids where uid='$uid'";

$res = mysql_query($qry) or die(mysql_error());
$count = mysql_num_rows($res);
echo $count;

?>