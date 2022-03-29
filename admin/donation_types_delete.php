<?php

include('../inc/connect.php');

session_start();
if(!isAdminLoggedIn()){
	redirectTo("login.php");
}

$id = isset($_REQUEST['id'])? $_REQUEST['id']: 0;

// sql to delete a record
$sql = "DELETE FROM donation_types WHERE id={$id}";

if ($conn->query($sql) === TRUE) {
  header('Location:donation_types_list.php');
} else {
  echo "Error deleting record: " . $conn->error;
}