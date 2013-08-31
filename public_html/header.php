<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />
  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Lang" content="en">
  <title><?php echo ($title ? $title : 'Minecraft PE Servers | MCPE Server List'); ?></title>
  <meta name="description" content="<?php echo ($desc ? $desc : 'Find a list of the best Minecraft PE servers for you to play on with your friends.'); ?>">
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="/stylesheets/foundation.min.css">
  <link rel="stylesheet" href="/stylesheets/app.css">
  <!--[if !IE 7]>
  <style type="text/css">
    #wrap {display:table;height:100%}
  </style>
<![endif]-->
	  <!-- Included JS Files (Compressed) -->
  <script src="/javascripts/jquery.js"></script>
  <script src="/javascripts/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <script src="/javascripts/app.js"></script>
  <link rel="stylesheet" href="/bootstrap.css">
  <script src="/javascripts/modernizr.foundation.js"></script>
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
<body>
  <?php global $index; 
  if($index){
?>  <div class="featurebg" style="background:url(/images/bigbg<?php echo rand(1,12); ?>.jpg) no-repeat center;background-size:100%;">
    
  </div> <?php } ?>
  <div class="navigation">
    
  </div>
  


  <div id="wrap">
    <div class="row" id="main">

    <div class="three columns sidecontainer">
      <div class="row  box logo"> 

        <a href="/">
		<img src="/images/logo.png"/>
		</a>
		<hr/>
		<a href="http://minecraftservers.com/">
		<img src="http://minecraftservers.com/images/logo.png"/>
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
                  <a href="http://craftstats.com">craftstats</a>
                </li>
                <li>
                  <a href="https://servercrate.com/mcpe.php">start a server</a>
                </li>
              </ul>

              <!-- Right Nav Section -->
              <ul class="right">
				
				<?php echo ($login->isUserLoggedIn()  ? '
				<li><a href=/login/edit.php>'.$_SESSION['user_name'].'</a></li>
				<li><a href="/manage.php">my servers</a></li>
			<li><a href="/login/index.php?logout">logout</a></li>
				' : '<li><a href="/login/index.php">login</a></li>')?>
              </ul>
            </section>
          </nav>
       </div>
      </div>
</div>
<div class="row">
<div class="twelve columns">
<?php
if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false){
?>
<div class="row">
<div class="twelve columns">
<div class="twelve columns main feat">
<h1>Minecraft PE Servers</h1>
<p>We track Minecraft PE Servers to help you find the perfect Minecraft PE server based on plugins and player data. <br/><b>Check out the new Minecraft PE hosting, and <a href="http://servercrate.com/mcpe">start your own server with PocketMine today!</a></b></p>
</div>
</div>
</div>
<?php } ?>
<div style="margin-bottom:20px;position:relative;top:20px;">
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
</div>
<div class="twelve columns main">
