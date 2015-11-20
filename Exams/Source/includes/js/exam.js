function submitExam(n)
{
	count=0
	for(i=1;i<=n;i++)
	{
		if($("input[type='radio'][name='question-"+i+"']:checked").val())
		{
			count++;
		}
	}
	bootbox.confirm("<br><br><p class='text-danger'>You Answered <b>"+count+"</b> questions out of  <b>"+n+"</b></p><br> <i>Are you sure you want to submit ?</i>", function(confirm)
	{
		if(confirm)
		{
			sum=$("#submit-checksum").val();
			document.location='submit.php?submit='+sum;
		}
	});
}
function openBlur()
{
		$("#BlurCheck").modal("show");
}
function MainLogin()
{
	pass=$("input[name='pass']").val();
	signin=$("input[name='signin']").val();
	$.ajax({
		type: "POST",
		async : false,
		url : "login_check.php",
		data : "pass="+pass+"&submit="+signin,
		dataType: "text",
		success : function(res)
		{
			if(res.indexOf("error_2") != -1)
			{
				$("#error").css({"display" : "inline"});
				$("#error").html("Password Doesn't Matched! Check Again !");
			}
			else if(res.indexOf("error_1") != -1)
			{
				$("#error").css({"display" : "inline"});
				$("#error").html(res);
			}
			else if(res.indexOf("./exam.php") != -1)
			{
				document.location="./exam.php";
			}
			else
			{
				$("#error").css({"display" : "inline"});
				$("#error").html(res);
			}
		},
		error : function (xhr,status,error)
		{
			$("#error").css({"display" : "inline"});
			$("#error").html(xhr+" : "+status+" : "+error);
		}
	});
	return false;
}

function checkInv()
{
	pass=$("input[name='pass']").val();
	pass1=$("input[name='pass1']").val();
	exam=$("input[name='e_id']").val();
	$.ajax({
		type: "POST",
		async : false,
		url : "inv_check.php",
		data : "pass="+pass+"&pass1="+pass1+"&exam="+exam,
		dataType: "text",
		success : function(res)
		{
			if(res.indexOf("error_2") != -1)
			{
				bootbox.alert("<p class='text-danger'>Password Doesn't Matched! Check Again !</p>");
			}
			else if(res.indexOf("success") != -1)
			{
				$("input[name='pass']").val("");
				$("input[name='pass1']").val("");
				$("#Invigilator").modal("hide");
				$("#BlurCheck").modal("hide");
			}
			else
			{
				bootbox.alert(res);
			}
		},
		error : function (xhr,status,error)
		{
			bootbox.alert(xhr+" : "+status+" : "+error);
		}
	});
	return false;		
}

var mins,sec;
function timeStart(a,b)
{
if(a!=-1){
mins=a;
sec=b;
timer();
}
else
	{
		sum=$("#submit-checksum").val();
		window.location='submit.php?submit='+sum;
	}
}
function timer()
{

	sec=sec-1;
	
	if(sec==0)
		{
		mins=mins-1
		
		if(mins==-1)
			{
				sum=$("#submit-checksum").val();
				window.location='submit.php?submit='+sum;
			}	
		sec=60;
		}
	document.getElementById('timer').innerHTML=mins+" : "+sec;
	update();
	setTimeout("timer()",1000);

}

function update()
{
	$.ajax({
			 type    : "POST",
   			 async   : false,
			 url     : "saveTime.php",
			 data	 : "min="+mins+"&sec="+sec,
    			 dataType: "text",
			 success: function(html) {
				if(html==0)
					{
			    		
					}
				else
					{	
					
					}
				    },
			    error: function (xhr, status) { 
       					$('#pError').animate({opacity:'1'},1000,function(){});
					$('#pError').html("&nbsp;<font size=2 color=red>Connection was Not Established</font>");
				    }   
			});
}

function save(a,q,s)
{	
	var ans=$("input[type='radio'][name='"+a+"']:checked").val();
	$.ajax({
			 type    : "POST",
   			 async   : false,
			 url     : "save.php",
			 data	 : "sect="+s+"&q="+q+"&ans="+ans,
    			 dataType: "text",
			 success: function(html) {

				 $("button[name='nvb-"+q+"']").attr("class", "btn btn-info btn-xs");
				if(html==0)
					{
			    		
					}
				else
					{	
					
					}
				    },
			    error: function (xhr, status) {
       					$('#pError').animate({opacity:'1'},1000,function(){});
					$('#pError').html("&nbsp;<font size=2 color=red>Connection was Not Established</font>");
				    }   
			});

}
