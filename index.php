<?php
$k=strtolower($_SERVER['HTTP_USER_AGENT']); 
session_start();
if(isSet($_SESSION['user']))
{
	$user=$_SESSION['user'];
	if($user=="coordinator@aoes.com")
	{
		?>
		<script type="text/javascript">
			document.location.href="./Coordinator/";
		</script>
		<?php
	}
	if($user=="inv@aoes.com")
	{
		?>
		<script type="text/javascript">
			document.location.href="./Inv/";
		</script>
		<?php
	}
	if(isSet($user))
	{
		?>
		<script type="text/javascript">
			document.location.href="./User/";
		</script>
		<?php
	}
	else
	{
		session_unset();
		?>
		<script type="text/javascript">
			document.location.href="./index.php";
		</script>
		<?php
	}
}
else
{
	if(!(file_exists("./includes/db.inc.php")))
	{
		?>
		<script type="text/javascript">
			document.location.href="./Install/";
		</script>
		<?php
		die();
	}
?>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="./includes/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="./includes/css/theme.css" />
	</head>
	<body>
		<br>
		<br>
		<div class="row col-md-4 col-md-offset-4">
		<div class="alert alert-danger alert-dismissable" id="login_error" style="display:none;">
		  <span id="login_error"></span>
		</div>
		</div>
		<div class="row col-md-4 col-md-offset-4">
		<div class="panel panel-default " id="login_table">
				<div class="panel-heading" align="center"><img src="./includes/img/avatar<?php echo mt_rand(1,5); ?>.png" style="height:75px; width:75px;" class="img-circle"><h3>Login</h3></div>
				<div class="panel-body">
						<form method="post" onSubmit="return MainLogin()">
						<div class="form-group">
						<input type="text" id="field" class="form-control input-lg" style="" name="user" size="30" placeholder="Email"  />
						<input type="password" id="field" class="form-control input-lg" style="" name="pass" size="30" placeholder="Password" />
						</div>
						<div class="form-group">
						<input type="submit" class="form-control btn btn-primary btn-block input-lg" id="login" name="signin" value="Sign in" />
						<span class="pull-right"><a href="registration.php">Register</a></span>
						</div>
						</form>
						<br>
						<br>
				</div>
		</div>
		<br>
		<br>
		<div class="panel panel-default">
			<div class="panel-body">
				Use <img src="./includes/img/chrome.png" width="20" height="20"> Google Chrome Latest Version
			</div>
		</div>
		</div>

		<script type="text/javascript" src="./includes/js/jquery.min.js"></script>
		<script type="text/javascript" src="./includes/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./includes/js/aoes.js"></script>
	</body>
</html>
<?php 
}

?>
