<html>
<head>
<title> Search </title>
<style>
body{
	background-color: gainsboro;
}
input{
	width: 40%;
	height: 5%;
	border: 1px;
	border-radius: 05px;
	padding: 8px 15px 8px 15px;
	margin:10px 0px 15px 0px;
	box-shadow: 1px 1px 2px 1px grey;
}
</style>
</head>
<body>
	<center>
	<h1> Inventory Database: Enter UPC number to get started </h1>
		<form action="" method="POST">
			<input type="text" name="upc"/> <br/>
			<input type="submit" name="search" value="Search">
		</form>

<?php
$dbconnection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($dbconnection,'inventoryengineering');

if(isset($_POST['search']))
{
	$upc = $_POST['upc'];

	$query = "SELECT * FROM product where upc='$upc' ";
	
	$query_run = mysqli_query($dbconnection,$query);

	while($row = mysqli_fetch_array($query_run))
	{
		?>
			<form action="" method="POST">
				<label name="upc">UPC Number:</label>
				<input type="text" name="upc" value="<?php echo $row['upc'] ?>"/><br>
				<label name="on_hand">Quantity:</label>
				<input type="text" name="on_hand" value="<?php echo $row['on_hand'] ?>"/><br>
				<label name="product_name">Product Name:</label>
				<input type="text" name="product_name" value="<?php echo $row['product_name'] ?>"/><br>
			</form>
		<?php
	}
	
}
?>

	</center>
</body>
</html>