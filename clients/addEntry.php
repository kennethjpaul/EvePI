 <?php
 	$baseURL ="http://127.0.0.1/EvePI/";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName ="EvePI";
	$tbName = "idtable";


	
	$conn_table = new mysqli($servername, $username, $password,$dbName);

	if ($conn_table->connect_error) 
	{
	    die("Connection failed: " . $conn_table->connect_error);
	} 

	$sql_check = "SELECT * FROM ".$tbName." WHERE name='".$_POST{'name'}."'";

	$query_check = $conn_table->query($sql_check);

	if($query_check->{'num_rows'}>0)
	{
		header("Location: ".$baseURL."error.php?error=1" ); /* Redirect browser */
		exit();
	}

	$sql_data ="INSERT INTO ".$tbName." (name,clientID,secretkey) VALUES ('".$_POST{'name'}."','".$_POST{'clientID'}."','".$_POST{'secretKey'}."')";

	if ($conn_table->query($sql_data) === TRUE) 
	{
		header("Location: ".$baseURL ); /* Redirect browser */
		exit();
	} 
	else
	{
		    echo "Error: " . $sql . "<br>" . $conn_table->error;
	}

?> 