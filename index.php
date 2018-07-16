<?php
/*
After successful login, it will display MAIN page.
*/
session_start();
include('session.php');

$app_account = $_SESSION['login_user'];
$timezone_login = $_SESSION['timezone'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>KAS Online Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

<div class="topnav">
  <h1>KAS Online Tool</h1>
</div>

<div class="container">

  <!-- <h1>KAS Online Tool</h1> -->
  <br>

  <p>App Account: <?php echo $app_account;?></p>

  <p>Property Name: <?php echo $_SESSION['property_name'];?></p>

  <button id="loggout"><a href='logout.php'>Logout</a></button>

  <div id="lockInfo"><?php require('locksInterface.php'); ?></div>


</div>

<div><?php require('footer.php'); ?></div>

</body>
</html>
