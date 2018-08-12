<?php 

$baseURL ="http://127.0.0.1/EvePI/";

include('createDatabaseTable.php');


## CHECKING THE TABLE FOR AN EMPTY ROW

$idTableEmpty = false;
$charTableEmpty = false;



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

$sql_data_check_2 = "SELECT id FROM $tb2Name";

$rows = $conn_data_check->query($sql_data_check_2);

if($rows->{'num_rows'}==0)
{

	$charTableEmpty = true;
}


#echo "id : ".$idTableEmpty."<br>\n char : ".$charTableEmpty;

if($idTableEmpty)
{
	$url=$baseURL."clients/addID";
}
elseif ($charTableEmpty) 
{
	$url=$baseURL."characters/addChar";
}
else
{
	$url=$baseURL."PI/main";
}

$conn_data_check->close();
header("Location: ".$url); /* Redirect browser */
exit(); 



?>