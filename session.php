<?php
  /*
  Session.php will verify the session, if there is no session it will redirect to login page.
  */
   //include('sqlconn.php');
   session_start();

   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($conn,"SELECT appaccount FROM users WHERE appaccount = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['appaccount'];

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>
