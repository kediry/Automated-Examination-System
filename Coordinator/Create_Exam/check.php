<?php
@session_start();
$user=@$_SESSION['user'];
if($user=="coordinator@aoes.com")
{
		include "../../includes/db.inc.php";
		if($_REQUEST['checkId']=="yes")
		{
			$id=$_REQUEST['examId'];
			$q=mysql_query("show databases")or die(mysql_error());
			$c=0;
			if(mysql_affected_rows()>0)
			{
				while($r=mysql_fetch_array($q))
				{
					if(strcasecmp($id,$r[0])==0)
					{
						$c=$c+1;
						break;
					}
				}
			}
			$q=mysql_query("select name from exams where id='$id'")or die(mysql_error());
			if(mysql_affected_rows()>0)
			{
				$c=$c+1;
			}
			if(strnatcasecmp($id, "source")==0)
			{
				$c=$c+1;
			}
			if($c>0)
			{
				echo "exist";
			}
			else
			{
				echo "not_exist";
			}
		}
}
else
{
}
?>
