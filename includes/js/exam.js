function openModal_exam(id)
{
	$("div[id='delete_exam-"+id+"']").modal("show");
}

function deleteExam(id)
{
	var formData = new FormData($("form[id='delete_exam-"+id+"']")[0]);
	$.ajax({
		type: "POST",
		url: "./Exams/operations.php",
		data: formData,
		async : false,

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
						$("div[id='delete_exam-"+id+"']").modal("hide");
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success") != -1)
							{
								response="<b>Exam: "+id+"</b> was Successfully Deleted !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");

								$("div[id='main-content']").load("./Exams/index.php");
							}
							else if(response.indexOf("PASS_ERROR") != -1)
							{
								response="<b>Password</b> Missmatch !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-danger alert-dismissable'>"
								+"<i class='glyphicon glyphicon-remove'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");
							}
							else
							{
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-warning alert-dismissable'>"
								+"<i class='fa fa-warning'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast"); 
							}
					},
					error: function(xhr,status,error)
					{	
						$("div[class='row'][id='alerts']").append(""
						+"<div class='alert alert-danger alert-dismissable'>"
						+"<i class='fa fa-ban'></i>"
						+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
						+"<div id='alert-content'>"+"<b> Error : </b>"+"xhr: "+xhr+"| status: "+status+"| error: "+error+"</div>"
						+"</div>").show("fast"); 
					},
					cache: false,
					contentType: false,
					processData: false
	});
	return false;
}

function examStatus(elem, op)
{
	$.ajax({
					type : "POST",
					async : false,
					url : "./Exams/operations-1.php",
					data : "id="+elem+"&operation="+op,
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
								response="<b>Operation </b>Success  !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast"); 
								
								$("div[id='main-content']").load("./Exams/index.php");
								
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
