<?

require __DIR__ . '/MinecraftQuery.class.php';

function updateServer(&$connect, $ip, $port)
{
	try
	{	
		$Query = new MinecraftQuery( );
		$Query->Connect($ip, $port, 5);
	}
	catch( MinecraftQueryException $e )
	{//WhetherOnlineNum 0=Online 1=Offline 2=Pending
		$query = "UPDATE ServerList1 SET WhetherOnline='Offline', WhetherOnlineNum='1', Last_Players='0' WHERE IP='".$ip."' AND Port='".$port."'";
		mysqli_query($connect, $query) or die(mysqli_error($connect));
	
	}
	
	$Info = $Query->GetInfo( );
	if($Info !== false)
	{
			$query = "UPDATE ServerList1 SET Name=\"".mysqli_real_escape_string($connect, $Info['HostName'])."\", Port='".mysqli_real_escape_string($connect, $Info['HostPort'])."', Last_Players='".mysqli_real_escape_string($connect, $Info['Players'])."', Last_MaxPlayers='".mysqli_real_escape_string($connect, $Info['MaxPlayers'])."', WhetherOnline='Online', WhetherOnlineNum='0' , GameMode='".mysqli_real_escape_string($connect, $Info['GameType'])."'WHERE IP='".$ip."' AND Port='".$port."'";
			mysqli_query($connect, $query) or die(mysqli_error($connect));
	
	}
	else
	{
		$query = "UPDATE ServerList1 SET WhetherOnline='Offline', WhetherOnlineNum='1', Last_Players='0' WHERE IP='".$ip."' AND Port='".$port."'";
		mysqli_query($connect, $query) or die(mysqli_error($connect));
	}
	unset($ip);
	unset($port);
	unset($Query);
}

//set_time_limit(300);

$connect = mysqli_connect("localhost","mcpestat_MCPE","q^6e?A;F?C@+") or die(mysqli_error($connect));
mysqli_select_db($connect, "mcpestat_MCPE") or die(mysqli_error($connect));

$server_list = array(
//TODO: Add list of servers that should be refreshed every 1 minute here
);

foreach($server_list as $c)
{
	updateServer($connect, $c[0], $c[1]);
}
mysqli_close($connect);
?>
