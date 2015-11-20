<?php
session_start();
if(isSet($_SESSION["e-user"]))
{
?>
<html>
	<link rel="stylesheet" type="text/css" href="../includes/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../includes/css/theme.css" />
<body>
	<div class="navbar navbar-fixed-top header">
		<div class="col-md-12">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">AOES</a>
			</div>
			<ul class="nav navbar-nav navbar-left">
				<li><a href="../about.php"> <i class="glyphicon glyphicon-heart"></i> About Us</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION['fname']; ?> <i class="glyphicon glyphicon-user"></i> </a>
					<ul class="dropdown-menu">
					  <li><a href="#" onclick="openModal()"><i class="glyphicon glyphicon-cog"></i> Change Password </a></li>
					  <li><a href="action.php?signout=yes"><i class="glyphicon glyphicon-off"></i> Logout </a></li>
					</ul>
				 </li>
			</ul>
		</div>
	</div>
	
	<div class="container" id="main">
	<?php
	include "../includes/db.inc.php";
	$q=mysql_query("select * from exams") or die(mysql_error());
	while($ar=mysql_fetch_array($q))
	{
			
			$e_id=$ar[0];
			$e_name=$ar[1];
			$e_type=$ar[2];
			$e_date=$ar[3];
			$no_q=$ar[4];
			$e_duration=$ar[5];
			$e_pass=$ar[6];
			$e_inv=$ar[7];
			$paper_status=$ar[8];
			$results=$ar[9];
			$key_status=$ar[10];
			$exam_active=$ar[11];
			$reg=$ar[12];
			$ngm=$ar[13];
			
			if(($exam_active=="YES") || ($results=="GENARATED") || ($key_status=="UPLOADED"))
			{
			?>
			<div class="panel panel-default col-md-4">
				<div class="panel-heading">
					<h3><?php echo $e_name; ?></h3>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<p>No. Of Questions</p>
						<p>Exam Duration</p>
						<p>Exam Type</p>
						<p>Negitive Marking</p>
					</div>
					<div class="col-md-6">
						<p>: <?php echo $no_q; ?></p>
						<p>: <?php echo $e_duration." Mins"; ?></p>
						<p>: <?php if($e_type=="SR"){echo "SPOT RESULTS"; }else{ echo "LATE RESULTS";  }?></p>
						<p>: <?php echo $ngm." (1)"; ?></p>
					</div>
				</div>
				<div class="panel-footer">
					<?php
						if($exam_active=="YES")
						{
							?>
							<a class="btn btn-primary" href="../Exams/<?php echo $e_id ?>"> Take Exam</a>
							<?php
						}
						if($results=="GENARATED")
						{
							?>
							<a class="btn btn-success" href="../Exams/<?php echo $e_id ?>/result.php">Your Result</a>
							<?php
						}
						if($key_status=="UPLOADED")
						{
							?>
							<a class="btn btn-info" href="../Exams/<?php echo $e_id ?>/key.php">Key</a>
							<?php
						}
					?>
				</div>
			</div>
			<?php
			}
			
	}
	?>
		
	</div>
	
	<div class="modal fade" id="changepass">
			<div class="modal-dialog" style="width:700px;">
						<div class="modal-content">
								<div class="modal-header">
										<span style="font-weight:bold;font-size:17px;">Changing Password:</span>
								</div>
											<form action="POST" onsubmit="return changePass()">
										    <div class="modal-body">
													Enter OLD Password:
													<input type="password" name='oldpass' class="form-control">
													<br>
													New Password:
													<input type="password" name='npass1' class="form-control">
													<br>
													New Password (again):
													<input type="password" name='npass2' class="form-control">
											</div>
											<div class="modal-footer">
												<button type='submit' class="btn btn-primary pull-left">Change Password</button><button type='reset' class="btn btn-danger pull-left">Reset Fields</button><button type='reset' class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
											</div>
											</form>
						</div><!-- /.modal-content -->			
			</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
</body>
<script type="text/javascript" src="../includes/js/jquery.min.js"></script>
<script type="text/javascript" src="../includes/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../includes/js/bootbox.min.js"></script>
<script type="text/javascript">
	function openModal()
	{
		$("#changepass").modal("show");
	}
	
	function changePass()
	{
		oldpass=$("input[name='oldpass']").val();
		npass1=$("input[name='npass1']").val();
		npass2=$("input[name='npass2']").val();
		if(npass1==npass2)
		{
			$.ajax({
				
				type:"POST",
				url:"action.php",
				data: "old="+oldpass+"&npass="+npass1+"&changepass=yes",
				dataType:"text",
				success: function(res)
				{
					if(res.indexOf("success"))
					{
						$("#changepass").modal("hide");
						bootbox.alert("<br><br><p class='text-success'>Password Successfully Changed!</p>");
						$("input[name='oldpass']").val("");
						$("input[name='npass1']").val("");
						$("input[name='npass2']").val("");
					}
					else if(res.indexOf("olderror"))
					{
						bootbox.alert("<br><br><p class='text-danger'>OLD Password is not Correct!</p>");
						$("input[name='oldpass']").val("");
						$("input[name='npass1']").val("");
						$("input[name='npass2']").val("");
					}
					else
					{
						$("#changepass").modal("hide");
						bootbox.alert("<br><br><p class='text-danger'>"+res+"</p>");
						$("input[name='oldpass']").val("");
						$("input[name='npass1']").val("");
						$("input[name='npass2']").val("");
					}
				}
				
			});
		}
		else
		{
			bootbox.alert("<br><br>Both Passwords are Not Matched!");
			$("input[name='npass1']").val("");
			$("input[name='npass2']").val("");
		}
		
		return false;
	}
</script>
</html>
<?php
}
else
{
	?>
	<script type="text/javascript">
		document.location="../"
	</script>
	<?php
}
?>
