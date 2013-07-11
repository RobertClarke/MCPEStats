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
	</div>
	<?php echo "<a href=/index.php><< Back</a><br>";?>
<form class="form-horizontal" name="loginform" action="/index.php" method="POST">
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
        <button class="btn btn-success" name="login" >Login</button>
      </div>
    </div>
  </fieldset>
</form>
	<a href=/login/register.php><button class="btn btn-success">Register</button></a>
	
	
	
	
	
	
	
	
    <footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
