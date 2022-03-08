<?php
    $user = 'root';
    $pass = '';
    $db = 'inventoryengineering';

    //connect to database
    $conn = mysqli_connect('localhost', $user, $pass, $db);

    //check connection. NOT WORKING. If successful, $conn returns true
    if(!$conn){ // dot . is for concatenation
        echo 'Connection error: ' . mysqli_connect_error();
    }

    //write query for product table
    $sql = 'SELECT upc, on_hand, product_name FROM product';

    //make query & get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as an array
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    //clear $result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    print_r($products);

    //$dbconnection = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
    //echo "Connection echo line";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Manager</title>
</head>

<body>
    <h1>Connected to database as</h1>
    <div><?php echo 'user = ', $user, '<br>database = ', $db; ?></div>
</body>
</html>