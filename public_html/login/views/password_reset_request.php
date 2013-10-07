<!-- this is the Simple sexy PHP Login Script. You can find it on http://www.php-login.net ! It's free and open source. -->

<!-- errors & messages --->
<?php 
include $_SERVER['DOCUMENT_ROOT'].'/../global.inc.php';;
include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
        
<div class="six columns centered">
<?php

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
      <legend class="">Password Reset</legend>
    </div>
<!-- request password reset form box -->
<form method="post" action="password_reset.php" name="password_reset_form">
   
       
    <div class="control-group">
      <!-- Username -->
      <label class="control-label" >Username</label><br/>
      <div class="controls">
        <input  class="input-xlarge" type="text" name="user_name" required />
      </div>
    </div>
	<div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="request_password_reset" style="float:left;">Reset Password</button>
      </div>
    </div>
</form>
</div>

<!-- this is the Simple sexy PHP Login Script. You can find it on http://www.php-login.net ! It's free and open source. -->
<?php 
include 'footer.php';
?>