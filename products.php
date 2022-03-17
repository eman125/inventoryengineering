
<?php
//echo phpinfo();
require('connect.php'); //This command will use the connection information to start the process of getting data.

session_start();
 // echo $_SESSION['username'] . '<br>'. $_SESSION['password']. '<br>'; // This shows what is being passed

 
 $sqluser="SELECT `username`, `password` FROM user WHERE  access_level IN (1,2,3) AND  username  = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password']. "'";
		
$resultuser = mysqli_query($conn, $sqluser);

if ($resultuser -> num_rows > 0) {
   while ($row = $resultuser->fetch_assoc()) {

 //write query for products table

 $sqlproduct = 'SELECT upc, product_name FROM products';

 //make query & get result
 $resultproducts = mysqli_query($conn, $sqlproduct);

echo "<table border='1'>
 <tr>
 <th>UPC </th>
 <th>Product_Name</th>
 </tr>";
 
//var_dump($result); // you can use var_dump to see any results as a check

while($row = $resultproducts -> fetch_array(MYSQLI_ASSOC))
   {   
   echo "<tr>";
   echo "<td>" . $row['upc'] . "</td>";
   echo "<td>" . $row['product_name'] . "</td>";
   echo "</tr>";
   }
   echo "</table>";
     mysqli_free_result($resultproducts);
}
} else {
   echo "You are not authorized to see this page.";
}
  //clear $result from memory
  mysqli_free_result($resultuser);

  //close connection
  mysqli_close($conn);


?>
