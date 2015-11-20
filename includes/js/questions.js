function openModal(elem)
{
	$("div[id='modal-"+elem+"']").modal("show");
}

function upModal(elem)
{
	$("div[id='modal-"+elem+"-up']").modal("show");
}

function deleteModal(elem)
{
	$("div[id='modal-"+elem+"-delete']").modal("show");
}

function openModall(elem,msg)
{
	$("div[id='modal-"+elem+"'] li").removeClass('active');
	$("div[id='modal-"+elem+"'] div[class='tab-pane']").removeClass('active');
	$("div[id='modal-"+elem+"']").modal("show");
	if(msg=="txt")
	{
		$("div[id='modal-"+elem+"'] li[id='tab-1']").addClass('active');
		$("div[id='modal-"+elem+"'] div[class='tab-pane'][id='tab_1-1']").addClass('active');
	}
	else if(msg=="img")
	{
		$("div[id='modal-"+elem+"'] li[id='tab-2']").addClass('active');
		$("div[id='modal-"+elem+"'] div[class='tab-pane'][id='tab_2-2']").addClass('active');
	}
	else
	{
	}
}

function textQuestion(num,exam)
{
	q_no=num;
	no_options=$("select[name='no_o-"+num+"']").val();
	question=$("textarea[name='question-"+num+"']").val();
	question=question.replace('+','@plus@');
	options="";
	for(i=1;i<=no_options;i++)
	{
		options+="&op"+i+"="+$("input[name='op-"+i+"-"+num+"']").val().replace('+','@plus@');
	}
	$.ajax({
		type: "POST",
		url: "./Exams/insert_txt.php",
		data:"exam="+exam+"&q_no="+q_no+"&no_options="+no_options+"&question="+question+options,
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
						$("div[id='modal-"+num+"']").modal("hide");
						
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success")!= -1)
							{
								response="<b>Question-"+num+"</b> was Successfully Inserted !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");

								$("div[id='main-content']").load("./Exams/questions.php?id="+exam);
								window.scrollTop;
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
					}
	});
	return false;
}


function imgQuestion(num,exam)
{
	q_no=num;
	var formData = new FormData($("form[id='form-"+num+"']")[0]);
	$.ajax({
		type: "POST",
		url: "./Exams/insert_img.php",
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
						$("div[id='modal-"+num+"']").modal("hide");
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success") != -1)
							{
								response="<b>Question-"+num+"</b> was Successfully Inserted !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");

								$("div[id='main-content']").load("./Exams/questions.php?id="+exam);
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


function updateTextQuestion(num,exam)
{
	q_no=num;
	no_options=$("select[name='no_o-"+num+"']").val();
	question=$("textarea[name='question-"+num+"']").val();
	question=question.replace('+','@plus@');
	options="";
	for(i=1;i<=no_options;i++)
	{
		options+="&op"+i+"="+$("input[name='op-"+i+"-"+num+"']").val().replace('+','@plus@');
	}
	$.ajax({
		type: "POST",
		url: "./Exams/update_txt.php",
		data:"exam="+exam+"&q_no="+q_no+"&no_options="+no_options+"&question="+question+options,
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
						$("div[id='modal-"+num+"']").modal("hide");
						
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success")!= -1)
							{
								response="<b>Question-"+num+"</b> was Successfully Updated !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");

								$("div[id='main-content']").load("./Exams/questions.php?id="+exam);
								window.scroll(0,0);
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
					}
	});
	return false;
}


function updateImgQuestion(num,exam)
{
	q_no=num;
	var formData = new FormData($("form[id='form-"+num+"']")[0]);
	$.ajax({
		type: "POST",
		url: "./Exams/update_img.php",
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
						$("div[id='modal-"+num+"']").modal("hide");
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success") != -1)
							{
								response="<b>Question-"+num+"</b> was Successfully Updated !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");

								$("div[id='main-content']").load("./Exams/questions.php?id="+exam);
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


function updateKey(num,exam)
{
	q_no=num;
	var formData = new FormData($("form[id='form-"+num+"-key']")[0]);
	$.ajax({
		type: "POST",
		url: "./Exams/update_key.php",
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
						$("div[id='modal-"+num+"-up']").modal("hide");
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success") != -1)
							{
								response="<b>Question-"+num+"</b> Key was Successfully Updated !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");
								
								$("div[id='main-content']").load("./Exams/questions.php?id="+exam);
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

function deleteQuestion(num, exam)
{
	q_no=num;
	
	$.ajax({
		type: "POST",
		url: "./Exams/delete_q.php",
		data:"exam="+exam+"&q_no="+q_no,
		dataType : "text",
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
						$("div[id='modal-"+num+"-delete']").modal("hide");
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					
					success: function(response)
					{
							if(response.indexOf("success") != -1)
							{
								response="<b>Question-"+num+"</b> Key was Successfully Deleted !";
								
								$("div[class='row'][id='alerts']").append(""
								+"<div class='alert alert-success alert-dismissable'>"
								+"<i class='fa fa-check'></i>"
								+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button>"
								+"<div id='alert-content'>"+response+"</div>"
								+"</div>").show("fast");
								
								$("div[id='main-content']").load("./Exams/questions.php?id="+exam);
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
					}
		});
	return false;
}
