<?php
   include("sqlconn.php");
   session_start();

   $conn = connect('localhost','user','','mydb');

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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="topnav">
  <h1>KAS Online Tool</h1>
</div>

<div class="container">
  <!-- <h1>KAS Online Tool</h1> -->

  <h3>Login</h3>

  <form method="post" action="">
    <div class="row uniform">
      <div class="6u 12u$(xsmall)">
        <input type="text" name="name" id="name" value="" placeholder="APP Account" required/>
      </div>
      <br>
      <div class="6u$ 12u$(xsmall)">
        <input type="password" name="password" id="password" value="" placeholder="Password" required/>
      </div>
      <br>
      <div class="12u$">
          <input type="submit" value="Log in" />
      </div>
      <p>Please note: Login may take some time</p>
    </div>
  </form>
  <!-- <a href="main.php">Go to main</a> -->


</div>

</body>
</html>
