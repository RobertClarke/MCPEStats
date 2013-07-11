<?
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
?>
