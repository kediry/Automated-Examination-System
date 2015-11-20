<?php
mysql_select_db($e_id)or die(mysql_error());
$t=mysql_query("SELECT * FROM time WHERE id='$user'") or die(mysql_error());
$time=mysql_fetch_row($t);
if($time[0]!=-1)
{
	?>
		<div class="panel panel-default col-md-6 col-md-offset-3">
					<div class="panel-heading">
						<h4 class="text-danger">Your Exam Not Completed !</h4>
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
if($key_status!="UPLOADED")
{
		?>
		<div class="panel panel-default col-md-6 col-md-offset-3">
					<div class="panel-heading">
						<h4 class="text-danger">Key Presently Not Active Try Again !</h4>
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
?>
