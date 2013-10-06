<?

$location = $_SERVER['REQUEST_URI'];
if ($_SERVER['QUERY_STRING']) {
  $location = substr($location, 0, strrpos($location, $_SERVER['QUERY_STRING']) - 1);
}
$method = $_SERVER['REQUEST_METHOD'];

$params = explode("/", $location);

$command = $params[3];//Params starts from 1(api) 2(v2) 3(command)

require_once(__DIR__.'/../../../constants.php'); $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
mysqli_select_db($connect, DB_NAME);

function getFakePlayerList($count, $online)
{
	$rere = 0;
	$list = array();
	
	if($online != 'Online')
		return $list;
	
	for($rere = 0; $rere < $count; $rere++)
	{
		$list[$rere] = "Player".$rere;
	}
	
	return $list;
}

function translateOpenState($param)
{
	if($param == 'Online')
	{
		return true;
	}
	else
	{
		return false;
	}
}

function translateGameMode($param)
{
	switch($param)
	{
		case 'CMP':
			return 'creative';
			break;
		case 'SMP':
			return 'survival';
			break;
		default:
			return 'creative';
	}
}

function parseWhitelist($whitelist)
{
	switch($whitelist)
	{
		case '0':
			return 'P';
			break;
		case '1':
			return 'W';
			break;
		case '2':
			return 'R';
			break;
		default:
			return 'W';
	}
}

switch($method)
{
	case 'GET':
		switch($command)
		{
			case 'list':
				switch(end($params))
				{
					case 'json':
						$query = "select * from ServerList1 where WhetherOnline='Online' ORDER BY IP ASC";

						$result = mysqli_query($connect, $query);
		
						$re = 0;
						$array = array();
						while($row = $result->fetch_assoc())
						{
							$array[$re] = array("id" => htmlspecialchars($row['id']), "name" => htmlspecialchars($row['Name']), "ip" => htmlspecialchars($row['IP']), "playerNames" => getFakePlayerList($row['Last_Players'], $row['WhetherOnline']), "maxNrPlayers" => htmlspecialchars($row['Last_MaxPlayers']), "port" => htmlspecialchars($row['Port']), "ownerName" => htmlspecialchars($row['Owner']), "open" => translateOpenState($row['WhetherOnline']), "type" => translateGameMode($row['GameMode']), "whitelist" => parseWhitelist($row['WhetherWhitelisted']), "whitelisted_players" => $row['WhitelistedPlayers']);
							$re++;
						}
		
						$query = "select * from ServerList1 where WhetherOnline='Offline' ORDER BY IP ASC";

						$result = mysqli_query($connect, $query);
		
						while($row = $result->fetch_assoc())
						{
							$array[$re] = array("id" => htmlspecialchars($row['id']), "name" => htmlspecialchars($row['Name']), "ip" => htmlspecialchars($row['IP']), "playerNames" => getFakePlayerList($row['Last_Players'], $row['WhetherOnline']), "maxNrPlayers" => htmlspecialchars($row['Last_MaxPlayers']), "port" => htmlspecialchars($row['Port']), "ownerName" => htmlspecialchars($row['Owner']), "open" => translateOpenState($row['WhetherOnline']), "type" => translateGameMode($row['GameMode']), "whitelist" => parseWhitelist($row['WhetherWhitelisted']), "whitelisted_players" => explode(";", $row['WhitelistedPlayers']));
							$re++;
						}
		
						header("HTTP/1.1 200 OK");
						echo json_encode($array);
						break;
					default:
						header("HTTP/1.1 501 Not Implemented");
						break;
				}
				break;
			case 'server':				
				$id = substr($params[4],0,10);
				
				$request = substr($params[5],0,20);
				
				$method = substr(end($params),0,10);
				
				if(ctype_digit($id) === false or ctype_alpha($request) === false or ctype_alpha($method) === false)
				{
					header("HTTP/1.1 400 Bad Request");
					break;
				}
				
				$request_mysql = false;
				
				switch(strtolower($request))
				{
					case "description":
						$request_mysql = "Description";
						break;
					case "name":
						$request_mysql = "Name";
						break;
					case "serverrules":
						$request_mysql = "ServerRules";
						break;
					case "open":
						$request_mysql = "WhetherOnline";
						break;
					case "all":
						$request_mysql = "all";
						break;
					default:
						header("HTTP/1.1 400 Bad Request");
						$request_mysql = false;
						break;
				}
				if($request_mysql === false)
					break;
				
				else if($request_mysql === "all")
				{
					$query = "select * from ServerList1 where id='".$id."' LIMIT 0,1";

					$result = mysqli_query($connect, $query);
					if($result === false)
					{
						header("HTTP/1.1 400 Bad Request");
						break;
					}
					$row = $result->fetch_assoc();
					$result = array("id" => htmlspecialchars($row['id']), "name" => htmlspecialchars($row['Name']), "ip" => htmlspecialchars($row['IP']), "playerNames" => getFakePlayerList($row['Last_Players'], $row['WhetherOnline']), "maxNrPlayers" => htmlspecialchars($row['Last_MaxPlayers']), "port" => htmlspecialchars($row['Port']), "ownerName" => htmlspecialchars($row['Owner']), "open" => translateOpenState($row['WhetherOnline']), "type" => translateGameMode($row['GameMode']), "whitelist" => parseWhitelist($row['WhetherWhitelisted']), "whitelisted_players" => explode(";", $row['WhitelistedPlayers']));
				}
				else
				{
					$stmt = mysqli_prepare($connect, "SELECT ".$request_mysql." FROM ServerList1 WHERE id=? LIMIT 0,1");
					mysqli_stmt_bind_param($stmt, "d", $id);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $result);
					mysqli_stmt_fetch($stmt);
					mysqli_stmt_close($stmt);
				}
				
				switch($method)
				{
					case 'json':
						header("HTTP/1.1 200 OK");
						echo json_encode($result);
						break;
					case 'text':
						header("HTTP/1.1 200 OK");
						echo $result;
						break;
					default:
						header("HTTP/1.1 501 Not Implemented");
						break;
				}
				break;
			default:
				header("HTTP/1.1 400 Bad Request");
				break;
		}
		break;
	default:
		header("HTTP/1.1 405 Method Not Allowed");
		break;
}
?>
