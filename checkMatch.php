<?php

include_once("connectDB.php");
$uid = $_POST["uid"];
$pwd = $_POST["pwd"];

$qry = "select * from alluids where uid='$uid' and password='$pwd'";
$result = mysql_query($qry) or die(mysql_error());
$count = mysql_num_rows($result);
echo $count;
?>