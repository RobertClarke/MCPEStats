<?

require_once(__DIR__.'/_libs/constants.php');

function addIP($ip, $port = "19132", $username, $whitelist)
{
	$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
	mysqli_select_db($connect, DB_NAME);

	$ip = strip_tags($ip);
	$ip = preg_replace('/\s\s+/', ' ', $ip);
	$ip = mysqli_real_escape_string($connect, $ip);
	
	$port = strip_tags($port);
	$port = preg_replace('/\s\s+/', ' ', $port);
	$port = mysqli_real_escape_string($connect, $port);
	
	$whitelist = strip_tags($whitelist);
	$whitelist = preg_replace('/\s\s+/', ' ', $whitelist);
	$whitelist = mysqli_real_escape_string($connect, $whitelist);
	
	$username = mysqli_real_escape_string($connect, $username);
		
	if(substr($ip, 0, 7) == "192.168" or substr($ip, 0, 3) == "10.")
		return "The IP address you have entered is a private IP address. IP:".$ip.":".$port;

	$stmt = mysqli_prepare($connect, "SELECT id FROM ServerList1 WHERE IP=? AND PORT=? LIMIT 0,1");
	mysqli_stmt_bind_param($stmt, "sd", $ip, $port);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $result);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);

	if($result != 0)
	{
		return "A server with a same IP already exists in our database. IP:".$ip.":".$port;
	}
	else
	{
		try
		{
			$Query = new MinecraftQuery( );
			$Query->Connect($ip, $port, 5);
		}
		catch( MinecraftQueryException $e )
		{
			return "Failed to verify the server. Is the server online? IP:".$ip.":".$port;
		}
		$Info = $Query->GetInfo( );
		if($Info !== false)
		{
			if($Info['HostName'] == "MCPEListClaimServer" or in_array("MCPEListClaimServer 1.0.0", $Info['Plugins']) or $Info['Plugins'] == "MCPEListClaimServer 1.0.0")
			{
				
			}
			else
			{
				return "Server's ownership cannot be verified. Did you change the hostname to 'MCPEListClaimServer'?";
			}
			$stmt = mysqli_prepare($connect, "INSERT INTO ServerList1 (IP, Port, Owner, WhetherWhitelisted) VALUES (?, ?, ?, ?)");
			mysqli_stmt_bind_param($stmt, "sdsd", $ip, $port, $username, $whitelist);
			$result = mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
	
			if($result)
				return true;
			else
				return "Failed to insert the server data into our database. IP:".$ip.":".$port;
		}
		else
		{
			return "Failed to verify the server. Is the server online? IP:".$ip.":".$port;
		}
	}
}


