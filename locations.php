
<?php
require('connect.php'); //This command will use the connection information to start the process of getting data.

 //write query for location table
 $sql = 'SELECT location_name FROM location';

 //make query & get result
 $result = mysqli_query($conn, $sql);

echo "<table border='1'>
 <tr>
 <th>Location_Name</th>
 </tr>";
 
//var_dump($result); // you can use var_dump to see any results as a check

while($row = $result -> fetch_array(MYSQLI_ASSOC))
   {   
   echo "<tr>";
   echo "<td>" . $row['location_name'] . "</td>";
   echo "</tr>";
   }
   echo "</table>";

  //clear $result from memory
  mysqli_free_result($result);

  //close connection
  mysqli_close($conn);


?>
