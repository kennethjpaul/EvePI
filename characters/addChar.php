<html>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
	<head>
		<meta charset=utf-8>
		<title>Eve PI</title>
	</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../css/navigation.css">
<link rel="stylesheet" href="../css/clients.css">
<script src="../scripts/jquery.js"></script>
<script src="../scripts/jquery-ui.js"></script>
<script src="../scripts/navigation.js"></script>
<script type="text/javascript">
	var baseUrl ="http://127.0.0.1/EvePI/";
	$(function()
	{
		$(".client_id_content").click(function(){
			var clientID= $(this).parent().children('.client_id_content').children('.ID_Client').html();
			var secretkeyClient= $(this).parent().children('.client_id_content').children('.secretkey_client').html();
			window.location.replace(baseUrl+"characters/SSO.php?clientID="+clientID+"&secretKey="+secretkeyClient);
		})
	})

</script>
<body>
<?php
include('../navigation/navigation_begin.php');

echo '<div id="client_box">
<div id="client_list"><div class="client_wrapper">';

$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb1Name = "idtable";

$conn = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT name,clientID,secretkey FROM ".$tb1Name;
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) 
{
	echo '<div class="client_ids">
<div class="client_id_content">
<span> Name :</span>
<span class="client_name">'.$row['name'].'</span>
</br>
<span> Client ID :</span>
<span class="ID_Client">'.$row['clientID'].'</span>
</br>
<span> Secret Key :</span>
<span class="secretkey_client">'.$row['secretkey'].' </span>
</div>
</div>';
}


$conn->close();



echo '</div></div></div>';

include('../navigation/navigation_end.php');
?>
</body>
</html>