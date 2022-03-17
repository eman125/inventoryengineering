<?php
session_start();
require_once('connect.php');
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
//  echo $_SESSION['username'] . '<br>'. $_SESSION['password']. '<br>'; // This shows what is being passed

$sql="SELECT `username`, `password` FROM user WHERE  access_level IN (1,2,3) AND  username  = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password']. "'";
		
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      echo "Welcome, " . $row["username"] . '<br>';
	  
		echo"<a href='insert_into.php'>Insert Page</a>". '<br>';
		echo"<a href='users.php'>Users</a>". '<br>';
		echo"<a href='products.php'>Product</a>". '<br>';
		echo"<a href='locations.php'>Locations</a>". '<br>';
		echo"<a href='stock.php'>Stock</a>". '<br>';
   }
} else {
   echo "You are not authorized to see this page.";
}

 // Free result set
$result -> free_result();


?>
