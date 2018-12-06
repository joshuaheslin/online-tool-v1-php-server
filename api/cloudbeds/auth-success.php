
<?php
  // echo "AC: " . $access_token;
  // echo "RE: " . $refresh_token;
  // echo "Ex: " . $expires_in;
?>

<script type="text/javascript">
  function validateForm() {
    var x = document.forms["myForm"]["password"].value;
    var y = document.forms["myForm"]["confirm_password"].value;
    if (x != y) {
        alert("Passwords do not match. Please re-submit your password");
        return false;
    }
  }
</script>
<div class="row">
  <div class="twelve columns">
    <h4>Thanks, you're almost connected.</h4>
    <p>In order to finalise the connection, copy and paste this code into the ToolKit application. Then the tool can start connecting to your Cloudbeds account.</p>
    <p>Copy and paste this <code>code</code> into the Integration ToolKit when prompted.</p>
    <form name="myForm" action="submit-details.php" method="post" onsubmit="return validateForm()">
      <input type="hidden" type= "text" name="access_token" value="<?php echo $access_token;?>">
      <input type="hidden" type= "text" name="refresh_token" value="<?php echo $refresh_token;?>">
      <input type="hidden" type= "text" name="expires_in" value="<?php echo $expires_in;?>">
      <div class="row">
        <div class="six columns">
          <code>code</code>
          <input class="u-full-width" type="text" placeholder="code from URl should display here" value="<?php echo $code;?>" id="login_token" name="login_token">
        </div>
      </div>
    </form>
  </div>
</div>


<!-- <div class="twelve columns">
    <h4>Thanks, your Cloudbeds account is almost connected.</h4>
    <p>In order to finalise the connection, enter your details which will be used to log into the Integration Tool. Note: You can use a different email and password if you like.</p>
    <p>We provided you with a <code>login_token</code> to your original email, please enter it below to verify that it's you.</p>
    <form name="myForm" action="submit-details.php" method="post" onsubmit="return validateForm()">
      <input type="hidden" type= "text" name="access_token" value="<?php echo $access_token;?>">
      <input type="hidden" type= "text" name="refresh_token" value="<?php echo $refresh_token;?>">
      <input type="hidden" type= "text" name="expires_in" value="<?php echo $expires_in;?>">
      <div class="row">
        <div class="six columns">
          <code>login_token</code>
          <input class="u-full-width" type="text" placeholder="Paste your login_token here" id="login_token" name="login_token" required>
        </div>
      </div>
      <div class="row">
        <div class="six columns">
          <label>Email</label>
          <input class="u-full-width" type="email" placeholder="email@mailbox.com" id="email" name="email" required>
        </div>
      </div>
      <div class="row">
        <div class="six columns">
          <label>Password</label>
          <input class="u-full-width" type="password" placeholder="Enter a password" id="password" name="password" required>
        </div>
      </div>
      <div class="row">
        <div class="six columns">
          <label>Re-enter Password</label>
          <input class="u-full-width" type="password" placeholder="Re-enter password" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="six columns">
            <span id="message"></span>
        </div>
      </div>
      <label>
        <input type="checkbox">
        <span class="label-body">Send a copy to yourself</span>
      </label>
      <input class="button-primary" type="submit" value="Connect">
    </form>
  </div> -->