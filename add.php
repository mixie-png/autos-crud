<?php
require_once "pdo.php";
session_start();

if (! isset($_SESSION['email']) ) {
    die('ACCESS DENIED');
  }

if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

if ( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage']) ) {
    if ( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1 ) {
        $_SESSION["error"] = "All fields are required"; 
        } else if ( !is_numeric($_POST['year']) && !is_numeric($_POST['mileage']) ) {
            $_SESSION["error"] = "Mileage and year must be numeric";
        } else {
            $stmt = $pdo->prepare('INSERT INTO autos (make, model, year, mileage) VALUES (:mk, :md, :yr, :mi)');
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':md' => $_POST['model'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage']));
                $_SESSION['success'] = "Record added";
                header("Location: index.php");
                return;
        }


     }

    if ( isset($_SESSION["error"]) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mixie's Automobile Tracker</title>
</head>
<body>
    <div class="container">
        <h1>Tracking Autos for <?= htmlentities($_SESSION['email']); ?></h1>
        <form method="post">
            <label for="make">Make:</label>
            <input type="text" name="make" id="make"><br/>
            <label for="make">Model:</label>
            <input type="text" name="model" id="model"><br/>
            <label for="year">Year:</label>
            <input type="text" name="year" id="year"><br/>
            <label for="mileage">Mileage:</label>
            <input type="text" name="mileage" id="mileage"><br/>
            <input type="submit" name="add" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>
</body>
</html>