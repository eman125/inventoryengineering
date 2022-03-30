<?php
//$localhost = '192.168.0.151';
$user =  'root';
$password = '';
$dbname = 'inventoryengineering';
$conn = new mysqli("localhost",$user,$password ,$dbname);

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}


?>