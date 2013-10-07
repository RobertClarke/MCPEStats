<?

require_once($_SERVER['DOCUMENT_ROOT']."/login/libraries/password_compatibility_library.php");
require_once($_SERVER['DOCUMENT_ROOT']."/login/config/db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/login/config/hashing.php");
require_once($_SERVER['DOCUMENT_ROOT']."/login/classes/Login.php");

$login = new Login();
$Timer = MicroTime( true ); 

require_once($_SERVER['DOCUMENT_ROOT'].'/MinecraftQuery_Simple.php');


function display_r_t($name, $ip, $players, $maxplayers, $onlinestatus, $port, $customname, $whitelist, $id)
{
	echo "<tr>";
	if($onlinestatus == "Online")
          	echo "<td><a href=/server/$id>$name</a></td>";
        else
        	echo "<td>$name</td>";
        	
        echo "<td>$customname</td>";
        
        if($whitelist == 0)
          	echo '<td><span class="label label-success">Public</span></td>';
          else if($whitelist == 1)//Whitelist
          	echo '<td><span class="label label-important">Whitelisted</span></td>';
          else if($whitelist == 2)//Registdation
          	echo '<td><span class="label label-warning">Registdation</span></td>';
          else
          	echo '<td><span class="label label-important">Unknown</span></td>';
        
        echo "
          <td>$ip:$port</td>
          <td>$players/$maxplayers</td><td>";
          if($onlinestatus == "Online")
          	echo '<span class="label label-success">';
          else if($onlinestatus == "Offline")
          	echo '<span class="label label-important">';
          else
          	echo '<span class="label label-warning">';
          echo "$onlinestatus</td>                                         
      </tr>"; 
      
      return true;
}

function alert($string)
{
	
}




if($_POST['doserveraction']){
switch($_POST['doserveraction'])
{
	case 'remove':
		if($_SESSION['user_name'] == $_POST['UserName'])
		{
			$data = removeServer($_SESSION['user_name'], $_POST['IP'], $_POST['Port'], $login, $_POST['id']);
		}
		else
		{
			$data = 'Username Verification Error. You have been logged for a possible abuse.';
		}
		
		if($data === true)
		{
			header( 'Location: /manage.php?serveractionr=true') ;
		}
		else
		{
			header( 'Location: /manage.php?serveractionr='.$data) ;
		}
		break;
	case 'whitelist':
		header( 'Location: /manage.php?serveractionr='."WhiteList Not Yet Available. Check back later.") ;
		//header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&action=admin");
		break;
	case 'editserverinfo':
		//header( 'Location: http://mcpe-list.sekjun9878.info/manage.php?serveractionr='."Server Edit Not Yet Available. Check back later.") ;
		header("Location: /editserverinfo.php?id=".$_POST['id']);
		break;
	default:
		$data = 'Action Unspecified. You may have been logged for directly accessing critical files.';
	//	alert('Action Unspecified. You may have been logged for directly accessing critical files.');
		header( 'Location: /manage.php?serveractionr='.$data) ;
		break;
}}

function removeServer($Owner, $IP, $Port, $login, $id)
{
	$connect = mysqli_connect("localhost","mcpestat_MCPE","J4gVuBfXSf7QwpJrEeYdR2AH");
	mysqli_select_db($connect, "mcpestat_MCPE");
	
	$Owner = mysqli_real_escape_string($connect, $Owner);
	$id = mysqli_real_escape_string($connect, $id);
	$IP = mysqli_real_escape_string($connect, $IP);
	$Port = mysqli_real_escape_string($connect, $Port);
	
	$stmt = mysqli_prepare($connect, "SELECT Owner FROM ServerList1 WHERE id=? LIMIT 0,1");
	mysqli_stmt_bind_param($stmt, "d", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $realOwner);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	
	if(in_array($_SESSION['user_name'], $login->moderators) === true)
	{
		$stmt = mysqli_prepare($connect, "DELETE FROM ServerList1 WHERE id=?");
		mysqli_stmt_bind_param($stmt, "d", $id);
	}
	else
	{
		$stmt = mysqli_prepare($connect, "DELETE FROM ServerList1 WHERE id=? AND Owner=?");
		mysqli_stmt_bind_param($stmt, "ds", $id, $Owner);
	}
	$result = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	
	if($result)
	{
		if(in_array($_SESSION['user_name'], $login->moderators) === true)
		{
			$stmt = mysqli_prepare($connect, "SELECT user_email FROM users WHERE user_name=? LIMIT 0,1");
			mysqli_stmt_bind_param($stmt, "s", $realOwner);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $result);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			
			$to = $result;
			$subject = "Minecraft PE Server List - Server Removed";


			$message = "Dear $realOwner


Your server $IP".":".$Port." has been removed from our database by a moderator / administrator.
This could be due to long time server inactivity and / or breach of our Terms of Service.
You can always resubmit your server at any time or create a support ticket.


Best Regards.
The Minecraft PE Server List Team.
			";
			$from = "noreply@mcpe-list.sekjun9878.info";


			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
		}
		else
		{
			$to = $_SESSION['user_email'];
			$subject = "Minecraft PE Server List - Server Removed";


			$message = "Dear $Owner


Your server $IP".":".$Port." has been removed from our database.
If you did not remove this server, please create a support ticket immediately as this could be a possible account breach.
You can always resubmit your server at any time or create a support ticket.


Best Regards.
The Minecraft PE Server List Team.
			";
			$from = "noreply@mcpe-list.sekjun9878.info";


			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
		}
		
		return true;
	}
	else
	{
		return "Could Not delete Server IP:".$IP.":".$Port;
	}
}

require 'MinecraftQuery.class.php';
$Query = new MinecraftQuery( );
?>