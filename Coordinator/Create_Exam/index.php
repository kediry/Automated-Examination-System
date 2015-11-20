<?php
@session_start();
$user=@$_SESSION['user'];
$fname=@$_SESSION['fname'];
if(@$user=="coordinator@aoes.com")
{
?>

        <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Creating New Exam</h4>
                    </div>
                    <form role="form" onsubmit="return ValidateExam()">
                        <div class="modal-body">
							
                            <div class="form-group" id="e_name">
                                <div class="input-group">
                                    <span class="input-group-addon">Exam Name:</span>
										<input type="text" class="form-control" name="e_name" placeholder="Exam Name" size="30"  />
                                </div>
									<p id="e_name" style="display:none;">
											<span id="e_name"></span>
											<small>
												<em>
											Exam Name should be greaterthan 4 letters.
												</em>
											</small>
									</p>
                            </div>
                            
                            <div class="form-group" id="e_id">
                                <div class="input-group">
                                    <span class="input-group-addon">Exam ID:</span>
										<input  type="text" class="form-control" name="e_id" placeholder="Exam ID(Unique)"  size="30"  />	
                                </div>
									<p id="e_id" style="display:none;">
											<span id="e_id"></span>
											<small>
												<em>
												</em>
											</small>
										</p>
                            </div>

                            <div class="form-group" id="e_type">
                                <div class="input-group">
                                    <span class="input-group-addon">Exam Type:</span>
										<select class="form-control" name="e_type" >
														<option  value="">::: Select Exam Type :::</option>
														<option  value="SR">Spot Result Exam</option>
														<option value="LR">Late Result Exam</option>
										</select>
                                </div>
										<p id="e_type" style="display:none;">
											<span id="e_type"></span>
											<small>
												<em>
										Select Exam Type from the list.
												</em>
											</small>
										</p>
                            </div>

                            <div class="form-group" id="no_questions">
                                <div class="input-group">
                                    <span class="input-group-addon">Number of Questions:</span>
										<input class="form-control" type="text" name="no_questions" placeholder="Number of Questions"   size="30"  />
                                </div>
										<p id="no_questions" style="display:none;">
											<span id="no_questions"></span>
											<small>
												<em>
													Number of Questions should be numaric.
													Should not be empty.
												</em>
											</small>
									</p>
                            </div>

                            <div class="form-group" id="e_duration">
                                <div class="input-group">
                                    <span class="input-group-addon">Exam Duration:</span>
										<input type="text" class="form-control" name="e_duration" placeholder="Duration of Exam(Mins)"   size="30"  />
                                </div>
										<p id="e_duration" style="display:none;">
											<span id="e_duration"></span>
											<small>
												<em>
													Exam Duration should be numaric.<br>
													Duration in minutes not in (hours,seconds).<br>
													Should not be empty.
												</em>
											</small>
									</p>
                            </div>

                            <div class="form-group" id="e_pass">
                                <div class="input-group">
									<span class="input-group-addon">Exam Password:</span>
                                    <input type="password" class="form-control" name="e_pass" placeholder=""   size="30"  />
                                </div>
									<p id="e_pass" style="display:none;">
										<span id="e_pass"></span>
										<small>
											<em>
												Password should have minimum 4 charecters.
											</em>
										</small>
									</p>
                            </div>

                            <div class="form-group" id="e_pass1">
                                <div class="input-group">
                                    <span class="input-group-addon">Password:</span>
										<input type="password" class="form-control" name="e_pass1" placeholder=""   size="30"  />
                                </div>
										<p id="e_pass1" style="display:none;">
											<span id="e_pass1"></span>
											<small>
												<em>
													Both Passwords should be match.
												</em>
											</small>
									</p>
                            </div>

                            <div class="form-group" id="e_inv">
                                <div class="input-group">
                                    <span class="input-group-addon">Invigilator Key:</span>
										<input type="text" class="form-control" name="e_inv" placeholder=""   size="30"  />
                                </div>
										<p id="e_inv" style="display:none;">
											<span id="e_inv"></span>
											<small>
												<em>
													Key must have minimum 4 charecters.
												</em>
											</small>
									</p>
                            </div>

                            <div class="form-group" id="e_date">
                                <div class="input-group">
                                    <span class="input-group-addon">Negitive Marking:</span>
										<select class="form-control" name="e_date" >
														<option  value="">::: Select Negitive Marking :::</option>
														<option  value="0">No Negitive Marking</option>
														<option value="0.25">1:4(one wrong answer '0.25' marks reduced)</option>
														<option value="0.33">1:3(one wrong answer '0.33' marks reduced)</option>
														<option value="0.50">1:2(one wrong answer '0.50' marks reduced)</option>
														<option value="1">1:1(one wrong answer '1' marks reduced)</option>
										</select>
                                </div>
                                
										<p id="e_date" style="display:none;">
											<span id="e_date"></span>
											<small>
												<em>
													Please Select Negitive Marking!
												</em>
											</small>
										</p>
                            </div>

                        </div>
                        <div class="modal-footer clearfix">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" id="exam-1" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> Create Exam</button>
                            <button type="submit" id="exam-2" class="btn btn-primary pull-left" data-dismiss="modal" data-toggle="modal" data-target="#status-modal" style="display:none;"><i class="fa fa-edit"></i> Confirm It</button>
                            <button type="reset" class="btn btn-danger pull-left"><i class="fa fa-reply"></i> Reset Fields</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <!-- Status Of Creating Exam
        <div class="modal fade" id="status-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-tasks"></i> Operation Status </h4>
                    </div>
                    <div class="modal-body">
			    <div class="row">
				    <div class="col-md-12 col-sm-6 col-xs-6 text-center">
						    <input type="text" id="status-modal" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
						    <div class="knob-label">New Visitors</div>
				   </div><!-- ./col
			    </div>
			    <p class="text-light-blue" id="status-modal">
				    
			     </p>
		    </div>
                    <div class="modal-footer clearfix">
			    
		   </div>
		   </div><!-- /.modal-content
            </div><!-- /.modal-dialog 
        </div><!-- /.modal -->
		
		<script type="text/javascript" src="../includes/js/createExam.js"></script>
		
<?php 
}
else
{
	?>
	<script type="text/javascript">
				document.location.href="../";
	</script>
	<?php 
}
?>
