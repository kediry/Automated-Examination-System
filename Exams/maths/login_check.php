<?php
@session_start();
include "./includes/user.php";
include "../../includes/db.inc.php";
if(isSet($_REQUEST["submit"]))
{
	include "./includes/default.php";
	$pass=$_REQUEST["pass"];
	$q="select pass from exams where id='$e_id'";
	$q1=mysql_query($q) or die(mysql_error());
	if(mysql_affected_rows()>0)
	{
		$r=mysql_fetch_row($q1);
		if($pass==$r[0])
		{
				$_SESSION['exam_user']=$user;
				$_SESSION['exam_id']=$e_id;
				$min=$e_duration-1;
				$sec=60;
				mysql_select_db($e_id)or die(mysql_error());
				//$user=str_replace(".", "\.", $user);
				$c=mysql_query("SELECT * FROM time where id='$user'")or die(mysql_error());
				if(mysql_affected_rows()==0)
				{
					mysql_query("INSERT INTO time VALUES($min,$sec,'$user')") or die(mysql_error());
				}
				echo "./exam.php";
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
