<?php
@session_start();
$user=@$_SESSION['user'];
$fname=@$_SESSION['fname'];
if(@$user=="coordinator@aoes.com")
{
	if(isSet($_REQUEST['id']))
	{
		$e_id=$_REQUEST['id'];
		include "../../includes/db.inc.php";
		$q=mysql_query("select no_questions,paper_status from exams where id='$e_id'") or die(mysql_error());
		if(mysql_affected_rows()>0)
		{
			$r=mysql_fetch_row($q);
			$total_q=$r[0];
			$p_q=$r[1];
			if($p_q=="NOT PREPARED")
			{
				$p_q=0;
			}
		
		?>				
		<div class="box box-solid navbar-static-top" id='nani' data-spy="affix">
			
				       <div class="box-header">
                                       <h3 class="box-title"><?php echo $p_q." out of ".$total_q."Prepared" ?></h3>
					</div>
					
					<?php
						$q=mysql_query("use $e_id") or die(mysql_error());
						if($q)
						{
							$i=1;
							?>
							<div class="box-body">
								
								<div class="row">
									<div class='col-md-9' id='nani1'>
									<ul class="pagination pagination-sm no-margin">
										<?php 
										for($k=1;$k<=$total_q;$k++)
										{
											echo "<li id='$k'><a href='#' class='btn btn-default btn-flat' onclick='openModal($k)'>$k</a></li>";
										}
										?>
									</ul>
									</div>
								</div>
								<br>
								<div class="row"><!--Main-->
								</div>
				</div>
		</div>
								
								<?php 
								$q1=mysql_query("select qid from questions")or die(mysql_error());
								$ar_q[0]=0;
								if($q1)
								{
									$n=1;
									while($r=mysql_fetch_array($q1))
									{
										$ar_q[$n]=$r[0];
										$n++;
									}
								}
								
								for($k=1;$k<=$total_q;$k++)
								{
									$c=0;
									for($m=1;$m<=$total_q;$m++)
									{
										if($k==@$ar_q[$m])
										{
											$c=1;
											break;
										}
									}
									if($c==0)
									{
									?>
									<div class="modal fade" id="modal-<?php echo $k; ?>" tabindex="-1" role="dialog" aria-hidden="true">
									    <div class="modal-dialog" style="width:900px;">
										<div class="modal-content">
										    <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title"><i class="fa fa-tasks"></i> Question Number: <?php echo $k; ?></h4>
										    </div>
										    <div class="modal-body">
												
											    <div class="nav-tabs-custom">
												<ul class="nav nav-tabs pull-right">
												    <li id="tab-1" class="active"><a href="#" class="tab_1-1" data-toggle="tab">TEXT</a></li>
												    <li id="tab-2"><a href="#" class="tab_2-2" data-toggle="tab">IMAGE</a></li>
												</ul>
												<div class="tab-content">
												    <div class="tab-pane active" id="tab_1-1">

													<form autocomplete="off" onsubmit="return textQuestion('<?php echo $k; ?>', '<?php echo $e_id; ?>')">
														

														<div class="form-group">
														    <label>Question:</label>
														    <textarea class="form-control" name="question-<?php echo $k; ?>" placeholder="Type Your Question Here" required /></textarea>
														</div>

														<div class="form-group">
														    <label>No.Of.Options:</label>
														    <select class="form-control" name="no_o-<?php echo $k; ?>" onchange="up_options('<?php echo $k; ?>')" required >
															<option value=''>:: Select Here ::</option>
															<option value='2'>2</option>
															<option value='3'>3</option>
															<option value='4'>4</option>
															<option value='5'>5</option>
															<option value='6'>6</option>
															<option value='7'>7</option>
															<option value='8'>8</option>
														    </select>
														</div>

														<div id='options-<?php echo $k; ?>'>
															
														
														
														</div>

														
													

													<div class="modal-footer clearfix">

														<button type="submit" class="btn btn-primary btn-flat pull-left"><i class='fa fa-plus'></i> Add Question</button>

														<button type="reset" class="btn btn-warning btn-flat pull-left"><i class='glyphicon glyphicon-transfer'></i> Reset Fields</button>

														<button type="button" class="btn btn-danger btn-flat pull-right" data-dismiss="modal"><i class='fa fa-times'></i> Discard</button>
										    
													</div>

													</form>
													
												    </div><!-- /.tab-pane -->
												    <div class="tab-pane" id="tab_2-2">

													<form id="form-<?php echo $k; ?>" autocomplete="off" onsubmit="return imgQuestion('<?php echo $k; ?>', '<?php echo $e_id; ?>')" enctype="multipart/form-data">

														<div class="fileinput fileinput-new" data-provides="fileinput">
															  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 400px; height: 250px;"></div>
															  <div>
															    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><input type="file" accept="image/*" required  name="question"></span>
															    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
															  </div>
														</div>

														<div class="form-group">
														    <label>No.Of.Options:</label>
														    <select class="form-control" name="no_options" required>
															<option value=''> :: Select Here :: </option>
															<option value='2'>2</option>
															<option value='3'>3</option>
															<option value='4' >4</option>
															<option value='5'>5</option>
															<option value='6'>6</option>
															<option value='7'>7</option>
															<option value='8'>8</option>
														    </select>
														</div>
														
														<input type="hidden" name="exam" value="<?php echo $e_id; ?>" />
														<input type="hidden" name="q_no" value="<?php echo $k; ?>" />

														<div class="modal-footer clearfix">
								
														<button type="submit" class="btn btn-primary btn-flat pull-left"><i class='fa fa-plus'></i> Add Question</button>

														<button type="reset" class="btn btn-warning btn-flat pull-left"><i class='glyphicon glyphicon-transfer'></i> Reset Fields</button>

														<button type="button" class="btn btn-danger btn-flat pull-right" data-dismiss="modal"><i class='fa fa-times'></i> Discard</button>
														</div>
														
													</form>
													
												    </div><!-- /.tab-pane -->
												</div><!-- /.tab-content -->
											    </div><!-- nav-tabs-custom -->
										
										    </div>
									   </div><!-- /.modal-content -->
								    </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
									<?php 
									}
								}
								
							$q=mysql_query("select qid from questions") or die(mysql_error());
							echo "<script src='../includes/js/jquery.min.js' type='text/javascript'></script>";
							?>
							<script type="text/javascript">
							function up_options(n)
							{
									num=$("select[name='no_o-"+n+"']").val();
									elem="";
									v="";
									for(i=1;num>=i;i++)
									{
										if(document.getElementsByName("op-"+i+"-"+n)[0])
										{
											v=document.getElementsByName("op-"+i+"-"+n)[0].value;
										}
										else
										{
											v="";
										}
										elem+="<div class='form-group'>";
										 elem+="<label>Option-"+i+":</label>";
										 elem+="<input type='text' class='form-control' name='op-"+i+"-"+n+"' placeholder='Type Option-"+i+" here' value='"+v+"'  />";
										elem+="</div>";
									}
									$("div[id='options-"+n+"']").html(elem);
							}
							</script>
							<?php 
							echo "<script src='../includes/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js' type='text/javascript'></script>";
							echo "<script type='text/javascript'>";
							echo "$(document).ready(function(){";
							while($r=mysql_fetch_array($q))
							{
									?>
										$("li[id='<?php echo $r[0]; ?>']").addClass("active");
										$("li[id='<?php echo $r[0]; ?>'] a").attr({'href':'#question_<?php echo $r[0]; ?>', 'class':'btn btn-default btn-flat', 'onclick':'goLoc()'});
									<?php 
								
							}
							?>
							$(function() {
								// Replace the <textarea id="editor1"> with a CKEditor
								// instance, using default configuration.
								//bootstrap WYSIHTML5 - text editor
								$(".textarea").wysihtml5();
							    });
								
								$(".tab_1-1").click(function()
								{
									$("div[id='tab_1-1']").attr("class","tab-pane active");
									$("div[id='tab_2-2']").attr("class","tab-pane");
									$("li[id='tab-2']").attr("class","");
									$("li[id='tab-1']").attr("class","active");
								});
								$(".tab_2-2").click(function()
								{
									$("div[id='tab_1-1']").attr("class","tab-pane");
									$("div[id='tab_2-2']").attr("class","tab-pane active");
									$("li[id='tab-2']").attr("class","active");
									$("li[id='tab-1']").attr("class","");
								});
							<?php 
							echo "});";
							echo "</script>";
							?>


							<div class="box box-primary col-md-12" id="abcd" data-spy="scroll" data-target="#nani1">
								<div class="box-header">
							       <h3 class="box-title">Prepared Questions</h3>
								</div>

								<div class="box-body">
									<?php 
									$q=mysql_query("select * from questions order by qid ASC") or die(mysql_error());
									while($r=mysql_fetch_array($q))
									{
										$qid=$r[0];
										$sid=$r[1];
										$question=str_replace("<img src=/includes/img/", "<img src=../Exams/$e_id/includes/img/", $r[2]);
										$nop=$r[3];
										$ans=$r[4];
										$options[0]="";
										$type="";
										for($i=1;$i<=$nop;$i++)
										{
											$options[$i]=$r[($i+4)];
										}
										?>
										<div class="box box-solid">
											<div class="box-body">

												<div class="row" style="padding-left:20px;">
												<p id="question_<?php echo $qid; ?>">
													<label><?php echo $qid; ?>)&emsp;<?php echo $question; ?></label>
												</p>
												
												<div class="form-group ">
													<?php
													for($i=1;$i<=$nop;$i++)
													{
														$tmp="<label><input type='radio' class='square-aero'  checked />".$options[$i]."</label><br>";
														echo $tmp;
													}
													?>
												</div>
												<p><span class="text-light-blue">Answer:</span><b>
													<?php
														if($ans==NULL)
														{
															echo "<span class='text-red'>Answer not Updated!</span>";
														}
														else
														{
															echo "<span class='text-green'> $ans</span>";
														}
													 ?>
												</b></p>
												</div>
											</div>

											<div class='box-footer'>
												<?php 
												if(stristr($question,"<img src="))
												{
													$type="img";
												?>
												<button class='btn btn-primary btn-flat' onclick="openModall(<?php echo $qid; ?>, 'img' )">Update Question</button>
												<?php 
												}
												else
												{
													$type="txt";
												?>
												<button class='btn btn-primary btn-flat' onclick="openModall(<?php echo $qid; ?>, 'txt' )">Update Question</button>
												<?php 
												}
												?>
												<button class='btn btn-success btn-flat' onclick="upModal(<?php echo $qid; ?>)">Update Key</button>
												<button class='btn btn-danger btn-flat' onclick="deleteModal(<?php echo $qid; ?>)"><i class='fa fa-trash-o'></i> Delete</button>
											</div>
										</div>


									

									<div class="modal fade" id="modal-<?php echo $qid; ?>" tabindex="-1" role="dialog" aria-hidden="true">
									    <div class="modal-dialog" style="width:900px;">
										<div class="modal-content">
										    <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title"><i class="fa fa-tasks"></i> Question Number: <?php echo $qid; ?></h4>
										    </div>
										    <div class="modal-body">
											    <div class="nav-tabs-custom">
												<ul class="nav nav-tabs pull-right">
												    <li id="tab-1"><a href="#" class="tab_1-1" data-toggle="tab">TEXT</a></li>
												    <li id="tab-2"><a href="#" class="tab_2-2" data-toggle="tab">IMAGE</a></li>
												</ul>
												<div class="tab-content">
												    <div class="tab-pane" id="tab_1-1">

													<form autocomplete="off" onsubmit="return updateTextQuestion('<?php echo $qid; ?>', '<?php echo $e_id; ?>')">
														
														<?php 
														if($type=="txt")
														{
														?>
														<div class="form-group">
														    <label>Question:</label>
														    <textarea class="form-control" name="question-<?php echo $qid; ?>" placeholder="Type Your Question Here" required ><?php echo $question; ?></textarea>
														</div>

														<div class="form-group">
														    <label>No.Of.Options:</label>
														    <select class="form-control" name="no_o-<?php echo $qid; ?>" onchange="up_options('<?php echo $qid; ?>')" required >
															<option value=''>:: Select Here ::</option>
															<option value='2'>2</option>
															<option value='3'>3</option>
															<option value='4'>4</option>
															<option value='5'>5</option>
															<option value='6'>6</option>
															<option value='7'>7</option>
															<option value='8'>8</option>
														    </select>
														</div>

														<div id='options-<?php echo $qid; ?>'>
															<?php 
															for($i=1;$i<=$nop;$i++)
															{
																echo "<div class='form-group'>";
																echo "<label>Option-$i:</label>";
																echo "<input type='text' class='form-control' name='op-$i-$qid' placeholder='Type Option-$i here' value='".$options[$i]."'  />";
																echo "</div>";
															}
															?>
														
														</div>
														<?php 
													}
													else
													{
														?>
														<div class="form-group">
														    <label>Question:</label>
														    <textarea class="form-control" name="question-<?php echo $qid; ?>" placeholder="Type Your Question Here" required /></textarea>
														</div>

														<div class="form-group">
														    <label>No.Of.Options:</label>
														    <select class="form-control" name="no_o-<?php echo $qid; ?>" onchange="up_options('<?php echo $qid; ?>')" required >
															<option value=''>:: Select Here ::</option>
															<option value='2'>2</option>
															<option value='3'>3</option>
															<option value='4'>4</option>
															<option value='5'>5</option>
															<option value='6'>6</option>
															<option value='7'>7</option>
															<option value='8'>8</option>
														    </select>
														</div>

														<div id='options-<?php echo $qid; ?>'>
															
														
														
														</div>
														<?php 
													}
													?>

										<div class="modal-footer clearfix">

														<button type="submit" class="btn btn-primary btn-flat pull-left"><i class='fa fa-plus'></i> Update Question</button>

														<button type="reset" class="btn btn-warning btn-flat pull-left"><i class='glyphicon glyphicon-transfer'></i> Reset Fields</button>

														<button type="button" class="btn btn-danger btn-flat pull-right" data-dismiss="modal"><i class='fa fa-times'></i> Discard</button>
										    
													</div>

													</form>
													
												    </div><!-- /.tab-pane -->
												    <div class="tab-pane" id="tab_2-2">

													<form id="form-<?php echo $qid; ?>" autocomplete="off" onsubmit="return updateImgQuestion('<?php echo $qid; ?>', '<?php echo $e_id; ?>')" enctype="multipart/form-data">
													
														<div class="fileinput fileinput-new" data-provides="fileinput">
															  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 400px; height: 250px;"></div>
															  <div>
															    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><input type="file" accept="image/*" required  name="question"></span>
															    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
															  </div>
														</div>

														<div class="form-group">
														    <label>No.Of.Options:</label>
														    <select class="form-control" name="no_options" required>
															<option value=''> :: Select Here :: </option>
															<option value='2'>2</option>
															<option value='3'>3</option>
															<option value='4' >4</option>
															<option value='5'>5</option>
															<option value='6'>6</option>
															<option value='7'>7</option>
															<option value='8'>8</option>
														    </select>
														</div>
														
														<input type="hidden" name="exam" value="<?php echo $e_id; ?>" />
														<input type="hidden" name="q_no" value="<?php echo $qid; ?>" />

														<div class="modal-footer clearfix">
								
														<button type="submit" class="btn btn-primary btn-flat pull-left"><i class='fa fa-plus'></i> Update Question</button>

														<button type="reset" class="btn btn-warning btn-flat pull-left"><i class='glyphicon glyphicon-transfer'></i> Reset Fields</button>

														<button type="button" class="btn btn-danger btn-flat pull-right" data-dismiss="modal"><i class='fa fa-times'></i> Discard</button>
														</div>
														
													</form>
													
												    </div><!-- /.tab-pane -->
												</div><!-- /.tab-content -->
											    </div><!-- nav-tabs-custom -->
										
										    </div>
									   </div><!-- /.modal-content -->
								    </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->



								<div class="modal fade" id="modal-<?php echo $qid; ?>-up" tabindex="-1" role="dialog" aria-hidden="true">
									    <div class="modal-dialog" style="width:900px;">
										<div class="modal-content">
										    <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title"><i class="fa fa-tasks"></i> Question Number: <?php echo $qid; ?></h4>
										    </div>
										    <div class="modal-body">
												<form autocomplete="off" id="form-<?php echo $qid; ?>-key" onsubmit="return updateKey('<?php echo $qid; ?>', '<?php echo $e_id; ?>')" enctype="multipart/form-data">
													
														<div class="form-group">
															<label><?php echo $question; ?></label>
														</div>

														<div class="form-group">
														    <label>Select Answer:</label>
														    <select class="form-control" name="key" required>
															<option value=''> :: Select Here :: </option>
															<?php 
															 for($i=1;$i<=$nop;$i++)
															{
																
																echo "<option  value='".$options[$i]."' >".$options[$i]."</option>";
															}
															?>
														    </select>
														</div>
														
														<input type="hidden" name="exam" value="<?php echo $e_id; ?>" />
														<input type="hidden" name="q_no" value="<?php echo $qid; ?>" />
														</div>

														
														<div class="modal-footer clearfix">
								
														<button type="submit" class="btn btn-primary btn-flat pull-left"><i class='fa fa-plus'></i> Update Key</button>

														<button type="reset" class="btn btn-warning btn-flat pull-left"><i class='glyphicon glyphicon-transfer'></i> Reset</button>

														<button type="button" class="btn btn-danger btn-flat pull-right" data-dismiss="modal"><i class='fa fa-times'></i> Discard</button>
														</div>
														
													</form>
										</div><!-- /.modal-content -->			
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->



								<div class="modal fade" id="modal-<?php echo $qid; ?>-delete" tabindex="-1" role="dialog" aria-hidden="true">
									    <div class="modal-dialog">
										<div class="modal-content">
										    <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title"><i class="fa fa-tasks"></i> Question Number: <?php echo $qid; ?></h4>
										    </div>
										    <div class="modal-body">
												<h4>Are You Sure? You Want to Delete Question - <?php echo $qid; ?> ?</h4>
											</div>
											<div class="modal-footer clearfix">
								
														<button type="submit" class="btn btn-danger btn-flat pull-left" onclick="return deleteQuestion('<?php echo $qid; ?>', '<?php echo $e_id; ?>')"><i class='fa fa-trash-o'></i>  Delete</button>

														<button type="button" class="btn btn-primary btn-flat pull-right" data-dismiss="modal"><i class='fa fa-times'></i> Cancel</button>
											</div>
										</div><!-- /.modal-content -->			
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
										<?php 
									}
									?>

								</div>

					<?php 

			}

		}
	}
	
}
else
{
}
?>
<script src='../includes/js/questions.js' type='text/javascript'></script>
<script src='../includes/js/modal.js' type='text/javascript'></script>
<script src="../includes/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<script src='../includes/js/affix.js' type='text/javascript'></script>
<script src='../includes/js/jasny-bootstrap.min.js' type='text/javascript'></script>
<script src="../includes/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
	//iCheck for checkbox and radio inputs
                $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                    checkboxClass: 'icheckbox_square',
                    radioClass: 'iradio_square'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].square-red, input[type="radio"].square-aero').iCheck({
                    checkboxClass: 'icheckbox_square-aero',
                    radioClass: 'iradio_square-aero'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-aero').iCheck({
                    checkboxClass: 'icheckbox_flat-aero',
                    radioClass: 'iradio_flat-aero'
                });

                $(window).scroll(function(){
			var y=$(window).scrollTop();
			if(y<70)
			{
				$('#nani').css({'margin-top':'0px'});
				$('#nani').attr({'class':'box box-solid'});
				$('#abcd').css({'margin-top':'0px'});
			}
			else
			{
				
				$('#nani').css({'margin-top':'40px','margin-right':'0px', 'z-index':'1'});
				$('#nani').attr({'class':'box box-solid navbar navbar-fixed-top'});
				$('#nani').addClass('col-md-offset-2');
				$('#abcd').css({'margin-top':$('#nani').height()+'px'});
			}
		});
		function goLoc()
		{
				$('#nani').css({'margin-top':'0px'});
				$('#nani').attr({'class':'box box-solid'});
				$('#abcd').css({'margin-top':'0px'});
		}
</script>
