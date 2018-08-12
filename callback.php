<!DOCTYPE html>
<html>

<body>
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb3Name = "tempID";
$tb2Name = "chartable";

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT clientID,secretkey FROM ".$tb3Name;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$clientID=$row['clientID'];
$secretKey=$row['secretkey'];


$sql_delete = "DELETE FROM ".$tb3Name." WHERE clientID='".$clientID."'";
$conn->query($sql_delete);

$auth_code = $clientID.":".$secretKey;
$auth_base64 =  base64_encode($auth_code);



$url = 'https://login.eveonline.com/oauth/token';
$postData = array(
    'grant_type' => 'authorization_code',
    'code' => $_GET["code"]
);

$headers[0] = 'Authorization: Basic '.$auth_base64;
$headers[1] = 'Content-Type: application/json';
$headers[2] = 'Host: login.eveonline.com';
$headers[3] = 'Accept: application/json';

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

curl_close ($ch);

if($response !==false)
{
	$parseResponse = json_decode($response);
	echo "Access Token : ".$parseResponse->{'access_token'}." <br>\n";
	echo "Refresh Token : ".$parseResponse->{'refresh_token'}."<br> \n";
	$fecha = new DateTime();
	$timestamp =	$fecha->getTimestamp();
	$access_token = $parseResponse->{'access_token'};
	$refresh_token= $parseResponse->{'refresh_token'};

	$ch2 = curl_init();


	curl_setopt_array($ch2, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://login.eveonline.com/oauth/verify',
	));

	$header_id[0]='Authorization: Bearer '.$access_token;
	curl_setopt($ch2, CURLOPT_HTTPHEADER,$header_id);
	curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);

	$response2 = curl_exec($ch2);

	curl_close ($ch2);
	if($response2 !==false)
	{
		$parseResponse2 = json_decode($response2);
		var_dump($parseResponse2);
		#CharacterID
		# INSERT INTO TABLES
		$character_ID = $parseResponse2->{'CharacterID'};
		$charcter_name= $parseResponse2->{'CharacterName'};
		$date =  date('Y-m-d H:i:s', substr($timestamp, 0, -3));

		$sql_check = "SELECT * FROM ".$tb2Name." WHERE characterID='".$character_ID."'";

		$query_check = $conn->query($sql_check);

		if($query_check->{'num_rows'}>0)
		{
			$conn->close();
			header("Location: ".$baseURL."error.php?error=2" ); /* Redirect browser */
			exit();
		}


		$sql_add_char ="INSERT INTO ".$tb2Name." (characterID,characterName,accessToken,refreshToken,authCode) VALUES ('".$character_ID."','".$charcter_name."','".$access_token."','".$refresh_token."','".$auth_code."')";

		if ($conn->query($sql_add_char)=== TRUE) 
		{
			# code...
		}
		else
		{
			echo "Error adding Character ID".$conn->error;
		}
	}
	else

	{
		print "Could not get a Char ID";
	}


}
else {
  print "Could not get a response";
}
$conn->close();

?>

</body>
</html>