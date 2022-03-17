
<?php
session_start();
require('connect.php'); //This command will use the connection information to start the process of getting data.

 //write query for stocked_product table
 $sql = 'SELECT upc, product_name, location_name, on_hand FROM stocked_product';

 //make query & get result
 $result = mysqli_query($conn, $sql);


 //includes access level control
$sql1 = "SELECT `username`, `password` FROM user WHERE  access_level = 1 AND username  = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password']. "'";
		
		
$result1 = mysqli_query($conn, $sql1);

if ($result1->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
	   
	   
echo "<table border='1'>
 <tr>
 <th>UPC</th>
 <th>Product_Name</th>
 <th>Location_Name</th>
 <th>On_Hand</th>
 </tr>";
 
//var_dump($result); // you can use var_dump to see any results as a check

while($row = $result -> fetch_array(MYSQLI_ASSOC))
   {   
   echo "<tr>";
   echo "<td>" . $row['upc'] . "</td>";
   echo "<td>" . $row['product_name'] . "</td>";
   echo "<td>" . $row['location_name'] . "</td>";
   echo "<td>" . $row['on_hand'] . "</td>";
   echo "</tr>";
   }
   echo "</table>";
   
}}

  //clear $result from memory
  mysqli_free_result($result);

  //close connection
  mysqli_close($conn);


?>
