<?php
	
	require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
$login = new Login();

	
	require __DIR__ . '/MinecraftQuery.class.php';
	
	$Timer = MicroTime( true );
	$Query = new MinecraftQuery( );
?>
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
    			<?
    			
function is_html($string)
{
  return preg_match("/<[^<]+>/",$string,$m) != 0;
}
 
			if ($login->isUserLoggedIn() == true) {
include("login/views/logged_in.php");
}

require_once(__DIR__.'/../constants.php'); $connect = mysqli_connect(DB_HOST, DB_NAME, DB_PASS);
mysqli_select_db($connect, "mcpestat_MCPE");

$id = strip_tags($_GET['id']);
$id = preg_replace('/\s\s+/', ' ', $id);
$id = mysqli_real_escape_string($connect, $id);

$result = array();

$stmt = mysqli_prepare($connect, "SELECT id, Name, IP, Port, Last_Players, Last_MaxPlayers, WhetherOnline, RegisteredDate, WhetherOnlineNum, Owner, WhetherWhitelisted FROM ServerList1 WHERE ID=? LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "d", $id);
mysqli_stmt_bind_result($stmt, $result['id'], $result['Name'], $result['IP'], $result['Port'], $result['Last_Players'], $result['Last_MaxPlayers'], $result['WhetherOnline'], $result['RegisteredDate'], $result['WhetherOnlineNum'], $result['Owner'], $result['WhetherWhitelisted']);
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
			
			<div class="input-append pull-right"><form name='input' action='search.php' method='post'><input type="text" id="query" name="query"><span class="add-on">Search</span><form></div>
		</div>

<?php if( isset( $Error ) ): ?>
		<div class="alert alert-info">
		<? echo '<a href=index.php><< Back</a>'; ?>
			<h4 class="alert-heading">Exception:</h4>
			<?php echo htmlspecialchars( $Error ); ?>
			<br>
			If you are getting this error, the server and the port you have chosen probably isn't online. Try choosing a different port.
		</div>
<?php else: ?>
		<div class="row">
			<div class="span6">
			<? echo '<a href=index.php><< Back</a>'; ?>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2">Server info</th>
						</tr>
					</thead>
					<tbody>
					<tr>
					<td>IP</td>
					<td><?echo htmlspecialchars($result['IP']); ?></td></tr>
					<td>Port</td>
					<td><?echo htmlspecialchars($result['Port']); ?></td></tr>
					<td>Owner</td>
					<td><?echo htmlspecialchars($result['Owner']); ?></td></tr>
					<?
	if($result['WhetherWhitelisted'] == 0)
          	echo "<td>Whitelist</td><td>Public</td></tr>";
          else if($result['WhetherWhitelisted'] == 1)//Whitelist
          	echo "<td>Whitelist</td><td>Whitelist</td></tr>";
          else if($result['WhetherWhitelisted'] == 2)//Registration
          	echo "<td>Whitelist</td><td>Registration</td></tr>";
          else
          	echo "<td>Whitelist</td><td>Unknown</td></tr>";
          	?>
<?php if( ( $Info = $Query->GetInfo( ) ) !== false ): ?>
<?php foreach( $Info as $InfoKey => $InfoValue ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $InfoKey ); ?></td>
							<td><?php
	if( Is_Array( $InfoValue ) )
	{
		foreach($InfoValue as $c)
			echo "$c<br>";
	}
	else
	{
		echo htmlspecialchars( $InfoValue );
	}
?></td>
						</tr>
<?php endforeach; ?>
<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="span6">
			<? echo "<a href=query.php?ip=".$result['IP']."&port=19131>Port 19132</a>|"."<a href=query.php?ip=".$result['IP']."&port=19133>Port 19133</a>|"."<a href=query.php?ip=".$result['IP']."&port=19134>Port 19134</a>|"."<a href=query.php?ip=".$result['IP']."&port=19135>Port 19135</a>|";?>
				<table class="table table-bordered table-striped">
					<thead>
					
						<tr>
							<th>Players</th>
						</tr>
					</thead>
					<tbody>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $Player ); ?></td>
						</tr>
<?php endforeach; ?>
<?php else: ?>
						<tr>
							<td>No players in da house!</td>
						</tr>
<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
<?php endif; ?>
		<footer>
			<? mysqli_close($connect); include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</body>
</html>
