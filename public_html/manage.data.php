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

function alert($string)
{
	$to = "sekjun9878@gmail.com";
	$subject = "Server Possible Abuse Alert";


	$message = "Dear sekjun9878
	This is an automated message generated from Apache2

	$string
	Page: PocketMine List manage.data.php
	IP: ".$_SERVER['HTTP_CF_CONNECTING_IP']."

	Have a nice day!
	";
	$from = "www-data@sekjun9878.info";


	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
}





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
			header( 'Location: http://mcpe-list.sekjun9878.info/manage.php?serveractionr=true') ;
		}
		else
		{
			header( 'Location: http://mcpe-list.sekjun9878.info/manage.php?serveractionr='.$data) ;
		}
		break;
	case 'whitelist':
		header( 'Location: http://mcpe-list.sekjun9878.info/manage.php?serveractionr='."WhiteList Not Yet Available. Check back later.") ;
		//header("Location: http://mcpe-list.sekjun9878.info/whitelist.php?id=".$_POST['id']."&action=admin");
		break;
	case 'editserverinfo':
		//header( 'Location: http://mcpe-list.sekjun9878.info/manage.php?serveractionr='."Server Edit Not Yet Available. Check back later.") ;
		header("Location: http://mcpe-list.sekjun9878.info/editserverinfo.php?id=".$_POST['id']);
		break;
	default:
		$data = 'Action Unspecified. You may have been logged for directly accessing critical files.';
		alert('Action Unspecified. You may have been logged for directly accessing critical files.');
		header( 'Location: http://mcpe-list.sekjun9878.info/manage.php?serveractionr='.$data) ;
		break;
}
?>
