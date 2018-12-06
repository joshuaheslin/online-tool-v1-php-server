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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- if uncommented it's not required and should be deleted before deployment-->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>

<script>
function deleteDataFunction(appaccount){
  alert(appaccount);
  alert("WARNING: This will delete all 'Door Name' references. Save/screenshot the page before refreshing.")
    $.ajax({
        type: "POST",
        url: "includes/delete_stale_data.php",
        data: {
            app_account:appaccount
        },
        success: function (data){
            alert(data);
        },
        error: function (xhr, ajaxOptions, thrownError){
        }
    });
    return false;
}
</script>

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
      <a class="dropdown-item" href="" onclick="return deleteDataFunction('<?php echo $app_account; ?>')"><i class="fa fa-trash" aria-hidden="true"></i></i> Delete stale data</a>
      <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
    </div>

  </div>
</div>

<nav class="navbar navbar-dark bg-light">
  <!-- Navbar content -->

  <!-- <a class="navbar-brand">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav inline">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>

  <form class="form-inline">
    <input class="form-control mr-sm-3" id="myInput2" type="search" onkeyup="searchBar()" placeholder="Enter a search term..." aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" onclick="alert('Enter a search term in the input box. Table will automatically filter.');">Search</button>
  </form>


</nav>


<div class="my-table-layout">
  <!-- <h1>KAS Online Tool</h1> -->
  <br>
