<?php
/*
After successful login, it will display MAIN page.
*/
session_start();
include('session.php');

?>

<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>KAS Online Tool</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo">APP Account: <?php echo $_SESSION['login_user']; ?><span></span></div>
				<a href="logout.php">Logout</a>
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
						<h2>KAS Online Tool </h2>
						<p>Check gateway and lock status</p>
					</header>
				</div>
			</section> -->

		<!-- Main -->
			<div id="main" class="container">

				<!-- Elements -->

					<h2 id="elements">KAS Online Tool</h2>
					<div class="12u 12u$(medium)">
						<ul class="actions">
							<li><a href="#" class="button special">Reload All</a>   Note: this could take some time</li>
						</ul>

						<form method="post" action="#">
							<div class="row uniform">
								<div class="6u 12u$(small)">
								<input type="text" name="query" id="query" value="" placeholder="Search Query: Enter 'Lock Name' or 'Room Number' i.e UL000010 or 0101" />
								</div>
								<div class="2u$ 12u$(small)">
									<input type="submit" value="Search" class="fit small" />
								</div>
							</div>
						</form>

						<!--TABLE--->
						<header>
							<h3>Lock status</h3>
							<p></p>
						</header>
						<div class="table-wrapper">
							<table class="alt" style="margin: 0px;">
								<tbody>
									<tr>
										<td colspan="2" align="center"><b>Locks</b></td>
										<td colspan="4" align="center"><b>Gateway 1</b></td>
										<td colspan="4" align="center"><b>Gateway 2</b></td>
										<td></td>
									</tr>
								</tbody>
									<tbody>
									<tr>
										<td><b>Room Number</b></td>
										<td><b>Lock Name</b></td>
										<td><b>Name</b></td>
										<td><b>Date</b></th>
										<td><b>Signal</b></th>
										<td><b>Score</b></th>
										<td><b>Name</b></th>
										<td><b>Date</b></th>
										<td><b>Signal</b></th>
										<td><b>Score</b></th>
										<td><b>Update Row</b></th>
									</tr>
									<tr>
										<td>0101</td>
										<td>UL000200</td>
										<td>GW000012</td>
										<td>2018-06-11T10:56:31.000Z</td>
										<td>-82</td>
										<td>Y</td>
										<td>GW000020</td>
										<td>2018-06-11T10:56:31.000Z</td>
										<td>-74</td>
										<td>N</td>
										<td><a href="#" class="button alt small">Update</a></td>
									</tr>
									<tr>
										<td>0102</td>
										<td>UL000311</td>
										<td>GW000012</td>
										<td>2018-06-11T10:56:31.000Z</td>
										<td>-82</td>
										<td>Y</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><a href="#" class="button alt small">Update</a></td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>

				</div>


		<!-- No Footer -->

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
