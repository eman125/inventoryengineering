<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Stocked Products</title>
	<link href="inventory_files/main.css" rel="stylesheet">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="inventory_files/style.css" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial scale=1.0">
</head>

<body>
<div id="wrapper">
	<nav>
		<div class="navlinks">
            <a class="logo" href="index.php">IE</a>
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
    session_start();
    
    if (isset($_SESSION['username'])&&isset($_SESSION['userpassword']))
    {
        $sql="SELECT `username`, `password` FROM user WHERE access_level IN (1,2,4) AND username  = '" . $_SESSION['username'] . "' AND   password = '" . $_SESSION['userpassword'] . "'";		
        $result = $conn-> query($sql);

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc())
		    {	
                $sqlstock = "SELECT * FROM stocked_product";
                $stockresultset = $conn-> query($sqlstock);
                echo "<table  id='stocked_product'>
		            <tr>
		            <th>UPC</th>
		            <th>Location Name</th>
		            <th>Quantity</th>
		            <th colspan='2'><a class='btn btn-secondary'  role='button' href = 'add_stock.php'>Add Stock</a></th>
	            </tr>";
                while($stockrow = $stockresultset -> fetch_array(MYSQLI_ASSOC))
                {
		            echo "<td>" . $stockrow['upc'] . "</td>";
		            echo "<td>" . $stockrow['location_name'] . "</td>";
		            echo "<td>" . $stockrow['quantity'] . "</td>";
		            echo "<td><a class='btn btn-primary' href = 'edit_stocks.php?id=" . $stockrow['upc'] . "'>Edit</a></td>";
		            echo "<td><button class='btn btn-danger btn-sm remove'>Delete</button></td>";
		            echo "</tr>";
                }
                echo "</table>";
            }
	    }

        $result -> free_result();
    }
?>
<script type="text/javascript">    
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
               url: '',
               type: 'GET',
               data: {id: id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
        }
    });
</script>
</div>

	<footer id="foot">
        <div class="navlinks">
            <h4>Emmanuel Huitron, Pedro Gonzalez, Kelsey Houghton, Tracey Taylor</h4>
            <a href="mailto:temporary@notyet.com"> temporary@notyet.com</a><br>
            <i>Copyright ?? Us 2022</i>
        </div>
    </footer>
</div>
</body></html>
