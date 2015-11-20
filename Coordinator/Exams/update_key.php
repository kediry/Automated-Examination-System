<?php
@session_start();
$user=@$_SESSION['user'];
if(@$user=="coordinator@aoes.com")
{
	include "../../includes/db.inc.php";
	$e_id = $_REQUEST["exam"];
	$q_no = $_REQUEST["q_no"];
	$key=	$_REQUEST["key"];
	//Storing into database
		$options=array("","A", "B", "C", "D", "E", "F", "G", "H");
		$opp=array("", "a", "b", "c", "d", "e", "f", "g", "h");
		$q=mysql_query("use $e_id") or die(mysql_error());
		if($q)
		{
			$query="update questions set ans='$key' where qid=$q_no";
			$result=mysql_query($query)or die(mysql_error());
			if($result)
			{
				$q2=mysql_query("select count(ans) from questions where ans <> 'NULL'")or die(mysql_error());
				if($q2)
				{
					$r2=mysql_fetch_row($q2)or die(mysql_error());
					$status=$r2[0];
					$q=mysql_query("use aoes") or die(mysql_error());
					if($q)
					{
						$q1=mysql_query("UPDATE exams SET key_status ='$status' WHERE id='$e_id'") or die(mysql_error());
						echo "success";  
					}
				}
			}
		}
}
?>

