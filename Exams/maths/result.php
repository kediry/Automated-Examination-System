<html>
	<head>
		<link rel="stylesheet" href="./includes/css/bootstrap.min.css" >
		<link rel="stylesheet" href="./includes/css/theme.css" >
	</head>
<?php
include "./includes/user.php";
include "../../includes/db.inc.php";
include "./includes/default.php";
mysql_select_db($e_id);
$query=mysql_query("select * from time where id='$user'");
if(mysql_affected_rows()<1)
{
	?>
	<div class="panel panel-default col-md-6 col-md-offset-3">
					<div class="panel-heading">
						<h4 class="text-danger">You have not written this Exam !</h4>
					</div>
					<div class="panel-body">
						Please wait page redirecting to Your account in <span id="time">6</span> seconds.
					</div>
				</div>
				<script type="text/javascript" src="./includes/js/jquery.min.js"></script>
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
$r=mysql_fetch_row($query)or die(mysql_error());
	if(($r[0]==-1)&&($r[1]==60))
	{
	}
	else
	{
		?>
		<div class="panel panel-default col-md-6 col-md-offset-3">
					<div class="panel-heading">
						<h4 class="text-danger">Your Exam was Still Pending !</h4>
					</div>
					<div class="panel-body">
						Please wait page redirecting to Your account in <span id="time">6</span> seconds.
					</div>
				</div>
				<script type="text/javascript" src="./includes/js/jquery.min.js"></script>
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
				$query=mysql_query("select qid,ans from questions order by qid asc") or die(mysql_error());
				while($r=mysql_fetch_array($query))
				{
					$qid=$r[0];
					$ans=$r[1];
					$ans1=mysql_query("SELECT ans FROM exam WHERE id='$user' AND sec=1 AND q=$qid");
					if(mysql_affected_rows()>0)
					{
						$answ=mysql_fetch_row($ans1);
						if($ans==$answ[0])
						{
							$pm+=1;
						}
						else
						{
							$nm-=$e_ngm;
						}
						$no_qq+=1;
					}
				}
				
			}
	?>
	<div class="navbar navbar-fixed-top header">
		<div class="col-md-12">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">AOES</a>
			</div>
			<ul class="nav navbar-nav navbar-left">
				<li class="">
					<a href="../"> <i class="glyphicon glyphicon-home"></i> Home</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION['fname']; ?> <i class="glyphicon glyphicon-user"></i> </a>
					<ul class="dropdown-menu">
					  <li><a href="action.php?signout=yes"><i class="glyphicon glyphicon-off"></i> Logout </a></li>
					</ul>
				 </li>
			</ul>
		</div>
	</div>
	<br><br><br><br>
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body">
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
						<table border="0">
							<tr>
								<td>
									 No. of. Answered Questions
								</td>
								
								<td>
									 : <span class="label label-primary"><?php echo $no_qq; ?> out of <?php echo $no_q; ?></span>
								</td>
							</tr>
								
							<tr>
								<td>
									 Positive Marks
								</td>
								
								<td>
									 : <span class="label label-success"><?php echo $pm; ?></span>
								</td>
							</tr>	
							
							<tr>
								<td>
									 Negitive Marks
								</td>
								
								<td>
									 : <span class="label label-danger"><?php echo $nm; ?></span>
								</td>
							</tr>	
							
							
							<tr>
								<td>
									 Total Marks
								</td>
								
								<td>
									 : <span class="label label-info"><?php echo $pm+$nm; ?></span>
								</td>
							</tr>	
						</table>
						</div>
						<hr>
					</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="./includes/js/jquery.min.js" ></script>
	<script type="text/javascript" src="./includes/js/bootbox.min.js" ></script>
