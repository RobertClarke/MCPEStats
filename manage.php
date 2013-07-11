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
$login = new Login();

function display_r_t($name, $ip, $players, $maxplayers, $onlinestatus, $port, $customname, $id)
{
	echo "<tr>";
	if($onlinestatus == "Online")
          	echo "<th><a href=/detail.php?id=$id>$name</a></th>";
        else
        	echo "<th>$name</th>";
        	
        echo "<th>$customname</th>";
        
        echo "
          <th>$ip:$port</th>
          <th>$players/$maxplayers</th><th>";
          if($onlinestatus == "Online")
          	echo '<span class="label label-success">';
          else if($onlinestatus == "Offline")
          	echo '<span class="label label-important">';
          else
          	echo '<span class="label label-warning">';
          echo "$onlinestatus</th></span>";
                            
          echo "<th><form name='input' action='manage.data.php' method='post'>";
          echo "<input type='hidden' name='doserveraction' id='doserveraction' value='remove' />";
          echo "<input type='hidden' name='UserName' id='UserName' value='".$_SESSION['user_name']."' />";
          echo "<input type='hidden' name='id' id='id' value='$id' />";
          echo "<input type='hidden' name='IP' id='IP' value='$ip' />";
          echo "<input type='hidden' name='Port' id='Port' value='$port' />";
          echo "<button title='Remove Server' class='btn btn-danger'></button></th>";
          echo "</form>"; 
          
          echo "<th><form name='input' action='manage.data.php' method='post'>";
          echo "<input type='hidden' name='doserveraction' id='doserveraction' value='editserverinfo' />";
          echo "<input type='hidden' name='UserName' id='UserName' value='".$_SESSION['user_name']."' />";
          echo "<input type='hidden' name='id' id='id' value='$id' />";
          echo "<input type='hidden' name='IP' id='IP' value='$ip' />";
          echo "<input type='hidden' name='Port' id='Port' value='$port' />";
          echo "<button title='Edit Server Info' class='btn btn-success'></button></th>";
          echo "</form>"; 
          
          echo "<th><form name='input' action='manage.data.php' method='post'>";
          echo "<input type='hidden' name='doserveraction' id='doserveraction' value='whitelist' />";
          echo "<input type='hidden' name='UserName' id='UserName' value='".$_SESSION['user_name']."' />";
          echo "<input type='hidden' name='id' id='id' value='$id' />";
          echo "<input type='hidden' name='IP' id='IP' value='$ip' />";
          echo "<input type='hidden' name='Port' id='Port' value='$port' />";
          echo "<button title='Manage Whitelist' class='btn btn-success'></button></th>";
          echo "</form>"; 
                                         
      echo "</tr>";
      
      return true;
}
?>
    <div class="container">
    	<div class="page-header">
    <?
    if ($login->isUserLoggedIn() == true) {
	include("login/views/logged_in.php");
}
else
{
	include("login/views/not_logged_in.php");
	exit();
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
		</div>
<h2>Manage your servers</h2>
<table class="table table-striped table-condensed">
	  <thead>
      <tr>
          <th>Name</th>
          <th>Owner</th>
          <th>Server IP : Port</th>
          <th>Players / MaxPlayers</th>
          <th>Status</th>         
          <th>Actions</th>                                  
      </tr>
  </thead>   
  <tbody>
<?
//shuffle($data);

function isCustomName($data)
{
	if(strlen($data) > 1)
		return '['.$data.']';
	else
		return '';
}


$connect = mysqli_connect("localhost","mcpestat_MCPE","q^6e?A;F?C@+");
mysqli_select_db($connect, "mcpestat_MCPE");

if(in_array($_SESSION['user_name'], $login->moderators) === true)
{
	$query = "select * from ServerList1 where '1' ORDER BY Name ASC";
}
else
{
	$query = "select * from ServerList1 where Owner='".mysqli_real_escape_string($connect, $_SESSION['user_name'])."'  ORDER BY Name ASC";
}
$result = mysqli_query($connect, $query);

	while($row = $result->fetch_assoc()){
	    display_r_t($row['Name'], $row['IP'], $row['Last_Players'], $row['Last_MaxPlayers'], $row['WhetherOnline'], $row['Port'], $row['Owner'], $row['id']);
	}
	
mysqli_close($connect);

if($_GET['serveractionr'] == 'true')
			{
				echo'
				<div class="alert alert-success">  
  <a class="close" data-dismiss="alert">×</a>  
  <strong>Success!</strong> You have successfully removed the server.
</div>  
';
}
if(isset($_GET['serveractionr']) and $_GET['serveractionr'] != 'true')
{
	echo'
		<div class="alert alert-error">  
  <a class="close" data-dismiss="alert">×</a>  
  <strong>Error!</strong> '.htmlspecialchars($_GET['serveractionr']).'
</div>  
';
}
echo "If this page is blank, try refreshing the page.";
?>

</tbody>
</table>
		<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
