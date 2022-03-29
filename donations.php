<?php
include('inc/connect.php');
include('inc/functions.php');

session_start();

$donation_types = getDonationTypes($conn);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>        
        <?php include("inc/nav.php"); ?>
		
        <h1>Donations</h1>
		<?php if($donation_types): ?>

			<table cellspacing="10" cellpadding="10">
				<tr>
					<th>Type</th>
					<th>Venue</th>
					<th>Price</th>
                    <th>Action</th>				
				</tr>

				<?php foreach($donation_types as $donation_type): ?>
				<tr>
					<td><a href="donation_types_single.php?id=<?php echo $donation_type['id']; ?>"><?php echo $donation_type['type']; ?></a></td>
					<td><?php echo $donation_type['venue']; ?></td>
					<td><?php echo $donation_type['price']; ?></td>
					<td>
						<a href="donation_form.php?id=<?php echo $donation_type['id'] ?>">Make Donation</a>
						
					</td>
					
				</tr>
				<?php endforeach; ?>

			</table>

		<?php else: ?>

			<p>There are no donation types</p>

		<?php endif ?>



		
	</body>
</html>
<?php $conn->close(); ?>