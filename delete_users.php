<?php 
require_once('connect.php');
	$id = $_GET['id'];
	
if(isset($_GET['id']))
{
	
	$sql = "DELETE FROM user WHERE id = $id ";
	if ($conn->query($sql) === TRUE) {
	header("Location: users.php");
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}
?>