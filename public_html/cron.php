<?

require __DIR__ . '/MinecraftQuery.class.php';

//set_time_limit(300);

$connect = mysqli_connect("localhost","mcpestat_MCPE","q^6e?A;F?C@+") or die(mysqli_error($connect));
mysqli_select_db($connect, "mcpestat_MCPE") or die(mysqli_error($connect));

$query = "select * from ServerList1 where 1 ORDER BY rand()";

$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

while($data = mysqli_fetch_array($result))
{
	unset($Info);
	try
	{	
		$Query = new MinecraftQuery( );
		$Query->Connect($data['IP'], $data['Port'], 5);
	}
	catch( MinecraftQueryException $e )
	{//WhetherOnlineNum 0=Online 1=Offline 2=Pending
		$query = "UPDATE ServerList1 SET WhetherOnline='Offline', WhetherOnlineNum='1', Last_Players='0' WHERE id=".mysqli_real_escape_string($connect, $data['id']);
		mysqli_query($connect, $query) or die(mysqli_error($connect));
	
	}
	
	$Info = $Query->GetInfo( );
	if($Info !== false)
	{
			$query = "UPDATE ServerList1 SET Name=\"".mysqli_real_escape_string($connect, $Info['HostName'])."\", Port='".mysqli_real_escape_string($connect, $Info['HostPort'])."', Last_Players='".mysqli_real_escape_string($connect, $Info['Players'])."', Last_MaxPlayers='".mysqli_real_escape_string($connect, $Info['MaxPlayers'])."', WhetherOnline='Online', WhetherOnlineNum='0' , GameMode='".mysqli_real_escape_string($connect, $Info['GameType'])."'WHERE id='".$data['id']."'";
			mysqli_query($connect, $query) or die(mysqli_error($connect));
	
	}
	else
	{
		$query = "UPDATE ServerList1 SET WhetherOnline='Offline', WhetherOnlineNum='1', Last_Players='0' WHERE id=".mysqli_real_escape_string($connect, $data['id']);
		mysqli_query($connect, $query) or die(mysqli_error($connect));
	}
	unset($data);
	unset($Query);
}

$result->free();
mysqli_close($connect);
?>
