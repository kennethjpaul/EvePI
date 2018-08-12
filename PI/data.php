<?php

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

		$postData = array(
		    'grant_type' => 'refresh_token',
		    'refresh_token' => $row['refresh_token']
		);

		$auth_code = base64_encode($row['authCode']);
		$headers[0] = 'Authorization: Basic '.$auth_code;
		$headers[1] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[2] = 'Host: login.eveonline.com';
		$headers[3] = 'Accept: application/json';


		$ch4 = curl_init();
		curl_setopt($ch4,CURLOPT_URL,$url_new_token);
		curl_setopt($ch4, CURLOPT_POSTFIELDS, json_encode($postData));
		curl_setopt($ch4, CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch4, CURLOPT_POST, true);
		curl_setopt($ch4,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

		echo var_dump(json_decode($reponse));
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