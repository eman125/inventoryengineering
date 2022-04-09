<?php
	$user =  'root';
    $password = '';
    $dbname = 'inventoryengineering';
    $conn = new mysqli("localhost",$user,$password ,$dbname);

	//calling variables
	$upcVar = '';
	$onHandVar = '';
	$productNameVar = '';

	// Check connection
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

	if(isset($_POST['search']))
	{
		//checks if input value is numeric before running sql query
		if(is_numeric($_POST['upc']))
		{
			$query = 'SELECT upc, on_hand, product_name FROM product WHERE upc=' . $_POST['upc'];
		
			//uses queary to get results
			$query_run = mysqli_query($conn,$query);
			
			//checks if upc select returned any results
			if (mysqli_num_rows($query_run)==0)
			{
				$upcVar = 'No results';
			}
			else
			{
				while($row = mysqli_fetch_array($query_run))
				{
					$upcVar = $row['upc'];
					$onHandVar = $row['on_hand'];
					$productNameVar = $row['product_name'];
				}
			}

			//clear $query_run from memory
			mysqli_free_result($query_run);
		}
		else
			$upcVar = "please enter numeric value";


        //close connection
        mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Search</title>
	<link href="inventory_files/main.css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial scale=1.0">
</head>

<body>
<div id="wrapper">
	<nav>
		<div class="navlinks">
            <a class="logo" href="index.php">IE</a>
            <a href="index.php">Home</a>
			<a href="login.php">Login</a>
        </div>
	</nav>

	<main id="twocolumn">
		<div id="leftcolumn">
			<h3>Inventory Database: Enter UPC number to get started</h3>
			<form action="" method="POST">
				<!--if type is "number", max/minlength don't work, php code checks for numeric-->
				<input type="text" maxlength="13" minlength="12" name="upc"/> <br/>
				<input type="submit" name="search" value="Search">
			</form>
        </div>

		<div>
			<form action="" method="">
				<label>upc:</label>
        		<input type="text" name="upcResult" value="<?php echo $upcVar; ?>" readonly> <br>
				<label>on hand:</label>
        		<input type="text" name="onHandResult" value="<?php echo $onHandVar; ?>" readonly> <br>
				<label>product name:</label>
        		<input type="text" name="productNameResult" style="width:20em;" value="<?php echo $productNameVar; ?>" readonly> <br>
			</form>
		</div>
	</main>

	<footer id="foot">
        <div class="navlinks">
            <h4>Emmanuel Huitron, Pedro Gonzalez, Kelsey Houghton, Tracey Taylor</h4>
            <a href="mailto:temporary@notyet.com"> temporary@notyet.com</a><br>
            <i>Copyright © Us 2022</i>
        </div>
    </footer>
</div>
</body></html>
