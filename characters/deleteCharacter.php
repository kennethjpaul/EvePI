<?php
$url="http://127.0.0.1/EvePI/";
$name = $_GET['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb2Name = "chartable";

$conn_database = new mysqli($servername, $username, $password,$dbName);
$sql_delete_character ="DELETE FROM ".$tb2Name." WHERE characterName='".$name."'";

if ($conn_database->connect_error) 
{
	    die("Connection failed: " . $conn_database->connect_error);
}
	
if ($conn_database->query($sql_delete_character) === TRUE) 
{
	header("Location: ".$url."characters/checkChar.php"); /* Redirect browser */
}	
else
{
	echo "Error deleting entry: " . $conn_database->error;
}

$conn_database->close();

?>