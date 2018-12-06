<?php
   include("includes/sqlconn.php");
   session_start();

   $conn = connect();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($conn,$_POST['name']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

      $sql = "SELECT * FROM users WHERE appaccount = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      $name = $row['property_name'];
      $timezone_sql = $row['timezone'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1 && $active == 1) {

         $_SESSION['login_user'] = $myusername;

         $_SESSION['property_name'] = $name;

         $_SESSION['timezone'] = $timezone_sql;

         header("Location: index.php");

      } else {
         $error = "Your APP Account or Password is invalid, Please enter APP Account and APP password as set from KAS Lock-S Software";
         echo '<br><br><div class="container"><header><h4 style="color:red">'. $error.'</h4></header></div>';
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>KAS Online Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<script>
$(document).ready(function() {
  //alert("doc loaded");
    $('#spinner').hide();
});
</script>

<body>

<div class="navbar" role="navigation">

  <span>KAS Online Tool</span>

</div>

<div class="container">
  <!-- <h1>KAS Online Tool</h1> -->
  <br>
  <div class="col-md-6">
    <div class="jumbotron">
      <!-- <h1 class="display-4">Login</h1> -->
      <p class="lead">Log in to KAS Online Tool</p>
      <hr class="my-4">

      <form method="post" action="">
          <div class="col-md-6">
            <input class="form-control" type="text" name="name" id="name" value="" placeholder="APP Account" required/>
            <br>
            <input class="form-control" type="password" name="password" id="password" value="" placeholder="Password" required/>
          </div>
          <br>
          <p>Please note: Login may take some time. After login, all lock data will be loaded.</p>
          <input class="btn btn-primary btn-md" type="submit" value="Log in" onclick="showSpinner()"/>
      </form>
      <br>
      <div class="loader" id="spinner"></div>

      <!-- <p class="lead">
        <a class="btn btn-primary btn-md" href="#" role="button">Learn more</a>
      </p> -->
    </div>
  </div>

  <!-- <a href="main.php">Go to main</a> -->


</div>


<script>
function showSpinner(){
  //alert("clicked");
  $('#spinner').show();
}
</script>

</body>
</html>
