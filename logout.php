<?php
  /*
  Logout page is having information about how to logout from login session.
  */
   session_start();

   if(session_destroy()) {
      header("Location: login-main.php");
   }
?>
