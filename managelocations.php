<?php
    if(isset($_POST['submit'])){

        //this if(empty) is redundant since we also check in html bellow, but can later be used to check for correct formatting
        if(empty($_POST['location'])){
            echo 'a location is required <br />';
        }
        else{
            //htmlspecialchars ensures that script or code submitted into form will not run
            echo 'entered location name: ' . htmlspecialchars($_POST['location']);
        }
    }
?>

<!DOCTYPE html>
<html>

    <section class="container">
        <h4 class="center">Add a location</h4>
        <form action="managelocations.php" method="POST">
        <label>location name:</label>
        <input type="text" name="location" required>
        <div class="center">
            <input type="submit" name="submit" value="submit">
        </div>
        </form>
    </section>

</html>