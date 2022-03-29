<?php
include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

$donation_options = getDonationOptions($conn);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>        
        <?php include("inc/nav.php"); ?>
		
        <h1>Donation Option List</h1>

		<p><a href="donation_options_create.php">Add Donation Option</a></p>


		<?php if($donation_options): ?>

			<table cellspacing="10" cellpadding="10">
				<tr>
					<th>Option Name</th>
					<th>Donation Type</th>					
                    <th>Action</th>				
				</tr>

				<?php foreach($donation_options as $donation_option): ?>
				<tr>
					<td><?php echo $donation_option['option_name']; ?></td>
					<td><?php echo $donation_option['type']; ?></td>
					<td>
						<a href="donation_options_update.php?id=<?php echo $donation_option['id'] ?>">Update</a> |
						<a href="donation_options_delete.php?id=<?php echo $donation_option['id']; ?>">Delete</a>
					</td>
					
				</tr>
				<?php endforeach; ?>

			</table>

		<?php else: ?>

			<p>There are no donation options</p>

		<?php endif ?>



		
	</body>
</html>
<?php $conn->close(); ?>