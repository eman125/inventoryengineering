
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
                   <a href="index.php">Home</a>
					<a href="login.php">Login</a>
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
require_once('connect.php');
session_start();
$_SESSION['userName'] = $_POST['userName'];
$_SESSION['userpassword'] = $_POST['userpassword'];

//echo $_SESSION['userName'] . '<br>'.$_SESSION['userpassword']. '<br>';

$sql="SELECT *  FROM user WHERE access_level IN (1,2,3,4) AND userName  = '" . $_SESSION['userName'] . "' AND   password ='" . $_SESSION['userpassword'] . "'";

$result = $conn-> query($sql);
echo "<table id='menus'>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
		
		if ($row['access_level'] == 4 )
		{ 
			echo "<tr><td><a href='users.php'>Users</a></td></tr>";
			echo "<tr><td><a href='products.php'>Products Page</a></td></tr>";
			echo "<tr><td><a href='locations.php'>Locations</a></td></tr>";
			echo "<tr><td><a href='managelocations.php'>Manage Locations</a></td></tr>";
		}
		else if($row['access_level'] == 3 )
		{
			echo "<tr><td><a href='products.php'>Products Page</a></td></tr>";
			echo "<tr><td><a href='locations.php'>Locations</a></td></tr>";
			echo "<tr><td><a href='managelocations.php'>Manage Locations</a></td></tr>";
		}
		else if($row['access_level'] == 2 )
		{
			echo"<tr><td><a href='stock.php'>Stock Page</a></td></tr>";
		}
		else if ($row['access_level'] == 1 )
		{ 
			echo"<tr><td><a href='stock.php'>Stock Page</a></td></tr>";
		}
		else
		{
			echo "<tr><td>You are not authorized to access this page.</td></tr>";
		}
    }
} else {
    echo "<tr><td>You are not authorized to access this page.</td></tr>";
}
echo '</table>';
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
     
    
</body></html>