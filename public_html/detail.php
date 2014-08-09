<?php
require_once(__DIR__.'/_libs/constants.php');
require_once(__DIR__.'/_libs/minecraft_includes.php');

$Query = new MinecraftQuery();

if(!(isset($_GET['id'])))
{
	exit();
}

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
mysqli_select_db($connect, DB_NAME);

$id = strip_tags($_GET['id']);
$id = preg_replace('/\s\s+/', ' ', $id);
$id = mysqli_real_escape_string($connect, $id);

$result = array();

$stmt = mysqli_prepare($connect, "SELECT id, Name, IP, Port, Last_Players, Last_MaxPlayers, WhetherOnline, RegisteredDate, WhetherOnlineNum, Owner, WhetherWhitelisted, Description, ServerRules, ServerMCPEVersion, Map, GameType, Software FROM ServerList1 WHERE id=? LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "d", $id);
mysqli_stmt_bind_result($stmt, $result['id'], $result['Name'], $result['IP'], $result['Port'], $result['Last_Players'], $result['Last_MaxPlayers'], $result['WhetherOnline'], $result['RegisteredDate'], $result['WhetherOnlineNum'], $result['Owner'], $result['WhetherWhitelisted'], $result['Description'], $result['ServerRules'], $result['ServerMCPEVersion'], $result['Map'], $result['GameType'], $result['Software']);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$_DESCRIPTION = $result['Name'].', '.$result['IP'].' - Minecraft Pocket Edition Server. Join now!';
$_TITLE = $result['Name'].' - Minecraft PE Server';
require_once(__DIR__.'/_layout/header.php');

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

function parseOnlineStatus($x)
{
    switch($x)
    {
        case 'Online':
            return "<span class='label label-success'>Online</span>";
            break;
        case 'Offline':
            return "<span class='label label-important'>Offline</span>";
            break;
        default:
            return "<span class='label label-warning'>Pending</span>";
    }
}
		?>
<h2><?php echo htmlspecialchars($result['Name']); ?></h2>

<div class='row-fluid'>
<div class='span6'>
<div class='thumbnail'>
<dl class="dl-horizontal">
<div class='centered-text'><h5>Basic Server Info</h5></div>
  <dt>Server Status</dt>
  <dd><?php echo parseOnlineStatus($result['WhetherOnline']); ?></dd>
  <dt>Server Name</dt>
  <dd><?php echo htmlspecialchars($result['Name']); ?></dd>
  <dt>Server IP</dt>
  <dd><?php echo htmlspecialchars($result['IP']); ?></dd>
  <dt>Server Port</dt>
  <dd><?php echo htmlspecialchars($result['Port']); ?></dd>
  <dt>Owner</dt>
  <dd><?php echo htmlspecialchars($result['Owner']); ?></dd>
  <dt>Registration Date</dt>
  <dd><?php echo htmlspecialchars($result['RegisteredDate']); ?></dd>
  <dt>Map</dt>
  <dd><?php echo htmlspecialchars($result['Map']); ?></dd>
  <dt>Gamemode</dt>
  <dd><?php echo htmlspecialchars($result['GameType']); ?></dd>
  <dt>Version</dt>
  <dd><?php echo htmlspecialchars($result['ServerMCPEVersion']); ?></dd>
  <dt>Software</dt>
  <dd><?php echo htmlspecialchars($result['Software']); ?></dd>
  <dt>Whitelist</dt>
  <dd><?php echo parseWhitelist($result['WhetherWhitelisted']); ?></dd>
</dl>
</div>
<br><br>
<div class='thumbnail'>
<div class='row-fluid'>
<div class='centered-text span6'><h5>Plugins</h5>
  <?php
  foreach(json_decode($result['Plugins'], true) as $p)
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


<div class='thumbnail'><center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MCPEStats Content 1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-3736311321196703"
     data-ad-slot="7598799478"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center></div>
<br><br>
<div class='thumbnail'>
<div class='centered-text'><h5>Description</h5></div>
  <p style="padding:0 19px">
  <?php
  if($result['Description'] !== "")
  {
      echo $result['Description'];
  }
  else
  {
      echo BLANK_DESCRIPTION_MESSAGE;
  }
  ?>
  </p>
</div>
<br><br>
<div class='thumbnail'>
<div class='centered-text'><h5>Server Rules</h5></div>
  <p style="padding:0 19px">
<?php
    if($result['ServerRules'] !== "")
    {
        echo $result['ServerRules'];
    }
    else
    {
        echo BLANK_SERVER_RULES_MESSAGE;
    }
?>
  </p>
</div>
<br><br>
<div class='thumbnail'>
<table class='table table-bordered table-striped'>
<thead>
<tr>
	<th>Players (<?php echo htmlspecialchars($result['Last_Players'])."/".htmlspecialchars($result['Last_MaxPlayers']); ?>)</th>
</tr>
</thead>
<tbody>

<?php
$re = 0;
foreach(json_decode($result['Players'], true) as $p)
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
 
<?php require_once(__DIR__.'/_layout/footer.php');?>
