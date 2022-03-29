<?php
include('inc/connect.php');
include('inc/functions.php');

$id = isset($_REQUEST['id'])? $_REQUEST['id']: 0;

$donation_type = getDonationTypeById($id, $conn);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>
        <?php include("inc/nav.php"); ?>
		<h1><?php echo $donation_type['type']; ?> Donation</h1>
		<p><a href="donations.php">Back to donations</a></p>


		<?php if($donation_type): ?>

		<p>
		Type: <?php echo $donation_type['type']; ?><br>
		Venue: <?php echo $donation_type['venue']; ?><br>
		Price: <?php echo $donation_type['price']; ?><br>
		Allow Personalised Text: <?php echo ($donation_type['allow_personalised_text']==1)?'yes': 'no'; ?>
		</p>
		

		<?php else: ?>

			<p>No record</p>

		<?php endif ?>



		
	</body>
</html>
<?php $conn->close(); ?>