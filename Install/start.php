<html>
	<link rel="stylesheet" type="text/css" href="../includes/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../includes/css/theme.css" />
<body>
<?php
if(@$_POST['accept']=="yes")
{
	$ref=0;
	$file1="../includes/db.inc.php";
	//$file1="../includes/dbb.php";
	//$db_name="nnnn";
	$db_name="aoes";
	if(file_exists($file1))
	{
		include $file1;
		$q=mysql_query("use $db_name");
		if($q)
		{
			$ref=3;
		}
		else
		{
			$ref=2;
		}
	}
	else
	{
		$ref=1;
	}
	if($ref==3)
	{
		?>
		<div class="col-md-6 col-md-offset-3 panel panel-default">
			<div class="panel-heading"><h3 class="text-danger">--Error:</h3></div>
			<div class="panel-body">
				Database <strong class="text-danger">aoes</strong> already Exist Delete This Database. without Deleting this you can't install<br><br>
				Page Redirect in <span id="time">6</span> seconds.
			</div>
		</div>
		<script type="text/javascript" src="../includes/js/jquery.min.js"></script>
					<script type="text/javascript">
						var time=5;
						$(document).ready(function()
						{
							nani();
						});
						function nani()
						{
							if(time==0)
							{
								document.location="../"
							}
							$("#time").html(time);
							time=time-1;
							setTimeout("nani()",1000);
						}
					</script>
		<?php
		die();
	}
	if($ref==2 || $ref==1)
	{
		?>
		<div class="col-md-6 col-md-offset-3 panel panel-default">
			<div class="panel-heading"><h3 class="text-info">Welcome to AOES Installation</h3></div>
			<div class="panel-body">
				<form action="install.php" method="post">
					<h4>DataBase Connection Configs:</h4>
					<div class="form-group">
						Enter MySql Host :<input type="text" name="dhost" required class="form-control" />
						<p class="text-info">Ex: localhost , 127.0.0.1 , 192.168.143.1 , www.nani.com , etc...</p>
					</div>
					<div class="form-group">
						Enter MySql User Name :<input type="text" name="duser" required class="form-control" />
						<p class="text-info">Ex: root, admin, etc...</p>
					</div>
					<div class="form-group">
						Enter MySql Password :<input type="text" name="dpass" class="form-control" />
					</div>
					<h4>Coordinator Configs:</h4>
					<div class="form-group">
						Enter Coordinator Name :<input type="text" name="cname" required class="form-control" />
					</div>
					<div class="form-group">
						Coordinator ID or Email : (Remember this)<input type="text" name="cemail" class="form-control" disabled value="coordinator@aoes.com" />
					</div>
					<div class="form-group">
						Coordinator Password : (Remember this)<input type="text" required name="cpass" class="form-control" />
					</div>
					<input type="hidden" name="K" value="OK" />
					<div class="form-group">
						<button type="submit" class="btn btn-primary"> Install </button>&emsp;<button type="reset" class="btn btn-danger"> Reset Fields </button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}
}
else
{
	if(file_exists("index.php"))
	{
	?>
	<script type="text/javascript">
		window.location="index.php";
	</script>
	<?php
	}
	else
	{
		die("--Error: FILE MISSING. Reinstall AOES.exe File");
	}
}
?>
<script type="text/javascript" src="../includes/js/jquery.min.js"></script>
<script type="text/javascript" src="../includes/js/bootstrap.min.js"></script>
</body>
</html>
