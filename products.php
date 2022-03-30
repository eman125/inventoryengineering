<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Edit User Information</title>
        <link href="inventory_files/main.css" rel="stylesheet">
         <link href="inventory_files/style.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
    </head>    
    <body> 
       <div id="wrapper">
            <nav>
                <div class="navlinks">
                    <a class="logo" href="index.php">IE</a>
                   
<a href='login.php'>Login</a>
<a href='maint_menu.php'>Maintenance Menu</a>
                </div>
            </nav>
                    <div>

<br />
<br /><br />

<?php
require_once('connect.php');
session_start();
if (isset($_SESSION['userName'])&&isset($_SESSION['userpassword']))
{

$sql="SELECT  *  FROM user WHERE access_level IN (3,4) AND username  = '" . $_SESSION['userName'] . "' AND   password = '" . $_SESSION['userpassword'] . "'";		
$result = $conn-> query($sql);
if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc())
		{	
$sqlproducts="SELECT * FROM products ";
$productsresultset = $conn-> query($sqlproducts);
echo "<table  id='products'>
		<tr>
			<th>UPC </th>
			<th>Product_Name</th>
			<th><a href='create_products.php'>Add Products</></th>
		</tr>";
while($productrow = $productsresultset -> fetch_array(MYSQLI_ASSOC))
   {
		echo "<tr>";
				echo "<td>" . $productrow['upc'] . "</td>";
				echo "<td>" . $productrow['product_name'] . "</td>";
				echo "<td>" . $productrow['on_hand'] . "</td>";
				echo "<td><a href = 'edit_products.php?id=" . $productrow['id'] . "'>Edit Product</a></td>";
		echo "</tr>";
  }
echo "</table>";

		}
		}
$result -> free_result();
}
?></div>          
            <footer id="foot">
                <div class="navlinks">
                    <h4>Emmanuel Huitron, Pedro Gonzalez, Kelsey Houghton, Tracey Taylor</h4>
                    <a href="mailto:temporary@notyet.com"> temporary@notyet.com</a><br>
                    <i>Copyright � Us 2022</i>
                </div>
            </footer>
        
</body>
</html>