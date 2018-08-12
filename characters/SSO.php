<?php
$url = "http://127.0.0.1/EvePI/";


$clientID = $_GET['clientID'];
$secretKey = $_GET['secretKey'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb3Name = "tempID";

$conn = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql_table_3 = "CREATE TABLE IF NOT EXISTS ".$tb3Name."(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
clientID VARCHAR(255) NOT NULL, secretkey VARCHAR(255) NOT NULL)";


$url_encode = urlencode($url);

if ($conn->query($sql_table_3) === TRUE) 
{
	$sql_data ="INSERT INTO ".$tb3Name." (clientID,secretkey) VALUES ('".$clientID."','".$secretKey."')";

	if ($conn->query($sql_data) === TRUE) 
	{
		header("Location: https://login.eveonline.com/oauth/authorize/?response_type=code&redirect_uri=".$url_encode."callback&client_id=".$clientID."&scope=esi-planets.manage_planets.v1&state=uniquestate123");
		exit();
	}
	else
	{
		echo "Error Inserting Data". $conn->error;
	}

	
}
else
{
	echo "Cannot Create Temp Table";
}

$conn->close();

?>