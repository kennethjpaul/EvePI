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
<link rel="stylesheet" href="../css/characters.css">
<script src="../scripts/jquery.js"></script>
<script src="../scripts/jquery-ui.js"></script>
<script src="../scripts/navigation.js"></script>
<script type="text/javascript">
	var baseUrl ="http://127.0.0.1/EvePI/";
	$(function()
	{
		$(".delete_character").click(function()
		{
			var charactertName = $(this).parent().children('.character_id_content').children('.character_name').html();
			
			$( "#dialog" ).dialog({
				buttons: {
				  "Delete all items": function() {
				    
				    console.log(charactertName);
				    window.location.replace(baseUrl+"characters/deleteCharacter.php?id="+charactertName);

				  },
				  Cancel: function() {
				    $( this ).dialog( "close" );
				  }
				},
			});
			$( "#dialog" ).dialog( "open" );

		})

		$("#add_character").click(function()
		{
			 window.location.replace(baseUrl+"characters/addChar");
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

echo '<div id="character_box">
<div id="character_list"><div class="character_wrapper">';


### GET DATA
$servername = "localhost";
$username = "root";
$password = "";
$dbName ="EvePI";
$tb2Name = "chartable";


$conn = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT characterID,characterName FROM ".$tb2Name;
$result = $conn->query($sql);


// output data of each row
while($row = $result->fetch_assoc()) 
{
	echo '<div class="character_ids">
<div class="character_id_content">
<div class="character_profile_pic"></div>
<span class="character_name">'.$row['characterName'].'</span>
</br>
</div>
<div class="delete_character">
Delete
</div>
</div>';
}


$conn->close();

echo'</div></div>
<div id="add_character">
Add
</div>

 </div>';

include('../navigation/navigation_end.php');

echo '	<div id="dialog" title="Error">
  <p>All fields must be filled.</p>
</div>';
?>
</body>
</html>