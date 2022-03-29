<?php

include('../inc/connect.php');
include('../inc/functions.php');

session_start();


if(isAdminLoggedIn()){
	redirectTo("index.php");
}

if(isset($_POST['login'])){
	//senitize incoming data

	$phone = $conn->real_escape_string(htmlentities(trim($_POST['phone'])));	
	$password = $conn->real_escape_string(htmlentities(trim($_POST['password'])));	
	$password = md5($password);

	$data = checkUserExist($phone, $password, $conn); 

	if($data){	
		$_SESSION['user_id'] = $data['id'];
	    $_SESSION['user_name'] = $data['name'];
        $_SESSION['user_role'] = $data['role'];
	    header('Location:index.php');  
	}else{
        echo "Login Failed";
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
    <h1>Admin Login</h1>

	<form action="login.php" method="post">	
		<label for="phone">Phone</label><br>
		<input type="text" name="phone"  required /><br>

		<label for="password">Password</label><br>
		<input type="password" name="password"  required /><br>

		


		<br><br>
		<input type="submit" name="login" value="submit"/>
	</form>

</body>
</html>