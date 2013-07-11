<?

require __DIR__ . '/insert.class.php';
require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
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
	header( 'Location: http://mcpe-list.sekjun9878.info/index.php?serveradded=true') ;
}
else
{
	header( 'Location: http://mcpe-list.sekjun9878.info/index.php?serveradded='.$data) ;
}
?>

