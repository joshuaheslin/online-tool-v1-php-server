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


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- if uncommented it's not required and should be deleted before deployment-->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>
<body>


<div class="navbar" role="navigation">

  <span>KAS Online Tool</span>

  <div class="dropdown btn-group">

    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Account
    </button>

    <div class="dropdown-menu dropdown-menu-right">
      <h6 class="dropdown-header">App Account: <?php echo $app_account;?></h6>
      <h6 class="dropdown-header">Property Name: <?php echo $_SESSION['property_name'];?></h6>
      <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
    </div>

  </div>


</div>


<div class="my-table-layout">
  <!-- <h1>KAS Online Tool</h1> -->
  <br>
