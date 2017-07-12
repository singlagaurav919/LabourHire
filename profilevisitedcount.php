<?php
include_once("connectDB.php");

$uid = $_GET["uid"];

$qry="select count from workerprofile where uid='$uid'";

$records=mysql_query($qry) or die(mysql_error());

$record = mysql_fetch_array($records);

$counts = mysql_num_rows($records);

echo $record["count"];



