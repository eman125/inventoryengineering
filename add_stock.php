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
            $upc= $_POST['upc'];
			$locationName= $_POST['location_name'];
			$quantity= $_POST['quantity'];
			
			$query = "INSERT INTO stocked_product (upc, location_name, quantity)
			VALUES (
			'$upc',
			'$locationName',
			'$quantity'
			)";
		
            if($conn->query($query) === TRUE)
            {
                $confirmText = "New record created successfully";
            } 
            else 
            {
                $confirmText = "Error: " . $query . "<br>" . $conn->error;
            }
		}
		else
			$confirmText = "Please enter a numeric value.";


        //close connection
        mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Add Stock</title>
	<link href="inventory_files/main.css" rel="stylesheet">
	<!--<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">-->
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
			<h3>Inventory Database: Enter UPC number, location, and quantity</h3>
			<form action="" method="POST">
				<!--if type is "number", max/minlength don't work, php code checks for numeric-->
                <label>upc:</label>
				<input type="text" maxlength="13" minlength="12" name="upc" required = "required"/> <br/>
                <label>location:</label>
                <select style="width: 178px; height: 20px; float: right;" type="text" name="location_name" required = "required" >
					<option value="Aisle 1"> Aisle 1 </option>
					<option value="Aisle 2"> Aisle 2 </option>
					<option value="Aisle 3"> Aisle 3 </option>
					<option value="Aisle 4"> Aisle 4 </option>
				</select></br>
				<label>quantity:</label>
                <input type="number" pattern="[0-9]" name="quantity" required = "required"/> <br/></br>
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
            <i>Copyright © Us 2022</i>
        </div>
    </footer>
</div>
</body></html>
