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


$Timer = MicroTime( true ); 

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
mysqli_select_db($connect, DB_NAME);

$stmt = mysqli_prepare($connect, "SELECT IP, WhetherWhitelisted, WhitelistedPlayers, Port, Name FROM ServerList1 WHERE id=? AND Owner=? LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "ds", $_GET['id'], $_SESSION['user_name']);
mysqli_stmt_bind_result($stmt, $IP, $WhetherWhitelisted, $WhitelistedPlayers, $Port, $Name);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if($IP == 0)
	header( 'Location: /manage.php?serveractionr='."Wrong ID or Bad Ownership") ;

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
		<h2>Whitelist for PocketMine Realms</h2>
		
	<?
	
	if($_GET['whitelistaction'] == 'true')
	{
		echo'
		<div class="alert alert-success">  
		<a class="close" data-dismiss="alert">×</a>  
		<strong>Success!</strong> The whitelist has been reconfigured! It may take a while for this change to come into effect.
		</div>  
		';
	}
	if(isset($_GET['whitelistaction']) and $_GET['whitelistaction'] != 'true')
	{
		echo'
		<div class="alert alert-error">  
	  	<a class="close" data-dismiss="alert">×</a>  
	 	<strong>Error!</strong> '.htmlspecialchars($_GET['whitelistaction']).'
		</div>  
		';
	}

	?>

<div class='row'>
<div class='span6'>
<a href=index.php> <?echo "<< Back"; ?> </a><br><br>

<b>Whitelist is still in beta. Please report any bugs with a support ticket.</b><br>
<br>
IP: <? echo $IP; ?><br>
Port: <? echo $Port; ?><br>
Name: <? echo $Name; ?><br>
<br>

<form class="form-horizontal" action='whitelist.data.php' method="POST">
  <fieldset>    
  <? echo "<input type='hidden' name='id' value=".$_GET['id'].">"; ?>
  <? echo "<input type='hidden' name='ToggleWhiteList' value='ToggleWhiteList'>"; ?>
<?
if($WhetherWhitelisted == 0)
{
	echo "WhiteList Status: <button class='btn btn-success'>WhiteList OFF (Click to toggle)</button>";
}
else if($WhetherWhitelisted == 1)
{
	echo "WhiteList Status: <button class='btn btn-danger'>WhiteList ON (Click to toggle)</button>";
}
else
{
	echo "WhiteList Status: <button class='btn btn-important'>WhiteList Unknown / Special</button>";
}
?>
  </fieldset>
</form>
<br>
<form class="form-horizontal" action='whitelist.data.php' method="POST">
  <fieldset>    
      <!-- Username -->
      <label for="AddUserName">Add Username</label>
      	<? echo "<input type='hidden' name='id' value=".$_GET['id'].">"; ?>
        <input type="text" name="AddUserName" placeholder="Username" class="input-xlarge"> 
        <button class="btn btn-success">Add</button>
  </fieldset>
</form>

<form class="form-horizontal" action='whitelist.data.php' method="POST">
  <fieldset>    
      <!-- Username -->
      <label for="RemoveUserName">Remove Username</label>
      	<? echo "<input type='hidden' name='id' value=".$_GET['id'].">"; ?>
        <input type="text" name="RemoveUserName" placeholder="Username" class="input-xlarge"> 
        <button class="btn btn-danger">Remove</button>
  </fieldset>
</form>

</div>

<div class='span6'>
<br><br>
<table class="table table-bordered table-striped">
					<thead>
					
						<tr>
							<th>Players</th>
						</tr>
					</thead>
					<tbody>
					<?
						if($WhetherWhitelisted == 1)
						{
							$array = explode(";", $WhitelistedPlayers);
							foreach($array as $p)
							{
							echo "
							<tr>
								<td>".htmlspecialchars($p)."</td>
							</tr>";
							}
						}
						else
						{
							echo "
							<tr>
								<td>Whitelist Not Active</td>
							</tr>";
						}
					?>
					</tbody>
				</table>
				
</div></div>





		<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
