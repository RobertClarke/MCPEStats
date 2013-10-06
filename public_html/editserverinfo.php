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

$id = strip_tags($_GET['id']);
$id = preg_replace('/\s\s+/', ' ', $id);

$Timer = MicroTime( true ); 

require_once(__DIR__.'/../constants.php'); $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
mysqli_select_db($connect, DB_NAME);

$id = mysqli_real_escape_string($connect, $id);

$stmt = mysqli_prepare($connect, "SELECT IP, Description, ServerRules, Name FROM ServerList1 WHERE id=? AND Owner=? LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "ds", $id, $_SESSION['user_name']);
mysqli_stmt_bind_result($stmt, $IP, $Description, $ServerRules, $Name);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if($IP == 0)
	header( 'Location: http://mcpe-list.sekjun9878.info/manage.php?serveractionr='."Wrong ID or Bad Ownership") ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Minecraft PE Server List</title>
	
	<? include($_SERVER['DOCUMENT_ROOT']."/headscript.php"); ?>
	
	<link rel="stylesheet" href="/bootstrap.css">
	<style type="text/css">
		footer {
			margin-top: 45px;
			padding: 35px 0 36px;
			border-top: 1px solid #e5e5e5;
		}
		footer p {
			margin-bottom: 0;
			color: #555;
		}
	</style>
</head>

<body>

    <div class="container">
    	<div class="page-header">
    	
    	
			<h1>Minecraft PE Server List</h1>
			
			
		</div>
		
	<?
	
	if($_GET['editaction'] == 'true')
	{
		echo'
		<div class="alert alert-success">  
		<a class="close" data-dismiss="alert">×</a>  
		<strong>Success!</strong> Server Info has been modified!
		</div>  
		';
	}
	if(isset($_GET['editaction']) and $_GET['editaction'] != 'true')
	{
		echo'
		<div class="alert alert-error">  
	  	<a class="close" data-dismiss="alert">×</a>  
	 	<strong>Error!</strong> '.htmlspecialchars($_GET['editaction']).'
		</div>  
		';
	}

	?>
	<a href=index.php> <?echo "<< Back"; ?> </a><br>
<h3>Edit your server info</h3>
<p>Here you can edit the details about your server including your server description.</p>
<form class="well span11" method='post' action='editserverinfo.data.php'>
<h3>Edit Description</h3>
  <div class="row-fluid">
		<div class="span4">
			<!--<label>First Name</label>
			<input type="text" class="span12" placeholder="Your First Name">
			<label>Last Name</label>
			<input type="text" class="span12" placeholder="Your Last Name">
			<label>Email Address</label>
			<input type="text" class="span12" placeholder="Your email address">-->
			<br><br>Description Guidelines:
			<p>1. Use first or third person.<br>
			2. No URLs to other websites.<br>
			3. As summative as possible.<br><br>
			Please do not use special characters like '*'. They will be blocked by our filter system.</p>
		</div>
		<div class="span8">
			<label>Description</label>
			<textarea name="description" id="description" class="input-xlarge span12" rows="10"></textarea>
		</div>
		
		<? echo "<input type='hidden' name='id' id='id' value='$id'>"; ?>
	
		<button type="submit" class="btn btn-primary pull-right">Send</button>
	</div>
</form>

<form class="well span11" method='post' action='editserverinfo.data.php'>
<h3>Edit server rules</h3>
  <div class="row-fluid">
		<div class="span4">
			<p>Here you can edit the details about your server including your server description.</p>
			<br><br>Server Rule Guidelines:
			<p>1. Use third person.<br>
			2. Use rules that are suitable to your server gamemode.<br>
			3. In numbered points.<br><br>
			Please do not use special characters like '*'. They will be blocked by our filter system.</p>
		</div>
		<div class="span8">
			<label>Server Rules</label>
			<textarea name="serverrules" id="serverrules" class="input-xlarge span12" rows="10"></textarea>
		</div>
	
		<? echo "<input type='hidden' name='id' id='id' value='$id'>"; ?>
		
		<button type="submit" class="btn btn-primary pull-right">Send</button>
	</div>
</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br>
<hr>
		<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
