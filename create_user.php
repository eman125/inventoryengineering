<?php 
require_once('connect.php');
	$email= $_POST['email'];
	$username= $_POST['username'];
	$password= $_POST['password'];
	$access_level= $_POST['access_level'];

	$sql = "INSERT INTO user ( email, username, password, access_level)
	VALUES (
	'$email',
	'$username',
	'$password',
	'$access_level')";

	if ($conn->query($sql) === TRUE) {
	header("Location: users.php");
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}
$conn->close();

?>
