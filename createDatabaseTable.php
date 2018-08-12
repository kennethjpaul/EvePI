<?php
## VARIABLES WILL BE READ FROM AN EXTERNAL FILE
$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb1Name = "idtable";
$tb2Name = "chartable";



## CREATING DATABASES AND TABLES IF IT DOESN'T EXIST


$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS ".$dbName;



if ($conn->query($sql) === TRUE) 
{

    $sql_table_1 = "CREATE TABLE IF NOT EXISTS ".$tb1Name."(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30) NOT NULL,
clientID VARCHAR(255) NOT NULL, secretkey VARCHAR(255) NOT NULL)";
	
	$conn_database = new mysqli($servername, $username, $password,$dbName);

	if ($conn_database->connect_error) {
	    die("Connection failed: " . $conn_database->connect_error);
	} 

	if ($conn_database->query($sql_table_1) === TRUE) 
	{

		$sql_table_2 = "CREATE TABLE IF NOT EXISTS ".$tb2Name."(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, characterID VARCHAR(30) NOT NULL, characterName VARCHAR(30) NOT NULL, accessToken VARCHAR(255) NOT NULL, refreshToken VARCHAR(255) NOT NULL,timeStamp TIMESTAMP NOT NULL)";

		if ($conn_database->query($sql_table_2) === TRUE) 
		{

			#echo "Tables created <br>\n";
		}
		else
		{
			echo "Error creating table 2: " . $conn_database->error;

		}

	}
	else
	{
		echo "Error creating table 1: " . $conn_database->error;
	}

	$conn_database->close();
} 
else 
{
    
    echo "Error creating database: " . $conn->error;
}

$conn->close();

?>