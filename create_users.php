<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<title>Create User</title>
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
 <form action="create_user.php" method="post"> 

<p>
 <label for="email">Email Address:</label> <input type="text" name="email" id="email">
 </p> 
 
 <p>
 <label for="username">User Name:</label> <input type="text" name="username" id="username">
 </p>  
 <p>
 <label for="password">Password:</label> <input type="text" name="password" id="password">
 </p> 
  <p>
 <label for="access_level">Access  Level:</label> <select name="access_level" id="access_level">
  <option value="1">Checkout</option>
  <option value="2">Stocker</option>
  <option value="3">Product Manager</option>
  <option value="4">Administrator</option>
  </select>
 </p> 
 
 <input type="submit" value="Submit"> </form> 
 
             <footer id="foot">
                <div class="navlinks">
                    <h4>Emmanuel Huitron, Pedro Gonzalez, Kelsey Houghton, Tracey Taylor</h4>
                    <a href="mailto:temporary@notyet.com"> temporary@notyet.com</a><br>
                    <i>Copyright © Us 2022</i>
                </div>
            </footer>
        </div>
    
</body></html>

 