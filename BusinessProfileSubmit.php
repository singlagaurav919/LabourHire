<?php
include_once("connectDB.php");

$uid = htmlentities($_POST["uidText"]);
$shopaddr = htmlentities($_POST["shopaddr"]);
$name = $_POST["nameText"];
$mobile = $_POST["mobileText"];
$resdaddr = htmlentities($_POST["resdaddr"]);
$pincode = $_POST["pinText"];
$city = $_POST["cityText"];
$state = $_POST["stateText"];
$country = "India";
$occ = $_POST["occText"];
$email = $_POST["emailText"];

/*
if($_POST["submit"]=="Save")
	{
		
		$idpictemp = $_FILES["idpic"]["tmp_name"];
		$idpicorg = $_FILES["idpic"]["name"];
		if(file_exists($_FILES["idpic"]["tmp_name"]))
			{	
				
				echo "image";
				$idpicorg = $uid."__".$idpicorg;
				move_uploaded_file($idpictemp,"businessIds/".$idpicorg);		
			}
		
		$qry = "insert into businessprofile values('$uid','$name','$mobile','$resdaddr','$pincode','$city','$state','$country','$email','$shopaddr','$idpicorg','$occ',CURRENT_DATE())";
		
		$result = mysql_query($qry) or die(mysql_error());
		echo "Your details have been saved succesfully";
	
	}
	
else */ 
	{
		//&&is_uploaded_file($_FILES["idpic"]["tmp_name"])
		if(file_exists($_FILES["idpic"]["tmp_name"]))
			{
				//deleting from uploads folder
				$qrysel1 = "select idpic from businessprofile where uid='$uid'";
				$res = mysql_query($qrysel1) or die(mysql_error());
				$ary = mysql_fetch_array($res) ;
				unlink("businessIds/".$ary["idpic"]);
				
				
				$idpictemp = $_FILES["idpic"]["tmp_name"];
				$idpicorg = $_FILES["idpic"]["name"];
				//$qrydel1 = "delete idpic from workerprofile where uid='$uid'";
				//mysql_query($qrydel1) or die(mysql_error()) ;
				//echo "id pic set".$idpicorg;
				$idpicorg = $uid."__".$idpicorg;
				move_uploaded_file($idpictemp,"businessIds/".$idpicorg);

			}
		else{
			$qrysel1 = "select idpic from businessprofile where uid='$uid'";
			$res = mysql_query($qrysel1) or die(mysql_error());
			$ary = mysql_fetch_array($res) ;
			$idpicorg = $ary["idpic"];
		}
			
		$qry = "update businessprofile set uid='$uid',occ='$occ',name='$name',mobile='$mobile',resdaddr='$resdaddr',pin='$pincode',city='$city',state='$state',country='$country',idpic='$idpicorg',email='$email',shopaddr='$shopaddr' where uid='$uid'";
		
			$result = mysql_query($qry) or die(mysql_error());
			$count = mysql_affected_rows();
			header("Location:BusinessConsole.php");
	}
	




?>