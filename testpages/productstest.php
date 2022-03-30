<?php
    $user =  'root';
    $password = '';
    $dbname = 'inventoryengineering';
    $conn = new mysqli("localhost",$user,$password ,$dbname);

    // Check connection
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

    if(isset($_POST['submit'])){

        //this if(empty) is redundant since we also check in html bellow, but can later be used to check for correct formatting
        if(empty($_POST['upcVar'])){
            echo 'a upc is required <br />';
        }
        else{
            //htmlspecialchars ensures that script or code submitted into form will not run
            echo 'entered upc name: ' . htmlspecialchars($_POST['upcVar']);

            $sql = 'SELECT upc, on_hand, product_name FROM product WHERE upc=' . $_POST['upcVar'];

            //make query & get result
            $result = mysqli_query($conn, $sql);

            //fetch the resulting rows as an array
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

            //clear $result from memory
            mysqli_free_result($result);

            //close connection
            mysqli_close($conn);

            print_r($products);
        }
    }
?>

<!DOCTYPE html>
<html>

    <section class="container">
        <h4 class="center">look up upc</h4>
        <form action="productstest.php" method="POST">
        <label>upc:</label>
        <input type="text" name="upcVar" required>
        <div class="center">
            <input type="submit" name="submit" value="submit">
        </div>
        </form>
    </section>

</html>