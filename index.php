<?php
require_once "pdo.php";
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mixie - Autos Database</title>
        <?php require_once "bootstrap.php"; ?>
    </head>
    <body>
        <div class="container">
            <h1>Welcome to Autos Database</h1>
            <?php
                if (! isset($_SESSION['email'])) {

            ?>
                <a href="login.php">Please log in</a>
                <p>
                    Attempt to go to <a href="add.php">add data</a> without logging in - it should fail with an error message.
                </p>
            <?php
                } else {
                if ( isset($_SESSION['error']) ) {
                    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                    unset($_SESSION['error']);
                }

                if ( isset($_SESSION['success']) ) {
                    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                    unset($_SESSION['success']);
                }


                echo('<table border="1">'."\n");
                $stmt = $pdo->query("SELECT auto_id, make, model, year, mileage FROM autos");
                if ($stmt->rowCount() == 0) {
                    echo "No rows found";
                } else {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo ("<thead><tr>");
                    echo ("<th>Make</th>");
                    echo ("<th>Model</th>");
                    echo ("<th>Year</th>");
                    echo ("<th>Mileage</th>");

                    echo "<tr><td>";
                    echo(htmlentities($row['make']));
                    echo "</td><td>";
                    echo(htmlentities($row['model']));
                    echo("</td><td>");
                    echo(htmlentities($row['year']));
                    echo("</td><td>");
                    echo(htmlentities($row['mileage']));
                    echo("</td><td>");
                    echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> / ');
                    echo('<a href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
                    echo("</td></td>\n");
                }
            }

            }
            ?>
            </table>
            <p>
                <a href="add.php">Add New Entry</a>
                <a href="logout.php">Logout</a>
            </p>
        </div>
    </body>
</html>