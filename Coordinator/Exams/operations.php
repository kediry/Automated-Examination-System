<?php
@session_start();
$user=@$_SESSION['user'];
if(@$user=="coordinator@aoes.com")
{
	include "../../includes/db.inc.php";
	$e_id=$_REQUEST["e_id"];
	$pass=$_REQUEST["pass"];
	$operation=$_REQUEST["operation"];

	$query=mysql_query("select passwd from accounts where uname='coordinator@aoes.com'")or die(mysql_error());
	if($query)
	{
		$result=mysql_fetch_row($query) or die(mysql_error());
		if($pass==$result[0])
		{
			switch ($operation)
			{
				case "delete":
					deleteExam($e_id);
					break;
			}
		}
		else
		{
			echo "PASS_ERROR";
		}
	}
}

function deleteExam($e_id)
{
	$q=mysql_query("DROP DATABASE $e_id") or die(mysql_error());
	$q1=mysql_query("DELETE FROM exams where id='$e_id'") or die(mysql_error());
	if($q&&$q1)
	{
		if(removeFolder("../../Exams/$e_id/"))
		{
			echo "success";
		}
		else
		{
			echo "FAIL TO DELETE FOLDER";
		}
	}
}

function removeFolder($dir)
{
		$files=array_diff(scandir($dir), array('.', '..'));
		foreach ($files as $file)
		{
			(is_dir("$dir/$file")) ? removeFolder("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
}
