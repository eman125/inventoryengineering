<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Users</title>
		
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="inventory_files/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="inventory_files/style.css" />
        <link href="inventory_files/main.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
    </head>
    
    <body> 
       <div id="wrapper">
            <nav>
                <div class="navlinks">
                    <a class="logo" href="https://emmanuelhuitron.com/index.html">EH</a>
					<a href='index.php'>Home</a> 
					<a href='login.php'>Login</a>
					<a href='maint_menu.php'>Maintenence Menu</a>
                </div>
            </nav>
                    <div>
				<br />
				<br />
				<br />
<?php
require_once('connect.php');

$sql="SELECT `id`, `email`, `username`, `access_level`  FROM user";
$result = $conn -> query($sql);
// Numeric array

echo "<table  id='users'>
 <tr>
  <th>Email</th>
   <th>Username</th>
    <th>Access Level</th>
	<th colspan='2'><a class='btn btn-secondary'  role='button' href = 'create_users.php'>Add Users</a></th>
 </tr>";

while($row = $result -> fetch_array(MYSQLI_ASSOC))
   {
		
		echo "<tr id='". $row['id']."'>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['access_level'] . "</td>";
		
		echo "<td><a class='btn btn-primary' href = 'edit_users.php?id=" . $row['id'] . "'>Edit</a></td>";
		echo "<td><button class='btn btn-danger btn-sm remove'>Delete</button></td>";
		echo "</tr>";
   }
 echo "</table>";
 // Free result set
$result -> free_result();
?>
</div> 

<script type="text/javascript">


    
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure you want to remove this record ?'))
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
            <footer id="foot">
                <div class="navlinks">
                    <h4>Emmanuel Huitron, Pedro Gonzalez, Kelsey Houghton, Tracey Taylor</h4>
                    <a href="mailto:temporary@notyet.com"> temporary@notyet.com</a><br>
                    <i>Copyright © Us 2022</i>
                </div>
            </footer>
     
           
</body>
</html>