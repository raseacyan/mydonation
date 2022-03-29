<?php
include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

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
		<p><a href="donation_types_list.php">Back to donation type list</a></p>


		<?php if($donation_type): ?>

		<p>
		Type: <?php echo $donation_type['type']; ?><br>
		Venue: <?php echo $donation_type['venue']; ?><br>
		Price: <?php echo $donation_type['price']; ?><br>
		Allow Personalised Text: <?php echo ($donation_type['allow_personalised_text']==1)?'yes': 'no'; ?>
		</p>
		<p><a href="donation_types_update.php?id=<?php echo $donation_type['id']; ?>">Update This</a></p>			

		<?php else: ?>

			<p>No record</p>

		<?php endif ?>



		
	</body>
</html>
<?php $conn->close(); ?>