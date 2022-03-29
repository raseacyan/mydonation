<?php
include('inc/connect.php');
include('inc/functions.php');

session_start();
if(!isLoggedIn()){
	redirectTo("login.php");
}

$id = isset($_REQUEST['id'])? $_REQUEST['id']: 0;
$donation_type = getDonationTypeById($id, $conn);

$donation_options = getDonationOptionsByDonationTypeId($id,$conn);
$user = getUserById($_SESSION['user_id'], $conn);

if(isset($_POST['create'])){


	//senitize

	$personalised_text = isset($_POST['personalised_text'])? $conn->real_escape_string(htmlentities(trim($_POST['personalised_text']))) : '';
	$donation_date = $conn->real_escape_string(htmlentities(trim($_POST['donation_date'])));
	$donar_name = $conn->real_escape_string(htmlentities(trim($_POST['donar_name'])));
	$donar_phone = $conn->real_escape_string(htmlentities(trim($_POST['donar_phone'])));
	$donar_address = $conn->real_escape_string(htmlentities(trim($_POST['donar_address'])));
	$amount = $conn->real_escape_string(htmlentities(trim($_POST['amount'])));
	$donation_type_id = $conn->real_escape_string(htmlentities(trim($_POST['donation_type_id'])));
	$donation_options_id = isset($_POST['donation_options_id'])? $conn->real_escape_string(htmlentities(trim($_POST['donation_options_id']))) : '';
	$user_id = $conn->real_escape_string(htmlentities(trim($_POST['user_id'])));

	$_SESSION['payment_amount'] = $amount; 

	$data = array(
		'personalised_text' => $personalised_text,
		'donation_date' => $donation_date,
		'donar_name' => $donar_name,
		'donar_phone' => $donar_phone,
		'donar_address' => $donar_address,
		'amount' => $amount,
		'donation_type_id' => $donation_type_id,
		'donation_options_id' => $donation_options_id,
		'user_id' => $user_id
	);


	$table = "donations";

	$result = createRecord($table, $data, $conn);

	if($result){        
		header('location:donation_success.php');
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
		<h1><?php echo $donation_type['type']; ?> Donation Form</h1>
		
	
		<form action="donation_form.php" method="post">			
			

			<label for="type">Donation Type</label><br>
			<input type="text" name="type" value="<?php echo $donation_type['type']; ?>" disabled/><br>

			<label for="venue">Venue</label><br>
			<input type="text" name="venue" value="<?php echo $donation_type['venue']; ?>" disabled/><br>

			<label for="donation_date">Donation Date:</label><br>
            <input type="date" name="donation_date" /><br>
			
			<?php if($donation_type['allow_personalised_text']==1): ?>
			<label for="personalised_text">Personalized Text:</label><br>
            <input type="text" name="personalised_text" /><br>
			<?php endif; ?>

			<?php if($donation_options): ?>
			<label for="donation_options_id">Options</label><br>
			<select name="donation_options_id">
			<?php foreach($donation_options as $donation_option): ?>
				<option value="<?php echo $donation_option['id']; ?>"><?php echo $donation_option['option_name']; ?></option>
			<?php endforeach; ?>
			</select><br>	
			<?php endif; ?>		

			<label for="donar_name">Donar Name:</label><br>
            <input type="text" name="donar_name" value="<?php echo $user['name']; ?>" /><br>

			<label for="donar_phone">Donar Phone:</label><br>
            <input type="text" name="donar_phone" value="<?php echo $user['phone']; ?>"/><br>

			<label for="donar_address">Donar Address:</label><br>
            <input type="text" name="donar_address" value="<?php echo $user['address']; ?>" /><br>

			<input type="hidden" name="amount" value="<?php echo $donation_type['price']; ?>"/>
			<input type="hidden" name="donation_type_id" value="<?php echo $donation_type['id']; ?>"/>
			<input type="hidden" name="user_id" value="<?php echo $user['id']; ?>"/>

			<input type="hidden" name="id" value="<?php echo $id; ?>"/>			

			<br><input type="submit" name="create" value="create"/>
		</form>
	</body>
</html>