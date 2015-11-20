<html>
	<head>
		<link rel="stylesheet" href="./includes/css/bootstrap.min.css" >
		<link rel="stylesheet" href="./includes/css/theme.css" >
		<style type="text/css">
			.btn-xs
			{
			  padding: 1px 1px;
			  height:22px;
			  width: 25px;
			 }
		</style>
	</head>
<?php
include "./includes/user.php";
include "../../includes/db.inc.php";
include "./includes/default.php";
include "./includes/key_check.php";

$op=array("","A", "B", "C", "D", "E", "F", "G", "H");			
$pm=0;
$nm=0;
$total=0;
$tc=0;
$query=mysql_query("select * from questions order by qid asc") or die(mysql_error());
?>
<body>

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
	<!--main-->
	<br><br><br><br>
		<div class="row col-md-10 col-md-offset-1">

				<div class="panel panel-info">
					<div class="panel-heading">
						<p class="text-info"><?php echo $e_name; ?></p>
					</div>
					<div class="panel-body">
<?php
while($r=mysql_fetch_array($query))
{
	$qid=$r[0];
	$sid=$r[1];
	$question=str_replace("<img src=/includes/img/", "<img src=../$e_id/includes/img/", $r[2]);
	$nop=$r[3];
	$ans=$r[4];
	$options[0]="";
	$type="";
	for($i=1;$i<=$nop;$i++)
	{
		$options[$i]=$r[($i+4)];
	}
	if(stristr($question,"<img src="))
	{
		$type="img";
	}
	else
	{
		$type="txt";
	}
?>
					
						<div id="<?php echo "dq-$qid"; ?>" class="col-md-10 col-md-offset-1 divq">
							<p style="font-size:13pt;"><?php echo $qid; ?>.&emsp;<?php echo $question; ?></p>
								<div class="form-group " style="font-size:11pt;">
								<br>
								<form>
								<?php
									for($i=1;$i<=$nop;$i++)
									{
										$c=0;
										$ans1=mysql_query("SELECT ans FROM exam WHERE id='$user' AND sec=1 AND q=$qid");
										$answ=mysql_fetch_row($ans1);
										if(($answ[0]==$options[$i])&&($answ[0]==$ans))
										{
											$c++;
										?>
										&emsp;
										<span class="text-success"><span class="glyphicon glyphicon-ok"></span></span>&emsp;<?php echo $op[$i]; ?>)&nbsp;<?php echo $options[$i]; ?>&emsp;<span class="label label-success">Your Answer was Correct !</span><br>
										 
										<?php
											$pm++;
										}
										if(($answ[0]==$options[$i])&&($answ[0]!=$ans))
										{
											$c++;
										?>
										&emsp;
										<span class="text-danger glyphicon glyphicon-remove"></span>&emsp;<?php echo $op[$i]; ?>)&nbsp;<?php echo $options[$i]; ?>&emsp;<span class="label label-danger">Your Answer was Wrong !</span><br>
										 
										<?php
											$nm-=$e_ngm;
										}
										if(($ans==$options[$i])&&($answ[0]!=$ans))
										{
											$c++;
										?>
										&emsp;
										<span class="text-success glyphicon glyphicon-ok"></span>&emsp;<?php echo $op[$i]; ?>)&nbsp;<?php echo $options[$i]; ?>&emsp;<span class="label label-success">Correct Answer !</span><br>
										 
										<?php
										}
										if($c==0)
										{
										?>
										&emsp;
										<span class="">&emsp;</span>&emsp;<?php echo $op[$i]; ?>)&nbsp;<?php echo $options[$i]; ?><br>
										
										<?php
										}
									}
								?>
								<br>
								</form>
								</div>
						</div>
					
<?php
}
?>
						<br>
						<div class="alert alert-info col-md-4 col-md-offset-4">
							<Strong>Total Marks</Strong> : <?php echo $pm+$nm; ?>
						</div>
						<div class="alert alert-success col-md-4 col-md-offset-4">
							<strong>Positive Marks</strong> : <?php echo $pm; ?>
						</div>
						<div class="alert alert-danger col-md-4 col-md-offset-4">
								<strong>Negitive Marks</strong> : <?php echo $nm; ?>
						</div>
						<div class="alert alert-warning col-md-4 col-md-offset-4">
								One Wrong Answer Carries  <strong>-<?php echo $e_ngm; ?></strong> Nagitive Mark.
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
	</body>
	<script type="text/javascript" src="./includes/js/jquery.min.js" ></script>
	<script type="text/javascript" src="./includes/js/bootbox.min.js" ></script>
	<script type="text/javascript" src="./includes/js/exam.js" ></script>
	<script type="text/javascript" src="./includes/js/bootstrap.min.js" ></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
		});

		function openPop(elem)
		{
			$(".btn[id='nv"+elem+"']").popover(
			{
				trigger : "click",
				html : "true",
				content : $("#nq"+elem).html()
			});
		}

		function previous(elem)
		{
			elem=parseInt(elem);
			p=elem-1;
			if(p>=1)
			{
				$(".divq").hide();
				$("#dq-"+p).show();
			}
		}
		function next(elem, last)
		{
			elem=parseInt(elem);
			last=parseInt(last);
			p=elem+1;
			if(p<=last)
			{
				$(".divq").hide();
				$("#dq-"+p).show();
			}
		}
		function goQ(elem)
		{
			elem=parseInt(elem);
			p=elem;
			$(".divq").hide();
			$("#dq-"+p).show();
			$(".btn").popover("hide");
		}
	</script>
</html>
