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

	<form class="form-horizontal" name="user_edit_form_email" action='/login/edit.php' method="POST">
  <fieldset>
      <div id="legend">
      <legend class="">Edit your details</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="edit_input_email">New Email</label>
      <div class="controls">
         <input id="edit_input_email" class="input-xlarge" type="email" name="user_email" required /> (currently: <?php echo $_SESSION['user_email']; ?>)
      </div>
    </div> 
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="user_edit_submit_ename" >Change Email</button>
      </div>
    </div>
  </fieldset>
</form>
	<form class="form-horizontal" name="user_edit_form_password" action='/login/edit.php' method="POST">
  <fieldset>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="edit_input_password_old">Your OLD Password</label>
      <div class="controls">
        <input id="edit_input_password_old" class="input-xlarge" type="password" name="user_password_old" autocomplete="off" /> 
      </div>
    </div> 
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="edit_input_password_new">Your NEW Password</label>
      <div class="controls">
        <input id="edit_input_password_new" class="input-xlarge" type="password" name="user_password_new" autocomplete="off" />     
      </div>
    </div> 
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="edit_input_password_repeat">Repeat NEW Password</label>
      <div class="controls">
        <input id="edit_input_password_repeat" class="input-xlarge" type="password" name="user_password_repeat" autocomplete="off" /> 
      </div>
    </div> 
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="user_edit_submit_password" >Change Password</button>
      </div>
    </div>
  </fieldset>
</form>

	
	
	
	
	
	
	
	
    <footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
