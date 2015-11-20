<?php
@session_start();
$user=@$_SESSION['user'];
$fname=@$_SESSION['fname'];
if(@$user=="coordinator@aoes.com")
{
	$user="Coordinator";
	include "../../includes/db.inc.php";
	$query="select * from exams";
	$colors= array('primary', 'danger', 'success', 'info', 'warning');
	$bar_color="";
	$result=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows()>0)
	{
		$rows=round(mysql_affected_rows()/2);
		$col_count=1;
		?>
		<input type="hidden" id="topss">
		<div class="row">
			<div class="col-md-6">
		<?php
		
		while($ar=mysql_fetch_array($result))
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
			$e_ngm=$ar[13];
			$color=$colors[mt_rand(0,4)];
			?>
                            <div class="box box-<?php echo $color; ?>">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $e_name." <small>ID: $e_id</small>"; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body" style="border-top:1px solid #f4f4f4;">
					<div class="row">

						<div class="col-md-8">
						<div class="col-md-6">

							<p>No. Of Questions</p>
							<p>Exam Duration</p>
							<p>Exam Type</p>
							<p>Created On</p>
							<p>Question Paper Status</p>
							<p>Exam Key Status</p>
							<p>Exam Registrations</p>
							<p>Exam Active</p>
							<p>Exam Results</p>
							
						</div>
						
						<div class="col-md-6" style="border-right:1px solid #f4f4f4;">
							<p>: <?php echo $no_q; ?></p>
							 <p>: <?php echo $e_duration." Mins"; ?></p>
							 <p>: 
							 <?php
								if($e_type=="SR")
								{
									echo "Spot Result";
								}
								else if($e_type=="LR")
								{
									echo "Late Result";
								}
								else
								{
									echo "Some This Wrong!";
								}
							 ?>
							 </p>
							<p>: <?php echo $e_date; ?></p>
							<?php

								$p_per=0;
								$k_per=0;
								$paper_text=$paper_status;
							//Question Paper
								if($paper_status=="NOT PREPARED")
								{
									echo "<p class='text-red'>: NOT AT PREPARED</p>";
								}
								else if($paper_status=="PREPARED")
								{
									echo "<p class='text-green'>: PREPARED</p>";
									$p_per=100;
								}
								else
								{
									echo "<p class='text-light-blue'>: Prepared $paper_status out of $no_q</p>";
									$p_per=round(($paper_status/$no_q)*100);
								}
								
							//Key
								if($key_status=="NOT UPLOADED")
								{
									echo "<p class='text-red'>: NOT UPLOADED</p>";
								}
								else if($key_status=="UPLOADED")
								{
									echo "<p class='text-green'>: UPLOADED</p>";
									$k_per=100;
								}
								else
								{
									echo "<p class='text-light-blue'>: Prepared $key_status out of $no_q</p>";
									$k_per=round(($key_status/$no_q)*100);
								}
							//Registrations
								if($reg=="NOT OPEND")
								{
									echo "<p>: <span class='text-red'>$reg</span></p>";
								}
								else if($reg=="OPEND")
								{
									echo "<p>: <span class='text-green'>$reg</span></p>";
								}
								else
								{
									echo "<p>: <span class='text-warning'>Some Thing Wrong !</span></p>";
								}
							//Exam Active
								if($exam_active=="NO")
								{
									echo "<p>: <span class='text-red'>$exam_active</span></p>";
								}
								else if($exam_active=="YES")
								{
									echo "<p>: <span class='text-green'>$exam_active</span></p>";
								}
								else
								{
									echo "<p>: <span class='text-warning'>Some Thing Wrong !</span></p>";
								}
							//Exam Results
								if($results=="NOT GENARATED")
								{
									echo "<p>: <span class='text-red'>$results</span></p>";
								}
								else if($results=="SPOT RESULTS")
								{
									echo "<p>: <span class='text-green'>$results</span></p>";
								}
								else if($results=="GENARATED")
								{
									echo "<p>: <span class='text-green'>$results</span></p>";
								}
								else
								{
									echo "<p>: <span class='text-warning'>Some Thing Wrong !</span></p>";
								}
							?>
							 
						</div>
						
					</div>
					<?php
						$q=mysql_query("show databases")or die(mysql_error());
						$c=0;
						$database="Not Exist";
						$db_per=0;
						//Data base check
						if(mysql_affected_rows()>0)
						{
							while($r=mysql_fetch_array($q))
							{
								if(strcasecmp($e_id,$r[0])==0)
								{
									$c=$c+1;
									break;
								}
							}
						}
						if($c>0)
						{
							$database="Exist";
							$db_per=20;
						}
						else
						{
							$database="Not Exist";
							$db_per=0;
						}
						//Directory Check
						$directory="";
						$dir_per=0;
						if(is_dir("../../Exams/$e_id"))
						{
							$dir_per+=10;
							if(opendir("../../Exams/$e_id"))
							{
								$dir_per+=10;
								$directory="<p calss='text-green'>Exist</p>";
							}
							else
							{
								$directory="<p calss='text-yellow'>Exist but not Readable</p>";
							}
						}
						else
						{
							$directory="<p calss='text-red'>Not Exist</p>";
						}
						
					?>

					<div class="col-md-4">
						<!-- prograss -->
						<div class="pad">

							
							<div class="clearfix">
								<span class="pull-left">Data Base</span>
								<small class="pull-right"><?php echo $database; ?></small>
							</div>
							<!--<div class="progress xs">
								<?php
									if($db_per>89)
									{
										$bar_color="green";
									}
									else if($db_per>69)
									{
										$bar_color="light-blue";
									}
									else if($db_per>49)
									{
										$bar_color="aqua";
									}
									else if($db_per>29)
									{
										$bar_color="yellow";
									}
									else
									{
										$bar_color="red";										
									}
								?>
								<div class="progress-bar progress-bar-<?php echo $bar_color; ?>" style="width: <?php echo $db_per; ?>%;"></div>
							</div>-->

							<div class="clearfix">
								<span class="pull-left">Exam Directory</span>
								<small class="pull-right"><?php echo $directory; ?></small>
							</div>
							<!--<div class="progress xs">
								<?php
									if($dir_per>89)
									{
										$bar_color="green";
									}
									else if($dir_per>69)
									{
										$bar_color="light-blue";
									}
									else if($dir_per>49)
									{
										$bar_color="aqua";
									}
									else if($dir_per>29)
									{
										$bar_color="yellow";
									}
									else
									{
										$bar_color="red";										
									}
								?>
								<div class="progress-bar progress-bar-<?php echo $bar_color; ?>" style="width: <?php echo $directory; ?>%;"></div>
							</div>-->

							<div class="clearfix">
								<span class="pull-left">Paper</span>
								<small class="pull-right"><?php echo $p_per."%"; ?></small>
							</div>
							<div class="progress xs">
								<?php
									if($p_per>89)
									{
										$bar_color="green";
									}
									else if($p_per>69)
									{
										$bar_color="light-blue";
									}
									else if($p_per>49)
									{
										$bar_color="aqua";
									}
									else if($p_per>29)
									{
										$bar_color="yellow";
									}
									else
									{
										$bar_color="red";										
									}
								?>
								<div class="progress-bar progress-bar-<?php echo $bar_color; ?>" style="width: <?php echo $p_per; ?>%;"></div>
							</div>

							<div class="clearfix">
								<span class="pull-left">Key</span>
								<small class="pull-right"><?php echo $k_per."%"; ?></small>
							</div>
							<div class="progress xs">
								<?php
									if($k_per>89)
									{
										$bar_color="green";
									}
									else if($k_per>69)
									{
										$bar_color="light-blue";
									}
									else if($k_per>49)
									{
										$bar_color="aqua";
									}
									else if($k_per>29)
									{
										$bar_color="yellow";
									}
									else
									{
										$bar_color="red";										
									}
								?>
								<div class="progress-bar progress-bar-<?php echo $bar_color; ?>" style="width: <?php echo $k_per; ?>%;"></div>
							</div>

							<div class="clearfix">
								<span class="pull-left">Total</span>
								<?php

								$total_per=0;
								$total_per+=$db_per+$dir_per;
								$total_per+=(($k_per*30)/100)+(($p_per*30)/100);
								?>
								<small class="pull-right"><?php echo $total_per."%"; ?></small>
							</div>
							<div class="col-md-12">
								<br>
														<div id="nob-<?php echo $e_id; ?>">
														    <input type="text" class="knob" id="" data-readonly="true" data-width="70" data-height="70" data-fgColor="#f56954"/>
														    </div>

									<script type="text/javascript">
										i<?php echo $e_id; ?>=0;
										k=0;
										nani<?php echo $e_id; ?>();
										function nani<?php echo $e_id; ?>()
										{
											if(i<?php echo $e_id; ?><=<?php echo $total_per; ?>)
											{
												bar_color=""
												if(i<?php echo $e_id; ?>>89)
												{
													bar_color="green";
												}
												else if(i<?php echo $e_id; ?>>69)
												{
													bar_color="purple";
												}
												else if(i<?php echo $e_id; ?>>49)
												{
													bar_color="blue";
												}
												else if(i<?php echo $e_id; ?>>29)
												{
													bar_color="aqua";
												}
												else
												{
													bar_color="red";										
												}
												setTimeout("nani<?php echo $e_id; ?>()",5);
												$("div[id='nob-<?php echo $e_id; ?>'] .knob").remove();
												$("#nob-<?php echo $e_id; ?>").html("<input type='text' class='knob' value='"+i<?php echo $e_id; ?>+"' data-readonly='true' data-width='70' data-height='70' data-fgColor='"+bar_color+"'/>");
												$("div[id='nob-<?php echo $e_id; ?>'] .knob").knob();
												++i<?php echo $e_id; ?>;
											}
										}
										
									</script>
							</div>
							
						</div>
						
					</div>

					</div><!-- row -->
                  
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
					<div class="col-md-8" style="border-right:1px solid #f4f4f4;">
					<?php
						if($exam_active=="YES")
						{
							?>
							<button class="btn btn-danger btn-flat btn-sm" onclick="examStatus('<?php echo $e_id; ?>', 'exam_deactive')"><i class="glyphicon glyphicon-off"></i> Deactive</button>
							<?php
						}
						if($exam_active=="NO")
						{
							?>
							<button class="btn btn-success btn-flat btn-sm" onclick="examStatus('<?php echo $e_id; ?>', 'exam_active')"><i class="glyphicon glyphicon-send"></i> Active</button>
							<?php
						}
						
						if($results=="NOT GENARATED")
						{
							?>
							<button class="btn btn-success btn-flat btn-sm" id="results-popover"  data-toggle="tooltip" title="Results are Not Avialable to Users(Students) ! Click Here to Active or Genarate Results !" onclick="examStatus('<?php echo $e_id; ?>', 'results_active')" ><i class="fa fa-trophy"></i>  Active Results</button>
							<?php
						}
						if($results=="SPOT RESULTS")
						{
							?>
							<button class="btn btn-default btn-flat btn-sm" id="results-popover" data-toggle="tooltip" title="This is Spot Result Exam ! You can't Stop the Results !"><i class="fa fa-trophy"></i>  Active Results</button>
							<?php
						}
						if($results=="GENARATED")
						{
							?>
							<button class="btn btn-danger btn-flat btn-sm" id="results-popover" data-toggle="tooltip" title="Results are Avialable to Users(Students) ! Click Here to Stop Results !" onclick="examStatus('<?php echo $e_id; ?>', 'results_deactive')"><i class="fa fa-trophy"></i>  Stop Results</button>
							<?php
						}
						if($key_status=="NOT UPLOADED")
						{
							?>
							<button class="btn btn-default btn-flat btn-sm" id="results-popover" data-toggle="tooltip" title="Key is Not at uploaded ! Upload the Key First !"><i class="fa fa-trophy"></i>  Active Key</button>
							<?php
						}
						if($key_status==$no_q)
						{
							?>
							<button class="btn btn-primary btn-flat btn-sm" id="results-popover" data-toggle="tooltip" title="BE CAREFULL!   Active the key after 'ALL USERS COMPLETE THEIR EXAM' Otherwise They can see the key. " onclick="examStatus('<?php echo $e_id; ?>', 'key_active')"><i class="fa fa-trophy"></i>  Active Key</button>
							<?php
						}
						if($key_status=="UPLOADED")
						{
							?>
							<button class="btn btn-primary btn-flat btn-sm" id="results-popover" data-toggle="tooltip" title="BE CAREFULL!   Active the key after 'ALL USERS COMPLETE THEIR EXAM' Otherwise They can see the key. " onclick="examStatus('<?php echo $e_id; ?>', 'key_deactive')"><i class="fa fa-trophy"></i>  Disable Key</button>
							<?php
						}
					?>
					<br><br>
					<button class="btn btn-primary btn-flat btn-sm" onclick="conf('<?php echo $e_pass; ?>', '<?php echo $e_inv; ?>')"><i class="glyphicon glyphicon-cog"></i>  Confidencial Information</button> <a class="btn btn-purple btn-flat btn-sm" href="./Exams/resultxl.php?id=<?php echo $e_id; ?>&type=<?php echo $e_type; ?>&ngm=<?php echo $e_ngm; ?>&ename=<?php echo $e_name; ?>" ><i class="glyphicon glyphicon-stats"></i>  Results Download</a>
					</div>
					<div class="col-md-4">
						<button class="btn btn-primary btn-flat" onclick="QuestionPaper('<?php echo $e_id; ?>', '<?php echo $e_name; ?>')"><i class="glyphicon glyphicon-file"></i>  Prepare Questions</button>
						<br><br>
						<button class="btn btn-danger btn-flat" onclick="openModal_exam('<?php echo $e_id; ?>')"><i class="fa fa-trash-o"></i> Delete Exam</button>
					</div>
					
                                </div>
                                
                            </div><!-- /.box -->

                            
                            <div class="modal fade" id="delete_exam-<?php echo $e_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
									    <div class="modal-dialog">
										<div class="modal-content">
										    <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title"><i class="fa fa-tasks"></i> Exam: <?php echo $e_name; ?></h4>
										    </div>
										    <div class="modal-body">
												<form id="delete_exam-<?php echo $e_id; ?>" onsubmit="return deleteExam('<?php echo $e_id; ?>')">
												<h4>Enter The Coordinator Password:</h4>
												<div class="form-group">
												<label>Password:</label>
												<input type="password" name="pass" class="form-control" required />
												<input type="hidden" name="e_id" value="<?php echo $e_id; ?>" />
												<input type="hidden" name="operation" value="delete" />
												</div>

											</div>
											<div class="modal-footer clearfix">
								
														<button type="submit" class="btn btn-danger btn-flat pull-left"><i class='fa fa-trash-o'></i>  Delete</button>

														<button type="button" class="btn btn-primary btn-flat pull-right" data-dismiss="modal"><i class='fa fa-times'></i> Cancel</button>
														</form>
										</div><!-- /.modal-content -->			
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							</div>
			<?php
			
			if($rows==$col_count)
			{
				?>
				</div>
				<div class="col-md-6">
				<?php
			}
			$col_count++;
		}
		
		?>
		</div>
		</div><!-- /.row end -->

							
		<?php
	}
?>
	<script src='../includes/js/jquery.min.js' type='text/javascript'></script>
	<script src="../includes/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
	<script src='../includes/js/modal.js' type='text/javascript'></script>
	<script src='../includes/js/exam.js' type='text/javascript'></script>
	<script src='../includes/js/tooltip.js' type='text/javascript'></script>
	<script src='../includes/js/bootbox.min.js' type='text/javascript'></script>
	<script type='text/javascript'>
		$(document).ready(function()
		{
			$(".btn").tooltip(
			{
				html : true,
				placement: 'top',
				animation: true
			});
		});
		function conf(e,i)
		{
			bootbox.alert("<br><br>Exam Password : "+e+"<br>Invigilator Password : "+i);
		}
	</script>
<?php
}
else
{
	?>
	<script type='text/javascript'>
		window.location="../"
	</script>
	<?php
}
?>
