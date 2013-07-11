<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Minecraft PE Server List</title>
	
	<? include($_SERVER['DOCUMENT_ROOT']."/headscript.php"); ?>
	
	<link rel="stylesheet" href="/bootstrap.css">
	<style type="text/css">
		footer {
			margin-top: 45px;
			padding: 35px 0 36px;
			border-top: 1px solid #e5e5e5;
		}
		footer p {
			margin-bottom: 0;
			color: #555;
		}
	</style>
</head>

<body>
    <div class="container">
    	<div class="page-header">
		<h1>Minecraft PE Server List</h1>
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
	</div>

<form class="form-horizontal" name="registerform" action='register.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Register</legend>
    </div>
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
        <br><b>MUST BE A VALID EMAIL ADDRESS! DOUBLE CHECK! THIS ADDRESS WILL BE USED TO SEND OUT NOTIFICATIONS!</b>
      </div>
    </div>
    
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
  </fieldset>
</form>

<!-- backlink -->
<a href="index.php"><?echo "<< ";?>Back to Login Page</a>

<!-- this is the Simple sexy PHP Login Script. You can find it on http://www.php-login.net ! It's free and open source. -->

<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
