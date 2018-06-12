<?php
   include("sqlconn.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($conn,$_POST['name']); //not sure which html parameter this takes
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

      $sql = "SELECT * FROM users WHERE appaccount = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1 && $active == 1) {

         $_SESSION['login_user'] = $myusername;

         header("Location: main.php");

      } else {
         $error = "Your APP Account or Password is invalid, Please enter APP Account and APP password as set from KAS Lock-S Software";
         echo '<br><br><div class="container"><header><h4 style="color:red">'. $error.'</h4></header></div>';
      }
   }
?>


<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>KAS ONLINE TOOL</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<!--div class="logo"><a href="index.html">KAS Online Tool<span></span></a></div>-->
				<!-- <a href="#">Logout</a> -->
			</header>

		<!-- Nav -->
			<!-- <nav id="menu">
				<ul class="links">
					<li><a href="index.html">Home</a></li>
					<li><a href="generic.html">Generic</a></li>
					<li><a href="elements.html">Elements</a></li>
				</ul>
			</nav> -->

		<!-- One -->
			<!-- <section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Sed amet nulla</p>
						<h2>Elements</h2>
					</header>
				</div>
			</section> -->

		<!-- Main -->
			<div id="main" class="container">

				<!-- Elements -->

					<h2 id="elements">Log in to the KAS Online Tool</h2>
					<div class="6u 12u$(medium)">
						<!-- Form -->
							<h3>Login</h3>

							<form method="post" action="">
								<div class="row uniform">
									<div class="6u 12u$(xsmall)">
										<input type="text" name="name" id="name" value="" placeholder="APP Account" required/>
									</div>
									<div class="6u$ 12u$(xsmall)">
										<input type="password" name="password" id="password" value="" placeholder="Password" required/>
									</div>
									<!-- Break -->

									<!-- Break -->

									<!-- Break -->

									<!-- Break -->

									<!-- Break -->
									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Log in" /></li>
										</ul>
									</div>
								</div>
							</form>
							<a href="main.php">Go to main</a>
					</div>
				</div>


	</body>

</html>
