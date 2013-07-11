<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Refresh" content="180">
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


<? $Timer = MicroTime( true ); 

require_once("login/libraries/password_compatibility_library.php");
require_once("login/config/db.php");
require_once("login/config/hashing.php");
require_once("login/classes/Login.php");
$login = new Login();

require_once($_SERVER['DOCUMENT_ROOT'].'/MinecraftQuery_Simple.php');

/*function display_r_t($thead, $array)
{
	echo '<table class="table table-striped table-condensed">
	<thead>
	<tr>';
	foreach($thead as $c)
	{
		echo "<th>$c</th>";
	}
	echo '</tr>
	</thead>';
	echo '<tbody>';
	foreach($array as $key => $value)
	{
		echo '<tr>';
		echo "<th>$key</th>";
		foreach($value as $key => $value
}*/

function display_r_t($name, $ip, $players, $maxplayers, $onlinestatus, $port, $customname, $whitelist, $id)
{
	echo "<tr>";
	if($onlinestatus == "Online")
          	echo "<th><a href=detail.php?id=$id>$name</a></th>";
        else
        	echo "<th>$name</th>";
        	
        echo "<th>$customname</th>";
        
        if($whitelist == 0)
          	echo '<th><span class="label label-success">Public</span></th>';
          else if($whitelist == 1)//Whitelist
          	echo '<th><span class="label label-important">Whitelisted</span></th>';
          else if($whitelist == 2)//Registration
          	echo '<th><span class="label label-warning">Registration</span></th>';
          else
          	echo '<th><span class="label label-important">Unknown</span></th>';
        
        echo "
          <th>$ip:$port</th>
          <th>$players/$maxplayers</th><th>";
          if($onlinestatus == "Online")
          	echo '<span class="label label-success">';
          else if($onlinestatus == "Offline")
          	echo '<span class="label label-important">';
          else
          	echo '<span class="label label-warning">';
          echo "$onlinestatus</th>                                         
      </tr>"; 
      
      return true;
}
?>
    <div class="container">
    	<div class="page-header">
    	<?
			if ($login->isUserLoggedIn() == true) {
include("login/views/logged_in.php");
}
else
{
echo '<div class="span4 well pull-right">
	<div class="row">
		<div class="span1"><a href="" class="thumbnail"><img src="https://www.gravatar.com/avatar/asdfsad?s=50&d=mm&r=g&f=y" alt="Gravatar"></a></div>
		<div class="span3">
		<strong>Welcome</strong>!<br>
		<a href="/login/index.php"><span class="badge badge-success">Log In</span></a>
		</div>
	</div>
</div>';
}
?>
			<h1>Minecraft PE Servers</h1>
<p>We track Minecraft PE Servers to help you find the perfect Minecraft PE server based on plugins and player data. You better <a href="http://craftstats.com">follow us on Twitter!</a> :)</p>
			<a href=/><button class="btn btn-success">Home</button></a>
			<a href=/insert.php><button class="btn btn-success">Add Server</button></a>
			<a href=http://craftstats.com><button class="btn btn-success">CraftStats</button></a>
			<?
			if ($login->isUserLoggedIn() != true)
			echo '<a href=/login/index.php><button class="btn btn-success">Login / Register</button></a>';
			?>
			
			<a href=/donate.php><button class="btn btn-success">Donate</button></a>
			
			<div class="input-append pull-right"><form name='input' action='search.php' method='post'><input type="text" id="query" name="query"><span class="add-on">Search</span><form></div>
		</div>

<h2>Coming soon :)</h2>
<!--<div class=row-fluid>
<div class=span4>

No simples here carry on


<a href=https://simplenode.co/hostbill/?affid=40><img src=/SimpleNode.png></a>
</div>
<div class=span8>
SimpleNode is a small VPS hosting company that offers extreme value VPSs for a very attractive cost. <b>You can use the VPSs you get from SimpleNode to host your very own PM server that will run 24/7 on a professional server grade hardware and enterprise connection!</b> You can donate to me by purchasing a VPS from SimpleNode which will give me 25% of all purchases made through my <a href=https://simplenode.co/hostbill/?affid=40>link</a>. <b>Since you and I both get the stuff we want, its profit for both of us!</b>
</div>
</div>-->
		<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>

