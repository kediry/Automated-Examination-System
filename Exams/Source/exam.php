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
include "./includes/exam_check.php";

$op=array("","A", "B", "C", "D", "E", "F", "G", "H");			
mysql_select_db($e_id)or die(mysql_error());
$t=mysql_query("SELECT * FROM time WHERE id='$user'") or die(mysql_error());
$time=mysql_fetch_row($t);
$query=mysql_query("select * from questions order by qid asc") or die(mysql_error());
?>
<body onload="timeStart(<?php echo $time[0].", ".$time[1]; ?>)" onblur="openBlur()">
		<div class="navbar navbar-fixed-top header">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">AOES</a>
			</div>
			<div class="center-block" style="padding-top:2px;">
				<button id="timer" class="btn btn-lg btn-success">Time</button>
				<button type="button" class="btn btn-flat btn-Primary pull-right navbar-brand" onclick="submitExam(<?php echo $no_q; ?>)"> Submit Exam   <i class="glyphicon glyphicon-send"></i></button>
			</div>
		</div>


	<!--main-->
	<br><br><br><br>
		<div class="row col-md-12">
			<div class="col-md-3">
				
					<div class="panel panel-default" onclick="full()">
						<div class="panel-heading"><h4>Navigation</h4></div>
						<div class="panel-body">

<?php
$q=mysql_query("select qid from questions order by qid asc")or die(mysql_error());
for($i=0;$r=mysql_fetch_array($q);$i++)
{
	$q1=mysql_query("select q from exam where q=$r[0] and id='$user' ");
	if(mysql_affected_rows()>0)
	{
	?>
	<button type="button" class="btn btn-info btn-xs" name="nvb-<?php echo $r[0]; ?>" onclick="goQ(<?php echo $r[0]; ?>)"><?php echo $r[0]; ?></button>
	<?php
	}
	else
	{
		?>
		<button type="button" class="btn btn-default btn-xs" name="nvb-<?php echo $r[0]; ?>" onclick="goQ(<?php echo $r[0]; ?>)"><?php echo $r[0]; ?></button>
		<?php
	}
}
?>

						</div>
					</div>

			</div>

			<div class="col-md-9">

				<div class="panel panel-info" onclick="full()">
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
										$ans=mysql_query("SELECT ans FROM exam WHERE id='$user' AND sec=1 AND q=$qid");
										$answ=mysql_fetch_row($ans);
										if($answ[0]==$options[$i])
										{
										?>
										&emsp;
										<input style=""  onclick="save('question-<?php echo $qid; ?>', <?php echo $qid; ?>, 1)" type="radio" name="question-<?php echo $qid; ?>" value="<?php echo $options[$i]; ?>" checked="checked">&emsp;<?php echo $op[$i]; ?>)&nbsp;<?php echo $options[$i]; ?><br>
										 
										<?php
										}
										else
										{
										?>
										&emsp;
										<input  onclick="save('question-<?php echo $qid; ?>', <?php echo $qid; ?>, 1)" type="radio" name="question-<?php echo $qid; ?>" value="<?php echo $options[$i]; ?>">&emsp;<?php echo $op[$i]; ?>)&nbsp;<?php echo $options[$i]; ?><br>
										
										<?php
										}
									}
								?>
								<br>
								</form>
								</div>
								<ul class="pager">
								  <li class="previous" onclick="previous('<?php echo $qid; ?>')"><a href="#">&larr; Previous</a></li>
								  <li class="next" onclick="next('<?php echo $qid; ?>', '<?php echo $no_q; ?>')"><a href="#">Next &rarr;</a></li>
								</ul>
						</div>
					
<?php
}
?>
					</div>
				</div>
				
			</div>
		</div>

	<input type="hidden" id="submit-checksum" value="<?php echo md5($user); ?>" />	
	</body>
	<script type="text/javascript" src="./includes/js/jquery.min.js" ></script>
	<script type="text/javascript" src="./includes/js/fullscreen.js" ></script>
	<script type="text/javascript" src="./includes/js/bootbox.min.js" ></script>
	<script type="text/javascript" src="./includes/js/exam.js" ></script>
	<script type="text/javascript" src="./includes/js/bootstrap.min.js" ></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$(".divq").hide();
			$("#dq-1").show();
			$("#Invigilator").modal("show");
		});
		
		function full()
		{
			$(document).fullScreen(true);
		}
		function fullC()
		{
			$(document).fullScreen(false);
		}
		
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
