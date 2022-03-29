<?php
include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>
        <?php include("inc/nav.php"); ?>
		<h1>Welcome Admin</h1>
		
	</body>
</html>