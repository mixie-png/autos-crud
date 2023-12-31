<?php require_once "pdo.php";
// Do not put any HTML above this line
session_start();

if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to autos.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

// $failure = false;

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['email']) && isset($_POST['pass']) ) {
    unset($_SESSION['email']);  // Logout current user
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
        $_SESSION["error"] = "Email and password are required";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
            // Redirect the browser to view.php
            $_SESSION['email'] = $_POST['email'];
            header("Location: index.php");
            error_log("Login success ".$_POST['email']);
            return;
        } else {
            $_SESSION["error"] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
        }
    }
}

// Fall through into the View
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Mixie's Login Page</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Autos Database</h1>
        <h2>Please log in</h2>
        <?php
            if ( isset($_SESSION["error"]) ) {
                echo('<p style="color: red;">'.htmlentities($_SESSION["error"])."</p>\n");
                unset($_SESSION["error"]);
            }
        ?>
        <form method="POST">
            <label for="nam">User Name</label>
                <input type="text" name="email" id="nam"><br/>
            <label for="id_1723">Password</label>
                <input type="text" name="pass" id="id_1723"><br/>
                <input type="submit" value="Log In">
                <input type="submit" name="cancel" value="Cancel">
        </form>
        <p>
            For a password hint, view source and find a password hint
            in the HTML comments.
        </p>
    </div>
</body>
</html>
