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
		$(".delete_client").click(function()
		{
			var clientName = $(this).parent().children('.client_id_content').children('.client_name').html();
			$("#dialog p").html("Do you want to delete the ID -'"+clientName+"' ?");
			$( "#dialog" ).dialog({
				buttons: {
				  "Delete ID": function() {
				    
				    console.log(clientName);
				    window.location.replace(baseUrl+"clients/deleteID.php?name="+clientName);

				  },
				  Cancel: function() {
				    $( this ).dialog( "close" );
				  }
				},
			});
			$( "#dialog" ).dialog( "open" );

		})

		$("#add_client").click(function()
		{
			 window.location.replace(baseUrl+"clients/addID");
		})

		$( "#dialog" ).dialog({
		  resizable: false,
		  autoOpen: false,
		  modal: true,
		  
		  show: {
		    effect: "blind",
		    duration: 1000
		  },
		  hide: {
		    effect: "blind",
		    duration: 1000
		  }
		});
	})

</script>
<body>
<?php
include('../navigation/navigation_begin.php');

echo '<div id="client_box">
<div id="client_list"><div class="client_wrapper">';


### GET DATA
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


// output data of each row
while($row = $result->fetch_assoc()) 
{
	echo '<div class="client_ids">
<div class="client_id_content">
<span> Name :</span>
<span class="client_name">'.$row['name'].'</span>
</br>
<span> Client ID :</span>
<span>'.$row['clientID'].'</span>
</br>
<span> Secret Key :</span>
<span>'.$row['secretkey'].' </span>
</div>
<div class="delete_client">
Delete
</div>
</div>';
}


$conn->close();

echo'</div></div>
<div id="add_client">
Add
</div>

 </div>';

include('../navigation/navigation_end.php');

echo '	<div id="dialog" title="Error">
  <p></p>
</div>';

?>
</body>
</html>