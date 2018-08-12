<?php 
$baseURL ="http://127.0.0.1/EvePI/";
include('../createDatabaseTable.php');
## VARIABLES WILL BE READ FROM AN EXTERNAL FILE

$idTableEmpty = false;

$conn_data_check = new mysqli($servername, $username, $password,$dbName);


if ($conn_data_check->connect_error) {
    die("Connection failed: " . $conn_data_check->connect_error);
} 

$sql_data_check_1 = "SELECT id FROM $tb1Name";

$rows = $conn_data_check->query($sql_data_check_1);

if($rows->{'num_rows'}==0)
{
	$idTableEmpty = true;
}

if($idTableEmpty)
{
	$url=$baseURL ."clients/addID";

}
else
{
	$url=$baseURL ."clients/clients";
}

header("Location: ".$url); /* Redirect browser */
exit();




?>