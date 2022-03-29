<?php

include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

if(isset($_POST['create'])){

	//senitize
	$type = $conn->real_escape_string(htmlentities(trim($_POST['type'])));
	$price = $conn->real_escape_string(htmlentities(trim($_POST['price'])));
	$venue = $conn->real_escape_string(htmlentities(trim($_POST['venue'])));
	$allow_personalised_text = isset($_POST['allow_personalised_text'])? $_POST['allow_personalised_text'] : 0 ;

	$data = array(
		'type' => $type,
		'price' =>  $price,
		'venue' => $venue,
		'allow_personalised_text' => $allow_personalised_text
	);


	$table = "donation_types";

	$result = createRecord($table, $data, $conn);

	if($result){        
		header('location:donation_types_list.php');
	}

}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>
        <?php include("inc/nav.php"); ?>
		<h1>Add Donation Type</h1>
		<p><a href="listview.php">Back to donation type list</a></p>
	
		<form action="donation_types_create.php" method="post">
			<label for="type">Donation Type:</label><br>
            <input type="text" name="type" /><br>

			<label for="venue">Venue</label><br>
			<select name="venue">
				<option value="pagoda">Pagoda</option>
				<option value="monastery">Monastery</option>
			</select><br>

            <label for="price">Donation Price:</label><br>
            <input type="text" name="price"/><br>

			<input type="checkbox" name="allow_personalised_text" value="1"/>
			Allow personalised text
			<br>

			<br><input type="submit" name="create" value="create"/>
		</form>
	</body>
</html>