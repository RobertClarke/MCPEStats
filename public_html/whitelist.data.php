<?

require __DIR__ . '/manage.class.php';
require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
$login = new Login();

if ($login->isUserLoggedIn() != true) {
    include("login/views/not_logged_in.php");
    exit();
}

require_once(__DIR__.'/../constants.php'); $connect = mysqli_connect(DB_HOST, DB_NAME, DB_PASS);
mysqli_select_db($connect, "mcpestat_MCPE");

function removeUsername($id, $username, &$connect)
{
	if(preg_match('/[^a-z_\-0-9]/i', $username))
		return "Not a valid username";	
	
	$stmt = mysqli_prepare($connect, "SELECT WhitelistedPlayers FROM ServerList1 WHERE id=? LIMIT 0,1");
	mysqli_stmt_bind_param($stmt, "d", $id);
	mysqli_stmt_bind_result($stmt, $WhitelistedPlayers);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	
	$NewWhiteListedPlayers = explode(";", $WhitelistedPlayers);
	
	$NewWhiteListedPlayers = array_values($NewWhiteListedPlayers);
	
	$WhitelistedPlayersKey = array_search($username, $NewWhiteListedPlayers);
	
	if($WhitelistedPlayersKey === false)
		return "Failed to remove: Username is not whitelisted!";
	
	unset($NewWhiteListedPlayers[$WhitelistedPlayersKey]);
	
	$NewWhiteListedPlayers = array_values($NewWhiteListedPlayers);
	
	//$NewWhiteListedPlayers = array_diff($NewWhiteListedPlayers, array($username));
	
	$NewWhiteListedPlayers = implode(";", $NewWhiteListedPlayers);
	
	$stmt = mysqli_prepare($connect, "UPDATE ServerList1 SET WhitelistedPlayers=? WHERE id=? AND Owner=?");
	mysqli_stmt_bind_param($stmt, "sds", $NewWhiteListedPlayers, $id, $_SESSION['user_name']);
	$result = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	if($result)	
		return true;
	else
	{
		return "Failed while removing username from our database.";
	}
}

function addUsername($id, $username, &$connect)
{
	if(preg_match('/[^a-z_\-0-9]/i', $username))
		return "Not a valid username";
	
	$stmt = mysqli_prepare($connect, "SELECT WhitelistedPlayers FROM ServerList1 WHERE id=? LIMIT 0,1");
	mysqli_stmt_bind_param($stmt, "d", $id);
	mysqli_stmt_bind_result($stmt, $WhitelistedPlayers);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	
	if(strpos($WhitelistedPlayers, $username.';') !== false)
		return "Username already exists!";
	
	$NewWhitelistedPlayers = $WhitelistedPlayers.$username.";";

	$stmt = mysqli_prepare($connect, "UPDATE ServerList1 SET WhitelistedPlayers=?, WhetherWhitelisted='1' WHERE id=? AND Owner=?");
	mysqli_stmt_bind_param($stmt, "sds", $NewWhitelistedPlayers, $id, $_SESSION['user_name']);
	$result = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	if($result)	
		return true;
	else
	{
		return "Failed while inserting username into our database.";
	}
}

function toggleWhiteList($id, &$connect)
{
	$stmt = mysqli_prepare($connect, "SELECT WhetherWhitelisted FROM ServerList1 WHERE id=? LIMIT 0,1");
	mysqli_stmt_bind_param($stmt, "d", $id);
	mysqli_stmt_bind_result($stmt, $WhetherWhitelisted);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	
	if($WhetherWhitelisted == 0)
		$NewValue = 1;
	else if($WhetherWhitelisted == 1)
		$NewValue = 0;
	else
		return "Your server seems to be on a special whitelist. Please create a ticket to have this changed";
	
	$stmt = mysqli_prepare($connect, "UPDATE ServerList1 SET WhetherWhitelisted=? WHERE id=? AND Owner=?");
	mysqli_stmt_bind_param($stmt, "dds", $NewValue, $id, $_SESSION['user_name']);
	$result = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	if($result)	
		return true;
	else
	{
		return "Failed while inserting username into our database.";
	}
}

if(isset($_POST['AddUserName']))
{
	$data = addUsername($_POST['id'], $_POST['AddUserName'], $connect);
	if($data === true)
	{
		header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&whitelistaction=true&action=admin");
	}
	else
	{
		header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&whitelistaction=".$data."&action=admin");
	}
}
else if(isset($_POST['RemoveUserName']))
{
	$data = removeUsername($_POST['id'], $_POST['RemoveUserName'], $connect);
	if($data === true)
	{
		header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&whitelistaction=true&action=admin");
	}
	else
	{
		header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&whitelistaction=".$data."&action=admin");
	}
}
else if(isset($_POST['ToggleWhiteList']))
{
	$data = toggleWhiteList($_POST['id'], $connect);
	if($data === true)
	{
		header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&whitelistaction=true&action=admin");
	}
	else
	{
		header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&whitelistaction=".$data."&action=admin");
	}
}

?>
