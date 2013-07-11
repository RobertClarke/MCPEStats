<?
require_once($_SERVER['DOCUMENT_ROOT']."/login/libraries/password_compatibility_library.php");
require_once($_SERVER['DOCUMENT_ROOT']."/login/config/db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/login/config/hashing.php");
require_once($_SERVER['DOCUMENT_ROOT']."/login/classes/Login.php");
$login = new Login();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Refresh" content="180">
	<title>Minecraft PE Servers</title>
	
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

require_once($_SERVER['DOCUMENT_ROOT'].'/MinecraftQuery_Simple.php');

/*function display_r_t($thead, $array)
{
	echo '<table class="table table-striped table-condensed">
	<thead>
	<tr>';
	foreach($thead as $c)
	{
		echo "<th>$c</th>";
	}
	echo '</tr>
	</thead>';
	echo '<tbody>';
	foreach($array as $key => $value)
	{
		echo '<tr>';
		echo "<th>$key</th>";
		foreach($value as $key => $value
}*/

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

  	<?require_once($_SERVER['DOCUMENT_ROOT'].'/header.php');?>

<table class="table table-striped table-condensed">
	  <thead>
      <tr>
          <th>Name</th>
          <th>Owner</th>
          <th>Whitelist</th>
          <th>Server IP : Port</th>
          <th>Players / MaxPlayers</th>
          <th>Status</th>                                         
      </tr>
  </thead>   
  <tbody>
<?
//shuffle($data);

	

$connect = mysqli_connect("localhost","mcpestat_MCPE","q^6e?A;F?C@+");
mysqli_select_db($connect, "mcpestat_MCPE");

$query = "select * from ServerList1 where WhetherOnline='Online' AND WhetherWhiteListed='0' ORDER BY rand()";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
    display_r_t(htmlspecialchars($row['Name']), htmlspecialchars($row['IP']), htmlspecialchars($row['Last_Players']), htmlspecialchars($row['Last_MaxPlayers']), htmlspecialchars($row['WhetherOnline']), htmlspecialchars($row['Port']), htmlspecialchars($row['Owner']), htmlspecialchars($row['WhetherWhitelisted']), htmlspecialchars($row['id']));
}

$query = "select * from ServerList1 where WhetherOnline='Online' AND WhetherWhiteListed='2' ORDER BY rand()";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
    display_r_t(htmlspecialchars($row['Name']), htmlspecialchars($row['IP']), htmlspecialchars($row['Last_Players']), htmlspecialchars($row['Last_MaxPlayers']), htmlspecialchars($row['WhetherOnline']), htmlspecialchars($row['Port']), htmlspecialchars($row['Owner']), htmlspecialchars($row['WhetherWhitelisted']), htmlspecialchars($row['id']));
}

$query = "select * from ServerList1 where WhetherOnline='Online' AND WhetherWhiteListed='1' ORDER BY rand()";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
    display_r_t(htmlspecialchars($row['Name']), htmlspecialchars($row['IP']), htmlspecialchars($row['Last_Players']), htmlspecialchars($row['Last_MaxPlayers']), htmlspecialchars($row['WhetherOnline']), htmlspecialchars($row['Port']), htmlspecialchars($row['Owner']), htmlspecialchars($row['WhetherWhitelisted']), htmlspecialchars($row['id']));
}

$query = "select * from ServerList1 where WhetherOnline='Offline' ORDER BY rand()";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
   display_r_t(htmlspecialchars($row['Name']), htmlspecialchars($row['IP']), htmlspecialchars($row['Last_Players']), htmlspecialchars($row['Last_MaxPlayers']), htmlspecialchars($row['WhetherOnline']), htmlspecialchars($row['Port']), htmlspecialchars($row['Owner']), htmlspecialchars($row['WhetherWhitelisted']), htmlspecialchars($row['id']));
}

$query = "select * from ServerList1 where WhetherOnline='Pending' ORDER BY rand()";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
   display_r_t(htmlspecialchars($row['Name']), htmlspecialchars($row['IP']), htmlspecialchars($row['Last_Players']), htmlspecialchars($row['Last_MaxPlayers']), htmlspecialchars($row['WhetherOnline']), htmlspecialchars($row['Port']), htmlspecialchars($row['Owner']), htmlspecialchars($row['WhetherWhitelisted']), htmlspecialchars($row['id']));
}

mysqli_close($connect);

/*include($_SERVER['DOCUMENT_ROOT']."/blog.php");*/

if(isset($_GET['serveradded']) and $_GET['serveradded'] == 'true')
			{
echo'
<div class="alert alert-success">  
  <a class="close" data-dismiss="alert">×</a>  
  <strong>Success!</strong> You have successfully added the server. Make sure you change the hostname / plugins back to normal! Please allow upto 5 minutes for the list to refresh itself.
</div>  
';
}
if(isset($_GET['serveradded']) and $_GET['serveradded'] != 'true')
{
	echo'
		<div class="alert alert-error">  
  <a class="close" data-dismiss="alert">×</a>  
  <strong>Error!</strong> '.htmlspecialchars($_GET['serveradded']).'
</div>  
';
}

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
</tbody>
</table>
		<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>