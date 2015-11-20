$(document).ready(function(){
});

$("button[type='reset']").click(function()
{
	$("input[name='e_id']").val("").removeClass("checked");
	$("input[name='e_name']").val("").removeClass("checked");
	$("select[name='e_type']").val("").removeClass("checked");
	$("input[name='e_date']").val("").removeClass("checked");
	$("input[name='e_duration']").val("").removeClass("checked");
	$("input[name='no_questions']").val("").removeClass("checked");
	$("input[name='e_pass']").val("").removeClass("checked");
	$("input[name='e_pass1']").val("").removeClass("checked");
	$("input[name='e_inv']").val("").removeClass("checked");


	$("div[id='e_id']").attr("class","form-group");
	$("div[id='e_name']").attr("class","form-group");
	$("div[id='e_type']").attr("class","form-group");
	$("div[id='e_date']").attr("class","form-group");
	$("div[id='e_duration']").attr("class","form-group");
	$("div[id='no_questions']").attr("class","form-group");
	$("div[id='e_pass']").attr("class","form-group");
	$("div[id='e_pass1']").attr("class","form-group");
	$("div[id='e_inv']").attr("class","form-group");
});
			
			$("input[name='e_name']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='e_name']");
				span=$("span[id='e_name']");
				p=$("p[id='e_name']");
				if(val.val().length>4)  
				{
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
					
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.addClass("text-danger").fadeOut("slow");
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("input[name='e_id']").focusout(function()
			{
				letters = /^[a-zA-Z]+[a-zA-Z0-9\_]+[a-zA-Z0-9]+$/;
				val=$(this);
				div=$("div[id='e_id']");
				span=$("span[id='e_id']");
				p=$("p[id='e_id']");
				err="<small><em>Exam ID should be alphabets or alphanumaric.<br>'_' is allowed and it should contain atleast 4 letters.<br>Ex: Maths_test_1,  Test1, Maths_test, MathsTest.</em></small>";
				if((val.val().length>=4) && (val.val().match(letters)))  
				{
					div.attr("class","form-group has-success has-feedback");
					p.show();
					p.attr("class","text-primary");
					p.html("<small><em><img src='../includes/img/check_load.gif' />&emsp; Checking Availability...</em></small>");
					$.ajax({
						type: "GET",
						async: false,
						url: "./Create_Exam/check.php",
						data: "checkId=yes&examId="+val.val(),
						dataType: "text",
						success:function(res)
						{
								if(res.indexOf("not_exist")!=-1)
								{
									p.html("<small><em>OK, Checked. you can use <b>"+val.val()+"</b></em></small>").attr("class","text-success");
									span.attr("class","glyphicon glyphicon-ok form-control-feedback");
									if(val.hasClass("checked"))
									{
									}
									else
									{
										val.attr("class","form-control checked");
									}
								}
								else if(res.indexOf("exist")!=-1)
								{
									p.attr("class","text-danger");
									p.html("<small><em><b>"+val.val()+"</b> is Already exist. Try to choose different ID.</em></small>");
									div.attr("class","form-group has-error has-feedback");
									span.attr("class","glyphicon glyphicon-remove form-control-feedback");
								}
								else
								{
									alert("Some Thing wrong! with database contact Administrator!");
								}
						},
						error:function(xhr,status,error)
						{
							alert(error);
						}
					});
					p.show();
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.attr("class","text-danger").fadeIn("slow");
					p.html(err);
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("select[name='e_type']").focusout(function()
			{
				val=$(this);
				div=$("div[id='e_type']");
				span=$("span[id='e_type']");
				p=$("p[id='e_type']");
				if(val.val()!="")  
				{
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.fadeOut("slow");
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("input[name='no_questions']").focusout(function()
			{
				letters = /^[0-9]+$/;
				val=$(this);
				div=$("div[id='no_questions']");
				span=$("span[id='no_questions']");
				p=$("p[id='no_questions']");
				if((val.val()!="")&&(val.val().match(letters)))  
				{
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.fadeOut("slow");
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("input[name='e_duration']").focusout(function()
			{
				letters = /^[0-9]+$/;
				val=$(this);
				div=$("div[id='e_duration']");
				span=$("span[id='e_duration']");
				p=$("p[id='e_duration']");
				if((val.val().length>0)&&(val.val().match(letters)))  
				{
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.fadeOut("slow");
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("input[name='e_pass']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='e_pass']");
				span=$("span[id='e_pass']");
				p=$("p[id='e_pass']");
				if(val.val().length>=4)  
				{
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.fadeOut("slow");
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("input[name='e_pass1']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='e_pass1']");
				span=$("span[id='e_pass1']");
				p=$("p[id='e_pass1']");
				pass=$("input[name='e_pass']");
				if((val.val().length>=4)&&(val.val()==pass.val()))  
				{
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.fadeOut("slow");
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("input[name='e_inv']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='e_inv']");
				span=$("span[id='e_inv']");
				p=$("p[id='e_inv']");
				if(val.val().length>=4)  
				{
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.fadeOut("slow");
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("select[name='e_date']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='e_date']");
				span=$("span[id='e_date']");
				p=$("p[id='e_date']");
				if(val.val()!="")  
				{
					div.attr("class","form-group has-success has-feedback");
					span.attr("class","glyphicon glyphicon-ok form-control-feedback");
					p.fadeOut("slow");
					if(val.hasClass("checked"))
					{
					}
					else
					{
						val.attr("class","form-control checked");
					}
				}
				else
				{
					div.attr("class","form-group has-error has-feedback");
					span.attr("class","glyphicon glyphicon-remove form-control-feedback");
					p.addClass("text-danger").fadeIn("slow");
					if(val.hasClass("checked"))
					{
						val.attr("class","form-control");
					}
					else
					{
					}
				}
			});

			$("input[type='reset']").click(function()
			{
				CreateExamGo();
			});

function ValidateExam()
{
	e_name=$("input[name='e_name']");
	e_id=$("input[name='e_id']");
	e_type=$("select[name='e_type']");
	no_q=$("input[name='no_questions']");
	e_duration=$("input[name='e_duration']");
	e_pass=$("input[name='e_pass']");
	e_pass1=$("input[name='e_pass1']");
	e_inv=$("input[name='e_inv']");
	e_date=$("select[name='e_date']");
	if(e_name.hasClass("checked"))
	{
		if(e_id.hasClass("checked"))
		{
			if(e_type.hasClass("checked"))
			{
				if(no_q.hasClass("checked"))
				{
					if(e_duration.hasClass("checked"))
					{
						if(e_pass.hasClass("checked"))
						{
							if(e_pass1.hasClass("checked"))
							{
								if(e_inv.hasClass("checked"))
								{
									if(e_date.hasClass("checked")||e_date.val()!="")
									{
										$("button[type='submit'][id='exam-1']").css({"display":"none"});
										$("button[type='submit'][id='exam-2']").show();
											$("button[type='submit'][id='exam-2']").click(function(){
												
												$(this).css({"display":"none"});
												$("button[type='submit'][id='exam-1']").show();
											
												CreateExam();
											
											});
									}
									else
									{
										$("div[id='e_date']").attr("class","form-group has-error has-feedback");
										$("span[id='e_date']").attr("class","glyphicon glyphicon-remove form-control-feedback");
										$("p[id='e_date']").addClass("text-danger").fadeIn("slow");
										e_date.focus();
										return false;
									}
								}
								else
								{
									$("div[id='e_inv']").attr("class","form-group has-error has-feedback");
									$("span[id='e_inv']").attr("class","glyphicon glyphicon-remove form-control-feedback");
									$("p[id='e_inv']").addClass("text-danger").fadeIn("slow");
									e_inv.focus();
									return false;
								}
							}
							else
							{
								$("div[id='e_pass1']").attr("class","form-group has-error has-feedback");
								$("span[id='e_pass1']").attr("class","glyphicon glyphicon-remove form-control-feedback");
								$("p[id='e_pass1']").addClass("text-danger").fadeIn("slow");
								e_pass1.focus();
								return false;
							}
						}
						else
						{
							$("div[id='e_pass']").attr("class","form-group has-error has-feedback");
							$("span[id='e_pass']").attr("class","glyphicon glyphicon-remove form-control-feedback");
							$("p[id='e_pass']").addClass("text-danger").fadeIn("slow");
							e_pass.focus();
							return false;
						}
					}
					else
					{
						$("div[id='e_duration']").attr("class","form-group has-error has-feedback");
						$("span[id='e_duration']").attr("class","glyphicon glyphicon-remove form-control-feedback");
						$("p[id='e_duration']").addClass("text-danger").fadeIn("slow");
						e_duration.focus();
						return false;
					}
				}
				else
				{
					$("div[id='no_questions']").attr("class","form-group has-error has-feedback");
					$("span[id='no_questions']").attr("class","glyphicon glyphicon-remove form-control-feedback");
					$("p[id='no_questions']").addClass("text-danger").fadeIn("slow");
					no_q.focus();
					return false;
				}
			}
			else
			{
				$("div[id='e_type']").attr("class","form-group has-error has-feedback");
				$("span[id='e_type']").attr("class","glyphicon glyphicon-remove form-control-feedback");
				$("p[id='e_type']").addClass("text-danger").fadeIn("slow");
				e_type.focus();
				return false;
			}
		}
		else
		{
			$("div[id='e_id']").attr("class","form-group has-error has-feedback");
			$("span[id='e_id']").attr("class","glyphicon glyphicon-remove form-control-feedback");
			$("p[id='e_id']").addClass("text-danger").fadeIn("slow");
			e_id.focus();
			return false;
		}
	}
	else
	{
		$("div[id='e_name']").attr("class","form-group has-error has-feedback");
		$("span[id='e_name']").attr("class","glyphicon glyphicon-remove form-control-feedback");
		$("p[id='e_name']").addClass("text-danger").fadeIn("slow");
		e_name.focus();
		return false;
	}
return false;
}
