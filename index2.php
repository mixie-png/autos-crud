<?php
require "pdo.php";
session_start();
if ( ! isset($_SESSION['name']) ) {
   
   ?>
   <html><head>
<title>Sanaullah Sajid</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

</head>
<body data-new-gr-c-s-check-loaded="14.1058.0" data-gr-ext-installed="">
<div class="container">
<h2>Welcome to the Automobiles Database</h2>
<p><a href="login.php">Please log in</a></p>
<p>Attempt to <a href="add.php">add data</a> without logging in</p>
</div></body></html>
   <?php
   exit;
}

if(isset($_POST["logout"])){
    header('Location: index.php');
}

?>

<html><head>
<title>Sanaullah Sajid</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body >
<div class="container">
<h1>Tracking Autos for <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?></h1>

<?php
if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}

?>
<h2>Automobiles</h2>

<table border="1">
<thead><tr>
<th>Make</th>
<th>Model</th>
<th>Year</th>
<th>Mileage</th>
<th>Action</th>
</tr></thead>


<?php
$stmt = $pdo->query("SELECT * FROM autos");
while ($row = $stmt->fetch()) {

    echo '<tr><td>'.htmlentities($row["make"]).'</td><td>'.htmlentities($row["model"]).'</td><td>'.htmlentities($row["year"]).'</td><td>'.htmlentities($row["mileage"]).'</td><td><a href="edit.php?autos_id='.$row["auto_id"].'">Edit</a> / <a href="delete.php?autos_id='.$row["auto_id"].'">Delete</a></td></tr>';
}
?>
</table>

<p><a href="add.php">Add New Entry</a></p>
<p><a href="logout.php">Logout</a></p>

</div>


</body></html>