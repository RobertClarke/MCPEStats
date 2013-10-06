<?php 

require_once(__DIR__.'/../global.inc.php');


if(!(isset($_GET['id'])))
	exit();

require_once(__DIR__.'/../constants.php'); $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
mysqli_select_db($connect, DB_NAME);

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

$desc = $result['Name'].', '.$result['IP'].' - Minecraft Pocket Edition Server. Join now!';
$title = $result['Name'].' - Minecraft PE Server';
include 'header.php';
?>
    <?
   


try
{
		$Query->Connect($result['IP'], $result['Port'], 5 );
}
catch( MinecraftQueryException $e )
{
		$Error = $e->getMessage( );
}	

?>
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
<?php  if ($login->isUserLoggedIn() == true && $result['Owner'] == $_SESSION['user_name']) { ?><div class=thumbnail>
<a href="/?delete=<?php echo $result['id']; ?>" class="btn btn-danger">Delete this server</a>
</div>

<?php } ?>
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
<div class='thumbnail'>
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
 
<?php include 'footer.php';?>
