<?php
	require_once('connect.php');
	session_start();

	//1st dimension is product, 2nd is for amount to be sold
	$upcArray = array('upc');
	$amountArray = array(0);

	//DuplicateFlag will be 1 if the same upc already exists in the cart
	$duplicateFlag = 0;

	$cart = '';
	$cartCounter = 0;
	$productName;

	// Check connection
    if ($conn -> connect_errno)
	{
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

	else if(isset($_POST['submit']))
	{
		//checks if input value is numeric before running sql query
		if(is_numeric($_POST['upc']))
		{
			$cartCounter = $_SESSION['cartCounter'];
			$upcArray = $_SESSION['upcArray'];
			$amountArray = $_SESSION['amountArray'];

			//checks if upc already exists in cart
			for($i = 0; $i < count($upcArray); $i++)
			{
				if($upcArray[$i] == $_POST['upc'])
				{
					$amountArray[$i] = $amountArray[$i] + (int)$_POST['amount'];
					$duplicateFlag = 1;
				}
			}

			if($duplicateFlag == 0)
			{
				//makes query
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
					$upcArray[$cartCounter] = $_POST['upc'];
					$amountArray[$cartCounter] = $_POST['amount'];
					$cartCounter++;
					$_SESSION['upcArray'] = $upcArray;
					$_SESSION['amountArray'] = $amountArray;
					$_SESSION['cartCounter'] = $cartCounter;

					//potentially consolidate this and line 61, and others?
					$cart = $_SESSION['cart'];
					while($row = mysqli_fetch_array($query_run))
					{
						$productName = $row['product_name'];
					}
					$cart = $cart . $productName . '<br>amount: ' . $_POST['amount'] . '<br>';
					$_SESSION['cart'] = $cart;
				}
			}
			else
			{
				$cart = '';
				$_SESSION['amountArray'] = $amountArray;

				for($i = 0; $i < count($upcArray); $i++)
				{
					$query = 'SELECT upc, on_hand, product_name FROM product WHERE upc=' . $upcArray[$i] . ';';
					$query_run = mysqli_query($conn,$query);
					while($row = mysqli_fetch_array($query_run))
					{
						$productName = $row['product_name'];
					}
					$cart = $cart . $productName . '<br>amount: ' . $amountArray[$i] . '<br>';
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
	else if(isset($_POST['checkout']))
	{
		$upcArray = $_SESSION['upcArray'];
		$amountArray = $_SESSION['amountArray'];
		$cart = '';

		for($i = 0; $i < count($upcArray); $i++)
		{
			$query = 'SELECT upc, on_hand, product_name FROM product WHERE upc=' . $upcArray[$i] . ';';
			//uses queary to get results
			$query_run = mysqli_query($conn,$query);

			while($row = mysqli_fetch_array($query_run))
			{
				$productOnHand = $row['on_hand'];
			}
			
			$productOnHand = $productOnHand - $amountArray[$i];
			$query = 'UPDATE product SET on_hand=' . $productOnHand . ' WHERE upc=' . $upcArray[$i] . ';';

			if($conn->query($query) === TRUE)
			{
				$cart = $cart . 'on hand amount of: ' . $amountArray[$i] .  ' ' . $upcArray[$i] . ' removed successfully<br>';
			}
			else
				$cart = 'Error: ' . $query . '<br>' . $conn->error;
		}

		$_SESSION['cart'] = '';
		$_SESSION['upcArray'] = array();
		$_SESSION['amountArray'] = array();
		$_SESSION['cartCounter'] = 0;
		mysqli_close($conn);
	}
	else
	{
		$_SESSION['cart'] = '';
		$_SESSION['upcArray'] = array();
		$_SESSION['amountArray'] = array();
		$_SESSION['cartCounter'] = 0;

		//close connection
        mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Checkout</title>
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
			<h3>Inventory Database: Checkout. Lookup by UPC</h3>
			<form action="" method="POST">
				<!--if type is "number", max/minlength don't work, php code checks for numeric-->
                <label>upc:</label>
				<input type="text" maxlength="13" minlength="12" name="upc" required/> <br/>
				<label>amount:</label>
				<input type="number" pattern="[0-9]" name="amount"/> <br/>
				<input type="submit" name="submit" value="Submit">
			</form>
			<form action="checkout.php" method="POST">
				<br>
				<input type="submit" name="" value="Destroy">
			</form>
        </div>

		<div style="border-style:solid;">
			<h3 style="text-align:center;">Cart</h3>
			<p><?php echo $cart; ?></p><br>
			<form action="" method="POST">
				<br>
				<input type="submit" name="checkout" value="Checkout">
			</form>
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
