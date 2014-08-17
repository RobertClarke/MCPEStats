<?php
require_once(__DIR__."/../_libs/login_includes.php");
$login = new Login();
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--<meta name="viewport" content="width=device-width" />-->
    <meta http-equiv="Lang" content="en">
    <meta name="verifyownership" content="fd5c9069ea667f2d5d8e3f0ee7284055" />

    <title><?php echo ($_TITLE ? $_TITLE: 'Minecraft PE Servers | MCPE Servers List'); ?></title>
    <meta name="description" content="<?php echo ($_DESCRIPTION ? $_DESCRIPTION : 'Find a list of the best Minecraft PE servers for you to play on with your friends. Our MCPE Servers list contains all the best MCPE servers around.'); ?>">
    <meta name="keywords" content="minecraft pe servers, mcpe servers, pocketmine servers, mcpe server list, minecraft pe server list">

    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png"/>
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />

    <link rel="stylesheet" href="/assets/stylesheets/foundation.min.css">
    <link rel="stylesheet" href="/assets/stylesheets/app.css">
    <link rel="stylesheet" href="/assets/bootstrap.css">
    <script src="/assets/javascripts/jquery.js"></script>
    <script src="/assets/javascripts/foundation.min.js"></script>
    <script src="/assets/javascripts/app.js"></script>
    <script src="/assets/javascripts/modernizr.foundation.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".togglelogos").click(function(){
                 $('.box.logo').toggleClass("open",100);
            });
        });
    </script>
    <script type="text/javascript">
        var GoSquared = {};
        GoSquared.acct = "GSN-600759-K";
        (function(w){
        function gs(){
          w._gstc_lt = +new Date;
          var d = document, g = d.createElement("script");
          g.type = "text/javascript";
          g.src = "//d1l6p2sc9645hc.cloudfront.net/tracker.js";
          var s = d.getElementsByTagName("script")[0];
          s.parentNode.insertBefore(g, s);
        }
        w.addEventListener ?
          w.addEventListener("load", gs, false) :
          w.attachEvent("onload", gs);
        })(window);
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-8521263-23', 'mcpestats.com');
      ga('send', 'pageview');

    </script>
</head>
<body>
  <div class="navigation">
  </div>
  <div id="wrap">
	<div class="row" id="main">

	<div class="three columns sidecontainer">
	  <div class="row  box logo">
	  <a href="http://mcpestats.com/">
		<img src="/assets/images/logos/mcpestats.png" alt="Minecraft PE Servers"/>
	  </a>
	<hr/>
	  <a href="http://mcpestats.com/">
		<img src="/assets/images/logos/mcpeservers.png" alt="Minecraft PE Servers"/>
	  </a>
	<hr/>
	  <a href="http://mcpestats.com/">
		<img src="/assets/images/logos/craftstats.png" alt="ServerLister"/>
	  </a>
	<a class="togglelogos"></a>
	  </div>
	</div>
	<div class="nine columns content">
	  <div class="row">
	   <div class="twelve columns">
		  <nav class="top-bar">
			<ul>
			  <li class="toggle-topbar"><a href="#"></a></li>
			</ul>

			<section>
			  <!-- Left Nav Section -->
			  <ul class="left">
				<li>
				  <a href="/insert.php">add server</a>
				</li>
				<li>
				  <a href="http://billing.netherbox.com/aff.php?aff=004&url=http://netherbox.com/plans.php?mcpe">start a server</a>
				</li>
				<li>
				  <a href="http://instantmc.org">free minecraft server hosting</a>
				</li>
				<li>
				  <a href="http://instantmcpe.com">instantmcpe</a>
				</li>
			  </ul>

                <ul class="right">
                    <?php
                        if($login->isUserLoggedIn())
                        {
                            echo '<li><a href=/login/edit.php>'.$_SESSION['user_name'].'</a></li>
                            <li><a href="/manage.php">my servers</a></li>
                            <li><a href="/login/index.php?logout">logout</a></li>
                            ';
                        }
                        else
                        {
                            echo '<li><a href="/login/index.php">login</a></li>';
                        }
                    ?>
                </ul>
			</section>
		  </nav>
	   </div>
	  </div>
</div>
<div class="row">
<div class="twelve columns">
    <?php
        if(strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false)
        {
            echo <<<'NOWDOC'
<div class="row">
<div class="twelve columns">
<div class="twelve columns main feat">
<h1>Minecraft PE Servers</h1>
<p>We track Minecraft PE Servers to help you find the perfect Minecraft PE server based on plugins and player data. Looking for <a href="http://mcpehub.com/seeds">Minecraft PE Seeds</a>? We've got you covered :)</p>
<!--<center><a href="http://billing.netherbox.com/aff.php?aff=004&url=http://netherbox.com/plans.php?mcpe"><img src="/assets/images/netherbox.jpg"></a></center>-->
<center><a href="http://b1831f25s0tllw66pkqx08orcd.hop.clickbank.net/" target="_blank"><img src="http://www.mcraftblueprint.com/img/728x90.gif" alt="Minecraft Blueprint"></a></center>
</div>
</div>
</div>
NOWDOC;
        }
    ?>
<div style="margin-bottom:20px;position:relative;top:20px;">
<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MCPEStats Header 1 -->
<ins class="adsbygoogle"
	 style="display:inline-block;width:970px;height:90px"
	 data-ad-client="ca-pub-3736311321196703"
	 data-ad-slot="3297125873"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
</div>
<div class="twelve columns main">
