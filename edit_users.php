<!DOCTYPE html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<title>Edit User Information</title>
			<link href="inventory_files/main.css" rel="stylesheet">
			 <link href="inventory_files/style.css" rel="stylesheet">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial scale=1.0">
    </head>    
    <body> 
       <div id="wrapper">
            <div id="wrapper">
            <nav>
                <div class="navlinks">
                    <a class="logo" href="index.php">IE</a>
                    <a href="index.php">Home</a>
					<a href="login.php">Login</a>
					<a href='maint_menu.php'>Maintenance Menu</a>
                </div>
            </nav>
	<div>
<br />
<br />
<br />

<?php
require_once('connect.php');
//var_dump($conn);


$sql="SELECT  `email`, `username`, `password`, `access_level` FROM user WHERE id = '" . $_GET['id'] . "'";
$result = $conn -> query($sql);
// Numeric array

$_SESSION['id'] = $_GET['id'];

while($row = $result -> fetch_array(MYSQLI_ASSOC))
   {
 $_SESSION['email'] = $row['email'] ;
 $_SESSION['username'] = $row['username'] ;
 $_SESSION['password'] = $row['password'] ;
 $_SESSION['access_level'] = $row['access_level'];
 
   }
 // Free result set
$result -> free_result();
?>
 <form action="edit_user.php" method="post"> 
 <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id'];?>">
 <table>
 <tr><td>
 <tr><td>
  <tr><td>
	
	
 <label for="email">Email Address:</label> <input type="text" name="email" id="email"  value="<?php echo $_SESSION['email'];?>">
   </td></tr> <tr><td>
 
 <label for="username">User Name:</label> <input type="text" name="username" id="username"  value="<?php echo $_SESSION['username'];?>">
   </td></tr> <tr><td>
 <label for="password">Password:</label> <input type="text" name="password" id="password"  value="<?php echo $_SESSION['password'];?>">
   </td></tr> <tr><td> <label for="access_level">Access  Level:</label> <select name="access_level" id="access_level" >
  <option value="1"> 1 </option>
  <option value="2"> 2 </option>
  <option value="3"> 3 </option>
  <option value="4"> 4 </option>
  </select>
   </td></tr> <tr><td>
 
<input type="submit" value="Submit"> </td></tr> </table></form> 

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

 