<html>
	<head>
		<link rel="stylesheet" href="./includes/css/bootstrap.min.css" >
		<link rel="stylesheet" href="./includes/css/theme.css" >
		<style type="text/css">
			.btn-xs
			{
			  padding: 1px 1px;
			  height:20px;
			  width: 25px;
			 }
			 td
			 {
				 padding:5px;
			 }
		</style>
		<script type="text/javascript" src="./includes/js/jquery.min.js" ></script>
		<script type="text/javascript" src="./includes/js/fullscreen.js" ></script>
	</head>
<body onclick="$(document).fullScreen(false);">
<?php
include "./includes/user.php";
include "../../includes/db.inc.php";
include "./includes/default.php";
mysql_select_db($e_id);
$q=mysql_query("update time set min=-1, sec=60 where id='$user'") or die(mysql_error());
$q=mysql_query("select * from exam where id='$user'") or die(mysql_error());
$pm=0;
$nm=0;
$no_qq=0;
if($e_type=="SR")
{
	while($r=mysql_fetch_array($q))
	{
		$qq=$r[2];
		$ans=$r[3];
		$mark=$r[4];
		if(strncmp("-", $mark, 1))
		{
			$pm+=$mark;
		}
		else
		{
			$nm+=$mark;
		}
		$no_qq+=1;
	}
	echo $no_qq;
}
if($e_type=="LR")
{
		$resul=mysql_query("select count(*) from exam where id='$user'") or die(mysql_error());
		$arrr=mysql_fetch_row($resul);
		$no_qq=$arrr[0];
}
if(@$_REQUEST['submit']==md5($user))
{
	?>
	<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
				  <div class="panel-heading"><h4><?php echo $e_name; ?></h4></div>
					<div class="panel-body">
						<div class="jumbotron">
							<h3 class="text-success"><i class="glyphicon glyphicon-ok"></i> Your Exam Successfully Completed!</h3>
						</div>
						<div align=center>
						<table border="1">
							<tr>
								<td align="center" colspan='4'><b>RESULT</b></td>
							</tr>
							<tr>
								<td align="right">
									ID:
								</td>
								
								<td align="left">
									<b><span class="text-primary"><em><?php echo $user; ?></em></span></b>&emsp;&emsp;
								</td>
							
								<td align="right">
									 Name:
								</td>
								
								<td align="left">
									<b><?php echo $_SESSION['fname']; ?></b>&emsp;&emsp;
								</td>
							</tr>
						</table>
						<br>
						<table border="1">
							<tr>
								<td>
									 <b>No. of. Answered Questions</b>
								</td>
								
								<td>
									<span class="label label-primary"><?php echo $no_qq; ?> out of <?php echo $no_q; ?></span>
								</td>
							</tr>
							<?php
								if($e_type=="SR")
								{
									?>
								
							<tr>
								<td>
									 <b>Positive Marks</b>
								</td>
								
								<td>
									<span class="label label-success"><?php echo $pm; ?></span>
								</td>
							</tr>	
							
							<tr>
								<td>
									 <b>Negitive Marks</b>
								</td>
								
								<td>
									<span class="label label-danger"><?php echo $nm; ?></span>
								</td>
							</tr>	
							
							
							<tr>
								<td>
									 <b>Total Marks</b>
								</td>
								
								<td>
									<span class="label label-info"><?php echo $pm+$nm; ?></span>
								</td>
							</tr>	
							<?php
								}
							?>
						</table>
						</div>
						<hr>
						<div class="col-xs-4 col-xs-offset-4"><a class="btn btn-danger center-block" href="#" onclick="full()">Exit</a></div>
					</div>
	</div>
	<?php
	session_unset();
}
?>
</body>
<script type="text/javascript">
	function full()
	{
		$(document).fullScreen(false);
		window.close();
	}
</script>
</html>
