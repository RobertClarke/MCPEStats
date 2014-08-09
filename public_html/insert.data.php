<?
require_once(__DIR__."/_libs/login_includes.php");
require_once(__DIR__.'/insert.class.php');

$login = new Login();

if ($login->isUserLoggedIn() != true) {
    include("login/views/not_logged_in.php");
    exit();
}

if(strlen($_POST['Port']) < 3)
{
	$port = "19132";
}
else
{
	$port = $_POST['Port'];
}

if(isset($_POST['IsWhitelisted']))
		$whitelist = 1;
	else
		$whitelist = 0;

$data = addIP($_POST['IP'], $port, $_SESSION['user_name'], $whitelist);
if($data === true)
{
	header( 'Location: /index.php?serveradded=true') ;
}
else
{
	header( 'Location: /index.php?serveradded='.$data) ;
}

