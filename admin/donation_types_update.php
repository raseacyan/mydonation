<?php

include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

$id = isset($_REQUEST['id'])? $_REQUEST['id']: 0;
$donation_type = getDonationTypeById($id, $conn);



if(isset($_POST['update'])){
	
	//senitize
	$type = $conn->real_escape_string(htmlentities(trim($_POST['type'])));
	$venue = $conn->real_escape_string(htmlentities(trim($_POST['venue'])));
	$price = $conn->real_escape_string(htmlentities(trim($_POST['price'])));
	$allow_personalised_text = isset($_POST['allow_personalised_text'])? $_POST['allow_personalised_text'] : 0 ;
	$id =  $conn->real_escape_string(htmlentities(trim($_POST['id'])));

	$table = "donation_types";
	$data = array(
		'type' => $type,
		'venue' => $venue,
		'price' => $price,
		'allow_personalised_text' => $allow_personalised_text		
	);

	$result = updateRecord($table, $data, $id, $conn);

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
		<h1>Update Donation Type</h1>
		<p><a href="donation_types_list.php">Back to donation type list</a></p>
	
		<form action="donation_types_update.php" method="post">
			<label for="type">Donation Type:</label><br>
            <input type="text" name="type" value="<?php echo $donation_type['type'] ?>" /><br>

			<label for="type">Donation Venue:</label><br>
			<select name="venue">
				<option value="pagoda" <?php echo ($donation_type['type'] == 'pagoda')?'selected':''; ?>>Pagoda</option>
				<option value="monastery" <?php echo ($donation_type['type'] == 'monestery')?'selected':''; ?>>Monastery</option>
			</select><br>

            <label for="price">Donation Price:</label><br>
            <input type="text" name="price" value="<?php echo $donation_type['price'] ?>"/><br>

			<input type="checkbox" name="allow_personalised_text" value="1" <?php echo ($donation_type['allow_personalised_text']=='1')?'checked':''; ?>/>
			Allow personalised text
			<br>

            <input type="hidden" name="id" value="<?php echo $donation_type['id']; ?>"/>

			<br><input type="submit" name="update" value="update"/>
		</form>
	</body>
</html>