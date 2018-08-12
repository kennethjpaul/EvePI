<!DOCTYPE html>
<html>
<head>
	<title>Eve PI</title>
</head>
<script src="scripts/jquery.js"></script>
<script src="scripts/navigation.js"></script>
<link rel="stylesheet" href="css/navigation.css">
<link rel="stylesheet" href="css/error.css">
<body>
<?php

$error = $_GET['error'];

include('navigation/navigation_begin.php');

echo '<div id="error_box">
<div id="error_content"><p>';

if($error == 1)
{
	echo "An ID with the same name already exists, please use a different name";
}
elseif ($error == 2) {
	echo "Entry for this charachter already exists";
}
else{
	echo "Unknown Error, Please try again";
}

echo '</p></div>
</div>';

include('navigation/navigation_end.php');

?>
</body>
</html>