<?php
	session_start();

	$user =  'root';
    $password = '';
    $dbname = 'inventoryengineering';
    $conn = new mysqli("localhost",$user,$password ,$dbname);

	//1st dimension is product, 2nd is for amount to be sold
	$upcArray = array('upc');
	$amountArray = array(0);

	$cart = '';
	$cartCounter = 0;
	$productName;

	// Check connection
    if ($conn -> connect_errno)
	{
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

	if(isset($_POST['destroy']))
	{
		session_destroy();
		$cart = '';
	}
	else if(isset($_POST['submit']))
	{
		//checks if input value is numeric before running sql query
		if(is_numeric($_POST['upc']))
		{
			$query = 'SELECT upc, on_hand, product_name FROM product WHERE upc=' . $_POST['upc'] . ';';

            //uses queary to get results
			$query_run = mysqli_query($conn,$query);

			//checks if query returned a value
			if (mysqli_num_rows($query_run)==0)
			{
				echo '<script>alert("product not found")</script>';
				$cart = $_SESSION['cart'];
			}
			else
			{
				$cartCounter = $_SESSION['cartCounter'];
				$upcArray = $_SESSION['upcArray'];

				$upcArray[$cartCounter] = $_POST['upc'];
				$_SESSION['upcArray'] = $upcArray;


				$cart = $_SESSION['cart'];
				while($row = mysqli_fetch_array($query_run))
				{
					$productName = $row['product_name'];
				}
				$cartCounter++;
				$cart = $cart . $productName . '<br>amount: ' . $_POST['amount'] . '<br>';
				$_SESSION['cart'] = $cart;
				$_SESSION['cartCounter'] = $cartCounter;

				echo '<br><br><br><br>';
				for($i = 0; $i < count($upcArray); $i++)
				{
					echo 'upc = ' . $upcArray[$i] . ' i = '. $i . ' cartCounter = ' . $cartCounter . '<br>';
				}
			}
		}
		else
		{
			echo '<script>alert("please enter numeric value")</script>';
			$cart = $_SESSION['cart'];
		}


        //close connection
        mysqli_close($conn);
	}
	else
	{
	$_SESSION['cart'] = '';
	$_SESSION['upcArray'] = array();
	$_SESSION['amountArray'] = array();
	$_SESSION['cartCounter'] = 0;
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
			<h3>Inventory Database: Checkout. Lookup by UPC</h3>
			<form action="" method="POST">
				<!--if type is "number", max/minlength don't work, php code checks for numeric-->
                <label>upc:</label>
				<input type="text" maxlength="13" minlength="12" name="upc" required/> <br/>
				<label>amount:</label>
				<input type="number" pattern="[0-9]" name="amount"/> <br/>
				<input type="submit" name="submit" value="Submit">
			</form>
			<form action="" method="POST">
				<br>
				<input type="submit" name="destroy" value="Destroy">
			</form>
        </div>

		<div style="border-style:solid;">
			<h3 style="text-align:center;">Cart</h3>
			<p><?php echo $cart; ?></p><br>
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
