<html>
	<link rel="stylesheet" type="text/css" href="./includes/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./includes/css/theme.css" />
<body>
<?php
if(isSet($_POST['submit']))
{
	include "./includes/db.inc.php";

	$fname=$_POST["fullname"];
	$email=$_POST["email"];
	$passwd=$_POST["pwd"];
	//$repasswd=$_POST["retypwd"];
	$gen=$_POST["gender"];
	$dob=$_POST["dob"];
	$edu=$_POST["edu"];
	$add=str_replace("'", "\'", $_POST["add"]);
	$pno=$_POST["pno"];
	$sq=str_replace("'", "\'", $_POST["secure"]);
	$ans=str_replace("'", "\'", $_POST["ans"]);
	$feedback="";
	$q=mysql_query("select * from accounts where uname='$email'")or die(mysql_error());
	if(mysql_affected_rows()>0)
	{
		$feedback="This $email was already registered! Choose Different Email!";
	}
	//echo "$fname, $uname, $passwd, $repasswd, $gen, $dob, $edu, $add, $email, $pno, $sq, $ans";
	if($feedback=="")
	{
		$q="insert into accounts values('$fname', '$email', '$passwd', '$gen', '$dob', '$edu', '$add', '$email', '$pno', '$sq', '$ans')";
		mysql_query($q);
		if(mysql_affected_rows()>0)
		{
			session_start();
			$_SESSION["user"]=$email;
			$_SESSION["e-user"]=$email;
			$_SESSION["fname"]=$fname;
			$_SESSION["login"]="user";
			?>
				<div class="panel panel-default col-md-6 col-md-offset-3">
					<div class="panel-heading">
						<h4>Successfully Registered !</h4>
					</div>
					<div class="panel-body">
						Please wait page redirecting to Your account in <span id="time">6</span> seconds.
					</div>
				</div>
				<script type="text/javascript" src="./includes/js/jquery.min.js"></script>
				<script type="text/javascript">
					var time=5;
					$(document).ready(function()
					{
						nani();
					});
					function nani()
					{
						if(time==0)
						{
							document.location="index.php"
						}
						$("#time").html(time);
						time=time-1;
						setTimeout("nani()",1000);
					}
				</script>
			<?php
			die();
		}
		else
		{
			$feedback=mysql_error();
		}
	}
}
?>		
				<br><br><br>
		<h1 class="col-md-offset-2">AOES User Registration</h1>
		<br>
		<div class="col-md-6 col-md-offset-3">
			<?php
				if(@(isSet($feedback))&&($feedback!=""))
				{
					?>
					<div class="alert alert-danger alert-dismissable">
					 <?php echo $feedback; ?>
					</div>
					<?php
				}
			?>
		<div class="panel panel-default">
			<div class="panel-heading">Input</div>
			<div class="panel-body">
				
	<form action="registration.php" method="POST" role="form" onsubmit="return ValidateExam()" autocomplete="on">
				
			<div class="form-group" id="fullname">
				<label class="control-label">FUll name</label>
				<input type="text" class="form-control" name="fullname" placeholder="" size="30" required  />
				<p id="fullname" style="displat:none;"></p>
			</div>
			

			<div class="form-group" id="email">
				<label class="control-label">Email</label>
				<input type="email" class="form-control" name="email" placeholder="" size="30" required  />
				<p id="email" style="displat:none;"></p>
			</div>			
			
			
			<div class="form-group" id="pwd">
				<label class="control-label">Password</label>
				<input type="password" class="form-control" name="pwd" placeholder="" size="30" required  />
				<p id="pwd" style="displat:none;"></p>
			</div>
			
			<div class="form-group" id="pwd1">
				<label class="control-label">Confirm Password</label>
				<input type="password" class="form-control" name="pwd1" placeholder="" size="30" required  />
				<p id="pwd1" style="displat:none;"></p>
			</div>

			
			<div class="form-group" id="gender">
				<label class="control-label">Gender</label>
				<select class="form-control" name="gender" required>
								<option  value="">::: Select gender :::</option>
								<option  value="M">Male</option>
								<option value="F">Female</option>
				</select>
				<p id="gender" style="displat:none;"></p>
			</div>
			
			
			<div class="form-group" id="dob">
				<label class="control-label">Date of Birth</label>
				<input type="date" class="form-control" name="dob" placeholder="" size="30" required />
				<p id="dob" style="displat:none;"></p>
			</div>
			
			
			<div class="form-group" id="edu">
				<label class="control-label">Education Qualification</label>
				<input type="text" class="form-control" name="edu" placeholder="" size="30" required  />
				<p id="edu" style="displat:none;"></p>
			</div>
			
			
			<div class="form-group" id="add">
				<label class="control-label">Address</label>
				<textarea type="text" class="form-control" name="add" placeholder="" rows=3 size="30" required ></textarea>
				<p id="add" style="displat:none;"></p>
			</div>
			
			
			<div class="form-group" id="pno">
				<label class="control-label">Phone Number</label>
				<input type="tel" class="form-control" name="pno" placeholder="" size="30" required  />
				<p id="pno" style="displat:none;"></p>
			</div>


			<div class="form-group" id="secure">
				<label class="control-label">Security Question</label>
				<input type="text" class="form-control" name="secure" placeholder="" size="30" required  />
				<p id="secure" style="displat:none;"></p>
			</div>
			
			
			<div class="form-group" id="ans">
				<label class="control-label">Answer</label>
				<input type="text" class="form-control" name="ans" placeholder="" size="30" required />
				<p id="ans" style="displat:none;"></p>
			</div>	
			
			</div>
			
			<div class="panel-footer">
				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="submit" value="SUBMIT" />
					<input class="btn btn-default" type="reset" name="submit" value="RESET FIELDS" />
				</div>
			</div>
			
			</form>


		</div>
		</div>
		
<script type="text/javascript" src="./includes/js/jquery.min.js"></script>
<script type="text/javascript" src="./includes/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./includes/js/userReg.js"></script>
</body>
</html>


