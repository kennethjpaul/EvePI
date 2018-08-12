<?php
$baseURL = "http://127.0.0.1/EvePI/";
$CharName = $_GET['charName'];
$data_url = $_GET['url'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb2Name = "chartable";

$conn_data = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn_data->connect_error) {
    die("Connection failed: " . $conn_data->connect_error);
} 

$sql_data = "SELECT * FROM ".$tb2Name." WHERE characterName='".$CharName."'";

$result = $conn_data->query($sql_data);

$row = $result->fetch_assoc();

$ch3 =curl_init();
curl_setopt_array($ch3, array(
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'https://esi.evetech.net/latest/characters/'.$row['characterID'].$data_url,
		));
$header_nn[0]='Authorization: Bearer '.$row['accessToken'];
curl_setopt($ch3, CURLOPT_HTTPHEADER,$header_nn);
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);

$response3 = curl_exec($ch3);

if($response3 !==false)
{
	$parseR3 = json_decode($response3);

	#var_dump($parseR3);
	#$tmp = property_exists($parseR3,'error');
	$error_check = isset($parseR3->{'error'});
	if($error_check)
	{
		echo "Expired";
		$url_new_token="https://login.eveonline.com/oauth/token";

		$postData = "grant_type=refresh_token&refresh_token=".$row['refreshToken'];

		$auth_code = base64_encode($row['authCode']);
		$headers[0] = 'Authorization: Basic '.$auth_code;
		$headers[1] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[2] = 'Host: login.eveonline.com';

		$ch4 = curl_init();
		curl_setopt($ch4,CURLOPT_URL,$url_new_token);
		curl_setopt($ch4, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch4, CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch4, CURLOPT_POST, true);
		curl_setopt($ch4,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch4);
		$result = json_decode($response);
		$sql_update = "UPDATE ".$tb2Name." SET accessToken='".$result->{'access_token'}."' WHERE characterName='".$CharName."'";

		$conn_data->query($sql_update);

		$conn_data->close();

		header("Location: ".$baseURL."PI/data?charName=".$CharName."&url=".$data_url );
		exit();
		
	}
	else
	{
		echo "data available";
	}	
	
}
else
{
	echo "No Response";
}

$conn_data->close();

?>