<?php 
require_once('connect.php');
	$upc = $_GET['upc'];
	
if(isset($_GET['upc']))
{
	
	$sql = "DELETE FROM stocked_product WHERE upc = $upc";
	if ($conn->query($sql) === TRUE) {
	header("Location: stock.php");
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}
?>