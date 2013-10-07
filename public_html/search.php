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

	</style>
</head>

<body>

<? $Timer = MicroTime( true ); 

require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
require_once('constants.php');
$login = new Login();

function display_r_t($name, $ip, $players, $maxplayers, $onlinestatus, $port, $customname, $whitelist, $id)
{
	echo "<tr>";
	if($onlinestatus == "Online")
          	echo "<th><a href=detail.php?id=$id>$name</a></th>";
        else
        	echo "<th>$name</th>";
        	
        echo "<th>$customname</th>";
        
        if($whitelist == 0)
          	echo '<th><span class="label label-success">Public</span></th>';
          else if($whitelist == 1)//Whitelist
          	echo '<th><span class="label label-important">Whitelisted</span></th>';
          else if($whitelist == 2)//Registration
          	echo '<th><span class="label label-warning">Registration</span></th>';
          else
          	echo '<th><span class="label label-important">Unknown</span></th>';
        
        echo "
          <th>$ip:$port</th>
          <th>$players/$maxplayers</th><th>";
          if($onlinestatus == "Online")
          	echo '<span class="label label-success">';
          else if($onlinestatus == "Offline")
          	echo '<span class="label label-important">';
          else
          	echo '<span class="label label-warning">';
          echo "$onlinestatus</th>                                         
      </tr>"; 
      
      return true;
}
?>
    <div class="container">
    	<div class="page-header">
    <?
    if ($login->isUserLoggedIn() == true) {
	include("login/views/logged_in.php");
}

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
mysqli_select_db($connect, DB_NAME);

$query = strip_tags($_POST['query']);
$query = preg_replace('/\s\s+/', ' ', $query);
$query = mysqli_real_escape_string($connect, $query);

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
			
			<div class="input-append pull-right"><form name='input' action='search.php' method='post'><input type="text" id="query" name="query" placeholder=<? echo $query; ?>><span class="add-on">Search</span><form></div>
			
		</div>
<h2>Search</h2>
<table class="table table-striped table-condensed">
	  <thead>
      <tr>
          <th>Name</th>
          <th>Owner</th>
          <th>Server IP : Port</th>
          <th>Players / MaxPlayers</th>
          <th>Status</th>                                          
      </tr>
  </thead>   
  <tbody>
<?
//shuffle($data);

$query = "SELECT * FROM ServerList1 WHERE Name LIKE '%".$query."%' OR IP LIKE '%".$query."%' OR Owner LIKE '%".$query."%' ORDER BY WhetherOnline DESC";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
    display_r_t(htmlspecialchars($row['Name']), htmlspecialchars($row['IP']), htmlspecialchars($row['Last_Players']), htmlspecialchars($row['Last_MaxPlayers']), htmlspecialchars($row['WhetherOnline']), htmlspecialchars($row['Port']), htmlspecialchars($row['Owner']), htmlspecialchars($row['WhetherWhitelisted']), htmlspecialchars($row['id']));
}


mysqli_close($connect);
?>

</tbody>
</table>
		<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
