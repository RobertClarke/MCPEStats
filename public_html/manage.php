<?
require_once($_SERVER['DOCUMENT_ROOT'].'/../global.inc.php');;
include 'header.php';
require_once('constants.php');

if ($login->isUserLoggedIn() != true) {
	include("login/views/not_logged_in.php");
	exit();
}


function display_r_t2($name, $ip, $players, $maxplayers, $onlinestatus, $port, $customname, $id)
{
	echo "<tr>";
	if($onlinestatus == "Online")
          	echo "<th><a href=/detail.php?id=$id>$name</a></th>";
        else
        	echo "<th>$name</th>";
        	
        echo "<th>$customname</th>";
        
        echo "
          <th>$ip:$port</th>
			<th>";
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
<h2>Manage your servers</h2>
<?
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
?>
<table class="table table-striped table-condensed">
	  <thead>
      <tr>
          <th>Name</th>
          <th>Owner</th>
          <th>Server IP : Port</th>
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


$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
mysqli_select_db($connect, DB_NAME);

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
	    display_r_t2($row['Name'], $row['IP'], $row['Last_Players'], $row['Last_MaxPlayers'], $row['WhetherOnline'], $row['Port'], $row['Owner'], $row['id']);
	}
	
mysqli_close($connect);
?>
</tbody>
</table>
<?php

include 'footer.php';
?>