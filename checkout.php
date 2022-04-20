<?php
	session_start();

	$user =  'root';
    $password = '';
    $dbname = 'inventoryengineering';
    $conn = new mysqli("localhost",$user,$password ,$dbname);

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
				if($duplicateFlag == 0)
				{
					$upcArray[$cartCounter] = $_POST['upc'];
					$amountArray[$cartCounter] = $_POST['amount'];
					$cartCounter++;
				}
				$_SESSION['upcArray'] = $upcArray;
				$_SESSION['amountArray'] = $amountArray;


				$cart = $_SESSION['cart'];
				while($row = mysqli_fetch_array($query_run))
				{
					$productName = $row['product_name'];
				}

				$cart = $cart . $productName . '<br>amount: ' . $_POST['amount'] . '<br>';
				$_SESSION['cart'] = $cart;
				$_SESSION['cartCounter'] = $cartCounter;

				echo '<br><br><br><br>';
				for($i = 0; $i < count($upcArray); $i++)
				{
					echo 'upc = ' . $upcArray[$i] . ' total in cart = ' . $amountArray[$i] . ' i = '. $i . ' cartCounter = ' . $cartCounter . '<br>';
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
				$cart = $cart . '<br>On hand amount removed successfully<br>query: ' . $query;
			}
			else
				$cart = 'Error: ' . $query . '<br>' . $conn->error;
		}

		session_destroy();
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
            <i>Copyright © Us 2022</i>
        </div>
    </footer>
</div>
</body></html>
