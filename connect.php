<?php
    $user = 'root';
    $pass = '';
    $db = 'inventoryengineering';

    $dbconnection = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

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