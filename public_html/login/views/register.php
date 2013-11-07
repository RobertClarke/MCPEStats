<?php 
include '../../global.inc.php';
include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>

		<?$Timer = MicroTime( true ); 
		// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo "<div class='alert alert-error'>  
  <a class='close' data-dismiss='alert'>×</a>  
  <strong>Error!</strong> $error
</div>";    
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo "<div class='alert alert-success'>  
  <a class='close' data-dismiss='alert'>×</a>  
  <strong>Success!</strong> $message
</div>";    
    }
}
?>

<form class="form-horizontal" name="registerform" action='register.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Register</legend>
    </div>
	<div class="six columns">
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="login_input_username">Username</label>
      <div class="controls">
        <input id="login_input_username" class="input-xlarge" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
      </div>
    </div>
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="login_input_email">Email</label>
      <div class="controls">
        <input id="login_input_email" class="input-xlarge" type="email" name="user_email" required />
        <br><b>Must be a valid email!</b>
      </div>
    </div>
    </div>
	<div class="six columns">
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="login_input_password_new">Password</label>
      <div class="controls">
        <input id="login_input_password_new" class="input-xlarge" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />  
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="login_input_password_repeat">Repeat Password</label>
      <div class="controls">
        <input id="login_input_password_repeat" class="input-xlarge" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />        
      </div>
    </div>
 
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="register" >Register</button>
      </div>
    </div>
	</div>
  </fieldset>
</form>


<!-- this is the Simple sexy PHP Login Script. You can find it on http://www.php-login.net ! It's free and open source. -->
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>

