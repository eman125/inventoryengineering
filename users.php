
<?php
require('connect.php'); //This command will use the connection information to start the process of getting data.

 //write query for user table
 $sql = 'SELECT username, password, email, access_level FROM user';

 //make query & get result
 $result = mysqli_query($conn, $sql);
	
echo "<table border='1'>
 <tr>
 <th>Username </th>
 <th>Password</th>
 <th>Email</th>
 <th>Access_Level</th>
 </tr>";
 
//var_dump($result); // you can use var_dump to see any results as a check

while($row = $result -> fetch_array(MYSQLI_ASSOC))
   {   
   echo "<tr>";
   echo "<td>" . $row['username'] . "</td>";
   echo "<td>" . $row['password'] . "</td>";
   echo "<td>" . $row['email'] . "</td>";
   echo "<td>" . $row['access_level'] . "</td>";
   echo "</tr>";
   }
   echo "</table>";

  //clear $result from memory
  mysqli_free_result($result);

  //close connection
  mysqli_close($conn);


?>
