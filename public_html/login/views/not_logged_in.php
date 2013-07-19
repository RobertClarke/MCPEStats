<?php 
include 'global.inc.php';
include 'header.php';
?>

		<?$Timer = MicroTime( true ); 
		// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo "<div class='alert alert-error'>  
  <a class='close' data-dismiss='alert'>×</a>  
  <strong>Error!</strong> $error
</div>";    
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo "<div class='alert alert-success'>  
  <a class='close' data-dismiss='alert'>×</a>  
  <strong>Success!</strong> $message
</div>";    
    }
}
?>
<div class="six columns centered">
<form class="form-horizontal" name="loginform" action="/login/index.php" method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Login</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="login_input_username">Username</label>
      <div class="controls">
        <input id="login_input_username" class="input-xlarge" type="text" name="user_name" required />
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input id="login_input_password" class="input-xlarge" type="password" name="user_password" autocomplete="off" required />
      </div>
    </div>
 
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="login" style="float:left;">Login</button>
		<a href=/login/password_reset.php class="btn btn-success" style="float:left;margin-left:15px;">Reset Password</a>
		<a href=/login/register.php class="btn btn-success" style="float:right;">Register</a>
      </div>
    </div>
  </fieldset>
  
</form>
	
</div>
<?php

	include 'footer.php';
?>
