<?php
require_once(__DIR__.'/_layout/header.php');
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

    <p>To add a server to MCPEStats, enter the IP and port here. You must own the server you are trying to register. You must also own the server(s) you add to MCPEStats.</p><br>
    <p>If you don't yet have a server, you can get one from <a href="https://netherbox.com/plans.php?mcpe">NetherBox</a>.</p>
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

	include '_layout/footer.php';
?>
