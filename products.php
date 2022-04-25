<!DOCTYPE html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<title>Products</title>
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
<br />

<main id="twocolumn">
                <div id="leftcolumn">
                    <div>

<?php
require_once('connect.php');
session_start();
if (isset($_SESSION['username'])&&isset($_SESSION['userpassword']))
{

$sql="SELECT  *  FROM user WHERE access_level IN (3,4) AND username  = '" . $_SESSION['username'] . "' AND   password = '" . $_SESSION['userpassword'] . "'";		
$result = $conn-> query($sql);
if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc())
		{	
$sqlproducts="SELECT * FROM product ";
$productsresultset = $conn-> query($sqlproducts);
echo "<table  id='product'>
		<tr>
			<th>UPC </th>
			<th>Product Name</th>
			<th>On Hand</th>
			<th><a href='add_product.php'>Add Products</></th>
		</tr>";
while($productrow = $productsresultset -> fetch_array(MYSQLI_ASSOC))
   {
		echo "<tr>";
				echo "<td>" . $productrow['upc'] . "</td>";
				echo "<td>" . $productrow['product_name'] . "</td>";
				echo "<td>" . $productrow['on_hand'] . "</td>";
				echo "<td><a href = 'edit_products.php?upc=" . $productrow['upc'] . "'>Edit Product</a></td>";
		echo "</tr>";
  }
echo "</table>";

		}
		}
$result -> free_result();
}
?></div>
	<div>
	</div>
</main>
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