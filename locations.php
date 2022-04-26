<!DOCTYPE html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<title>Locations</title>
			<link href="inventory_files/main.css" rel="stylesheet">
			 <link href="inventory_files/style.css" rel="stylesheet">
			 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial scale=1.0">
    </head>
    
    <body> 
       <div id="wrapper">
            <nav>
                <div class="navlinks">
                    <a class="logo" href="index.php">IE</a>
					<a href="login.php">Login</a>
					<a href='maint_menu.php'>Maintenance Menu</a>
                </div>
            </nav>
                    <div>

</head> 
<body>
<br />
<br />
<br />
<br />

<?php
require('connect.php'); //This command will use the connection information to start the process of getting data.

 //write query for location table
 $sqllocation = 'SELECT * FROM location';

 //make query & get result
 $result = mysqli_query($conn, $sqllocation);
 $resultset = $conn-> query($sqllocation);

echo "<table border='1'>
 <tr>
	<th>Location_Name</th>
	<th><a class='btn btn-secondary'  role='button' href = ''>Add Location</></th>
 </tr>";
 
//var_dump($result); // you can use var_dump to see any results as a check

while($locationrow = $resultset -> fetch_array(MYSQLI_ASSOC))
   {   
   echo "<tr>";
		echo "<td>" . $locationrow['location_name'] . "</td>";
		echo "<td><a class='btn btn-primary' href = '" . $locationrow['location_name'] . "'>Edit Location</a></td>";
		echo "<td><button class='btn btn-danger btn-sm remove'>Delete</button></td>";
   echo "</tr>";
   }
   echo "</table>";

  //clear $result from memory
  mysqli_free_result($result);

  //close connection
  mysqli_close($conn);


?>
