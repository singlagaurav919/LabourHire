<?php

function SendSMS($mobilenumbers,$message)
{
	$user="bcebti"; //your username
	$password="sunsoft@1234"; //your password
	$senderid="BCEBTI"; //Your senderid
	$url="http://smsapple.in/api/swsend.asp";//URL To HIT
	$message = urlencode($message);
	$ch = curl_init();
	if (!$ch){die("Couldn't initialize a cURL handle");}
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt ($ch, CURLOPT_POSTFIELDS,
	"username=$user&password=$password&sender=$senderid&sendto=$mobilenumbers&message=$message");
	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$curlresponse = curl_exec($ch); // execute
	if(curl_errno($ch))
	echo "";
	//echo 'curl error : '. curl_error($ch);
	if (empty($ret)) 
		{
			// some kind of an error happened
			//die(curl_error($ch));
			curl_close($ch); // close cURL handler
		} 
	else 
		{
			$info = curl_getinfo($ch);
			curl_close($ch); // close cURL handler
			return $curlresponse; 
		}
		
}

$mob=$_GET["mob"];
$msg=$_GET["msg"];
$resp= SendSMS($mob,$msg);
if($resp=="sent")
echo "1";
else
echo "0";



?>