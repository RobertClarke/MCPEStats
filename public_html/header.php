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
			
			<!--<div class="input-append pull-right"><form name='input' action='search.php' method='post'><input type="text" id="query" name="query"><span class="add-on">Search</span><form></div>-->
		</div>
		<center
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-8782622759360356";
			/* MCPE Header */
			google_ad_slot = "4769895837";
			google_ad_width = 970;
			google_ad_height = 90;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</center>
