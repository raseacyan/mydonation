<?php

include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

$id = isset($_REQUEST['id'])? $_REQUEST['id']: 0;
echo $id;

if(isset($_POST['create'])){

	//senitize
	$payment_date = $conn->real_escape_string(htmlentities(trim($_POST['payment_date'])));
	$payment_method = $conn->real_escape_string(htmlentities(trim($_POST['payment_method'])));
	$payment_amount = $conn->real_escape_string(htmlentities(trim($_POST['payment_amount'])));
	$donation_id = $conn->real_escape_string(htmlentities(trim($_POST['id'])));


	$data = array(
		'payment_date' => $payment_date,
		'payment_method' =>  $payment_method,
		'payment_amount' => $payment_amount,
		'donation_id' => $donation_id
	);


	$table = "payments";

	$result = createRecord($table, $data, $conn);

	if($result){        
		header('location:donations_list.php');
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
		<h1>Add Payment</h1>

	
		<form action="payments_create.php" method="post">
			<label for="payment_date">Payment Date:</label><br>
            <input type="date" name="payment_date" /><br>

			<label for="payment_method">Payment Type</label><br>
			<select name="payment_method">
				<option value="Cash">Cash</option>
				<option value="Bank Transfer">Bank Transfer</option>
                <option value="Kpay">KPay</option>
			</select><br>

            <label for="payment_amount">Payment Amount:</label><br>
            <input type="text" name="payment_amount"/><br>

            <input type="hidden" name="id" value="<?php echo $id; ?>"/>


			<br><input type="submit" name="create" value="add payment"/>
		</form>
	</body>
</html>