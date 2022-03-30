<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <link href="inventory_files/main.css" rel="stylesheet">
         <link href="inventory_files/style.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
    </head>
    
    <body> 
       <div id="wrapper">
            <nav>
                <div class="navlinks">
                    <a class="logo" href="https://emmanuelhuitron.com/index.html">EH</a>
                   
<a href='login.php'>Login</a>
<a href='maint_menu.php'>Maintenance Menu</a>
                </div>
            </nav>
                    <div>

<br />
<br /><br />
<?php
require_once('connect.php');

$sql="SELECT `id`, `email`, `username`, `access_level`  FROM user";
$result = $conn -> query($sql);
// Numeric array

echo "<table  id='users'>
 <tr>
  <th>Email</th>
   <th>Username</th>
    <th>Access Level</th>
	    <th><a href='create_users.php'>Create User</a></th>
 </tr>";

while($row = $result -> fetch_array(MYSQLI_ASSOC))
   {
		echo "<tr>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['access_level'] . "</td>";
		echo "<td><a href = 'edit_users.php?id=" . $row['id'] . "'>Edit User</a></td>";
		echo "</tr>";
   }
 echo "</table>";
 // Free result set
$result -> free_result();
?>
</div>          
            <footer id="foot">
                <div class="navlinks">
                    <h4>Emmanuel Huitron, Pedro Gonzalez, Kelsey Houghton, Tracey Taylor</h4>
                    <a href="mailto:temporary@notyet.com"> temporary@notyet.com</a><br>
                    <i>Copyright © Us 2022</i>
                </div>
            </footer>
     
           
</body>
</html>