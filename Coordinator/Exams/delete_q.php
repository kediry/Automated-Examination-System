<?php
@session_start();
$user=@$_SESSION['user'];
if(@$user=="coordinator@aoes.com")
{
	include "../../includes/db.inc.php";
	$e_id = $_REQUEST["exam"];
	$q_no = $_REQUEST["q_no"];
	
		$q=mysql_query("use $e_id") or die(mysql_error());
		if($q)
		{
			$query="delete from questions where qid=$q_no";
			$result=mysql_query($query)or die(mysql_error());
			if($result)
			{
				$q2=mysql_query("select count(*) from questions")or die(mysql_error());
				$q3=mysql_query("select count(ans) from questions where ans <> 'NULL'")or die(mysql_error());
				if($q2&&$q3)
				{
					$r2=mysql_fetch_row($q2)or die(mysql_error());
					$r3=mysql_fetch_row($q3)or die(mysql_error());
					$status1=$r2[0];
					$status2=$r3[0];
					$q=mysql_query("use aoes") or die(mysql_error());
					if($q)
					{
						$q1=mysql_query("UPDATE exams SET paper_status ='$status1', key_status='$status2' WHERE id='$e_id'") or die(mysql_error());
						echo "success";  
					}
				}
			}
		}
}
?>


