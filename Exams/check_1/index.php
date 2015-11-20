<?php
@session_start();
if(isSet($_SESSION['e-user']))
{
	$user=$_SESSION['e-user'];
	$log=$_SESSION['login'];
	if($log=="user")
	{
		if(@$_SESSION['exam_user']==$user)
		{
			?>
			<script type="text/javascript">
				window.location="exam.php";
			</script>
			<?php
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
			<br>
			<br>
			<div class="container">
				<div class="alert alert-danger col-md-6 col-md-offset-3" id="error" style="display:none;">
				</div>
			<div class="panel panel-default col-md-6 col-md-offset-3">
				<div class="panel-heading">Enter Exam Password:</div>
				<div class="panel-body">
					<div class="form-group">
							<form method="post" onSubmit="return MainLogin()">
							<input type="password" id="field" class="form-control" name="pass" size="30" placeholder="Password" /><br>
							<input type="submit" id="login" class="btn btn-primary" name="signin" value="Sign in" />
							</form>
					</div>
				</div>
				</div>
			</div>
		</body>
			<script type="text/javascript" src="./includes/js/jquery.min.js"></script>
			<script type="text/javascript" src="./includes/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="./includes/js/exam.js"></script>
		</html>
		<?php
	}
}
else
{
	?>
	<script type="text/javascript">
		document.location="../";
	</script>
	<?php
}
?>
