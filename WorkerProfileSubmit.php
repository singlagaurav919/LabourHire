<?php
include_once("connectDB.php");

$uid = htmlentities($_POST["uidText"]);
$fieldofwork = $_POST["fieldofwork"];
$exp = $_POST["exp"];
$ofcaddr = htmlentities($_POST["ofcaddr"]);
$spec = htmlentities($_POST["spec"]);
$prevwork = htmlentities($_POST["prevwork"]);
$name = $_POST["nameText"];
$mobile = $_POST["mobileText"];
$resdaddr = htmlentities($_POST["resdaddr"]);
$pincode = $_POST["pinText"];
$city = $_POST["cityText"];
$state = $_POST["stateText"];
$country = "India";
$website = $_POST["websiteText"];
$email = $_POST["emailText"];
/*
if($_POST["submit"]=="Save")
	{
		$idpictemp = $_FILES["idpic"]["tmp_name"];
		$idpicorg = $_FILES["idpic"]["name"];
		$profilepictemp = $_FILES["profilepic"]["tmp_name"];
		$profilepicorg = $_FILES["profilepic"]["name"];
		if(file_exists($_FILES["idpic"]["tmp_name"]))
			{
				$idpicorg = $uid."__".$idpicorg;
				move_uploaded_file($idpictemp,"workerIds/".$idpicorg);
			}
		if(file_exists($_FILES["profilepic"]["tmp_name"]))
			{
				$profilepicorg = $uid."__".$profilepicorg;
				move_uploaded_file($profilepictemp,"workerPps/".$profilepicorg);
			}
		
		$qry = "insert into workerprofile values('$uid','$fieldofwork','$exp','$ofcaddr','$spec','$prevwork','$name','$mobile','$resdaddr','$pincode','$city','$state','$country','$idpicorg','$profilepicorg','$website','$email',0,0,CURRENT_DATE(),'$businessId',0)";
	
		$result = mysql_query($qry) or die(mysql_error());
		echo "Your details have been saved succesfully";
	
	}
else */
	{
		//&&is_uploaded_file($_FILES["idpic"]["tmp_name"])
		if(file_exists($_FILES["idpic"]["tmp_name"]))
			{
				//deleting from uploads folder
				$qrysel1 = "select idpic from workerprofile where uid='$uid'";
				$res = mysql_query($qrysel1) or die(mysql_error());
				$ary = mysql_fetch_array($res) ;
				
				/* $old = getcwd(); // Save the current directory
   				 chdir("C:\xampp\htdocs\xampp\PhpWorkspace\Major Project\workerIds");
				 unlink($ary["idpic"]);
			     chdir($old); // Restore the old working directory*/
				unlink("workerIds/".$ary["idpic"]);
				
				
				$idpictemp = $_FILES["idpic"]["tmp_name"];
				$idpicorg = $_FILES["idpic"]["name"];
				//$qrydel1 = "delete idpic from workerprofile where uid='$uid'";
				//mysql_query($qrydel1) or die(mysql_error()) ;
				//echo "id pic set".$idpicorg;
				$idpicorg = $uid."__".$idpicorg;
				move_uploaded_file($idpictemp,"workerIds/".$idpicorg);

			}
		else{
			$qrysel1 = "select idpic from workerprofile where uid='$uid'";
			$res = mysql_query($qrysel1) or die(mysql_error());
			$ary = mysql_fetch_array($res) ;
			$idpicorg = $ary["idpic"];
		}
		if(file_exists($_FILES["profilepic"]["tmp_name"]))
			{
				$qrysel2 = "select profilepic from workerprofile where uid='$uid'";
				$res2 = mysql_query($qrysel2) or die(mysql_error());			
				$ary = mysql_fetch_array($res2) ;
				
				
				/* $old = getcwd(); // Save the current directory
   				 chdir("C:\xampp\htdocs\xampp\PhpWorkspace\Major Project\workerPps");
				 unlink($ary["profilepic"]);
			     chdir($old); // Restore the old working directory*/
				unlink("workerPps/".$ary["profilepic"]);
			
			
				$profilepictemp = $_FILES["profilepic"]["tmp_name"];
				$profilepicorg = $_FILES["profilepic"]["name"];
				//$qrydel2 = "delete profilepic from workerprofile where uid='$uid'";
				//mysql_query($qrydel2) or die(mysql_error()) ;
				//echo "<br>profile set".$profilepicorg."<br>";
				$profilepicorg = $uid."__".$profilepicorg;
				move_uploaded_file($profilepictemp,"workerPps/".$profilepicorg);
			}
		else{
			$qrysel2 = "select profilepic from workerprofile where uid='$uid'";
			$res2 = mysql_query($qrysel2) or die(mysql_error());			
			$ary = mysql_fetch_array($res2) ;
			$profilepicorg = $ary["profilepic"];
		}

		
		
		//delete from database

		
		
		$qry = "update workerprofile set uid='$uid',fieldofwork='$fieldofwork',exp='$exp',ofcaddr='$ofcaddr',spec='$spec',prevwork='$prevwork',name='$name',mobile='$mobile',resdaddr='$resdaddr',pin='$pincode',city='$city',state='$state',country='$country',idpic='$idpicorg',profilepic='$profilepicorg',website='$website',email='$email',likes=0,unlikes='0' where uid='$uid'";
		
			$result = mysql_query($qry) or die(mysql_error());
			//echo "Your details have been updated succesfully";
			header("Location:WorkerConsole.php");
	}
	

?>