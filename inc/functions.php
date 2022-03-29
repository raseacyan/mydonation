<?php

/******************
@Helper Functions
*******************/

function display($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function redirectTo($url){
	header("location:{$url}");
}

function createRecord($table, $data, $conn){

	$columns = "";
	$values = "";
	foreach($data as $key=>$val){
		$columns .= "{$key},";
		$values .= "'{$val}',";
	}
	$columns = substr($columns, 0,-1);
	$values = substr($values, 0,-1);



	$sql = "INSERT INTO {$table} ({$columns}) 
	VALUES ({$values})";

	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
	  return $last_id;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}

function updateRecord($table, $data, $id, $conn){

	$set = "";
	foreach($data as $k=>$v){
		$set .= "`".$k."`='".$v."',";
	}
	$set = substr($set, 0,-1);


	$sql = "UPDATE {$table} set {$set} WHERE id={$id}";
	$result = $conn->query($sql);

	if ($result) {
	  return true;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;die();
	  return false;
	}
}

function deleteRecord($table, $id, $conn){
	$sql = "DELETE FROM {$table} WHERE id={$id}";	
	$result = $conn->query($sql);

	if ($result) {
	  return true;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;die();
	  return false;
	}	
}


/****************
@Login
*****************/

function checkUserExist($phone, $password, $conn){
	$sql = "SELECT `id`,`name`,`role` FROM users WHERE phone = '{$phone}' AND password='{$password}'";
    $result = $conn->query($sql);

    if($result){
    	if ($result->num_rows > 0) {
	      $data = array();
	      $row = $result->fetch_assoc();
	      $data = $row;
	      return $data;	      
	    } else {	        
	        return false;
	    }
    }else{
    	echo $conn->error;
    	return false;
    }
}

function showLoggedInUser(){	
	$username = $_SESSION['user_name'];
	echo "<p>Logged in as: {$username}</p>";
}

function isLoggedIn(){
	if(isset($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}
}

function isAdminLoggedIn(){
	if(isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
		return true;
	}else{
		return false;
	}
}

/******************
@Donation Types
*******************/

function getDonationTypes($conn){	
	$sql = "SELECT * FROM donation_types";
	$result = $conn->query($sql);

	$data = array();
	if ($result->num_rows > 0) { 
	  while($row = $result->fetch_assoc()) {
	    array_push($data, $row);
	  }
	} 

	return $data;
}

function getDonationTypeById($id, $conn){
	$sql = "SELECT * FROM donation_types WHERE id={$id}";
	$result = $conn->query($sql);
	
	$data;
	if ($result->num_rows > 0) { 
	  $row = $result->fetch_assoc();
	   $data = $row;	 
	} 
	return $data;	
}


/******************
@Donation Options
*******************/

function getDonationOptions($conn){	
	$sql = "SELECT o.id, o.option_name, t.type FROM donation_options as o, donation_types as t WHERE o.donation_type_id = t.id";
	$result = $conn->query($sql);

	$data = array();
	if ($result->num_rows > 0) { 
	  while($row = $result->fetch_assoc()) {
	    array_push($data, $row);
	  }
	} 

	return $data;
}

function getDonationOptionsByDonationTypeId($id, $conn){	
	$sql = "SELECT o.id, o.option_name, t.type FROM donation_options as o, donation_types as t WHERE o.donation_type_id = t.id AND o.donation_type_id={$id}";
	$result = $conn->query($sql);

	$data = array();
	if ($result->num_rows > 0) { 
	  while($row = $result->fetch_assoc()) {
	    array_push($data, $row);
	  }
	} 

	return $data;
}


/******************
@Donation Types
*******************/

function getDonations($conn){	
	$sql = "SELECT d.id, d.donation_date, t.type, t.venue, d.personalised_text, 
	d.donar_name, d.donar_phone, d.donar_address, 
	d.personalised_text, o.option_name, 
	d.amount, sum(p.payment_amount) as payment_amount, d.user_id, d.created_on  
	FROM donations as d 
	LEFT JOIN donation_types as t
	ON d.donation_type_id = t.id  
	LEFT JOIN donation_options as o
	ON d.donation_options_id = o.id
	LEFT JOIN payments as p
	ON d.id = p.donation_id
	GROUP BY d.id

	";


	$result = $conn->query($sql);

	$data = array();
	if ($result->num_rows > 0) { 
	  while($row = $result->fetch_assoc()) {
	    array_push($data, $row);
	  }
	} 

	return $data;
}


/****************
@Users
*****************/
function getUserById($user_id, $conn){
	$sql = "SELECT * from users WHERE id={$user_id}";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			$row = $result->fetch_assoc();
			$data = $row;		
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}


function getUserNameById($user_id, $conn){
	$sql = "SELECT name from users WHERE id={$user_id}";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			$row = $result->fetch_assoc();
			$data = $row['name'];		
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}