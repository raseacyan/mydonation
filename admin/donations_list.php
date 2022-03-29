<?php
include('../inc/connect.php');
include('../inc/functions.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

$donations = getDonations($conn);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample</title>
	</head>
	<body>        
        <?php include("inc/nav.php"); ?>
		
        <h1>Donation List</h1>

		<?php if($donations): ?>

			<table cellspacing="10" cellpadding="10">
				<tr>
					<th>Date</th>
                    <th>Donation Type</th>
                    <th>Venue</th>
                    <th>Personalised Text</th>
                    <th>Option</th>
                    <th>Donar Name</th>
                    <th>Donar Phone</th>
                    <th>Donar Address</th>
                    <th>Amount</th>
                    <th>Amount paid</th>
                    <th>Balance</th>
                    <th>User Id</th>
                    <th>Created On</th>
                    <th>Action</th>
				</tr>

				<?php foreach($donations as $donation): ?>
   
				<tr>					
					<td><?php echo $donation['donation_date']; ?></td>	
                    <td><?php echo $donation['type']; ?></td>
                    <td><?php echo $donation['venue']; ?></td>				
					<td><?php echo $donation['personalised_text']; ?></td>	
                    <td><?php echo $donation['option_name']; ?></td>
                    <td><?php echo $donation['donar_name']; ?></td>
                    <td><?php echo $donation['donar_phone']; ?></td>
                    <td><?php echo $donation['donar_address']; ?></td>	
                    <td><?php echo $donation['amount']; ?></td>                    
                    <td><?php echo ($donation['payment_amount']=='')?0:$donation['payment_amount']; ?></td>
                    <td><?php echo $donation['amount'] - $donation['payment_amount']; ?></td>
                    <td><?php echo $donation['user_id']; ?></td>
                    <td><?php echo $donation['created_on']; ?></td>
                    <td><a href="payments_create.php?id=<?php echo   $donation['id'] ?>">Add Payment</a></td>
				</tr>
				<?php endforeach; ?>

			</table>

		<?php else: ?>

			<p>There are no donations</p>

		<?php endif ?>



		
	</body>
</html>
<?php $conn->close(); ?>