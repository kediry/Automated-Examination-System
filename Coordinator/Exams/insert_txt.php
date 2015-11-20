<?php
@session_start();
$user=@$_SESSION['user'];
if(@$user=="coordinator@aoes.com")
{
	include "../../includes/db.inc.php";
	$e_id=$_REQUEST["exam"];
	$q_no=$_REQUEST["q_no"];
	$no_options=$_REQUEST["no_options"];
	$question=str_replace("'","\'",$_REQUEST["question"]);
	$question=str_replace("@plus@","+",$question);
	$options[0]="";
	for($i=1;$i<=$no_options;$i++)
	{
		$options[$i]=str_replace("'","\'",$_REQUEST["op$i"]);
		$options[$i]=str_replace("@plus@","+",$_REQUEST["op$i"]);
	}
	$q=mysql_query("use $e_id") or die(mysql_error());
	if($q)
	{
		$query="insert into questions values($q_no, default, '$question', $no_options, default";
		for($i=1;$i<=8;$i++)
		{
			if($i<=$no_options)
			{
				$query=$query.", '".$options[$i]."'";
			}
			else
			{
				$query=$query.", default";
			}
		}
		$query=$query.")";
		$result=mysql_query($query)or die(mysql_error());
		if($result)
		{
			$q2=mysql_query("select count(*) from questions")or die(mysql_error());
			if($q2)
			{
				$r2=mysql_fetch_row($q2)or die(mysql_error());
				$status=$r2[0];
				$q=mysql_query("use aoes") or die(mysql_error());
				if($q)
				{
					$q1=mysql_query("UPDATE exams SET paper_status ='$status' WHERE id='$e_id'") or die(mysql_error());
					echo "success";  
				}
			}
		}
	}
}
?>
