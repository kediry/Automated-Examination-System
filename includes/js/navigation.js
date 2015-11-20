function NavigateTo(elem)
{
	$.ajax({
					type: "GET",
					url: elem,
					data:"#",
					dataType:"text",
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
						+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"
						+"<div id='alert-content'>"+"<b>Information</b> : <p id='loading'> Loading: <span id='progressCounter'>0%</span></p>"+"</div>"
						+"</div>").show("fast"); 
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					success:function(response)
					{
						$("div[id='main-content']").html(response);
						
						if(elem.search("/Exams/index.php"))
						{
							$("ul[class='sidebar-menu'] li").removeClass("active");
							$("ul[class='sidebar-menu'] li:contains('Exams')").addClass("active");
							$("section[class='content-header']").html("<h1>Exams<small>Control Panel</small></h1>");
						}
					},
					error:function(xhr,status,error)
					{
						$("div[class='row'][id='alerts']").append(""
						+"<div class='alert alert-danger alert-dismissable'>"
						+"<i class='fa fa-ban'></i>"
						+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"
						+"<div id='alert-content'>"+"<b> Error : </b>"+"xhr: "+xhr+"| status: "+status+"| error: "+error+"</div>"
						+"</div>").show("fast"); 
					}
	});
}

function QuestionPaper(elem, name)
{
	$.ajax({
					type: "GET",
					url: "./Exams/questions.php?id="+elem,
					data:"#",
					dataType:"text",
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
						+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"
						+"<div id='alert-content'>"+"<b>Information</b> : <p id='loading'> Loading: <span id='progressCounter'>0%</span></p>"+"</div>"
						+"</div>").show("fast"); 
				      },
				      complete  : function(){
					$("div[class='alert alert-info alert-dismissable']").remove();
				      },
					success:function(response)
					{
						$("div[id='main-content']").html(response);
						
						if(elem.search("/Exams/index.php"))
						{
							$("ul[class='sidebar-menu'] li").removeClass("active");
							$("ul[class='sidebar-menu'] li:contains('Exams')").addClass("active");
						}
						$("section[class='content-header']").html("<h1>"+name+"<small>"+elem+"</small></h1>");
					},
					error:function(xhr,status,error)
					{
						$("div[class='row'][id='alerts']").append(""
						+"<div class='alert alert-danger alert-dismissable'>"
						+"<i class='fa fa-ban'></i>"
						+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"
						+"<div id='alert-content'>"+"<b> Error : </b>"+"xhr: "+xhr+"| status: "+status+"| error: "+error+"</div>"
						+"</div>").show("fast"); 
					}
	});
}
