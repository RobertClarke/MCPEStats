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

<? $Timer = MicroTime( true ); ?>


<style>
  .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
</style>
<title>Error 404</title>
<body>
  <div class="hero-unit center">
    <h1>Hacking Attempt Detected</h1>
    <br />
    <p>Our advanced Web Application Firewall system has detected an attack on our website.</p>
    <p><? echo "<--"; ?> Click the support button if you believe this page should not be here..
Please do not fill the support box with messages such as 'I didn't hack!!!'. <b>Only request with real threat will be forwarded for further review. Absolutely no action will be taken against you if you did not attempt anything.</b></p>
    <p>You connection details including your IP and the date of offence has been logged for further review. You may be blacklisted and / or reported to certain anti-hack communities depending on the severity of your offence.</p>
    <p>IP: <?
     if(isset($_SERVER['HTTP_CF_CONNECTING_IP']) === true)
     	echo $_SERVER['HTTP_CF_CONNECTING_IP'];
     else
     	echo $_SERVER['REMOTE_ADDR'];
     ?></p>
    <p>Date: <? echo date("F j, Y, g:i a"); ?></p>
  </div>
  <p></p>
  
<?

	$to = "sekjun9878@gmail.com";
	$subject = "Mod Security Attack Warning";
	
	$message = "Dear sekjun9878
	This is an automated message generated from Apache2

	Mod Security Attack Warning
	Page: ".$_SERVER['REDIRECT_URL']."
	Date: ".date("F j, Y, g:i a")."
	Country Code: ".$_SERVER["HTTP_CF_IPCOUNTRY"]."
	IP_CF: ".$_SERVER['HTTP_CF_CONNECTING_IP']."
	IP: ".$_SERVER['REMOTE_ADDR']."
	Blocked due to suspicion.

	Have a nice day!
	";
	$from = "www-data@mcpe-list.sekjun9878.info";


	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);


?>
<div class="container">
    	<div class="page-header">
<footer>
			<? include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
		</footer>
	</div>
</div>
</body></html>
