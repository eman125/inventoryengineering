<?php 
require_once('connect.php');

$id = $_POST['id'];
 $email= $_POST['email'];
 $username= $_POST['username'];
 $password= $_POST['password'];
 $access_level= $_POST['access_level'];
 
 /**/
 $sql = "UPDATE user SET  email = '$email', username = '$username', password = '$password', access_level = $access_level
 WHERE id = $id ";

if ($conn->query($sql) === TRUE) {
	header("Location: users.php");
 // echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// }
?>
