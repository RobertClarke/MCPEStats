<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Refresh" content="300">
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
		
		.centered-text {
    text-align:center
}    

	</style>
</head>

<body>

<? $Timer = MicroTime( true ); 

require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
$login = new Login();

require __DIR__ . '/MinecraftQuery.class.php';
$Query = new MinecraftQuery( );
	
?>
    <div class="container">
    	<div class="page-header">
    <?
    if ($login->isUserLoggedIn() == true) {
	include("login/views/logged_in.php");
}

if(!(isset($_GET['id'])))
	exit();

$connect = mysqli_connect("localhost","mcpestat_MCPE","q^6e?A;F?C@+");
mysqli_select_db($connect, "mcpestat_MCPE");

$id = strip_tags($_GET['id']);
$id = preg_replace('/\s\s+/', ' ', $id);
$id = mysqli_real_escape_string($connect, $id);

$result = array();

$stmt = mysqli_prepare($connect, "SELECT id, Name, IP, Port, Last_Players, Last_MaxPlayers, WhetherOnline, RegisteredDate, WhetherOnlineNum, Owner, WhetherWhitelisted, Description, ServerRules FROM ServerList1 WHERE id=? LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "d", $id);
mysqli_stmt_bind_result($stmt, $result['id'], $result['Name'], $result['IP'], $result['Port'], $result['Last_Players'], $result['Last_MaxPlayers'], $result['WhetherOnline'], $result['RegisteredDate'], $result['WhetherOnlineNum'], $result['Owner'], $result['WhetherWhitelisted'], $result['Description'], $result['ServerRules']);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

try
{
		$Query->Connect($result['IP'], $result['Port'], 5 );
}
catch( MinecraftQueryException $e )
{
		$Error = $e->getMessage( );
}	

?>
			<h1>Minecraft PE Server List</h1>
            <p>is a directory for all the Minecraft PE servers running PocketMine. <br>Minecraft Pocket Realms support will be released when it is out of beta. <br>All connection between you and our server is secured by SSL issued by CloudFlare. <br>You can also register to add your own server.</p>
						
			<a href=/index.php><button class="btn btn-success">Server Index</button></a>
			<a href=/insert.php><button class="btn btn-success">Add Server</button></a>
			<a href=http://mcpelist.freshdesk.com><button class="btn btn-success">Support</button></a>
			<?
			if ($login->isUserLoggedIn() != true)
			echo '<a href=/login/index.php><button class="btn btn-success">Login / Register</button></a>';
			?>
			
			<a href=/donate.php><button class="btn btn-success">Donate / Cheap Servers</button></a>
			
			<div class="input-append pull-right"><form name='input' action='search.php' method='post'><input type="text" id="query" name="query"><span class="add-on">Search</span><form></div>
			
		</div>
		
		<?php
		if(isset($Error) or $result == 0)
		{
		?><div class='alert alert-info'>
		<a href=index.php><< Back</a>
			<h4 class='alert-heading'>Exception:</h4>
			<? echo htmlspecialchars($Error); ?>
			<br>
			If you are getting this error, the id variable probably isn't valid.</div>
			
		<footer>
		<? include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
		</footer>
	</div>
</div>
</body></html><?

		exit();
		}
		
		$Info = $Query->GetInfo( );
		$Players = $Query->GetPlayers( );
		
		function parseWhitelist($whitelist)
		{
			switch($whitelist)
			{
				case 0:
					return "<span class='label label-success'>Public</span>";
					break;
				case 1:
					return "<span class='label label-important'>Whitelisted</span>";
					break;
				default:
					return "<span class='label label-warning'>Unknown</span>";
			}
		}
		?>
<h2><? echo htmlspecialchars($result['Name']); ?></h2>

<div class='row-fluid'>
<div class='span6'>
<div class='thumbnail'>
<dl class="dl-horizontal">
<div class='centered-text'><h5>Basic Server Info</h5></div>
  <dt>Server Name</dt>
  <dd><? echo htmlspecialchars($result['Name']); ?></dd>
  <dt>Server IP</dt>
  <dd><? echo htmlspecialchars($result['IP']); ?></dd>
  <dt>Server Port</dt>
  <dd><? echo htmlspecialchars($result['Port']); ?></dd>
  <dt>Owner</dt>
  <dd><? echo htmlspecialchars($result['Owner']); ?></dd>
  <dt>Registration Date</dt>
  <dd><? echo htmlspecialchars($result['RegisteredDate']); ?></dd>
  <dt>Map</dt>
  <dd><? echo htmlspecialchars($Info['Map']); ?></dd>
  <dt>Gamemode</dt>
  <dd><? echo htmlspecialchars($Info['GameType']); ?></dd>
  <dt>Version</dt>
  <dd><? echo htmlspecialchars($Info['Version']); ?></dd>
  <dt>Software</dt>
  <dd><? echo htmlspecialchars($Info['Software']); ?></dd>
  <dt>Whitelist</dt>
  <dd><? echo parseWhitelist($result['WhetherWhitelisted']); ?></dd>
</dl>
</div>
<br><br>
<div class='thumbnail'>
<div class='row-fluid'>
<div class='centered-text span6'><h5>Plugins</h5>
  <?
  foreach($Info['Plugins'] as $p)
  {
  	echo htmlspecialchars($p)."<br>";
  }
  ?>
</div>

<div class='centered-text span6'><h5>Additional Notes</h5>
	None<br>
</div>
</div>
<br>
</div>
<br><br>
<div class=thumbnail>
<p class=text-center><b>Want to host servers like this one? <a href=/donate.php>Donate</a> and get a VPS!</b></p></div>
</div>
<div class='span6'>
<div class='thumbnail'>
<div class='centered-text'><h5>Description</h5></div>
  <p style="padding:0 19px">
  <? echo $result['Description']; ?>
  </p>
</div>
<br><br>
<div class='thumbnail'>
<div class='centered-text'><h5>Server Rules</h5></div>
  <p style="padding:0 19px">
  <? echo $result['ServerRules']; ?>
  </p>
</div>
<br><br>
<table class='table table-bordered table-striped'>
<thead>
<tr>
	<th>Players (<? echo htmlspecialchars($Info['Players'])."/".htmlspecialchars($Info['MaxPlayers']); ?>)</th>
</tr>
</thead>
<tbody>

<?
$re = 0;
foreach($Players as $p)
{
if($re == 0 or ($re %2 == 0))
{
echo "
<tr>
	<td>".htmlspecialchars($p)."</td>";
}
else
{
echo "<td>".htmlspecialchars($p)."</td>
</tr>";
}
$re++;
}
?>

</table>

</div>

</div>
<!--<hr>

<div class='row-fluid'>
	<div class='span6'>
	<b>sekjun9878: </b>Amazing Server!!!
	<hr>
	<b>sekjun9878: </b>Amazing Server!!!
	<hr>
	<b>sekjun9878: </b>Amazing Server!!!
	<hr>
	</div>
	<div class='span6'>
	  <form>
	      <div class="controls">
		  <textarea id="message" name="message" class="span12" placeholder="Your Message" rows="5"></textarea>
	      </div>
	      <div class="controls">
		  <button id="contact-submit" type="submit" class="btn btn-primary input-medium pull-right">Comment</button>
	      </div>
	  </form>
	</div>
</div>
</div>-->
<hr>
 
     <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'mcpe-list'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	<br>
	 The "Around the Web" articles above(Excluding the comments) are powered by DISQUS and is not related nor is it the opinion of sekjun9878 / Minecraft PE Server List. They are very interesting articles though, so I would appriciate it if you could take time to read the articles. They are of very high quality, I promise!


		<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
