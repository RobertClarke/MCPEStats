<?
require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
$login = new Login();

if ($login->isUserLoggedIn() != true) {
    include("login/views/not_logged_in.php");
    exit();
}

$connect = mysqli_connect("localhost","mcpestat_MCPE","q^6e?A;F?C@+");
mysqli_select_db($connect, "mcpestat_MCPE");

function setDescription($id, $text, &$connect)
{	
	$text = strip_tags($text);
	$text = htmlspecialchars($text);
	$text = nl2br($text);
	$text = preg_replace('/\s\s+/', ' ', $text);
	
	//$text = mysqli_real_escape_string($connect, $text);

	$stmt = mysqli_prepare($connect, "UPDATE ServerList1 SET Description=? WHERE id=? AND Owner=?");
	mysqli_stmt_bind_param($stmt, "sds", $text, $id, $_SESSION['user_name']);
	$result = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	if($result)	
		return true;
	else
	{
		return "Failed while setting new Description.";
	}
}

function setServerRules($id, $text, &$connect)
{
	$text = strip_tags($text);
	$text = htmlspecialchars($text);
	$text = nl2br($text);
	$text = preg_replace('/\s\s+/', ' ', $text);
	//$text = mysqli_real_escape_string($connect, $text);

	$stmt = mysqli_prepare($connect, "UPDATE ServerList1 SET ServerRules=? WHERE id=? AND Owner=?");
	mysqli_stmt_bind_param($stmt, "sds", $text, $id, $_SESSION['user_name']);
	$result = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	if($result)	
		return true;
	else
	{
		return "Failed while setting new Server Rules.";
	}
}

if(isset($_POST['description']))
{
	$data = setDescription($_POST['id'], $_POST['description'], $connect);
	if($data === true)
	{
		header("Location: http://mcpe-list.sekjun9878.info/editserverinfo.php?id=".$_POST['id']."&editaction=true");
	}
	else
	{
		header("Location: http://mcpe-list.sekjun9878.info/editserverinfo.php?id=".$_POST['id']."&whitelistaction=".$data);
	}
}
if(isset($_POST['serverrules']))
{
	$data = setServerRules($_POST['id'], $_POST['serverrules'], $connect);
	if($data === true)
	{
		header("Location: http://mcpe-list.sekjun9878.info/editserverinfo.php?id=".$_POST['id']."&editaction=true");
	}
	else
	{
		header("Location: http://mcpe-list.sekjun9878.info/editserverinfo.php?id=".$_POST['id']."&editaction=".$data);
	}
}

?>
