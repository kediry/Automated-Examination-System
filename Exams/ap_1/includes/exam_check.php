<?php
mysql_select_db($e_id);
if(isSet($_SESSION['exam_user']) && ($_SESSION['exam_user']==$_SESSION['e-user']) && isSet($_SESSION['exam_id']) && $_SESSION['exam_id']==$e_id)
{
	
}
else
{
	unset($_SESSION['exam_user']);
	unset($_SESSION['exam_id']);
	?>
	<script type="text/javascript">
		document.location="./index.php";
	</script>
	<?php
	die("");
}
if($exam_active=="NO")
{
	?>
	<div class="panel panel-default col-md-6 col-md-offset-3">
					<div class="panel-heading">
						<h4 class="text-danger">This Exam Currently Not Active !</h4>
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
$query=mysql_query("select * from time where id='$user'")or die(mysql_error());
$r=mysql_fetch_row($query)or die(mysql_error());
if(($r[0]==-1)&&($r[1]==60))
{
	?>
	<script type="text/javascript">
		document.location="./submit.php?submit=<?php echo md5($user); ?>";
	</script>
	<?php
	die();
}
else if(($r[0]==$e_duration-1)&&($r[1]==60))
{
	
}
else
{
	?>
			<div class="modal fade"  id="Invigilator" data-backdrop="static" data-keyboard="false">
									    <div class="modal-dialog" style="width:700px;">
										<div class="modal-content">
										    <div class="modal-header">
											<span style="font-weight:bold;font-size:17px;">Exam: <?php echo $e_name; ?></span>
										    </div>
										    <div class="modal-body">
												<p class="text-red">
													<font color="red">
													<dl>
														<dt>-- Note for Invigilator:</dt>
														<dd>This window was open because He/She was <b>ReOpened</b> the Exam or <b>Refreshed</b> the window.</dd>
														<br>
														<dd>Ask the reason if you satisify with the reason of him/her then type the password.</dd>
													</dl>
													</font>
											    </p>
											    <br>
											    <br>
												<form id="delete_exam-<?php echo $e_id; ?>" onsubmit="return checkInv()">
												<span style="font-weight:bold;font-size:15px;">Enter The Invigilator Password:</span>
												<br><br>
												<div class="form-group">
												Password:
												<input type="password" name="pass1" class="form-control" onfocus="fullC()" required />
												<input type="hidden" name="e_id" value="<?php echo $e_id; ?>" />
												</div>

											</div>
											<hr>
											<div class="modal-footer">
														<button type="submit" class="btn btn-danger btn-flat pull-right"><i class='fa fa-trash-o'></i>   Close  </button>
														</form>
											</div>
										</div><!-- /.modal-content -->			
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
	<?php
}
?>
						<div class="modal fade"  id="BlurCheck" data-backdrop="static" data-keyboard="false">
									    <div class="modal-dialog" style="width:700px;">
										<div class="modal-content">
										    <div class="modal-header">
											<span style="font-weight:bold;font-size:17px;">Exam: <?php echo $e_name; ?></span>
										    </div>
										    <div class="modal-body">
											    <br>
											    <p class="text-red">
													<font color="red">
													<dl>
														<dt>-- Note for Invigilator:</dt>
														<dd>This window was open because He/She was <b>Minimize</b> the Exam or open other <b>Window</b> or <b>Tab</b>.</dd>
														<br>
														<dd>Ask the reason if you satisify with the reason of him/her then type the password.</dd>
													</dl>
													</font>
											    </p>
											    <br>
												<form id="delete_exam-<?php echo $e_id; ?>" onsubmit="return checkInv()">
												<span style="font-weight:bold;font-size:15px;">Enter The Invigilator Password:</span>
												<br><br>
												<div class="form-group">
												Password:
												<input type="password" name="pass" class="form-control" onfocus="fullC()" required />
												<input type="hidden" name="e_id" value="<?php echo $e_id; ?>" />
												</div>

											</div>
											<hr>
											<div class="modal-footer">
														<button type="submit" class="btn btn-danger btn-flat pull-right"><i class='fa fa-trash-o'></i>   Close  </button>
														</form>
											</div>
										</div><!-- /.modal-content -->			
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
