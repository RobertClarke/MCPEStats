<?php

require_once(__DIR__."/_libs/minecraft_includes.php");
require_once(__DIR__."/_libs/constants.php");

//set_time_limit(300);

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die(mysqli_error($connect));
mysqli_select_db($connect, DB_NAME) or die(mysqli_error($connect));

$query = "select * from ServerList1 where 1 ORDER BY rand()";

$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

while($data = mysqli_fetch_array($result))
{
	unset($Info);
	try
	{	
		$Query = new MinecraftQuery();
		$Query->Connect($data['IP'], $data['Port'], 5);
	}
	catch( MinecraftQueryException $e )
	{//WhetherOnlineNum 0=Online 1=Offline 2=Pending
		$query = "UPDATE ServerList1 SET WhetherOnline='Offline', WhetherOnlineNum='1', Last_Players='0' WHERE id=".mysqli_real_escape_string($connect, $data['id']);
		mysqli_query($connect, $query) or die(mysqli_error($connect));
	
	}
	
	$Info = $Query->GetInfo();
    $Players = $Query->GetPlayers();
	if($Info !== false)
	{
			$query = "UPDATE ServerList1 SET Name=\"".mysqli_real_escape_string($connect, $Info['HostName'])."\", Port='".mysqli_real_escape_string($connect, $Info['HostPort'])."', Last_Players='".mysqli_real_escape_string($connect, $Info['Players'])."', Last_MaxPlayers='".mysqli_real_escape_string($connect, $Info['MaxPlayers'])."', WhetherOnline='Online', WhetherOnlineNum='0', GameMode='".mysqli_real_escape_string($connect, $Info['GameType'])."', WHERE id='".$data['id']."'";
			mysqli_query($connect, $query) or die(mysqli_error($connect));
			mysqli_query($connect, "UPDATE ServerList1 SET ServerMCPEVersion='".mysqli_real_escape_string($connect, $Info['Version'])."' WHERE id='".$data['id']."'") or die(mysqli_error($connect));
			mysqli_query($connect, "UPDATE ServerList1 SET Map='".mysqli_real_escape_string($connect, $Info['Map'])."' WHERE id='".$data['id']."'") or die(mysqli_error($connect));
			mysqli_query($connect, "UPDATE ServerList1 SET GameType='".mysqli_real_escape_string($connect, $Info['GameType'])."' WHERE id='".$data['id']."'") or die(mysqli_error($connect));
			mysqli_query($connect, "UPDATE ServerList1 SET Software='".mysqli_real_escape_string($connect, $Info['Software'])."' WHERE id='".$data['id']."'") or die(mysqli_error($connect));
			mysqli_query($connect, "UPDATE ServerList1 SET Plugins='".mysqli_real_escape_string($connect, json_encode($Info['Plugins']))."' WHERE id='".$data['id']."'") or die(mysqli_error($connect));
			mysqli_query($connect, "UPDATE ServerList1 SET Players='".mysqli_real_escape_string($connect, json_encode($Players))."' WHERE id='".$data['id']."'") or die(mysqli_error($connect));
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
