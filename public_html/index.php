<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/../global.inc.php');
include 'header.php';
require_once('constants.php');

if($_GET['delete']){
	$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
mysqli_select_db($connect, DB_NAME);

$id = strip_tags($_GET['delete']);
$id = preg_replace('/\s\s+/', ' ', $id);
$id = mysqli_real_escape_string($connect, $id);

$result = array();

$stmt = mysqli_prepare($connect, "SELECT id, Name, IP, Port, Last_Players, Last_MaxPlayers, WhetherOnline, RegisteredDate, WhetherOnlineNum, Owner, WhetherWhitelisted, Description, ServerRules FROM ServerList1 WHERE id=? LIMIT 0,1");
mysqli_stmt_bind_param($stmt, "d", $id);
mysqli_stmt_bind_result($stmt, $result['id'], $result['Name'], $result['IP'], $result['Port'], $result['Last_Players'], $result['Last_MaxPlayers'], $result['WhetherOnline'], $result['RegisteredDate'], $result['WhetherOnlineNum'], $result['Owner'], $result['WhetherWhitelisted'], $result['Description'], $result['ServerRules']);
mysqli_stmt_execute($stmt);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if($result['Owner'] == $_SESSION['user_name']){
	$query = "delete from ServerList1 where owner = '$result[Owner]' AND id = $id";

$result = mysqli_query($connect, $query);
}
}

if(isset($_GET['serveradded']) and $_GET['serveradded'] == 'true')
{
	echo'
<div class="alert alert-success">
  <a class="close" data-dismiss="alert">×</a>
  <strong>Success!</strong> You have successfully added the server. Make sure you change the hostname / plugins back to normal! Please allow upto 5 minutes for the list to refresh itself.
</div>
';
}
if(isset($_GET['serveradded']) and $_GET['serveradded'] != 'true')
{
	echo'
		<div class="alert alert-error">
  <a class="close" data-dismiss="alert">×</a>
  <strong>Error!</strong> '.urldecode($_GET['serveradded']).'
</div>
';
}

if ($login->errors) {
	foreach ($login->errors as $error) {
		echo "<div class='alert alert-error'>
  <a class='close' data-dismiss='alert'>×</a>
  <strong>Error!</strong> $error
</div>";
	}
}

// show positive messages
if ($login->messages) {
	foreach ($login->messages as $message) {
		echo "<div class='alert alert-success'>
  <a class='close' data-dismiss='alert'>×</a>
  <strong>Success!</strong> $message
</div>";
	}
}
?>

<!--<div class="alert alert-success">
 Starting a new MCPE world and need <a href="http://mcpehub.com/seeds">Minecraft PE Seeds</a>? We've got a site for that :)
</div>-->

<table class="table table-striped table-condensed">
	  <thead>
      <tr>
          <th>Name</th>
          <th>Owner</th>
          <th>Whitelist</th>
          <th>Server IP</th>
          <th>Players</th>
          <th>Status</th>                                         
      </tr>
  </thead>   
  <tbody>
<?php
//shuffle($data);

//For some reason this needs to go below the table statement. Weird.

$servers = array();
$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
mysqli_select_db($connect, DB_NAME);

$query = "select * from ServerList1 where WhetherOnline='Online' AND WhetherWhiteListed='0' ORDER BY rand(HOUR(NOW()))";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
    array_push($servers,$row);
}

$query = "select * from ServerList1 where WhetherOnline='Online' AND WhetherWhiteListed='2' ORDER BY rand(HOUR(NOW()))";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
    array_push($servers,$row);
}

$query = "select * from ServerList1 where WhetherOnline='Online' AND WhetherWhiteListed='1' ORDER BY rand(HOUR(NOW()))";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
    array_push($servers,$row);
}

$query = "select * from ServerList1 where WhetherOnline='Offline' ORDER BY rand(HOUR(NOW()))";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
	array_push($servers,$row);
}

$query = "select * from ServerList1 where WhetherOnline='Pending' ORDER BY rand(HOUR(NOW()))";

$result = mysqli_query($connect, $query);

while($row = $result->fetch_assoc()){
	array_push($servers,$row);
  }

$cpage = ($_GET['p'] ? $_GET['p'] : 1);
$cpage = max(1,min($cpage,ceil(count($servers)/25)));
$pagemin = ($cpage-1)*25;
$pagemax = $pagemin+25;
$i = 0;
foreach($servers as $row){
	if($i<$pagemin || $i>=$pagemax){
	$i++;
	continue;
	}
	$i++;
	if($i == ($pagemin + 10))
	{
		?>
			</tbody>
			</table>
<center><div style="padding-bottom:20px;align:center;">

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- MCPEStats Header 2 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-3736311321196703"
     data-ad-slot="4773859071"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</div></center>
			<table class="table table-striped table-condensed">
			<tbody>
		<?php
	}
	display_r_t(htmlspecialchars($row['Name']), htmlspecialchars($row['IP']), htmlspecialchars($row['Last_Players']), htmlspecialchars($row['Last_MaxPlayers']), htmlspecialchars($row['WhetherOnline']), htmlspecialchars($row['Port']), htmlspecialchars($row['Owner']), htmlspecialchars($row['WhetherWhitelisted']), htmlspecialchars($row['id']));
}
mysqli_close($connect);

?>
</tbody>
</table>
<div class="row">

			<div class="six columns centered">
			<?PHP 
			$tservers = ceil(count($servers)/25);
			$dictionary  = array(
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
		 5                   => 'five'
    );
	for($i = $cpage-1;$i<$cpage+2;$i++){
					if($i >= 1 && $i <= $tservers){
						$listout .= '<li><a href="/p/'.$i.'" class="button radius '.($i == $cpage ? 'active':'').'">'.($i).'</a></li>';
						$lcount++;
					}
				}
			?>
				<ul class="button-group radius even <?php echo $dictionary[$lcount+2];?>-up">
						<?php
				
				echo '<li><a href="/" class="button radius '.($cpage == 0 ? 'active':'').'">&laquo;</a></li>';
				
				echo $listout;
				
				echo '<li><a href="/p/'.$tservers.'"class="button radius '.($cpage == $tservers ? 'active':'').'">&raquo;</a></li>';
				?>
				</ul>
				
		</div>
      </div>
	  
<?php include 'footer.php'; ?>
