<?php
	session_start();
	if(isSet($_REQUEST['signout']))
	{
		if($_REQUEST['signout']=="yes")
		{
			unset($_SESSION['user']);
			unset($_SESSION['e-user']);
			unset($_SESSION['login']);
			unset($_SESSION['exam_user']);
			?>
			<script type="text/javascript">
				document.location.href="../";
			</script>
			<?php 
		}
	}
	if(@isSet($_REQUEST['changepass']) && $_REQUEST['changepass']=="yes")
	{
		$oldp=str_replace("'","\'",$_REQUEST['old']);
		$np=str_replace("'","\'",$_REQUEST['npass']);
		if(isSet($_SESSION['e-user']))
		{
			include "../includes/db.inc.php";
			$user=$_SESSION['e-user'];
			mysql_query("select * from accounts where uname='$user' and passwd='$oldp'") or die(mysql_error());
			if(mysql_affected_rows()>0)
			{
				if(mysql_query("update accounts set passwd='$np' where uname='$user'"))
				{
					echo "success";
				}
				else
				{
					echo mysql_error();
				}
			}
			else
			{
				echo "olderror";
			}
			
		}
		
	}
?>
