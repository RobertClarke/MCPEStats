<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/../global.inc.php');;
include 'header.php';
?>

    <div id="legend">
      <legend class="">Add a server</legend>
    </div>
    
<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MCPEStats Header 2 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-3736311321196703"
     data-ad-slot="4773859071"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>

<div class="eight columns">

  <fieldset>

    <p>You must own the server you are trying to register. You MUST also set the server's host name to 'MCPEListClaimServer' during the registration process. If your server is too big(20+ players at any given time) and cannot afford to change the hostname, contact our team at the bottom to have your server manually added. Currently only PocketMine servers are accepted due the limitations of the Mojang Client.</p>
    <p>How to change the hostname:<br>
    1. Turn your server off<br>
    2. Start up your server with './start.(cmd|bat|sh) --server-name MCPEListClaimServer'<br>
    3. Register your server using the form below<br>
    4. Shut your server down<br>
    5. Turn your server back on with './start.sh' to put your hostname back to normal.<br>
    </p>
    <p>
    Alternatively you can download <a href=/MCPEListClaimServer.pmf>this dummy plugin</a> and install it on your server. Please make sure you remove this plugin after you have claimed the server to prevent your server from being claimed by others.<br>
    <br>
    Both methods will require rebooting a server due to PocketMine restrictions.
    The whole process should take about 30 seconds(Only 30 seconds! I'm sure your players will come back with a 10 seconds of donwtime!)
</div>
<div class="four columns">
	<form class="form-horizontal" action='insert.data.php' method="POST">
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">IP</label>
      <div class="controls">
        <input type="text" id="IP" name="IP" placeholder="" class="input-xlarge">
        <p class="help-block">The server IP MUST be valid and point to a running PocketMine server. You MUST enable query in PocketMine for this list to recognise your server!</p>
      </div>
    </div>
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="Port">Port</label>
      <div class="controls">
        <input type="text" id="Port" name="Port" placeholder="19132" class="input-xlarge">
        <p class="help-block">The Server Port. Default is 19132</p>
      </div>
    </div>
    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="IsWhitelisted">Whitelist</label>
      <div class="controls">
        <input type="checkbox" name="IsWhitelisted" value="value1">
        <p class="help-block">Check if your server has a whitelist.</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Add</button>
      </div>
    </div>
  </fieldset>
</form>
</div>
</div>
</div>

<?php

	include 'footer.php';
?>
