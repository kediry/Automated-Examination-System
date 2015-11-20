$(document).ready(function(){
});

			$("input[name='fullname']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='fullname']");
				span=$("span[id='fullname']");
				p=$("p[id='fullname']");
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
			
			
			$("input[name='email']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='email']");
				span=$("span[id='email']");
				p=$("p[id='email']");
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
			
			
			$("input[name='pwd']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='pwd']");
				span=$("span[id='pwd']");
				p=$("p[id='pwd']");
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
			
			$("input[name='pwd1']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='pwd1']");
				span=$("span[id='pwd1']");
				p=$("p[id='pwd1']");
				if((val.val()!="")&&($("input[name='pwd']").val()==$(this).val()))  
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
					p.html("Both passwords Should Match and Not Null !");
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
			
			$("select[name='gender']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='gender']");
				span=$("span[id='gender']");
				p=$("p[id='gender']");
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
			
			
			$("input[name='dob']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='dob']");
				span=$("span[id='dob']");
				p=$("p[id='dob']");
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
			
			
			$("input[name='edu']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='edu']");
				span=$("span[id='edu']");
				p=$("p[id='edu']");
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
			
			
			$("textarea[name='add']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='add']");
				span=$("span[id='add']");
				p=$("p[id='add']");
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
			
			
			$("input[name='pno']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='pno']");
				span=$("span[id='pno']");
				p=$("p[id='pno']");
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
			
			
			$("input[name='secure']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='secure']");
				span=$("span[id='secure']");
				p=$("p[id='secure']");
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
			
			
			$("input[name='ans']").focusout(function()
			{
				//letters = /^[A-z]+[\s\d\-]?[A-z]*[\s\d\-]?[0-9]*$/;
				val=$(this);
				div=$("div[id='ans']");
				span=$("span[id='ans']");
				p=$("p[id='ans']");
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
			
			
			








				
