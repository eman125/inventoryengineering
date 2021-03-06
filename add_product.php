<?php
require_once('connect.php');
session_start();

	//calling variables
	$confirmText = "";

	// Check connection
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

	if(isset($_POST['submit']))
	{
		//checks if input value is numeric before running sql query
		if(is_numeric($_POST['upc']))
		{
			//make string with passed values (commented out due to syntax confusion - Tracey)
            // $passedVal = '\'' . $_POST['upc'] . '\', ' . $_POST['onHand'] . ', \'' . $_POST['productName'] . '\'';
			// $query = 'INSERT INTO product (upc, on_hand, product_name) VALUES (' . $passedVal . ');';
			
			$upc= $_POST['upc'];
			$productName= $_POST['productName'];
			$onHand= $_POST['onHand'];	
			$available = $_POST['availabilityStatus'];
			
			$query = "INSERT INTO product (upc, on_hand, product_name, available)
			VALUES (
			'$upc',
			'$onHand',
			'$productName',	
			'$available'
			)";
			
			
            if($conn->query($query) === TRUE)
            {
                $confirmText = "New record created successfully.";
            } 
            else 
            {
                $confirmText = "Error: " . $query . "<br>" . $conn->error;
            }
		}
		else
			$confirmText = "please enter numeric value";


        //close connection
        mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Add Product</title>
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
			<a href='maint_menu.php'>Maintenance Menu</a>
        </div>
	</nav>

	<main id="twocolumn">
		<div id="leftcolumn">
			<h3>Inventory Database: Enter UPC number, on hand number, and name</h3>
			<form action="" method="POST">
				<!--if type is "number", max/minlength don't work, php code checks for numeric-->
                <label>UPC:</label>
				<input type="text" maxlength="13" minlength="12" name="upc" required/> <br/>
                <label>On Hand:</label>
                <input type="number" pattern="[0-9]" name="onHand" required/> <br/>
                <label>Product Name:</label>
                <input type="text" maxlength="255" name="productName" required/> <br/>
				<label>Available:</label><br/>
				<input type="radio" name="availabilityStatus" value="1">
				<label> Yes </label>
				<br/>
				<input type="radio" name="availabilityStatus" value="0">
				<label> No </label>
				<br/>
				<br/>
				<input type="submit" name="submit" value="Submit">
			</form>
        </div>

		<div>
			<h3><?php echo $confirmText; ?></h3>
		</div>
	</main>

	<footer id="foot">
        <div class="navlinks">
            <h4>Emmanuel Huitron, Pedro Gonzalez, Kelsey Houghton, Tracey Taylor</h4>
            <a href="mailto:temporary@notyet.com"> temporary@notyet.com</a><br>
            <i>Copyright ?? Us 2022</i>
        </div>
    </footer>
</div>
</body></html>
