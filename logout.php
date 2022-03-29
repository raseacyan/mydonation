<?php

include('inc/functions.php');

session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>
        <?php include("inc/nav.php"); ?>
		
		<p>You have been logged out successfully</p>
		
	</body>
</html>