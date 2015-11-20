<html>
	<link rel="stylesheet" type="text/css" href="../includes/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../includes/css/theme.css" />
<body>
<div class="col-md-6 col-md-offset-3 panel panel-default">
		<div class="panel-heading"><h3 class="text-success"><i class='glyphicon glyphicon-ok'></i> You Have Success fully Configured AOES !!</h3></div>
		<div class="panel-body">
			<BR>
			<?php
				if(removeFolder("../Install/"))
				{
					?>
					<span class="text-success"><i class='glyphicon glyphicon-ok'></i> Successfully Removed <i class='glyphicon glyphicon-folder-open'></i>  Install Folder !! </span>
					<br>
					<br>
					Please Wait Page Redirect in <span id='time'>8</span> seconds.
					<?php
				}
				else
				{
					?>
					<span class="text-danger"><i class='glyphicon glyphicon-remove'></i> Faild to Remove <i class='glyphicon glyphicon-folder-open'></i>  Install Folder !! <br> goto webroot directory and remove <strong><i class='glyphicon glyphicon-folder-open'></i> Install folder </strong> </span>
					<br>
					<br>
					Please Wait Page Redirect in <span id='time'>8</span> seconds.
					<?php
				}
			?>
		</div>
	</div>
	<script type="text/javascript" src="../includes/js/jquery.min.js"></script>
				<script type="text/javascript">
					var time=8;
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
function removeFolder($dir)
{
		$files=array_diff(scandir($dir), array('.', '..'));
		foreach ($files as $file)
		{
			(is_dir("$dir/$file")) ? removeFolder("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
}
?>
