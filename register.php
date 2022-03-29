<?php
session_start();
include('inc/connect.php');
include('inc/functions.php');

if(isLoggedIn()){
	redirectTo("index.php");
}



if(isset($_POST['register'])){
	//senitize incoming data
	$name = $conn->real_escape_string(htmlentities(trim($_POST['name'])));	
	$phone = $conn->real_escape_string(htmlentities(trim($_POST['phone'])));
	$address = $conn->real_escape_string(htmlentities(trim($_POST['address'])));
	$password = $conn->real_escape_string(htmlentities(trim($_POST['password'])));	
	$password = md5($password);
	


	$data = array(
		'name' => $name,
		'phone' =>  $phone,
		'address' => $address,
		'password' => $password	
	);


	$table = "users";

	$result = createRecord($table, $data, $conn);

	if($result){        
		header('location:registration_success.php');
	}
	
}
$conn->close();

?>
<!DOCTYE html>
<html>
<head>
	<title>Demo</title>
</head>
<body>
	<?php include('inc/nav.php'); ?>

	<h3>User Registration</h3>

	<form action="register.php" method="post">
		<label for="name">Name</label><br>
		<input type="text" name="name"  required /><br>

		<label for="phone">Phone</label><br>
		<input type="text" name="phone"  required /><br>  

		<label for="address">Address</label><br>
		<input type="text" name="address"  required /><br>

		<label for="password">Password</label><br>
		<input type="password" name="password"  required /><br>

		

		<br>
		<input type="submit" name="register" value="submit"/>
	</form>

</body>
</html>
