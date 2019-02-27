<?php



?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
		function validateForm() {
    var x = document.forms["pw_reset_form"]["password"].value;
		var y = document.forms["pw_reset_form"]["confirm_password"].value;
	    if (x != y) {
	        alert("Passwords do not match. Please re-submit your password");
	        return false;
	    }
		}

</script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-sm-6">
				<br><br>
				<h4>KAS Manager App</h4>

				<h5>Reset Password</h5>

				<form name="pw_reset_form" method="post" action="https://cloud.kas.com.au/api/users/passwordSubmit" onsubmit="return validateForm()">
					<input type="hidden" type= "token" name="token" value="<?php echo $_GET['token'];?>">
                    <input type="hidden" type= "email" name="email" value="<?php echo $_GET['email'];?>">
					<p>Enter New password</p>
					<input class="form-control" required type="password" name='password' placeholder='New Password (6-20 characters)' maxlength="20" minLength="6"> <br>
					<input class="form-control" required type="password" name='confirm_password' placeholder='Confirm New Password' maxlength="20" minLength="6"> <br>
					<span id='message'> </span>
					<input class="btn btn-primary" type="submit" name="submit_password">
				</form>

		</div>
	</div>
</div>

</body>
</html>
