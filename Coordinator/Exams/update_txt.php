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
	$opp=array("", "a", "b", "c", "d", "e", "f", "g", "h");
	for($i=1;$i<=$no_options;$i++)
	{
		$options[$i]=str_replace("'","\'",$_REQUEST["op$i"]);
		$options[$i]=str_replace("@plus@","+",$_REQUEST["op$i"]);
	}
	$q=mysql_query("use $e_id") or die(mysql_error());
	if($q)
	{
		$query="update questions set q='$question', nop=$no_options";
		for($i=1;$i<=8;$i++)
		{
			if($i<=$no_options)
			{
				$query=$query.", ".$opp[$i]."= '".$options[$i]."'";
			}
			else
			{
				$query=$query.", ".$opp[$i]."= default ";
			}
		}
		$query=$query." where qid=$q_no";
		echo $query;
		$result=mysql_query($query)or die(mysql_error());
		if($result)
		{
			echo "success";
		}
	}
}
?>
