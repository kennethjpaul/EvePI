<?php
$url="http://127.0.0.1/EvePI/";
$name = $_GET['name'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb1Name = "idtable";

$conn_database = new mysqli($servername, $username, $password,$dbName);
$sql_delete_client ="DELETE FROM ".$tb1Name." WHERE name='".$name."'";
echo $sql_delete_client."<br>\n";
if ($conn_database->connect_error) 
{
	    die("Connection failed: " . $conn_database->connect_error);
}
	
if ($conn_database->query($sql_delete_client) === TRUE) 
{
	header("Location: ".$url."clients/checkID.php"); /* Redirect browser */
}	
else
{
	echo "Error deleting entry: " . $conn_database->error;
}

$conn_database->close();

?>