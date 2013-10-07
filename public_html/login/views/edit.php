<?php 
include $_SERVER['DOCUMENT_ROOT'].'/../global.inc.php';;
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
<div id="legend">
      <legend class="">Edit your details</legend>
    </div>
<div class="six columns">
	<form class="form-horizontal" name="user_edit_form_email" action='/login/edit.php' method="POST">
  <fieldset>
      
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="edit_input_email">New Email</label>
      <div class="controls">
         <input id="edit_input_email" class="input-xlarge" type="email" placeholder="<?php echo $_SESSION['user_email']; ?>" name="user_email" required /> 
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
</div>
<div class="six columns">
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
</div>
<?php

	include 'footer.php';
?>
