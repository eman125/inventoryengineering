<!DOCTYPE html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<title>Edit Products</title>
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


$sql="SELECT  `upc`, `on_hand`, `product_name` FROM product WHERE upc = '" . $_GET['upc'] . "'";
$result = $conn -> query($sql);
// Numeric array

$_SESSION['upc'] = $_GET['upc'];

while($row = $result -> fetch_array(MYSQLI_ASSOC))
   {
 $_SESSION['upc'] = $row['upc'] ;
 $_SESSION['on_hand'] = $row['on_hand'] ;
 $_SESSION['product_name'] = $row['product_name'] ;
 
   }
 // Free result set
$result -> free_result();
?>
 <form action="edit_product.php" method="post"> 
 <table>
 <tr><td>
 <tr><td>
  <tr><td>
	
	
 <label for="upc">UPC:</label> <input type="text" name="upc" id="upc"  value="<?php echo $_SESSION['upc'];?>">
   </td></tr> <tr><td>
 
 <label for="on_hand">On Hand:</label> <input type="text" name="on_hand" id="on_hand"  value="<?php echo $_SESSION['on_hand'];?>">
   </td></tr> <tr><td>
 <label for="product_name">Product Name:</label> <input type="text" name="product_name" id="product_name"  value="<?php echo $_SESSION['product_name'];?>">
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

 