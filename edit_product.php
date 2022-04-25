<?php 
require_once('connect.php');

$upc = $_POST['upc'];
 $on_hand = $_POST['on_hand'];
 $product_name = $_POST['product_name'];
 
 /**/
 $sql = "UPDATE product SET  upc = '$upc', on_hand = '$on_hand', product_name = '$product_name'
 WHERE upc = $upc ";

if ($conn->query($sql) === TRUE) {
	header("Location: products.php");
 // echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// }
?>
