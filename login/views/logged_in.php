<div class="span4 well pull-right">
	<div class="row">
		<div class="span1"><a href="" class="thumbnail"><?echo $login->user_gravatar_image_tag;?></a></div>
		<div class="span3">
		<strong>Welcome </strong><?php echo $_SESSION['user_name']."!"; ?><br>
          	
			<a href="/login/index.php?logout"><span class="badge badge-warning">Logout</span></a>
			<a href="/manage.php"><span class="badge badge-success">Manage</span></a>
			<a href=/insert.php><span class="badge badge-success">Add Server</span></a>
			<a href=/login/edit.php><span class="badge badge-success">Account</span></a>
		</div>
	</div>
</div>
