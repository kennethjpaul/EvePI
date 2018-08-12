<html>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
	<head>
		<meta charset=utf-8>
		<title>Eve PI</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="../css/navigation.css">
	<link rel="stylesheet" href="../css/addID.css">
	<script src="../scripts/jquery.js"></script>
	<script src="../scripts/jquery-ui.js"></script>
	<script src="../scripts/navigation.js"></script>
	<script type="text/javascript">

	$(function(){

		$( "#dialog" ).dialog({
		  autoOpen: false,
		  show: {
		    effect: "blind",
		    duration: 1000
		  },
		  hide: {
		    effect: "blind",
		    duration: 1000
		  }
		});

		$("#container").submit(function(){
			if ($("#name_i").val().length==0 || $("#clientID_i").val().length==0  || $("#secretKey_i").val().length==0 ) 
			{
				$( "#dialog" ).dialog( "open" );
				return false;
			}
			else
			{
				return true;
			}
		});

	})
</script>

<body>
<?php
include('../navigation/navigation_begin.php');

echo '<form action="addEntry.php" method="post" id="container" style="background-attachment:fixed;">	


<div id="ID_title">
	Add ID
</div>
<div id="formContent">
<span id="name_s">Name</span> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" id="name_i" name="name">
<br>
<br>
<br>
<span id="clientID_s">Client ID</span>&nbsp&nbsp&nbsp&nbsp <input type="text" id="clientID_i" name="clientID">
<br>
<br>
<br>
<span id="secretKey_s">Secret Key</span> &nbsp&nbsp<input type="text" id="secretKey_i" name="secretKey">
<br>

<input type="submit" id="login" value="Submit">
</div>	
</form>';
echo '	<div id="dialog" title="Error">
  <p>All fields must be filled.</p>
</div>';

include('../navigation/navigation_end.php');
?>
</body>
</html>