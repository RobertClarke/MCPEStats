<?
require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
require_once('constants.php');

$login = new Login();

if ($login->isUserLoggedIn() != true) {
    include("login/views/not_logged_in.php");
    exit();
}

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
mysqli_select_db($connect, DB_NAME);

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
		header("Location: /editserverinfo.php?id=".$_POST['id']."&editaction=true");
	}
	else
	{
		header("Location: /editserverinfo.php?id=".$_POST['id']."&whitelistaction=".$data);
	}
}
if(isset($_POST['serverrules']))
{
	$data = setServerRules($_POST['id'], $_POST['serverrules'], $connect);
	if($data === true)
	{
		header("Location: /editserverinfo.php?id=".$_POST['id']."&editaction=true");
	}
	else
	{
		header("Location: /editserverinfo.php?id=".$_POST['id']."&editaction=".$data);
	}
}

?>
