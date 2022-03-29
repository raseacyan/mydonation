<?php

include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

$donation_types = getDonationTypes($conn);



if(isset($_POST['create'])){

	//senitize
	$option_name = $conn->real_escape_string(htmlentities(trim($_POST['option_name'])));
	$donation_type_id = $conn->real_escape_string(htmlentities(trim($_POST['donation_type_id'])));


	$data = array(
		'option_name' => $option_name,
		'donation_type_id' =>  $donation_type_id
	);


	$table = "donation_options";

	$result = createRecord($table, $data, $conn);

	if($result){        
		header('location:donation_options_list.php');
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
		<h1>Add Donation Options</h1>
		<p><a href="donation_options_list.php">Back to donation option list</a></p>
	
		<form action="donation_options_create.php" method="post">
			<label for="type">Option Name:</label><br>
            <input type="text" name="option_name" /><br>

			<label for="donation_type_id">Donation Type</label><br>
			<select name="donation_type_id">
                <?php foreach($donation_types as $donation_type): ?>
				<option value="<?php echo $donation_type['id']; ?>"><?php echo $donation_type['type']; ?></option>
                <?php endforeach; ?>				
			</select><br>

            

			<br><input type="submit" name="create" value="create"/>
		</form>
	</body>
</html>