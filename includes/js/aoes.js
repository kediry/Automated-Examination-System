$(document).ready(function(){
});

function CreateExam()
{
	e_id=$("input[name='e_id']").val();
	e_name=$("input[name='e_name']").val();
	e_type=$("select[name='e_type']").val();
	e_ngm=$("select[name='e_date']").val(); //negitive marks
	e_duration=$("input[name='e_duration']").val();
	no_questions=$("input[name='no_questions']").val();
	e_pass=$("input[name='e_pass']").val();
	e_inv=$("input[name='e_inv']").val();
	
	$.ajax({
					type : "POST",
					//async : false,
					url : "./Create_Exam/create_exam.php",
					data : "id="+e_id+"&name="+e_name+"&type="+e_type+"&no_questions="+no_questions+"&date="+e_ngm+"&duration="+e_duration+"&e_pass="+e_pass+"&e_inv="+e_inv,
					dataType : "text",

					xhr: function()
				      {
					var xhr = new window.XMLHttpRequest();
					//Download progress
					xhr.addEventListener("progress", function(evt){
					  if (evt.lengthComputable) {
					    var percentComplete = evt.loaded / evt.total;
					    $('#progressCounter').html(Math.round(percentComplete * 100) + "%");
					    console.log(Math.round(percentComplete * 100) + "%");
					  }
					}, false);
					
					//Upload Progress
					xhr.upload.addEventListener("progress", function(evt){
					  if (evt.lengthComputable) {
					    var percentComplete = evt.loaded / evt.total;
					    $('#progressCounter').html(Math.round(percentComplete * 100) + "%");
					    console.log(Math.round(percentComplete * 100) + "%");
					  }
					}, false);
					
					return xhr;
				      },
				      beforeSend: function()
				      {
					play = false;
					$("div[class='row'][id='alerts']").append(""
						+"<div class='alert alert-info alert-dismissable'>"
						+"<i class='fa fa-info'></i>"
						+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
						+"<div id='alert-content'>"+"<b>Information</b> : <p id='loading'> Loading: <span id='progressCounter'>0%</span></p>"+"</div>"
						+"</div>").show("fast"); 
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success") != -1)
							{
								response="<b>"+e_name+"</b>( "+e_id+" ) Exam was Successfully Created !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast"); 
								
								$("input[name='e_id']").val("").removeClass("checked");
								$("input[name='e_name']").val("").removeClass("checked");
								$("select[name='e_type']").val("").removeClass("checked");
								$("select[name='e_date']").val("").removeClass("checked");
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
							}
							else
							{
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-danger alert-dismissable'>"
								+"<i class='fa fa-warning'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast"); 
							}
							
						/*$("div#form").hide(3000);
						$("div#status").show(3000);
						$("div#status").html(response);*/
					},
					error: function(xhr,status,error)
					{	
						$("div[class='row'][id='alerts']").append(""
						+"<div class='alert alert-danger alert-dismissable'>"
						+"<i class='fa fa-ban'></i>"
						+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
						+"<div id='alert-content'>"+"<b> Error : </b>"+"xhr: "+xhr+"| status: "+status+"| error: "+error+"</div>"
						+"</div>").show("fast"); 
					}
				});			
	return false;
}

function MainLogin()
{
	user=$("input[name='user']").val();
	pass=$("input[name='pass']").val();
	signin=$("input[name='signin']").val();
	$.ajax({
		type: "POST",
		async : false,
		url : "login_check.php",
		data : "user="+user+"&pass="+pass+"&submit="+signin,
		dataType: "text",
		success : function(res)
		{
			if(res.indexOf("error_1")!=-1)
			{
				$("span[id='login_error']").html("Not valid email or email not registered !");
				$("div[id='login_error']").show("slow");
				$("input[name='user']").focus().css("border", "1px solid red");
				$("input[name='user']").val("");
				$("input[name='pass']").val("");
			}
			else if(res.indexOf("error_2")!=-1)
			{
				
				$("span[id='login_error']").html("Password is not valid make sure your password !");
				$("div[id='login_error']").show("slow");
				$("input[name='pass']").focus().css("border", "1px solid red");
				$("input[name='pass']").val("");
			}
			else if(res.indexOf("Coordinator")!=-1)
			{
				document.location.href=res;
			}
			else if(res.indexOf("User")!=-1)
			{
				document.location.href=res;
			}
			else
			{
				$("span[id='login_error']").html(res);
				$("div[id='login_error']").show("slow");
			}
		},
		error : function (xhr,status,error)
		{
				$("span[id='login_error']").html(status+" : "+error);
				$("div[id='login_error']").show("slow");
		}
	});
	return false;
}
