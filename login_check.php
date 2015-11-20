<?php
include "./includes/db.inc.php";
session_start();
if(isSet($_REQUEST["submit"]))
{
	$user=$_REQUEST["user"];
	$pass=$_REQUEST["pass"];
	$submit=$_REQUEST["submit"];
	$q="select fname,passwd from accounts where uname='$user'";
	$q1=mysql_query($q) or die(mysql_error());
	if(mysql_affected_rows()>0)
	{
		$r=mysql_fetch_row($q1);
		if($pass==$r[1])
		{
			if($user=="coordinator@aoes.com")
			{
				$_SESSION['user']=$user;
				$_SESSION['fname']=$r[0];
				echo "./Coordinator/";
			}
			else
			{
				$_SESSION["user"]=$user;
				$_SESSION["e-user"]=$user;
				$_SESSION["login"]="user";
				$_SESSION["fname"]=$r[0];
				echo "./User/";
			}
		}
		else
		{
			echo "error_2";
		}
	}
	else
	{
		echo "error_1";
	}
}
