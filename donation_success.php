<?php
include('inc/functions.php');

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>
        <?php include("inc/nav.php"); ?>
		<p>Donation form has been submitted successfully. Please pay <?php echo $_SESSION['payment_amount']; ?>mmk</p>

		<h3>Payment Information</h3>
		<p>
			KPay - Pay to xxxxxxxx
		</p>
		<p>
			Aya Banking - Pay to account number xxxxxxxx
		</p>
		
	</body>
</html>